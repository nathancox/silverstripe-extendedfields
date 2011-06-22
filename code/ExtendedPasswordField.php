<?php

class ExtendedPasswordField extends ExtendedTextField {
	
	function makeField() {
		$attributes = $this->getFieldAttributes();
		$attributes['type'] = 'password';
		
		return $this->createTag('input', $attributes);
	}
	
	/**
	 * Makes a pretty readonly field with some stars in it
	 */
	function performReadonlyTransformation() {
		$stars = '*****';

		$field = new ReadonlyField($this->name, $this->title ? $this->title : '', $stars);
		$field->setForm($this->form);
		$field->setReadonly(true);
		return $field;
	}
	
}