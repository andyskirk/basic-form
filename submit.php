<?php 
	include_once("form.php"); 
	include_once("helpers/strings.php");
	include_once("config/settings.php");
?>

<?php 
	// Success State
	$_POST['success'] = false;

	// Validate the form
	if(\form\register::validateForm()){
		// We can submit as the form data is valid
		$dbh = new PDO("mysql:host={$dbConn['host']};dbname={$dbConn['dbname']}", $dbConn['user'], $dbConn['pass']);
		
		$strSQL = "
			INSERT INTO user_registration (strFirstName, strLastName, strJobTitle, strEmailAddress)
			VALUES (:strFirstName, :strLastName, :strJobTitle, :strEmailAddress)
		";
		
		// Build the post data into an array
		$aryData = array(
			":strFirstName" => $_POST['firstname'], 
			":strLastName" => $_POST['lastname'], 
			":strJobTitle" => $_POST['jobtitle'], 
			":strEmailAddress" => $_POST['emailaddress']
		);
		
		// Perform a basic XSS protection on all the inputs -> htmlspecialchars
		$aryPostData = array_map(function($strField){
			return \helpers\strings::cleanString($strField);
		}, $aryData);

		// Insert
		$stmt = $dbh->prepare($strSQL);
		$stmt->execute($aryPostData);
		
		// Show success state
		$_POST['success'] = true;
		header('Location: /?success=true');
		exit();
	} else {
		// Show failed state
		header('Location: /?error=true');
		exit();
	}
	