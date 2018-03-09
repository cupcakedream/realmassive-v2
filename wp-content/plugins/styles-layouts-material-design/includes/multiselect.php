<?php

/***************************************** for multiselect inputs ****************************************************************************/
//var_dump($field->type);
if ( in_array( $field->type, $multiselect_fields )  ) {
	$multiselect_classes_types = array( 'ginput_container_multiselect' );

	//get the  divs

	$divs = $dom->getElementsByTagName( 'div' );



	foreach ( $divs as $div ) {

		$is_valid_input_field = false;
		$div_classes = $div->getAttribute( 'class' );
		$div_classes_array = explode( ' ', $div_classes );
		foreach ( $div_classes_array as $div_class_value ) {
			if ( in_array( $div_class_value, $multiselect_classes_types ) ) {
				$is_valid_input_field = true;
			}
		}

		if ( $is_valid_input_field ) {
			$selects = $dom->getElementsByTagName( 'select' );
			foreach ( $selects as $select ) {
				$select_classes = $select->getAttribute( 'class' );
				$select->setAttribute( 'class', $select_classes . ' mdc-list mdc-list--dense' );
				$select->setAttribute( 'size', '5' );
				$options = $select->getElementsByTagName( 'option' );
				foreach ( $options as $option ) {
					$option->setAttribute( 'class', $option->getAttribute( 'class' ) . ' mdc-list-item' );
				}

				if ( strpos( $select_classes, 'large' ) !== false ) {
					$field_size_class = 'stla_material_large';
				}
				else if ( strpos( $select_classes, 'medium' ) !== false ) {
					$field_size_class = 'stla_material_medium';
				}
				else {
					$field_size_class = 'stla_material_small';
				}
			}
			$div->setAttribute( 'class', $div->getAttribute( 'class' ) . ' ' . $field_size_class );
		}
		
	}

	$content = $dom->saveHTML();
}
