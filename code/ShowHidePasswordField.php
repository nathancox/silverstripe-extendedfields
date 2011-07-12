<?php

class ShowHidePasswordField extends ExtendedPasswordField {
	var $extraButtonClasses = array();
	var $buttonTag = 'checkbox';
	var $buttonShowText = 'show password';
	var $buttonHideText = 'hide password';
	
	function makeField() {
		$this->setData(array(
			'button-tag' => $this->buttonTag,
			'button-show-text' => $this->buttonShowText,
			'button-hide-text' => $this->buttonHideText
		));
		$attributes = $this->getFieldAttributes();
		$attributes['type'] = 'password';
		
		$inputHTML = $this->createTag('input', $attributes);
		
		return $inputHTML;
	}
	/*
	function addButtonClass($class) {
		$this->extraButtonClasses[$class] = $class;
	}
	function removeButtonClass($class) {
		if(isset($this->extraButtonClasses) && array_key_exists($class, $this->extraButtonClasses)) unset($this->extraButtonClasses[$class]);
	}
	*/
	function setButtonTag($tag) {
		if ($tag == 'button' || $tag == 'input' || $tag == 'a' || $tag == 'checkbox') {
			$this->buttonTag = $tag;
		}
	}
	function getButtonTag() {
		return $this->buttonTag;
	}

	function setButtonShowText($text) {
		$this->buttonShowText = $text;
	}
	function getButtonShowText() {
		return $this->buttonShowText;
	}
	
	function setButtonHideText($text) {
		$this->buttonHideText = $text;
	}
	function getButtonHideText() {
		return $this->buttonHideText;
	}

	function includeJavascript() {
		Requirements::javascript('extendedfields/javascript/extendedFields.js');
	}


}