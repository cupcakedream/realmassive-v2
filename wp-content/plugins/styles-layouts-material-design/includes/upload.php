<?php

/***************************************** for Upload Field ****************************************************************************/
		//var_dump($field->type);
		if( $field->type === 'fileupload' || $field->type === 'post_image'){
			$inputs = $dom->getElementsByTagName('input');
			foreach($inputs as $input) {
				$input_type = $input->getAttribute('type');
				if( $input_type === 'file'|| $input_type === 'button'){
					$input->setAttribute('class', $input->getAttribute('class').' mdc-button mdc-button--raised ');
				}				
			}	
			$content = utf8_decode($dom->saveHTML($dom->documentElement));
		}

	