<?php

class CheckoutPage extends Page {
	static $icon = 'mysite/images/checkout';
	static $allowed_children = "none";

	static $defaults = array(
		'ShowInMenus' => false,
		'ShowInSearch' => false
	);

	public static $db = array(
	);

	public static $has_one = array(
	);

	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		return $fields;
	}
	
	public function canCreate() {
		// here is a trick to only allow one (e.g. holder) of a page
		return !DataObject::get_one($this->class);
	}

	public function canDelete() {
		return false;
	}
	
}
class CheckoutPage_Controller extends Page_Controller {
	
	function index($request) {
		$member = Member::currentUser();
		
		/*
		if ($member) {
			// proceed to payment
			Page::setStatusMessage("User is logged in");
			Director::redirect($this->Link('confirm'));
			return;
		} else {
			// show sign up/log in
		}
		*/
		
		return $this->customise(array(
		));
	}
	
	function AccountDetailsForm() {
		$fields = new FieldSet();
		
		$fields->push($shippingTitle = new HeaderField('ShippingHeader', 'Shipping Details', 2));
		
		$fields->push($fullName = new ExtendedTextField('FullName', 'Full name'));
			$fullName->setValidationRules(array(
				'required' => true
			));
			$fullName->setValidationMessages(array(
				'required' => 'Please tell us your name.'
			));
		
		
		$fields->push(new CompositeField(
			$addressOne = new ExtendedTextField('AddressOne', 'Address 1'),
			$addressTwo = new ExtendedTextField('AddressTwo', 'Address 2 (optional)')
		));
			$addressOne->setValidationRules(array(
				'required' => true
			));
			$addressOne->setValidationMessages(array(
				'required' => 'Please give us a shipping address.'
			));
			
			
		$fields->push($city = new ExtendedTextField('City', 'City'));
			$city->setValidationRules(array(
				'required' => true
			));
			$city->setValidationMessages(array(
				'required' => 'Which city do you want your purchases sent to?'
			));
			
			
		$fields->push($postCode = new ExtendedTextField('PostCode', 'Post Code'));
			$postCode->setValidationRules(array(
				'required' => true
			));
			$postCode->setValidationMessages(array(
				'required' => 'Please tell us your post code'
			));

		$fields->push($phone = new ExtendedTextField('PhoneNumber', 'Phone Number'));
			$phone->setRightTitle('In case we need to call for delivery related questions.');
			$phone->setValidationRules(array(
				'required' => true
			));
			$phone->setValidationMessages(array(
				'required' => 'Please tell us your phone number.  We promise not to call during dinner.'
			));
		
		if (Country::current() == 'NZ') {
			$country = 'New Zealand';
		} else {
			$country = 'Australia';
		}
		$fields->push($countryField = new TextField('Country', 'Country', $country));
		$countryField->setReadonly(true);
		
		
		$fields->push($accountTitle = new HeaderField('AccountHeader', 'Account Details', 2));
		$fields->push($accountBlurb = new LiteralField('AccountBlurb', '
		<p>
			You can use these details to log in and view your order history or make purchases without filling in this form again.
		</p>
		'));
		
		$fields->push($email = new ExtendedEmailField('Email', 'Email Address'));
			$email->setValidationRules(array(
				'required' => true,
				'email' => true
			));
			$email->setValidationMessages(array(
				'required' => 'We need your email address to associate with your account, and to send you a receipt.  We promise not to spam you.',
				'email' => "That doesn't look like a valid email address.  Is there a typo?"
			));
		
		$fields->push($passwordField = new ExtendedPasswordField('SignupPassword', 'Password'));
			$passwordField->setAutoComplete(false);
			$passwordField->setValidationRules(array(
				'required' => true,
			));
			$passwordField->setValidationMessages(array(
				'required' => "You'll need a password or your account won't work."
			));
		
		
		
		
		$actions = new FieldSet(
			$submitButton = new FormAction('doCheckoutSignup', "Proceed")
		);
		//$submitButton->addExtraClass('black');
		
		$validator = new FMFieldValidator();
		
		$form = new Form($this, 'AccountDetailsForm', $fields, $actions, $validator);
//		$form->setTemplate('UpdateCartForm');

		$member = Member::currentUser();
		if ($member) {
			$form->loadDataFrom($member);
			$passwordField->setValue('');
			$passwordField->setPlaceholder('(your password)');
		}
		
		return $form;
	}
	
	
	
	/*
		Show the cart and totals with "confirm/pay now" button
	*/
	function confirm($request) {
		$member = Member::currentUser();
		if (!$member) {
			// proceed to payment
			Page::setStatusMessage("You must be logged in to check out", "error");
			Director::redirect($this->Link());
			return;
		}
		
		return $this->customise(array(
			'Title' => 'Confirm your purchase',
		));
	}
	
	
}

















