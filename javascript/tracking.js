$(document).ready(function() {

	/*
		$("a.track").click(function() {
			$(this).analyticsTrackEvent();
		});
	*/
	

		/* Header & Footer Social Icons */
		$(".header li.social a").on('click', function(e) {
			//e.preventDefault();
			//console.log("header-social");
			_gaq.push(['_trackEvent', 'Header Social Icon', 'Click', $(this).attr('href')]);
		});	
		
		$(".footer .social a").on('click', function(e) {
			//e.preventDefault();
			//console.log("footer-social");
			_gaq.push(['_trackEvent', 'Footer Social Icon', 'Click', $(this).attr('href')]);
		});
		
		
		/*Spiff Image/Header/Button-link Clicks */	

		$(".grid a img").on('click', function(e) {
			//e.preventDefault();
			//console.log("Spiff Image");
			_gaq.push(['_trackEvent', 'Spiff Image', 'Click', $(this).attr('href')]);
		});	

		$(".grid h4 a").on('click', function(e) {
			//e.preventDefault();
			//console.log("Spiff h4");
			_gaq.push(['_trackEvent', 'Spiff Header Link', 'Click', $(this).attr('href')]);
		});	

		$(".grid a.learnMore").on('click', function(e) {
			//e.preventDefault();
			//console.log("Spiff Learn More");
			_gaq.push(['_trackEvent', 'Spiff Button/Link', 'Click', $(this).attr('href')]);
		});	
		
		
		/*Slider Calls */
		
		$(".flexslider a img").on('click', function(e) {
			//e.preventDefault();
			//console.log("Slider Image Click");
			_gaq.push(['_trackEvent', 'Slider Image', 'Click', $(this).attr('href')]);
		});	
		$(".flexslider a.flex-button").on('click', function(e) {
			//e.preventDefault();
			//console.log("slide button Click");
			_gaq.push(['_trackEvent', 'Slider Button', 'Click', $(this).attr('href')]);
		});	


		/*Form Submit Button */
		$("#Form_Form_action_process").on('click', function(e) {
			//e.preventDefault();
			//console.log("Submit Button");
			_gaq.push(['_trackEvent', 'Form Submit Button', 'Click', 'Form Submission']);
		});	


		/*Company Config Tracking */
		$("a.PhoneTracking").on('click', function(e) {
			//e.preventDefault();
			//console.log("Phone Number");
			_gaq.push(['_trackEvent', 'Phone Number', 'Click', 'Phone Number']);
		});	

		$(".addressMap a img").on('click', function(e) {
			//e.preventDefault();
			//console.log("Google Map");
			_gaq.push(['_trackEvent', 'Map', 'Click', 'Map']);
		});	

		/*ChildListPage Page Image/Header/Button-link Clicks */	

		$("#ChildEvent a img").on('click', function(e) {
			//e.preventDefault();
			//console.log("ChildListPage Image");
			_gaq.push(['_trackEvent', 'Child List Page Image', 'Click', $(this).attr('href')]);
		});	

		$("#ChildEvent h4 a").on('click', function(e) {
			//e.preventDefault();
			//console.log("ChildListPage h4");
			_gaq.push(['_trackEvent', 'Child List Page Title Link', 'Click', $(this).attr('href')]);
		});	

		$("#ChildEvent a.learnMore").on('click', function(e) {
			//e.preventDefault();
			//console.log("ChildListPage Learn More");
			_gaq.push(['_trackEvent', 'Child List Page button click', 'Click', $(this).attr('href')]);
		});	

		/*News Page Image/Header/Button-link Clicks */	

		$(".blog-list a img").on('click', function(e) {
			//e.preventDefault();
			//console.log("blog Image");
			_gaq.push(['_trackEvent', 'Blog Holder Image', 'Click', $(this).attr('href')]);
		});	

		$(".blog-list h4 a").on('click', function(e) {
			//e.preventDefault();
			//console.log("blog h4");
			_gaq.push(['_trackEvent', 'Blog Holder Title Link', 'Click', $(this).attr('href')]);
		});	

		$(".blog-list a.readmore").on('click', function(e) {
			//e.preventDefault();
			//console.log("blog Learn More");
			_gaq.push(['_trackEvent', 'Blog Holder button click', 'Click', $(this).attr('href')]);
		});	






});