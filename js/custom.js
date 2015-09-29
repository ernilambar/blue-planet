( function( $ ) {

	'use strict';

	$( document ).ready( function( $ ){

		// Mean menu.
		$( 'nav#site-navigation' ).meanmenu({
			meanScreenWidth: '640'
		} );

		// Goto top.
		if ( $( '.scrollup' ).length > 0 ) {

			$( window ).scroll( function() {
				if ($( this ).scrollTop() > 100) {
					$( '.scrollup' ).fadeIn();
				} else {
					$( '.scrollup' ).fadeOut();
				}
			} );

			$( '.scrollup' ).click( function() {
				$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
				return false;
			} );

		}

	} );

} )( jQuery );
