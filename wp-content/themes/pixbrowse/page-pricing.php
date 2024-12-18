<?php get_header(); ?>
<main>
	<div class="section section_pricing pricing">
		<div class="container">
			<div class="pricing__block">
				<h1 class="title title_tac title_fw400">Choose the perfect image plan for your projects</h1>
				<div class="pricing__text">Access the best content from our extensive library with worry-free licensing and full resolution images.</div>
				<div class="pricing__credits">1 IMAGE = 500 CREDITS or less</div>
				<form class="pricing__form send-form btn-modal" action="pricing">
					<div class="pricing__form-title">Buy an exact amount</div>
					<div class="pricing__form-text">Choose how many images you want to buy by inputing the exact amount yourself.</div>
					<div class="pricing__form-card">
						<div class="pricing__form-card-title">Enter your number of Credits</div>
						<input type="number" class="pricing__form-card-input" value="1000" name="pricing_sum">
						<div class="pricing__form-card-credits">€1.00 / per 100 credits</div>
					</div>
					<input type="text" class="pricing__form-promocode" placeholder="Enter a promocode">
					<?php wp_nonce_field('pricing_nonce_action', 'pricing_nonce_field'); ?>
					<button class="pricing__form-btn form__btn">Buy now</button>
					<div class="pricing__form-text">Need a large amount of credits?<br><a href="/contacts/">Contact us</a> for a special offer!</div>
				</form>
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<div class="title title_tac title_fw400 title_mb">Frequently asked Questions</div>
			<div class="qa-item">
				<div class="qa-item__title-block">
					<div class="qa-item__title">What are PixBrowse credits?</div>
					<svg class="qa-item__btn" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddRoundedIcon">
						<path d="M18 13h-5v5c0 .55-.45 1-1 1s-1-.45-1-1v-5H6c-.55 0-1-.45-1-1s.45-1 1-1h5V6c0-.55.45-1 1-1s1 .45 1 1v5h5c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
					</svg>
				</div>
				<div class="qa-item__text-block">
					<div class="qa-item__text">With PixBrowse credits you can purchase images and creative content on the PixBrowse platform.</div>
				</div>
			</div>
			<div class="qa-item">
				<div class="qa-item__title-block">
					<div class="qa-item__title">How can I purchase credits?</div>
					<svg class="qa-item__btn" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddRoundedIcon">
						<path d="M18 13h-5v5c0 .55-.45 1-1 1s-1-.45-1-1v-5H6c-.55 0-1-.45-1-1s.45-1 1-1h5V6c0-.55.45-1 1-1s1 .45 1 1v5h5c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
					</svg>
				</div>
				<div class="qa-item__text-block">
					<div class="qa-item__text">Buying credits is easy and secure with your credit card. We gladly accept VISA and MasterCard payments.</div>
				</div>
			</div>
			<div class="qa-item">
				<div class="qa-item__title-block">
					<div class="qa-item__title">What is the value of one credit?</div>
					<svg class="qa-item__btn" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddRoundedIcon">
						<path d="M18 13h-5v5c0 .55-.45 1-1 1s-1-.45-1-1v-5H6c-.55 0-1-.45-1-1s.45-1 1-1h5V6c0-.55.45-1 1-1s1 .45 1 1v5h5c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
					</svg>
				</div>
				<div class="qa-item__text-block">
					<div class="qa-item__text">It's important to note that one credit is worth EUR 0.01.</div>
				</div>
			</div>
			<div class="qa-item">
				<div class="qa-item__title-block">
					<div class="qa-item__title">Is purchasing credits mandatory to buy images on PixBrowse?</div>
					<svg class="qa-item__btn" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddRoundedIcon">
						<path d="M18 13h-5v5c0 .55-.45 1-1 1s-1-.45-1-1v-5H6c-.55 0-1-.45-1-1s.45-1 1-1h5V6c0-.55.45-1 1-1s1 .45 1 1v5h5c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
					</svg>
				</div>
				<div class="qa-item__text-block">
					<div class="qa-item__text">Absolutely, to access images and creative content on the PixBrowse platform, the first step is purchasing credits.</div>
				</div>
			</div>
			<div class="qa-item">
				<div class="qa-item__title-block">
					<div class="qa-item__title">Can I get a refund for purchased credits?</div>
					<svg class="qa-item__btn" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddRoundedIcon">
						<path d="M18 13h-5v5c0 .55-.45 1-1 1s-1-.45-1-1v-5H6c-.55 0-1-.45-1-1s.45-1 1-1h5V6c0-.55.45-1 1-1s1 .45 1 1v5h5c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
					</svg>
				</div>
				<div class="qa-item__text-block">
					<div class="qa-item__text">To request a refund for your purchased credits, reach out to our customer support at support@pixbrowse.com.</div>
				</div>
			</div>
			<div class="qa-item">
				<div class="qa-item__title-block">
					<div class="qa-item__title">How can I redeem a voucher code?</div>
					<svg class="qa-item__btn" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="AddRoundedIcon">
						<path d="M18 13h-5v5c0 .55-.45 1-1 1s-1-.45-1-1v-5H6c-.55 0-1-.45-1-1s.45-1 1-1h5V6c0-.55.45-1 1-1s1 .45 1 1v5h5c.55 0 1 .45 1 1s-.45 1-1 1z"></path>
					</svg>
				</div>
				<div class="qa-item__text-block">
					<div class="qa-item__text">If you have a voucher, you can enter it when finalizing your purchase. If you run into any problems while redeeming your voucher code, please reach out to our customer support at support@pixbrowse.com.</div>
				</div>
			</div>
		</div>
	</div>

	<?php echo get_template_part("template_parts/footer-block"); ?>
</main>
<div class="modal" id="modal-callback">
	<div class="modal__block">
		<div class="modal__close">&#10006;</div>
		<div id="widget"></div>
	</div>
</div>
<?php get_footer(); ?>