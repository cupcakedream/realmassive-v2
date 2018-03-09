<?php
/***************************************** for input fields like text, numbers, email and website **************************************/

if ( in_array( $field->type, $input_fields ) ) {
	$input_classes_types = array( 'ginput_container_date', 'ginput_container_text', 'ginput_container_phone', 'ginput_container_email', 'ginput_container_website', 'ginput_container_post_title', 'ginput_container_number' );

	$contains_error = false;
	$contains_placeholder = false;
	$input_id = '';
	$all_divs = $dom->getElementsByTagName( 'div' );
	foreach ( $all_divs as $current_div ) {
		$current_div_classes = $current_div->getAttribute( 'class' );
		if ( strpos( $current_div_classes, 'validation_message' ) !== false ) {
			$contains_error = true;
			$current_div->setAttribute( 'class', $current_div->getAttribute( 'class' ) . ' mdc-text-field-helper-text mdc-text-field-helper-text--persistent mdc-text-field-helper-text--validation-msg' );
		}
	}
	//get the first div

	foreach ( $all_divs as $div ) {
		$div_classes = $div->getAttribute( 'class' );

		$div_classes_array = explode( ' ', $div_classes );

		//var_dump($div_classes_array);

		$is_valid_input_field = false;

		foreach ( $div_classes_array as $div_class_value ) {
			if ( in_array( $div_class_value, $input_classes_types ) ) {
				$is_valid_input_field = true;
			}
		}
		// var_dump($is_valid_input_field);
		if ( $is_valid_input_field ) {


			//add class to input
			$inputs = $dom->getElementsByTagName( 'input' );
			foreach ( $inputs as $input ) {
				$id = $input->getAttribute( 'id' );
				
				$input_type = $input->getAttribute( 'type' );
				if ( $input_type === 'text' && preg_match( '/^input_/', $id ) ) {
					$input_id = $id;
					$input_classes = $input->getAttribute( 'class' );
					$input->setAttribute( 'class', $input_classes . ' mdc-text-field__input' );

					// check if contains placeholder
					if ( $input->getAttribute( 'placeholder' ) !== '' ) {
						$contains_placeholder = true;
					}

					//find the size of field
					if ( strpos( $input_classes, 'large' ) !== false ) {
						$field_size_class = 'stla_material_large';
					}
					else if ( strpos( $input_classes, 'medium' ) !== false ) {
						$field_size_class = 'stla_material_medium';
					}
					else {
						$field_size_class = 'stla_material_small';
					}
				}
			}



			//add classes to div
			$add_div_classes = ' mdc-text-field ' . $field_size_class;
			//if has error then add the error class
			if ( $contains_error ) {
				$add_div_classes .= ' mdc-text-field--invalid';
			}
			$div->setAttribute( 'class', $div->getAttribute( 'class' ) . $add_div_classes );
			$div->setAttribute( 'data-mdc-auto-init', 'MDCTextField' );

			//get the first label
			$labels = $dom->getElementsByTagName( 'label' );
			foreach ( $labels as $label ) {
				$label_for = $label->getAttribute( 'for' );
				

				if ( $input_id === $label_for ) {
					$add_label_classes = ' mdc-text-field__label';
					if ( $contains_placeholder ) {
						$add_label_classes .= ' mdc-text-field__label--float-above';
					}
					$label->setAttribute( 'class', $label->getAttribute( 'class' ) . $add_label_classes );
					$div->appendChild( $label );
				}
			}
			//create a new div
			$bottom_line_div = $dom->createElement( 'div' );
			$bottom_line_div->setAttribute( 'class', 'mdc-text-field__bottom-line' );
			$div->appendChild( $bottom_line_div );
		}
		$content = $dom->saveHTML();
	}
}
