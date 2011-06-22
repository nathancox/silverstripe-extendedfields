<?php

class ExtendedEmailField extends ExtendedTextField {

	function validate($validator){
		$this->value = trim($this->value);
		
		$pcrePattern = '^[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$';


		// PHP uses forward slash (/) to delimit start/end of pattern, so it must be escaped
		$pregSafePattern = str_replace('/', '\\/', $pcrePattern);

		if($this->value && !preg_match('/' . $pregSafePattern . '/i', $this->value)){
 			$validator->validationError(
 				$this->name,
				_t('EmailField.VALIDATION', "Please enter an email address."),
				"validation"
			);
			return false;
		} else{
			return true;
		}
	}
	
}