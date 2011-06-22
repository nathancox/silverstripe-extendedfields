$(document).ready(function() {
	jQuery('.ExtendedNumericField').keyup(function () {
		var oldValue = this.value;
		this.value = this.value.replace(/[^0-9\.]/g,'');
		if (this.value != oldValue) {
			// @TODO: provide a hook or something so we can have a "numbers only" message?
		}
	});
});