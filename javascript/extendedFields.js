$(document).ready(function() {

	jQuery('.ExtendedNumericField').live('keyup', function () {
		var oldValue = this.value;
		this.value = this.value.replace(/[^0-9\.]/g,'');
		if (this.value != oldValue) {
			// @TODO: provide a hook or something so we can have a "numbers only" message?
		}
	});
	
	jQuery('.ShowHidePasswordField').showHidePassword();

});




// @TODO: refactor this whole thing now that I've stabilised the scope a bit
(function($){
		var showHidePasswordMethods = {
			init: function(options) {
				return this.each(function() {
					
					var buttonTag = this.getAttribute('data-button-tag');
					var buttonShowText = this.getAttribute('data-button-show-text');
					var buttonHideText = this.getAttribute('data-button-hide-text');
					var labelText = '';
					
					$passwordField = $(this);
					
					var $textField = $('<input />');
					$textField.attr({
						'type': 'text',
						'class': $passwordField.attr('class'),
						'style': $passwordField.attr('style'),
						'size':	$passwordField.attr('size'),
						'name':	$passwordField.attr('name')+'-text',
						'id':	$passwordField.attr('id')+'-text',
						'tabindex':	$passwordField.attr('tabindex')
					});
					$textField.hide();
					$textField.insertAfter(this);
					
					$textField.live('keyup', function() {
						$passwordField.val($(this).val());
					});
					
					if (buttonTag == 'checkbox') {
						var $buttonField = $('<input />');
						$buttonField.attr({
							'type': 'checkbox',
							'class': 'show-hide-password-checkbox',
							'name':	this.getAttribute('name')+'-checkbox',
							'id':	this.getAttribute('id')+'-checkbox'
						});
						
						$buttonField.click(function() {
							if ($(this).is(':checked')) {
								$textField.val($passwordField.val());
								$passwordField.hide();
							//	$textField.show();
								$textField.attr('style', '');		// use this hacky way because .show() sets display:block when I don't want it to
							} else {
								$passwordField.val($textField.val());
								$textField.hide();
							//	$passwordField.show();
								$passwordField.attr('style', '');		// use this hacky way because .show() sets display:block when I don't want it to
							}
							
							
							
						});
						
						labelText = buttonShowText;
					
					
					} else if (buttonTag == 'a') {
						var $buttonField = $('<a>');
						$buttonField.attr({
							'class': 'show-hide-password-button',
							'id':	this.getAttribute('id')+'-button',
							'href': '#'
						});
						$buttonField.html(buttonShowText);
						
						$buttonField.click(function() {
							if ($passwordField.css('display') != 'none') {
								$textField.val($passwordField.val());
								$passwordField.hide();
							//	$textField.show();
								$textField.attr('style', '');		// use this hacky way because .show() sets display:block when I don't want it to
								$buttonField.html(buttonHideText);
							} else {
								$passwordField.val($textField.val());
								$textField.hide();
							//	$passwordField.show();
								$passwordField.attr('style', '');		// use this hacky way because .show() sets display:block when I don't want it to
								$buttonField.html(buttonShowText);
							}
							return false;
						});
					} else if (buttonTag == 'button') {
						var $buttonField = $('<button />');
						$buttonField.attr({
							'class': 'show-hide-password-button',
							'id':	this.getAttribute('id')+'-button',
							'name':	this.getAttribute('name')+'-button'
						});
						$buttonField.html(buttonShowText);
						
						$buttonField.click(function() {
							if ($passwordField.css('display') != 'none') {
								$textField.val($passwordField.val());
								$passwordField.hide();
							//	$textField.show();
								$textField.attr('style', '');		// use this hacky way because .show() sets display:block when I don't want it to
								$buttonField.html(buttonHideText);
							} else {
								$passwordField.val($textField.val());
								$textField.hide();
							//	$passwordField.show();
								$passwordField.attr('style', '');		// use this hacky way because .show() sets display:block when I don't want it to
								$buttonField.html(buttonShowText);
							}
							return false;
						});
						
					} else if (buttonTag == 'input') {
						var $buttonField = $('<input />');
						$buttonField.attr({
							'class': 'show-hide-password-button',
							'id':	this.getAttribute('id')+'-button',
							'name':	this.getAttribute('name')+'-button',
							'value': buttonShowText,
							'type': 'button'
						});
						
						
						$buttonField.click(function() {
							if ($passwordField.css('display') != 'none') {
								$textField.val($passwordField.val());
								$passwordField.hide();
							//	$textField.show();
								$textField.attr('style', '');		// use this hacky way because .show() sets display:block when I don't want it to
								$buttonField.attr('title', buttonHideText);
							} else {
								$passwordField.val($textField.val());
								$textField.hide();
							//	$passwordField.show();
								$passwordField.attr('style', '');		// use this hacky way because .show() sets display:block when I don't want it to
								$buttonField.attr('title', buttonShowText);
							}
							return false;
						});
						
					}
				
					$labelField = $('<label />');
					$labelField.attr({
						'for': this.getAttribute('id')+'-checkbox',
						'class': 'show-hide-password-button-label',
						'id':	this.getAttribute('id')+'-button-label'
					});
					$labelField.append($buttonField);
					$labelField.append(' '+labelText);
					$labelField.insertAfter($textField);
					
				});
			}
		};
		
		
    $.fn.showHidePassword = function(method) {
			if (showHidePasswordMethods[method]) {
				return showHidePasswordMethods[method].apply(this, Array.prototype.slice.call(arguments, 1));
			} else if (typeof method === 'object' || ! method) {
				return showHidePasswordMethods.init.apply(this, arguments);
			} else {
				$.error('Method ' +  method + ' does not exist on jQuery.tooltip');
			}
    
  };
})(jQuery);







