jQuery(document).ready(function($) {

	// Superfish

	$(function(){ // run after page loads
		$('#navigation ul.menu')
		.find('li.current_page_item,li.current_page_parent,li.current_page_ancestor,li.current-cat,li.current-cat-parent,li.current-menu-item')
			.addClass('active')
			.end()
			.superfish({autoArrows	: true});
	});

	// valid XHTML method of target_blank
	$(function(){ // run after page loads
		$('a[rel*=external]').click( function() {
			window.open(this.href);
			return false;
		});
	});

	// Style Tags

	$(function(){ // run after page loads
		$('p.tags a')
		.wrap('<span class="st_tag" />');
	});

	// Focus on search form on 404 pages
	$(function(){ // run after page loads
			// focus on search field after it has loaded
			$("body.error404 #content #s").focus();
	});

});