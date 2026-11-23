/**
 * Gutenberg Blocks Demo theme: mobile nav toggle, scroll reveal, pricing period toggle.
 */
(function () {
	'use strict';

	// Mobile navigation
	var header = document.querySelector('.site-header');
	var toggle = document.querySelector('.nav-toggle');

	if (header && toggle) {
		toggle.addEventListener('click', function () {
			var open = header.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});

		header.querySelectorAll('.site-nav a').forEach(function (link) {
			link.addEventListener('click', function () {
				header.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			});
		});
	}

	// Reveal on scroll. Section wrappers inside editor content get the class here rather than in
	// the saved markup, so they never render hidden inside the block editor.
	document
		.querySelectorAll('.front-blocks .section__head, .front-blocks .about, .front-blocks .section-title')
		.forEach(function (el) {
			el.classList.add('reveal');
		});

	var revealItems = document.querySelectorAll('.reveal');

	if ('IntersectionObserver' in window) {
		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					observer.unobserve(entry.target);
				}
			});
		}, { threshold: 0.15 });

		revealItems.forEach(function (item) {
			observer.observe(item);
		});
	} else {
		revealItems.forEach(function (item) {
			item.classList.add('is-visible');
		});
	}

	// Pricing: monthly / yearly, scoped to each pricing table (theme section or Pricing Table block)
	document.querySelectorAll('[data-pricing]').forEach(function (table) {
		var periodButtons = table.querySelectorAll('[data-period]');

		periodButtons.forEach(function (button) {
			button.addEventListener('click', function () {
				var period = button.getAttribute('data-period');

				periodButtons.forEach(function (other) {
					other.setAttribute('aria-pressed', other === button ? 'true' : 'false');
				});

				table.querySelectorAll('[data-price-monthly]').forEach(function (price) {
					price.querySelector('.plan__amount').textContent = price.getAttribute('data-price-' + period);
					price.querySelector('small').textContent = period === 'yearly' ? '/yr' : '/mo';
				});
			});
		});
	});
})();
