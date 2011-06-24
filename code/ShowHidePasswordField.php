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
		
		/*
		// @TODO: the whole way the button is made is just messy
		$buttonClasses = implode(' ', $this->extraButtonClasses);
		$buttonAttributes = array(
			"data-field-id='".$attributes['id']."'",
			"data-show-text='".$this->buttonShowText."'",
			"data-hide-text='".$this->buttonHideText."'"
		);
		$buttonAttributeHTML = implode(' ', $buttonAttributes);
		
		if ($this->buttonTag == 'a') {
			$buttonHTML = "<a href='#' class='ShowHidePasswordField-button {$buttonClasses}' style='display:none;' ".$buttonAttributeHTML.">".$this->buttonShowText."</a>";
		} else if ($this->buttonTag == 'button') {
			$buttonHTML = "<button class='ShowHidePasswordField-button {$buttonClasses}' style='display:none;' ".$buttonAttributeHTML.">".$this->buttonShowText."</button>";
		} else if ($this->buttonTag == 'input') {
			$buttonHTML = "<input type='button' class='ShowHidePasswordField-button {$buttonClasses}' title='".$this->buttonShowText."' style='display:none;' ".$buttonAttributeHTML." />";
		}
		
		$html = $inputHTML . $buttonHTML;*/
		
		return $inputHTML;
	}
	
	function addButtonClass($class) {
		$this->extraButtonClasses[$class] = $class;
	}
	function removeButtonClass($class) {
		if(isset($this->extraButtonClasses) && array_key_exists($class, $this->extraButtonClasses)) unset($this->extraButtonClasses[$class]);
	}
	
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