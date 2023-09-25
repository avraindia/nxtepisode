// JavaScript Document


$(document).ready(function (e) {
	// for home slider
	// $(".main-banner-slider").owlCarousel({
	// 	nav: false,
	// 	loop: true,
	// 	dots: false,
	// 	// autoplay: true,
	// 	autoPlaySpeed: 5000,
	// 	autoplayTimeout: 5000,
	// 	// smartSpeed: 3000,
	// 	singleItem: true,
	// 	items: 1,
	// 	itemsDesktop: false,
	// 	itemsDesktopSmall: false,
	// 	itemsTablet: false,
	// 	itemsMobile: false,
	// });

	// owl carousel slider 	
	var owl = $('.product-details-image-slider');
	owl.owlCarousel({
		margin: 20,
		nav: false,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		dots: true,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 1
			},
			1000: {
				items: 1
			}
		}
	});
	//   nav js
	const navbarMenu = document.getElementById("menu");
	const burgerMenu = document.getElementById("burger");
	const bgOverlay = document.getElementById("overlay");

	// Show Menu when Click the Burger
	// Hide Menu when Click the Overlay
	if (burgerMenu && navbarMenu && bgOverlay) {
		burgerMenu.addEventListener("click", () => {
			navbarMenu.classList.toggle("is-active");
			bgOverlay.classList.toggle("is-active");
		});

		bgOverlay.addEventListener("click", () => {
			navbarMenu.classList.toggle("is-active");
			bgOverlay.classList.toggle("is-active");
		});
	}

	// Hide Menu when Click the Links
	document.querySelectorAll(".menu-link").forEach((link) => {
		link.addEventListener("click", () => {
			navbarMenu.classList.remove("is-active");
			bgOverlay.classList.remove("is-active");
		});
	});

	// sticky header section
	$(window).on('scroll', function () {
		if ($(window).scrollTop()) {
			$('.header').addClass('sticky');
		}
		else {
			$('.header').removeClass('sticky');
		}
	});

});

// number quantity js start

var QtyInput = (function () {
	var $qtyInputs = $(".qty-input");

	if (!$qtyInputs.length) {
		return;
	}

	var $inputs = $qtyInputs.find(".product-qty");
	var $countBtn = $qtyInputs.find(".qty-count");
	var qtyMin = parseInt($inputs.attr("min"));
	var qtyMax = parseInt($inputs.attr("max"));

	$inputs.change(function () {
		var $this = $(this);
		var $minusBtn = $this.siblings(".qty-count--minus");
		var $addBtn = $this.siblings(".qty-count--add");
		var qty = parseInt($this.val());

		if (isNaN(qty) || qty <= qtyMin) {
			$this.val(qtyMin);
			$minusBtn.attr("disabled", true);
		} else {
			$minusBtn.attr("disabled", false);

			if (qty >= qtyMax) {
				$this.val(qtyMax);
				$addBtn.attr('disabled', true);
			} else {
				$this.val(qty);
				$addBtn.attr('disabled', false);
			}
		}
	});

	$countBtn.click(function () {
		var operator = this.dataset.action;
		var $this = $(this);
		var $input = $this.siblings(".product-qty");
		var qty = parseInt($input.val());

		if (operator == "add") {
			qty += 1;
			if (qty >= qtyMin + 1) {
				$this.siblings(".qty-count--minus").attr("disabled", false);
			}

			if (qty >= qtyMax) {
				$this.attr("disabled", true);
			}
		} else {
			qty = qty <= qtyMin ? qtyMin : (qty -= 1);

			if (qty == qtyMin) {
				$this.attr("disabled", true);
			}

			if (qty < qtyMax) {
				$this.siblings(".qty-count--add").attr("disabled", false);
			}
		}

		$input.val(qty);
	});
})();

// number quantity js end

// for faq
$(document).on('click', '.faq-tab li a', function(){
	$(this).siblings('div.faq-content').stop().slideToggle(); 
	$(this).closest('li').siblings('li').find('div.faq-content').stop().slideUp();	 
	$(this).children('i').toggleClass("fa-angle-down fa-angle-up");
	$(this).closest('li').siblings('li').find('i').removeClass("fa-angle-up");
	$(this).closest('li').siblings('li').find('i').addClass("fa-angle-down");
}); 


// responsive product list filter button js start

$(".filter-button").click(function () {
	var value = $(this).attr('data-filter');

	if (value == "all") {
		$('.filter').show('1000');
	}
	else {
		$(".filter").not('.' + value).hide('3000');
		$('.filter').filter('.' + value).show('3000');

	}
});

if ($(".filter-button").removeClass("active")) {
	$(this).removeClass("active");
}
$(this).addClass("active");

// button active unactive js start
$(".filter-button").click(function () {
	$('.acc').removeClass("active-filter-btn");
	$(this).addClass("active-filter-btn");
});
// button active unactive js end

// hide and show filter option section start
$('#show-filter-option').click(()=>{
 $('#responsive-filter-option-section').show();
});
$('#hide-filter-option-section').click(()=>{
	$('#responsive-filter-option-section').hide();
});
// hide and show filter option section end

// responsive product list filter button js end
