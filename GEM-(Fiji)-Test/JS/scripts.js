// Sidenav
$(".sidenav").sidenav({
	onOpenStart: function (){
		$('.nav-button').toggleClass('is-open')
	},
	onCloseStart: function (){
		$('.nav-button').toggleClass('is-open');
	},
	edge: 'left',
	closeOnClick: true,
	preventScrolling: true
});

// collapsible trigger for sidebar
$(document).ready(function(){
	$('.collapsible').collapsible();
});

// Parallax initialization
$(document).ready(function(){
	$('.parallax').parallax();
});

// Function for scrolling title
(function titleScroller(text) {
  document.title = text;
  setTimeout(function () {
    titleScroller(text.substr(1) + text.substr(0, 1));
  }, 800);
}(document.title));

// Tooltip initialization
$(document).ready(function(){
	$('.tooltipped').tooltip({
		enterDelay: 500
	});
});

// Function for loading screen
$(document).ready(function(){
    $('#loader').delay(1000).fadeOut(function(){$(this).remove()});
});

// function for slideshow
$(document).ready(function(){
    $('.slider').slider({
    	indicators: false,
    	height: 500,
    	interval: 3000
    });
});

// Dropdown trigger
$(document).ready(function(){
	$(".dropdown-button").dropdown({
		hover: true
	});
});

// Carousel trigger
$(document).ready(function(){
	$('.carousel').carousel({
		padding: 200,
	});
});

// Scrollspy trigger
$(document).ready(function(){
	$('.scrollspy').scrollSpy({
		scrollOffset: 0
	});
});


// Tabs trigger
$(document).ready(function(){
	$('ul.tabs').tabs();
});

// Material box trigger (For images)
$(document).ready(function(){
	$('.materialboxed').materialbox();
});

// Logo fadeIn function
$(window).scroll(function() {
	var scrollPosition = $(this).scrollTop();
	
	if (scrollPosition > 500) {
		$('#top-btn').fadeIn();
		$('#sidenav-top-btn').fadeIn();
	} 
	else {
		$('#top-btn').fadeOut();
		$('#sidenav-top-btn').fadeOut();
	}
});

// Modal trigger
$(document).ready(function(){
	// the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
	$('.modal').modal();
});

// Dynamic reload of input labels
$(document).ready(function() {
	M.updateTextFields();
});

