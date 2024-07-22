// JavaScript Document


$(document).ready(function (e) {
	// for home slider
	$(".top-banner-slider").owlCarousel({
		nav: false,
		loop: true,
		dots: true,
		// autoplay: true,
		autoPlaySpeed: 5000,
		autoplayTimeout: 5000,
		// smartSpeed: 3000,
		singleItem: true,
		items: 1,
		itemsDesktop: false,
		itemsDesktopSmall: false,
		itemsTablet: false,
		itemsMobile: false,
	});

	// owl carousel slider 	
	var owl = $('.product-details-image-slider');
	owl.owlCarousel({
		margin: 20,
		nav: false,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		// autoplay: true,
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
	var owl = $('.other-product-slider');
	owl.owlCarousel({
		margin: 10,
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
				items: 2
			},
			600: {
				items: 2
			},
			1000: {
				items: 3
			}
		}
	});

	// unmissable-collection-image-slider js
	var owl = $('.unmissable-collection-image-slider');
	owl.owlCarousel({
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 2.1,
				nav: false,
				dots: false,
				margin: 10,
			},
			600: {
				items: 3,
				nav: false,
				dots: false,
				margin: 10,
			},
			1000: {
				items: 3,
				nav: true,
				dots: false,
				margin: 10,
			}
		}
	});
	// unmissable-collection-image-slider js end
	// straight-form-hollywood-image-slider js
	var owl = $('.straight-form-hollywood-image-slider');
	owl.owlCarousel({
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: false,
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 2,
				nav: false,
				dots: false,
				margin: 8,
			},
			600: {
				items: 3,
				nav: false,
				dots: false,
				margin: 10,
			},
			1000: {
				items: 3,
				nav: false,
				dots: false,
				margin: 15
			}
		}
	});
	// straight-form-hollywood-image-slider js end

	// trending-near-product-list-slider js
	var owl = $('.trending-near-product-list-slider');
	owl.owlCarousel({
		margin: 10,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 2.5,
				nav: false,
				dots: false,
			},
			600: {
				items: 4,
				nav: false,
				dots: false,
			},
			1000: {
				items: 5,
				nav: true,
				dots: false,
			}
		}
	});
	// trending-near-product-list-slider js end	
	// top-ten-this-week-image-slider js
	var owl = $('.top-ten-this-week-image-slider');
	owl.owlCarousel({
		margin: 10,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 2.1,
				nav: false,
				dots: false,
			},
			600: {
				items: 3,
				nav: false,
				dots: false,
			},
			1000: {
				items: 4,
				nav: true,
				dots: false,
			}
		}
	});
	// top-ten-this-week-image-slider js end
	// trending-near-product-list-slider js
	var owl = $('.trending-categories-image-slider');
	owl.owlCarousel({
		margin: 10,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 1,
				nav: false,
				dots: true,
				loop: true,
			},
			600: {
				items: 1,
				nav: false,
				dots: true,
				loop: true,
			},
			1000: {
				items: 1,
				nav: true,
				dots: false,
				loop: false,
			}
		}
	});
	// trending-near-product-list-slider js end	
	// next-episode-x-ray-section-product-slider js start	
	$(".next-episode-x-ray-section-product-slider").owlCarousel({
		nav: false,
		loop: true,
		dots: true,
		// autoplay: true,
		autoPlaySpeed: 5000,
		autoplayTimeout: 5000,
		// smartSpeed: 3000,
		singleItem: true,
		items: 1,
		itemsDesktop: false,
		itemsDesktopSmall: false,
		itemsTablet: false,
		itemsMobile: false,
	});
	// next-episode-x-ray-section-product-slider js end	
	// straight-form-hollywood-image-slider js
	var owl = $('.popular-categories-image-slider');
	owl.owlCarousel({
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 2.5,
				nav: false,
				dots: false,
				margin: 8,
			},
			600: {
				items: 3,
				nav: false,
				dots: false,
				margin: 10,
			},
			1000: {
				items: 3,
				nav: true,
				dots: false,
				margin: 10
			}
		}
	});
	// straight-form-hollywood-image-slider js end
	// recently-added-product-slider js
	var owl = $('.recently-added-product-slider');
	owl.owlCarousel({
		margin: 10,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 2.1,
				nav: false,
				dots: false,
			},
			600: {
				items: 3.1,
				nav: false,
				dots: false,
			},
			1000: {
				items: 4,
				nav: true,
				dots: false,
			}
		}
	});
	// recently-added-product-slider js end	
	// the-boys-club-image-slider js
	var owl = $('.the-boys-club-image-slider');
	owl.owlCarousel({
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 1,
				nav: false,
				dots: true,
			},
			600: {
				items: 1,
				nav: false,
				dots: true,
			},
			1000: {
				items: 1,
				nav: false,
				dots: true,
			}
		}
	});
	// the-boys-club-image-slider js end
	// shop-by-theme-image-slider js start	
	$(".shop-by-theme-image-slider").owlCarousel({
		nav: true,
		loop: true,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		dots: false,
		// autoplay: true,
		autoPlaySpeed: 5000,
		autoplayTimeout: 5000,
		// smartSpeed: 3000,
		singleItem: true,
		itemsDesktop: false,
		itemsDesktopSmall: false,
		itemsTablet: false,
		itemsMobile: false,
		responsive: {
			0: {
				items: 1.1,
				nav: false,
				dots: false,
				margin: 15,
			},
			600: {
				nav: false,
				dots: false,
				items: 1,
			},
			1000: {
				nav: true,
				dots: false,
				items: 1,
			}
		}
	});
	// shop-by-theme-image-slider js end
	// shop-by-theme-image-slider js
	var owl = $('.shop-by-theme-circle-image-slider');
	owl.owlCarousel({
		margin: 10,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 2.5,
				nav: false,
				dots: false,
			},
			600: {
				items: 3.5,
				nav: false,
				dots: false,
			},
			1000: {
				items: 4,
				nav: true,
				dots: false,
			}
		}
	});
	// review-image-text-slider js
	var owl = $('.review-image-text-slider');
	owl.owlCarousel({
		margin: 10,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 1,
				nav: false,
				dots: false,
			},
			600: {
				items: 2,
				nav: false,
				dots: false,
			},
			1000: {
				items: 3,
				nav: true,
				dots: false,
			}
		}
	});
	// best-of-nxt-episode-image-slider js
	var owl = $('.best-of-nxt-episode-image-slider');
	owl.owlCarousel({
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		loop: true,
		// autoplay: true,
		autoPlaySpeed: 1200,
		autoplayTimeout: 3700,
		// smartSpeed: 3000,
		responsive: {
			0: {
				items: 1,
				nav: false,
				dots: true,
			},
			600: {
				items: 1,
				nav: false,
				dots: true,
			},
			1000: {
				items: 1,
				nav: false,
				dots: true,
			}
		}
	});
	// best-of-nxt-episode-image-slider js end
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

/*var QtyInput = (function () {
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
})();*/

// number quantity js end

// for faq
$(document).on('click', '.faq-tab li a', function () {
	$(this).siblings('div.faq-content').stop().slideToggle();
	$(this).closest('li').siblings('li').find('div.faq-content').stop().slideUp();
	$(this).children('.angel').toggleClass("fa-angle-down fa-angle-up");
	$(this).closest('li').siblings('li').find('.angel').removeClass("fa-angle-up");
	$(this).closest('li').siblings('li').find('.angel').addClass("fa-angle-down");
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
$('#show-filter-option').click(() => {
	$('#responsive-filter-option-section').show();
});
$('#hide-filter-option-section').click(() => {
	$('#responsive-filter-option-section').hide();
});
// hide and show filter option section end

// responsive product list filter button js end

// check unchake hide show btn js start

// check unchake hide show btn js end

// image zoom js start

var isActiveMode = false;
$(".zoom_image")
	.on("click", function () {
		(isActiveMode = !isActiveMode)
			? ($(this).addClass("zoom_mode_active"),
				$(window).width() > 767
					? $(this).children("img").css({ transform: "scale(4)" })
					: $(this).children("img").css({ transform: "scale(5)" }))
			: ($(this).removeClass("zoom_mode_active"),
				$(this).children("img").css({ transform: "scale(1)" }));
	})
	.on("mousemove", function (e) {
		$(this)
			.children("img")
			.css({
				"transform-origin":
					((e.pageX - $(this).offset().left) / $(this).width()) * 100 +
					"% " +
					((e.pageY - $(this).offset().top) / $(this).height()) * 100 +
					"%"
			});
	});

// image zoom js end

// login register form toogle js start
function switchCard() {
	const loginCard = document.querySelector('.container .logi-card');
	const registerCard = document.querySelector('.container .register-card');
  
	if (loginCard.style.display === 'none') {
	  loginCard.style.display = 'block';
	  registerCard.style.display = 'none';
	} else {
	  loginCard.style.display = 'none';
	  registerCard.style.display = 'block';
	}
}
// login register form toogle js end

// desktop search input js

$('.header-search-icon a').click(function(){
	$('.search-input').toggleClass('search-input-add-class');
});

$('.responsive-search-icon').click(function(){
	$('.responsive-search-input').show();
	$('.navbar').hide();
	$('.responive-search-cancle-btn').show();
});

$('.cancel-responsive-search').click(function(){
	$('.responsive-search-input').hide();
	$('.navbar').show();
	$('.responive-search-cancle-btn').hide();
});

$('#desktop-dropdown-btn').click(() => {
	$('#desktop-dropdown-list').toggle();
});