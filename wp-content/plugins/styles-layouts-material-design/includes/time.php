<?php
/***************************************** for time field ****************************************************************************/
//var_dump($field->type);
if ( $field->type === 'time' ) {

	$contains_error = false;

	//check if error is present
	$all_divs = $dom->getElementsByTagName( 'div' );
	foreach ( $all_divs as $current_div ) {
		$current_div_classes = $current_div->getAttribute( 'class' );
		if ( strpos( $current_div_classes, 'validation_message' ) !== false ) {
			$contains_error = true;
			//$current_div->setAttribute( 'class', $current_div->getAttribute( 'class').' mdc-text-field-helper-text mdc-text-field-helper-text--persistent mdc-text-field-helper-text--validation-msg' );
		}
	}

	foreach ( $all_divs as $container ) {
		$div_classes = $container->getAttribute( 'class' );
		if ( strpos( $div_classes, 'gfield_time_hour' ) !== false || strpos( $div_classes, 'gfield_time_minute' ) !== false ) {

			if ( $contains_error ) {
				$div_classes .= ' mdc-text-field--invalid';
			}
			$container->setAttribute( 'class',
			$div_classes.' mdc-text-field'  );
			$container->setAttribute( 'data-mdc-auto-init', 'MDCTextField' );

			$inputs = $container->getElementsByTagName( 'input' );
			foreach ( $inputs as $input ) {
				$input_id = $input->getAttribute( 'id' );
				$input_type = $input->getAttribute( 'type' );
				//partial match id to make sure its the input we want to tag
				if ( strpos(  $input_id, 'input_' ) !== false && $input_type === 'text' ) {
					$input->setAttribute( 'class',
						$input->getAttribute( 'class' ) . ' mdc-text-field__input' );
				}

				//check if placeholer is present then add float above class
				$add_label_classes = ' mdc-text-field__label';
				if ( $input->getAttribute( 'placeholder' ) !== '' ) {
					$add_label_classes .= ' mdc-text-field__label--float-above';
				}

				$labels = $container->getElementsByTagName( 'label' );
				foreach ( $labels as $label ) {
					$label_for = $label->getAttribute( 'for' );
					//check if the label is meant to be for the input we have tagged with mdc
					if ( $label_for === $input_id ) {
						$label->setAttribute( 'class',
							$label->getAttribute( 'class' ) . $add_label_classes );
					}
				}
			}

			//if current field is either for hours or minutes then consider it as input type text and add bottom line

			//create a new div
			$bottom_line_div = $dom->createElement( 'div' );
			$bottom_line_div->setAttribute( 'class', 'mdc-text-field__bottom-line' );
			$container->appendChild( $bottom_line_div );

			//$content = utf8_decode( $dom->saveHTML( $dom->documentElement ) );
			$content = $dom->saveHTML( $dom ) ;
		}

	}


}
