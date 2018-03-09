<?php

/***************************************** for radio ****************************************************************************/

if ( in_array( $field->type, $radio_fields ) ) {

	$radio_classes_types = array( 'ginput_container_radio' );
	//get the first div
	$contains_error = false;
	$all_divs = $dom->getElementsByTagName( 'div' );
	foreach ( $all_divs as $current_div ) {
		$current_div_classes = $current_div->getAttribute( 'class' );
		if ( strpos( $current_div_classes, 'validation_message' ) !== false ) {
			$contains_error = true;
			$current_div->setAttribute( 'class', $current_div->getAttribute( 'class' ) . ' mdc-text-field-helper-text mdc-text-field-helper-text--persistent mdc-text-field-helper-text--validation-msg' );
		}
	}
	if ( $contains_error ) {
		foreach ( $all_divs as $current_div ) {
			$current_div_classes = $current_div->getAttribute( 'class' );
			if ( strpos( $current_div_classes, 'ginput_container_radio' ) !== false ) {
				$contains_error = true;
				$current_div->setAttribute( 'class', $current_div->getAttribute( 'class' ) . '  mdc-text-field--invalid' );
			}
		}
	}
	foreach ( $all_divs as $div ) {
		$div_classes = $div->getAttribute( 'class' );
		$div_classes_array = explode( ' ', $div_classes );
		$is_valid_radio_field = false;
		foreach ( $div_classes_array as $div_class_value ) {
			if ( in_array( $div_class_value, $radio_classes_types ) ) {
				$is_valid_radio_field = true;
			}
		}
		if ( $is_valid_radio_field ) {
			$get_container = $dom->getElementsByTagName( 'li' );
			foreach ( $get_container as $container_element ) {
				$container_classes = $container_element->getAttribute( 'class' );
				if ( strpos( $container_classes, 'gchoice_' ) !== false ) {
					$container_element->setAttribute( 'class', $container_element->getAttribute( 'class' ) . ' mdc-form-field' );
					$outer_div = $dom->createElement( 'div' );
					$outer_div->setAttribute( 'class', 'mdc-radio' );
					$container_element->appendChild( $outer_div );
					$outer_div = $container_element->lastChild;
					$get_input = $container_element->firstChild;
					$outer_div->appendChild( $get_input );
					$outer_background_div = $dom->createElement( 'div' );
					$outer_background_div->setAttribute( 'class', 'mdc-radio__background' );
					$outer_div->appendChild( $outer_background_div );
					$outer_background_div = $container_element->lastChild->lastChild;
					$inner_circle_div = $dom->createElement( 'div' );
					$inner_circle_div->setAttribute( 'class', 'mdc-radio__inner-circle' );
					$outer_circle_div = $dom->createElement( 'div' );
					$outer_circle_div->setAttribute( 'class', 'mdc-radio__outer-circle' );
					$outer_background_div->appendChild( $outer_circle_div );
					$outer_background_div->appendChild( $inner_circle_div );
					$container_element->appendChild( $container_element->firstChild );
				}
			}

			$get_input = $div->getElementsByTagName( 'input' );
			foreach ( $get_input as $input_element ) {
				$input_element->setAttribute( 'class',
					$input_element->getAttribute( 'class' ) . ' mdc-radio__native-control' );
			}
			$content = utf8_decode($dom->saveHTML($dom->documentElement));
		}
	}

}
