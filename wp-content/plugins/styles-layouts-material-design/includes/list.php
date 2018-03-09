<?php

/***************************************** for list field **************************************/

if ( $field->type == 'list' ) {
	//add class to input
	$get_tds = $dom->getElementsByTagName( 'td' );


	foreach ( $get_tds as $td ) {
		$td_classes = $td->getAttribute( 'class' );
		if ( strpos( $td_classes, 'gfield_list_icons' ) === false ) {
			$container_div = $dom->createElement( 'div' );
			$container_div->setAttribute( 'class', 'mdc-text-field' );
			$container_div->setAttribute( 'data-mdc-auto-init', 'MDCTextField' );
			$td->appendChild( $container_div );
			$div = $td->getElementsByTagName( 'div' )->item( 0 );

			$div_classes = $div->getAttribute( 'class' );
			if ( strpos( $div_classes, 'mdc-text-field' ) !== false ) {
				$inputs = $td->getElementsByTagName( 'input' );
				foreach ( $inputs as $input ) {
					$input->setAttribute( 'class',
						$input->getAttribute( 'class' ) . '  mdc-text-field__input' );
					$div->appendChild( $input );
					//create a new div
					$bottom_line_div = $dom->createElement( 'div' );
					$bottom_line_div->setAttribute( 'class', 'mdc-text-field__bottom-line' );
					$div->appendChild( $bottom_line_div );
				}
			}
		}
	}
	$content = $dom->saveHTML();
}
