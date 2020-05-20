/* global BP_OPTIONS */
( function( $ ) {

	'use strict';

	$( document ).ready( function( $ ) {

		// Secondary slider.
		var controlNav = ( '1' === BP_OPTIONS.control_nav_2 ) ? true : false;
		var directionNav = ( '1' === BP_OPTIONS.direction_nav_2 ) ? true : false;
		var pauseTime = BP_OPTIONS.transition_delay_2 * 1000;
		var animSpeed = BP_OPTIONS.transition_length_2 * 1000;
		var manualAdvance = ( '1' === BP_OPTIONS.slider_autoplay_2 ) ? false : true;
		var effect = BP_OPTIONS.transition_effect_2;

		$('#bp-secondary-slider').nivoSlider( {
			controlNav: controlNav,
			directionNav: directionNav,
			pauseTime: pauseTime,
			effect: effect,
			manualAdvance: manualAdvance,
			animSpeed: animSpeed
		} );

		// Main slider.
		directionNav = ( '1' === BP_OPTIONS.direction_nav ) ? true : false;
		pauseTime = BP_OPTIONS.transition_delay * 1000;
		animSpeed = BP_OPTIONS.transition_length * 1000;
		manualAdvance = ( '1' === BP_OPTIONS.slider_autoplay ) ? false : true;
		effect = BP_OPTIONS.transition_effect;

		$('#bp-main-slider').nivoSlider( {
			controlNav: false,
			directionNav: directionNav,
			pauseTime: pauseTime,
			effect: effect,
			manualAdvance: manualAdvance,
			animSpeed: animSpeed
		} );

	} );

} )( jQuery );
