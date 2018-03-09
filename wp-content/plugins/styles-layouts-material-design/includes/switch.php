<?php

/***************************************** for checkbox ****************************************************************************/

if ( in_array( $field->type, $checkbox_fields ) ) {
	if (  isset( $material_options['checkbox-to-switch'] ) && $material_options['checkbox-to-switch'] === true  ) {


		$checkbox_classes_types = array( 'ginput_container_checkbox' );

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
				if ( strpos( $current_div_classes, 'ginput_container_checkbox' ) !== false ) {
					$contains_error = true;
					$current_div->setAttribute( 'class', $current_div->getAttribute( 'class' ) . '  mdc-text-field--invalid' );
				}
			}
		}
		foreach ( $all_divs as $div ) {
			$div_classes = $div->getAttribute( 'class' );
			$div_classes_array = explode( ' ', $div_classes );
			$is_valid_checkbox_field = false;

			foreach ( $div_classes_array as $div_class_value ) {
				if ( in_array( $div_class_value, $checkbox_classes_types ) ) {
					$is_valid_checkbox_field = true;
				}
			}

			if ( $is_valid_checkbox_field ) {
				$get_container = $div->getElementsByTagName( 'li' );
				foreach ( $get_container as $container_element ) {
					$container_classes = $container_element->getAttribute( 'class' );
					if ( strpos( $container_classes, 'gchoice_' ) !== false ) {

						// $container_element->setAttribute( 'class',
						// 	$container_element->getAttribute( 'class' ) . ' mdc-text-field' );

						$outer_div = $dom->createElement( 'div' );
						$outer_div->setAttribute( 'class', 'mdc-switch' );
						$container_element->appendChild( $outer_div );

						$outer_div = $container_element->lastChild;

						$get_input = $container_element->getElementsByTagName( 'input' )->item( 0 );
						// var_dump( $get_input );
						$outer_div->appendChild( $get_input );
						$outer_background_div = $dom->createElement( 'div' );
						$outer_background_div->setAttribute( 'class', 'mdc-switch__background' );
						$outer_div->appendChild( $outer_background_div );

						$outer_background_div = $container_element->lastChild->lastChild;

						// $svg = $dom->createElement( 'svg' );
						// $svg->setAttribute( 'class', 'mdc-checkbox__checkmark' );
						// $svg->setAttribute( 'viewBox', '0 0 24 24' );

						// $path = $dom->createElement( 'path' );
						// $path->setAttribute( 'class', 'mdc-checkbox__checkmark__path' );
						// $path->setAttribute( 'fill', 'none' );
						// $path->setAttribute( 'stroke', 'white' );
						// $path->setAttribute( 'd', 'M1.73,12.91 8.1,19.28 22.79,4.59' );

						$mixed_div = $dom->createElement( 'div' );
						$mixed_div->setAttribute( 'class', 'mdc-switch__knob' );

						// $outer_background_div->appendChild( $svg );
						// $outer_background_div->appendChild( $path );
						$outer_background_div->appendChild( $mixed_div );

						// $get_svg = $container_element->getElementsByTagName( 'svg' )->item( 0 );
						// $get_svg->appendChild( $path );

						$container_element->appendChild( $container_element->getElementsByTagName( 'label' )->item( 0 ) );
					}
				}

				$get_input = $div->getElementsByTagName( 'input' );
				foreach ( $get_input as $input_element ) {
					$input_element->setAttribute( 'class',
						$input_element->getAttribute( 'class' ) . ' mdc-switch__native-control' );
				}
				$content = utf8_decode( $dom->saveHTML( $dom->documentElement ) );
			}
		}
	}
}
