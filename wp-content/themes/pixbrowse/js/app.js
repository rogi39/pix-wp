document.addEventListener("DOMContentLoaded", function () {

	// Custom JS

});


const widthScrollBar = () => {
	let div = document.createElement("div");
	div.style.overflowY = "scroll";
	div.style.width = "50px";
	div.style.height = "50px";
	document.body.append(div);
	let scrollWidth = div.offsetWidth - div.clientWidth;
	div.remove();
	return scrollWidth;
}

const fadeIn = (el, timeout, display) => {
	el.style.opacity = 0;
	el.style.display = display || "block";
	el.style.transition = `opacity ${timeout}ms`;
	setTimeout(() => {
		el.style.opacity = 1;
	}, 10);
}

const fadeOut = (el, timeout) => {
	el.style.opacity = 1;
	el.style.transition = `opacity ${timeout}ms`;
	el.style.opacity = 0;
	setTimeout(() => {
		el.style.display = "none";
	}, timeout);
}


const wrapTagInDiv = (el, wrapClass = 'wrapclass') => {
	let div = document.createElement("div");
	div.classList.add(wrapClass);
	el.parentNode.insertBefore(div, el);
	div.appendChild(el);
}

const wrapVideoInContent = () => {
	let contents = document.querySelectorAll('.content');
	if (!contents) return false;
	contents.forEach(el => {
		let videos = el.querySelectorAll('iframe, video');
		videos.forEach(video => {
			wrapTagInDiv(video, 'video');
		});
		let tables = el.querySelectorAll('table');
		tables.forEach(table => {
			wrapTagInDiv(table, 'table-adaptive');
		});
	})
}
document.addEventListener("DOMContentLoaded", wrapVideoInContent);




const header = document.querySelector('.header');

const togglemenu = document.querySelector("#toggle-menu");
const menu = document.querySelector(".menu");
const overlay = document.querySelector('.header__overlay');
const menuClose = document.querySelector('.menu__close');
if (togglemenu) {
	togglemenu.addEventListener("click", openMenu);
	menuClose.addEventListener("click", closeMenu);
	overlay.addEventListener("click", closeMenu);
}

function openMenu() {
	togglemenu.classList.add("on");
	menu.classList.add("on");
	overlay.classList.add("active");
	document.body.classList.add("noscroll");
}

function closeMenu() {
	togglemenu.classList.remove("on");
	menu.classList.remove("on");
	overlay.classList.remove("active");
	document.body.classList.remove("noscroll");
}

window.addEventListener("resize", () => {
	if (window.outerWidth >= 768 && togglemenu) {
		closeMenu();
	}
});


let grid = document.querySelectorAll('.grid');
if (grid) {
	grid.forEach(el => {
		imagesLoaded(el, function () {
			var msnry = new Masonry(el, {
				percentPosition: true,
				gutter: '.grid__gutter',
				itemSelector: '.grid__item',
				// horizontalOrder: true
			});
		});
	});
}

const formMessageResponse = (check, msg = '') => {
	if (document.querySelector('.form-message-response')) document.querySelector('.form-message-response').remove();
	let div = document.createElement('div');
	div.classList.add('form-message-response');
	check === true ? div.classList.add('form-message-response__success') : div.classList.add('form-message-response__error');
	div.textContent = msg ? msg : (check === true ? 'Message sent successfully!' : 'Please fill in the required fields!');
	// div.textContent = 'Сообщение успешно отправлено!';

	document.querySelector('body').insertAdjacentElement('beforebegin', div);
	setTimeout(() => {
		div.remove();
	}, 5000);
}

// страница /login/
const login = document.querySelector('#login');
if (login) {
	const loginAcc = (e) => {
		e.preventDefault();
		let formData = new FormData(login);
		formData.append("action", "login");
		fetch('/wp-admin/admin-ajax.php', {
				method: "POST",
				body: formData,
			})
			.then(response => response.json())
			.then((data) => {
				if (data.result === 'ok') {
					formMessageResponse(true, data.message);
					setTimeout(() => {
						window.location.href = data.redirect;
					}, 1000);
				} else if (data.result === 'false') {
					formMessageResponse(false, data.message);
					// btn.textContent = btnText;
					// btn.removeAttribute('disabled');
					let inputs = login.querySelectorAll('input');
					inputs.forEach(el => {
						el.addEventListener('input', () => {
							el.removeAttribute("style");
						});
					});
					if (data.errors) {
						for (let el in data.errors) {
							document.querySelector(`input[name=${el}]`).style.borderColor = "#da4c4c";
						}
					}
				}
			});
	}
	login.addEventListener('submit', loginAcc);
}

// страница /register/
const register = document.querySelector('#register');
if (register) {
	const registerAcc = (e) => {
		e.preventDefault();
		let formData = new FormData(register);
		formData.append("action", "register");
		fetch('/wp-admin/admin-ajax.php', {
				method: "POST",
				body: formData,
			})
			.then(response => response.json())
			.then((data) => {
				if (data.result === 'ok') {
					formMessageResponse(true, data.message);
					setTimeout(() => {
						window.location.href = data.redirect;
					}, 1000);
				} else if (data.result === 'false') {
					formMessageResponse(false, data.message);
					// btn.textContent = btnText;
					// btn.removeAttribute('disabled');
					let inputs = register.querySelectorAll('input');
					inputs.forEach(el => {
						el.addEventListener('input', () => {
							el.removeAttribute("style");
						});
					});
					if (data.errors) {
						for (let el in data.errors) {
							document.querySelector(`input[name=${el}]`).style.borderColor = "#da4c4c";
						}
					}
				}
			});
	}
	register.addEventListener('submit', registerAcc);
}

// страница /profile/favourites/
let tableDelLikes = document.querySelectorAll('.table__del');
if (tableDelLikes) {
	const unlikePost = (e) => {
		let trg = e.currentTarget;
		let postId = trg.dataset.productId;
		let form = document.createElement('form');
		let formData = new FormData(form);
		formData.append("action", "like_post");
		formData.append("post_id", postId);
		formData.append("like_nonce_field", likeNonce.like_nonce_field);
		fetch('/wp-admin/admin-ajax.php', {
				method: "POST",
				body: formData,
			})
			.then(response => response.json())
			.then((data) => {
				if (data.result === 'ok') {
					trg.closest('.table__row').remove();
					if (!document.querySelector('.table__row:not(.table__row_header)')) {
						let row = document.createElement('div');
						row.classList.add('table__row');
						let col = document.createElement('div');
						col.classList.add('table__col');
						col.innerText = 'No likes';
						row.insertAdjacentElement('afterbegin', col);
						document.querySelector('.table__row.table__row_header').insertAdjacentElement('afterend', row);

					}
				} else if (data.result === 'false') {
					formMessageResponse(false, data.message);
				}
			});
	}
	tableDelLikes.forEach(el => {
		el.addEventListener('click', unlikePost);
	});
}

// страница /photos/post/
let like = document.querySelector('#like-photo');
if (like) {
	const likePost = (e) => {
		let trg = e.currentTarget;
		if (trg.classList.contains('active')) {
			trg.classList.remove('active');
		} else {
			trg.classList.add('active');
		}
		let postId = trg.closest('#photo').dataset.productId;
		let form = document.createElement('form');
		let formData = new FormData(form);
		formData.append("action", "like_post");
		formData.append("post_id", postId);
		formData.append("like_nonce_field", likeNonce.like_nonce_field);
		fetch('/wp-admin/admin-ajax.php', {
				method: "POST",
				body: formData,
			})
			.then(response => response.json())
			.then((data) => {
				if (data.result === 'ok') {
					// formMessageResponse(true, data.message);
				} else if (data.result === 'false') {
					// formMessageResponse(false, data.message);
					// btn.textContent = btnText;
					// btn.removeAttribute('disabled');
				}
			});
	}
	like.addEventListener('click', likePost);
}

// страница /photos/post/
let buy = document.querySelector('#buy');
if (buy) {
	const buyProduct = (e) => {
		let trg = e.currentTarget;
		let postId = trg.closest('#photo').dataset.productId;
		let form = document.createElement('form');
		let formData = new FormData(form);
		formData.append("action", "buy_product");
		formData.append("post_id", postId);
		formData.append("buy_product_nonce_field", buyProductNonce.buy_product_nonce_field);
		fetch('/wp-admin/admin-ajax.php', {
				method: "POST",
				body: formData,
			})
			.then(response => response.json())
			.then((data) => {
				if (data.result === 'ok') {
					formMessageResponse(true, data.message);
					if (data.redirect_url) {
						setTimeout(() => {
							window.location.href = data.redirect_url;
						}, 1000);
					}
				} else if (data.result === 'false') {
					formMessageResponse(false, data.message);
					if (data.redirect_url) {
						setTimeout(() => {
							window.location.href = data.redirect_url;
						}, 1000);
					}
				}
			});
	}
	buy.addEventListener('click', buyProduct);
}


// страница /profile/
const forms = document.querySelectorAll('.send-form');
if (forms) {
	const sendForm = (e) => {
		e.preventDefault();
		let formData = new FormData(e.target);
		formData.append("action", e.target.getAttribute('action'));
		fetch('/wp-admin/admin-ajax.php', {
				method: "POST",
				body: formData,
			})
			.then(response => response.json())
			.then((data) => {
				if (data.result === 'ok' && data.type === 'ORDER' || data.result === 'false' && data.type === 'ORDER') {
					if (data.result === 'false') {
						formMessageResponse(false, data.message);
					} else {
						let widget = document.querySelector('#widget');
						PSP.Widget.init({
							display: {
								mode: "embedded",
								params: {
									container: widget,
									pcidss: "full",
								},
							},
							payUrl: data.payUrl,
						});
					}
				} else if (data.result === 'ok') {
					formMessageResponse(true, data.message);
					setTimeout(() => {
						window.location.href = data.redirect;
					}, 1000);
				} else if (data.result === 'false') {
					formMessageResponse(false, data.message);

					if (data.redirect) {
						setTimeout(() => {
							window.location.href = data.redirect;
						}, 1000);
					}

					let inputs = e.target.querySelectorAll('input');
					inputs.forEach(el => {
						el.addEventListener('input', () => {
							el.removeAttribute("style");
							if (e.target.getAttribute('action') === 'billing_update') el.previousElementSibling.removeAttribute("style");
						});
					});
					if (data.errors) {
						if (e.target.getAttribute('action') === 'billing_update') {
							for (let el in data.errors) {
								document.querySelector(`input[name=${el}]`).previousElementSibling.style.color = "#da4c4c";
							}
						} else {
							for (let el in data.errors) {
								document.querySelector(`input[name=${el}]`).style.borderColor = "#da4c4c";
							}
						}
					}
				}
			});
	}
	forms.forEach(el => {
		el.addEventListener('submit', sendForm);
	});
}



let qa = document.querySelectorAll('.qa-item');
if (qa) {
	const openTab = (e) => {
		if (e.target.closest('.qa-item__title-block').parentElement.classList.contains("open")) {
			e.target.closest('.qa-item__title-block').nextElementSibling.style.maxHeight = "0";
			e.target.closest('.qa-item__title-block').parentElement.classList.remove("open");
		} else {
			e.target.closest('.qa-item__title-block').nextElementSibling.style.maxHeight = e.target.closest('.qa-item__title-block').nextElementSibling.scrollHeight + "px";
			e.target.closest('.qa-item__title-block').parentElement.classList.add("open");
		}
	}
	qa.forEach((el, i) => {
		el.addEventListener('click', openTab);
	});
}



// document.querySelector('.tag-list__item.active') ? document.querySelector('.tag-list__item.active').closest('.tag-list').scrollLeft = document.querySelector('.tag-list__item.active').getBoundingClientRect().left : '';