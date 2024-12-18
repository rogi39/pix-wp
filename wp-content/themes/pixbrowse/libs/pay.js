(function () {
    function createIframe(options) {
        const iframe = document.createElement("iframe");
        iframe.id = options.id;
        iframe.classList.add("psp-payform-widget");

        if (options.width)
            iframe.style.width = options.width;
        if (options.height)
            iframe.style.height = options.height;

        iframe.style.border = 0;
        iframe.scrolling = "no";
        iframe.style.position = "relative";
        iframe.style.boxSizing = "border-box";
        iframe.setAttribute("src", options.src);

        return iframe;
    }

    function getSafeURL(options) {
        if (options.display.mode === "embedded" || options.display.mode === "sandbox" || options.display.mode === "modal") {
            const formUrl = new URL(options.payUrl);
            formUrl.searchParams.set("mode", options.display.mode);
            return formUrl;
        } else if (options.display.mode === "secure" || options.display.mode === "secure-sandbox") {
            // local development
            if (window.location.host.includes("localhost:")) {
                const formUrl = new URL("/secure/index.html", window.location.origin);
                formUrl.host = formUrl.host.replace("pay.", "secure.");
                formUrl.port = window.location.host.includes("8888") ? "8889" : "8888";
                return formUrl;
            } else {
                let urlStr = document.getElementById("psp-widget-loader").src;
                urlStr = urlStr.replace("pay.", "secure.");
                return new URL(new URL(urlStr).origin);
            }
        }
        return null;
    }

    function getWidgetId(token) {
        return "psp-payform-widget-" + token
    }

    function createTyppedIframe(options) {
        const formUrl = getSafeURL(options);

        let payformIframe = null;
        switch (options.display.mode) {
            case "embedded":
                payformIframe = createIframe({
                    id: getWidgetId(formUrl.searchParams.get("token")),
                    width: "100%",
                    height: "800px",
                    src: formUrl,
                });
                break;

            case "sandbox":
                payformIframe = createIframe({
                    id: getWidgetId(formUrl.searchParams.get("token")),
                    width: "100%",
                    height: "800px",
                    src: formUrl,
                });
                break;

            case "secure":
            case "secure-sandbox":
                let secureMode = options.display.params?.pcidss ?? "full";

                let theme = options.display.params?.theme ?? "";

                formUrl.searchParams.set("mode", secureMode);
                formUrl.searchParams.set("theme", theme);

                payformIframe = createIframe({
                    id: getWidgetId(formUrl.searchParams.get("token")),
                    width: "100%",
                    height: "60px",
                    src: formUrl,
                });
                break;

            case "modal":
                payformIframe = createIframe({
                    id: getWidgetId(formUrl.searchParams.get("token")),
                    width: "475px",
                    height: "800px",
                    src: formUrl,
                });
                break;
            default:
                throw new SyntaxError("Error handling display.mode");
        }

        return payformIframe;
    }

    window.PSP = window.PSP || {};
    window.PSP.Widget = window.PSP.Widget || {};
    window.PSP.Widget.init = function (options) {
        const invalidOptionsCommon = "invalid options";
        if ((typeof options !== "object") || (typeof options.display !== "object") || (typeof options.display.mode !== "string")) {
            throw new TypeError(`${invalidOptionsCommon}: missing required fields`);
        } else if (options.display.mode != "modal" &&
            options.display.mode !== "embedded" &&
            options.display.mode !== "secure" &&
            options.display.mode !== "sandbox" &&
            options.display.mode !== "secure-sandbox"
        ) {
            throw new TypeError(`${invalidOptionsCommon}: invalid display.mode value`);
        }

        if ((options.display.mode === "embedded" || options.display.mode === "modal")) {
            if (!(options.payUrl?.length > 0)) {
                throw new TypeError(`${invalidOptionsCommon}: payUrl parameter is empty`);
            } else {
                try {
                    if (!(new URL(options.payUrl).searchParams.get("token")?.length > 0)) {
                        throw new Error();
                    }
                } catch (e) {
                    throw new TypeError(`${invalidOptionsCommon}: invalid payUrl value`);
                }
            }
        }

        let dst = null;
        let isCreatedWrapper = false;
        if (options.display.mode != "modal") {
            if (typeof options.display.params?.container == "string") {
                dst = document.getElementById(options.display.params?.container);
                if (!dst) {
                    throw new TypeError(`${invalidOptionsCommon}: invalid container id`);
                }
            } else if (options.display.params?.container instanceof HTMLElement) {
                dst = options.display.params?.container;
            }
            if (dst == null) {
                throw new TypeError(`${invalidOptionsCommon}: current display.mode requires display.params.container value`)
            }
        } else {
            isCreatedWrapper = true;
            dst = document.createElement("div");
            dst.id = "psp-payform-wrapper";
            dst.style.position = "absolute";
            dst.style.height = "100vh";
            dst.style.width = "100vw";
            dst.style.top = "0px";
            dst.style.left = "0px";
            dst.style.display = "flex";
            dst.style.justifyContent = "center";
            dst.style.alignItems = "center";
            dst.style.background = "rgba(35, 34, 34, 0.5)";
        }
        const widgetIframe = createTyppedIframe(options);

        // Payform messages listener
        function handleCloseEvent(e) {
            const payFormData = e.data;
            if (payFormData.action) {
                switch (payFormData.action) {
                    case "close":
                        widgetIframe.remove();
                        widgetIframe = null;
                        // also removes provided container
                        dst.innerHTML = null;
                        if (isCreatedWrapper) {
                            dst.remove();
                        }
                        window.removeEventListener("message", handleCloseEvent);
                        break;
                    default:
                        break;
                }
            }
        }
        window.addEventListener("message", handleCloseEvent);

        if (options.display.mode !== "secure" && options.display.mode !== "secure-sandbox") {
            widgetIframe.onload = (e) => {
                e.target.contentWindow.postMessage(JSON.stringify({
                    message: {
                        type: "WIDGET_THEME",
                        theme: options.display.theme,
                    }
                }), "*");
            }
        }

        dst.innerHTML = null;
        dst.appendChild(widgetIframe);
        // in provided HTMLElement case
        if (!document.contains(dst)) {
            document.body.appendChild(dst);
        }
    }
})();

/**
 * Usage example
 *
    <script charset="utf-8" src="https://pay.symoco.com/widget/payform.js" id="psp-widget-loader"></script>

    <!-- Container element (optional) -->
    <div id="mywidget"></div>

    <script charset="utf-8">
    SYMOCO.Widget.init({
        "display": {
        "mode": "modal",
        "options": {
            "container": "mywidget" | HTMLElement,
            "pcidss": "full",
        },
        "theme": {
            "name": "dark",
            "colors": {
            "bg": "#4a5b5b",
            "primary": "#313337",
            "secondary": "#009D8C",
            "info": "#fff",
            "label": "#fff",
            "danger": "#FF592C",
            "success": "#17BD98",
            "inactive": "#fff"
            }
        }
        },
        "payUrl": {PAY_URL}
    });
    </script>
 */