<?php

/***************************************** for textarea ****************************************************************************/
//var_dump($field->type);
if ( $field->type === 'textarea' || $field->type === 'post_content' || $field->type === 'post_excerpt' ) {

	$divs = $dom->getElementsByTagName( 'div' );

	$contains_error = false;
	foreach ( $divs as $div ) {
		$current_div_classes = $div->getAttribute( 'class' );
		if ( strpos( $current_div_classes, 'validation_message' ) !== false ) {
			$contains_error = true;
			$div->setAttribute( 'class', $div->getAttribute( 'class' ) . ' mdc-text-field-helper-text mdc-text-field-helper-text--persistent mdc-text-field-helper-text--validation-msg' );
		}
	}

	foreach ( $divs as $div ) {
		$contains_placeholder = false;
		$add_label_classes = '';
		$div_classes = $div->getAttribute( 'class' );
		if ( strpos( $div_classes, 'ginput_container_textarea' ) !== false || strpos( $div_classes, 'ginput_container_post_excerpt' ) !== false ) {
			if ( $contains_error ) {
				$div_classes .= ' mdc-text-field--invalid';
			}
			$div->setAttribute( 'class', $div_classes . ' mdc-text-field mdc-text-field--textarea' );
			$div->setAttribute( 'data-mdc-auto-init', 'MDCTextField' );

			$textareas = $div->getElementsByTagName( 'textarea' );

			foreach ( $textareas as $textarea ) {
				if ( $textarea->getAttribute( 'placeholder' ) !== '' ) {
					$add_label_classes .= ' mdc-text-field__label--float-above';
				}
				$textarea->setAttribute( 'class',
					$textarea->getAttribute( 'class' ) . ' mdc-text-field__input' );

			}
			$labels = $dom->getElementsByTagName( 'label' );
			foreach ( $labels as $label ) {
				$add_label_classes .= ' mdc-text-field__label';
				$label->setAttribute( 'class', $label->getAttribute( 'class' ) . $add_label_classes );
				$div->appendChild( $label );
			}



		}

	}



	//get the first label


	$content = $dom->saveHTML();
}
