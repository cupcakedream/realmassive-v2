<?php

/***************************************** for dropdown inputs ****************************************************************************/
if ( in_array( $field->type, $select_fields ) ) {
	$dropdown_classes_types = array( 'ginput_container_select' );

	$divs = $dom->getElementsByTagName( 'div' );

	// $div_classes = $div->getAttribute( 'class' );

	// $div_classes_array = explode( ' ', $div_classes );
	$contains_error = false;
	foreach ( $divs as $div ) {
		$div_classes = $div->getAttribute( 'class' );
		if ( strpos( $div_classes, 'validation_message' ) !== false ) {
			$contains_error = true;
			$div->setAttribute( 'class', $div->getAttribute( 'class' ) . ' mdc-text-field-helper-text mdc-text-field-helper-text--persistent mdc-text-field-helper-text--validation-msg' );
		}
	}

	foreach ( $divs as $div ) {
		$is_valid_input_field = false;
		$div_classes = $div->getAttribute( 'class' );
		$div_classes_array = explode( ' ', $div_classes );
		foreach ( $div_classes_array as $div_class_value ) {
			if ( in_array( $div_class_value, $dropdown_classes_types ) ) {
				$is_valid_input_field = true;
			}
		}

		if ( $is_valid_input_field ) {
			//add class to input
			$get_selects = $dom->getElementsByTagName( 'select' );
			//var_dump($get_input->getAttribute('placeholder'));

			foreach ( $get_selects as $get_select ) {
				$select_classes = $get_select->getAttribute( 'class' );
				$select_id = $get_select->getAttribute( 'id' );
				$select_classes .= ' mdc-text-field__input';
				if ( $contains_error ) {
					$select_classes .= ' mdc-text-field--invalid';
				}
				$get_select->setAttribute( 'class', $select_classes );
			}

			//find the size of field
			if ( strpos( $select_classes, 'large' ) !== false ) {
				$field_size_class = 'stla_material_large';
			}
			else if ( strpos( $select_classes, 'medium' ) !== false ) {
				$field_size_class = 'stla_material_medium';
			}
			else {
				$field_size_class = 'stla_material_small';
			}


			$div->setAttribute( 'class', $div->getAttribute( 'class' ) . ' mdc-text-field ' . $field_size_class );
			$div->setAttribute( 'data-mdc-auto-init', 'MDCTextField' );

			//get the first label
			$get_label = $dom->getElementsByTagName( 'label' )->item( 0 );

			$get_label->setAttribute( 'class', $get_label->getAttribute( 'class' ) . ' mdc-text-field__label  mdc-text-field__label--float-above' );
			//move label to be the last child of div
			$div->appendChild( $get_label );

			//create a new div
			$bottom_line_div = $dom->createElement( 'div' );
			$bottom_line_div->setAttribute( 'class', 'mdc-text-field__bottom-line' );
			$div->appendChild( $bottom_line_div );
			$content = $dom->saveHTML();
		}
	}

}


/***************************************** for time dropdown ****************************************************************************/

if ( $field->type === 'time' ) {
	$get_divs = $dom->getElementsByTagName( 'div' );
	foreach ( $get_divs as $get_div ) {
		$div_classes = $get_div->getAttribute( 'class' );
		if ( strpos( $div_classes, 'gfield_time_ampm' ) !== false ) {
			$get_div->setAttribute( 'class',
				$get_div->getAttribute( 'class' ) . '  mdc-text-field' );
			$get_div->setAttribute( 'data-mdc-auto-init', 'MDCTextField' );

			$get_select = $get_div->getElementsByTagName( 'select' )->item( 0 );
			$get_select->setAttribute( 'class',
				$get_select->getAttribute( 'class' ) . '  mdc-text-field__input' );

			//create a new div
			$bottom_line_div = $dom->createElement( 'div' );
			$bottom_line_div->setAttribute( 'class', 'mdc-text-field__bottom-line' );
			$get_div->appendChild( $bottom_line_div );
		}
	}
	$content = $dom->saveHTML();
}

/***************************************** for address dropdown inputs ****************************************************************************/
if ( $field->type == 'address' ) {

	$get_spans = $dom->getElementsByTagName( 'span' );
	$contains_error = false;

	$all_divs = $dom->getElementsByTagName( 'div' );
	foreach ( $all_divs as $current_div ) {
		$current_div_classes = $current_div->getAttribute( 'class' );
		if ( strpos( $current_div_classes, 'validation_message' ) !== false ) {
			$contains_error = true;
			$current_div->setAttribute( 'class', $current_div->getAttribute( 'class' ) . ' mdc-text-field-helper-text mdc-text-field-helper-text--persistent mdc-text-field-helper-text--validation-msg' );
		}
	}

	foreach ( $get_spans as $get_span ) {
		$address_classes = $get_span->getAttribute( 'class' );
		if ( strpos( $address_classes, 'address_country' ) !== false ) {
			
			
			$span_classes = $get_span->getAttribute( 'class' );
			$span_classes .= ' mdc-text-field ';
			if ( $contains_error ) {
				$span_classes .= ' mdc-text-field--invalid';
			}
			$get_span->setAttribute( 'class', $span_classes );
			$get_span->setAttribute( 'data-mdc-auto-init', 'MDCTextField' );

			//add class to select
			$get_select = $get_span->getElementsByTagName( 'select' )->item( 0 );
			$select_classes = $get_select->getAttribute( 'class' ) . ' mdc-text-field__input';
			
			$get_select->setAttribute( 'class', $select_classes );

			$get_label = $get_span->getElementsByTagName( 'label' )->item( 0 );
			$get_label->setAttribute( 'class', $get_label->getAttribute( 'class' ) . ' mdc-text-field__label  mdc-text-field__label--float-above' );

			//check if the country field has placeholder
			if( $field->inputs[5]['placeholder'] !== '' ){
				$option = $get_span->getElementsByTagName( 'option' )->item( 0 );
				$option->setAttribute( 'class', $option->getAttribute( 'class' ) . ' stla-material-placeholder' );
		   }
			//move label to be the last child of div
			$get_span->appendChild( $get_label );

			//create a new div
			$bottom_line_div = $dom->createElement( 'div' );
			$bottom_line_div->setAttribute( 'class', 'mdc-text-field__bottom-line' );
			$get_span->appendChild( $bottom_line_div );
			$content = $dom->saveHTML();
		}

	}


	$content = $dom->saveHTML();
}
