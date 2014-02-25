/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-desc' ).text( to );
		} );
	} );
	//Update site title color in real time...
	wp.customize( 'skeleton_options[primary_color]', function( value ) {
		value.bind( function( newval ) {
			$('#site-title a').css('color', newval );
		} );
	} );
	//Update taglne color in real time...
	wp.customize( 'skeleton_options[secondary_color]', function( value ) {
		value.bind( function( newval ) {
			$('span.site-desc').css('color', newval );
		} );
	} );
	//Update background color in real time...
	wp.customize( 'skeleton_options[body_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('body').css('color', newval );
		} );
	} );
	//Update background color in real time...
	wp.customize( 'skeleton_options[body_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );

} )( jQuery );
