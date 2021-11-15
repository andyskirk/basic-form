<?php 
	namespace form; 
	class register {
		public static $arrFormFields = array(
			"firstname" => array(
				"label" => "First Name",
				"type" => "text",
				"required" => false,
				"maxsize" => 80
			),
			"lastname" => array(
				"label" => "Last Name",
				"type" => "text",
				"required" => false,
				"maxsize" => 80
			),
			"jobtitle" => array(
				"label" => "Job Title",
				"type" => "text",
				"required" => true,
				"maxsize" => 60
			),
			"emailaddress" => array(
				"label" => "Email Address",
				"type" => "email",
				"required" => true,
				"maxsize" => 120
			)
		);
		
		// Validate the posted form values
		// Expansion:: return more than just false, return field level messaging
		public static function validateForm(){
			session_start();
			// Check csrf token
			if(!isset($_SESSION['csrf_token']) || !isset($_POST['token'])){
				return false;
			}
			
			if($_SESSION['csrf_token'] !== $_POST['token']){
				return false;
			}
			
			// Validate required fields
			foreach(static::$arrFormFields as $strFieldName => $arrField){
				if($arrField['required'] && $_POST[$strFieldName] == ""){
					return false;
				}
				
				// Validate field length
				// Expansion:: allow for other types than just strings (numbers etc.)
				if(strlen($_POST[$strFieldName]) > $arrField['maxsize']){
					return false;
				}
			}
			// Fall through - success state
			return true;
		}
	}
