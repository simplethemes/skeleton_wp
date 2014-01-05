/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {

	var siteURL = skeleton_getsiteurl.skeleton_siteurl;
	var themeDir = skeleton_activethemedir.skeleton_activethemedir;
	var shortName = skeleton_shortname;
	var PreSet = skeleton_preset;

	// Fade out the save message
	$('.fade').delay(1000).animate({height: 0, opacity: 0}, 'fast', function() {
        $(this).remove();
    });

	// Switches option sections

	$('.group').hide();
	var active_tab = '';
	if (typeof(localStorage) != 'undefined' ) {
		active_tab = localStorage.getItem("active_tab");
	}
	if (active_tab != '' && $(active_tab).length ) {
		$(active_tab).fadeIn();
	} else {
		$('.group:first').fadeIn();
	}
	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each(
			function(){
				if ($(this).hasClass('last')) {
					$(this).removeClass('hidden');
						return false;
					}
				$(this).filter('.hidden').removeClass('hidden');
			});
	});
	if (active_tab != '' && $(active_tab + '-tab').length ) {
		$(active_tab + '-tab').addClass('nav-tab-active');
	}
	else {
		$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
	}

	$('.nav-tab-wrapper a').click(function(evt) {
		$('.nav-tab-wrapper a').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active').blur();
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("active_tab", $(this).attr('href'));
		}
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();

		// Editor Height (needs improvement)
		$('.wp-editor-wrap').each(function() {
			var editor_iframe = $(this).find('iframe');
			if ( editor_iframe.height() < 30 ) {
				editor_iframe.css({'height':'auto'});
			}
		});

	});

	$('.group .collapsed input:checkbox').click(unhideHidden);

	function unhideHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().nextAll().each(
			function(){
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;
					}
				$(this).addClass('hidden');
			});

		}
	}



	$('#use_logo_image').click(function() {
		$('#section-header_logo,#section-logo_width,#section-logo_height').fadeToggle(400);
	});

	if ($('#use_logo_image:checked').val() !== undefined) {
		$('#section-header_logo,#section-logo_width,#section-logo_height').show();
	}

	// Initially show/hide content options if responsive enabled/disabled
	var ContentType = $('input[name='+shortName+'\\[content_type\\]]');
	var ContentTypeSelected = ContentType.filter(':checked').val();

	if (ContentTypeSelected == 'content') {
		$('#section-display_readmore').hide();
	} else {
		$('#section-display_readmore').show();
	}

	// show if enabled is clicked
	$('#'+shortName+'-content_type-excerpt').click(function() {
		$('#section-display_readmore').fadeIn(400);
	});
	$('#'+shortName+'-content_type-none').click(function() {
		$('#section-display_readmore').fadeIn(400);
	});
	// hide if disabled is clicked
	$('#'+shortName+'-content_type-content').click(function() {
		$('#section-display_readmore').fadeOut(400);
	});


	// Initially show/hide
	var ShowFeaturedThumb = $('input[name='+shortName+'\\[display_featured_thumbnails\\]]');
	var ShowFeaturedThumbSelected = ShowFeaturedThumb.filter(':checked').val();

	if (ShowFeaturedThumbSelected == 'disabled') {
		$('#section-featured_thumbnail_places').hide();
	} else {
		$('#section-featured_thumbnail_places').show();
	}

	$(ShowFeaturedThumb).click(function() {
		if($(this).val() !== 'disabled') {
			$('#section-featured_thumbnail_places').fadeIn(400);
		} else {
			$('#section-featured_thumbnail_places').fadeOut(400);
		}
	});


	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});

	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	//$('#layout_style_nostyle.of-radio-img-radio').show();
	//$('#label_layout_style_nostyle.of-radio-img-label').show();

	$('#of-nav li:first').addClass('current');
	$('#of-nav li a').click(function(evt) {
		$('#of-nav li').removeClass('current');
		$(this).parent().addClass('current');
		var clicked_group = $(this).attr('href');
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();
	});
});

