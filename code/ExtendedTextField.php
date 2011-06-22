<?php

class ExtendedTextField extends TextField {
	protected $placeholder;
	protected $dataAttributes = array();
	protected $includeJS = true;
	protected $includeCSS = true;
	
	function setIncludeJavaScript($doIt) {
		$this->includeJS = $doIt;
	}
	function getIncludeJavaScript() {
		return $this->includeJS;
	}
	
	function setIncludeCSS($doIt) {
		$this->includeCSS = $doIt;
	}
	function getIncludeCSS() {
		return $this->includeCSS;
	}
	
	function setPlaceHolder($text) {
		$this->placeholder = $text;
	}
	function getPlaceHolder($text) {
		return $this->placeholder;
	}
	
	function setData($input, $value = null) {
		if (is_string($input)) {
			$this->dataAttributes[$input] = $value;
		} else if (is_array($input)) {
			foreach ($input as $key => $value) {
				$this->dataAttributes[$key] = $value;
			}
		}
	}
	function getData() {
		return $this->dataAttributes;
	}
	
	/*
	function getFieldType() {
		return 'text';
	}
	*/
	function getFieldAttributes() {
		$attributes = array(
			'type' => 'text',
			'class' => $this->getClassNames() . ' ' . ($this->extraClass() ? $this->extraClass() : ''),
			'id' => $this->id(),
			'name' => $this->Name(),
			'value' => $this->Value(),
			'tabindex' => $this->getTabIndex(),
			'maxlength' => ($this->maxLength) ? $this->maxLength : null,
			'size' => ($this->maxLength) ? min( $this->maxLength, 30 ) : null 
		);
		
		if($this->placeholder) {
			$attributes['placeholder'] = $this->placeholder;
		}
		
		foreach ($this->dataAttributes as $key => $value) {
			if (!is_null($value)) {
				$attributes['data-'.$key] = $value;
			}
		}
		
		if($this->disabled) {
			$attributes['disabled'] = 'disabled';
		}

		return $attributes;
	}
	
	function Field() {
		if ($this->getIncludeJavaScript()) {
			$this->includeJavaScript();
		}
		if ($this->getIncludeCSS()) {
			$this->includeCSS();
		}
		
		return $this->makeField();
	}
	
	function makeField() {
		$attributes = $this->getFieldAttributes();
		return $this->createTag('input', $attributes);		
	}
	
	function getClassNames() {
		return 'text '.$this->class;
	}
	
	function includeJavascript() {
	}
	
	function includeCSS() {
	}
	
}