<?php
/*
	@TODO look at using type='number'
	
*/
class ExtendedNumericField extends ExtendedTextField {
	
	function validate($validator){
		if($this->value && !is_numeric(trim($this->value))){
 			$validator->validationError(
 				$this->name,
				sprintf(
					_t('NumericField.VALIDATION', "'%s' is not a number, only numbers can be accepted for this field"),
					$this->value
				),
				"validation"
			);
			return false;
		} else{
			return true;
		}
	}
	
	function dataValue() {
		return (is_numeric($this->value)) ? $this->value : 0;
	}
	
	function includeJavascript() {
		Requirements::javascript('extendedfields/javascript/ExtendedNumericField.js');
	}
	
	function includeCSS() {
	}
	
}