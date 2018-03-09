<?php
/***************************************** for complex fields like address and name *************************************/

if ( in_array( $field->type, $complex_fields ) ) {

	$get_span = $dom->getElementsByTagName( 'span' );

	$contains_error = false;

	//check if error is present
	$all_divs = $dom->getElementsByTagName( 'div' );
	foreach ( $all_divs as $current_div ) {
		$current_div_classes = $current_div->getAttribute( 'class' );
		if ( strpos( $current_div_classes, 'validation_message' ) !== false ) {
			$contains_error = true;
			$current_div->setAttribute( 'class', $current_div->getAttribute( 'class' ) . ' mdc-text-field-helper-text mdc-text-field-helper-text--persistent mdc-text-field-helper-text--validation-msg' );
		}
	}

	foreach ( $get_span as $input_element ) {
		$span_classes = $input_element->getAttribute( 'class' );
		//only modify fields if first, middle or last name field
		if ( strpos( $span_classes, 'name_' ) !== false || strpos( $span_classes, 'address_' ) !== false ) {
			if ( strpos( $span_classes, 'address_country' ) === false ) {

				//create a new div to append to span

				$container_div = $dom->createElement( 'div' );
				$container_div->setAttribute( 'class', 'MDCTextField' );
				$input_element->appendChild( $container_div );


				//get newly appended container div
				$container_div = $input_element->getElementsByTagName( 'div' )->item( 0 );

				$add_classes = ' stla_material_large  mdc-text-field';

				if ( $contains_error ) {
					$add_classes .= ' mdc-text-field--invalid';
				}

				$container_div->setAttribute( 'class',
					$container_div->getAttribute( 'class' ) . $add_classes );
				$container_div->setAttribute( 'data-mdc-auto-init', 'MDCTextField' );

				$input = $input_element->getElementsByTagName( 'input' )->item( 0 );
				$input->setAttribute( 'class',
					$input->getAttribute( 'class' ) . '  mdc-text-field__input' );

				$container_div->appendChild( $input );


				$add_label_classes = ' mdc-text-field__label';
				if ( $input->getAttribute( 'placeholder' ) !== '' ) {
					$add_label_classes .= ' mdc-text-field__label--float-above';
				}

				$label = $input_element->getElementsByTagName( 'label' )->item( 0 );
				$label->setAttribute( 'class',
					$label->getAttribute( 'class' ) . $add_label_classes );

				$container_div->appendChild( $label );

				//create a new div
				$bottom_line_div = $dom->createElement( 'div' );
				$bottom_line_div->setAttribute( 'class', 'mdc-text-field__bottom-line' );
				$container_div->appendChild( $bottom_line_div );


			}
		}
	}

	$content = $dom->saveHTML();
}
