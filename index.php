<?php 
// CSRF Token
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<?php 
	include_once("form.php"); 
?>

<!DOCTYPE html>
<html>
<head>
<title>Form by Andy</title>
<link rel="stylesheet" href="/css/main.css">
</head>
<body>
	<div class="form-wrapper"> 
		<?php if(isset($_GET['success']) && $_GET['success']): ?>
			<h3>Thank you for using our form, we'll be in contact with you soon.</h3>
		<?php else: ?>
			<form method="post" action="submit.php" id="registration-form">
				<?php if(isset($_GET['error']) && $_GET['error']): ?>
					<div class="form-error"> 
						<h3>Please ensure you fill in all the required fields</h3>
					</div>
				<?php endif; ?>
				<input type="hidden" name="token" value="<?= $_SESSION['csrf_token']; ?>" />
				<?php foreach(form\register::$arrFormFields as $strFieldName => $arrField): ?>
					<div class="form-row-wrapper">
						<label for="<?= $strFieldName; ?>"><?= $arrField['label']; ?> <?= $arrField['required'] ? "<span class='required-asterisk'>*</span>" : ""; ?></label>
						<div class="form-field-wrapper">
							<input 
								type="<?= $arrField['type']; ?>" 
								name="<?= $strFieldName; ?>"
								maxlength="<?= $arrField['maxsize']; ?>" 
								value="<?= isset($_POST[$strFieldName]) ? $_POST[$strFieldName] : ""; ?>" 
								class="<?= $arrField['required'] ? "required": ""; ?>" />
						</div>
					</div>
				<?php endforeach; ?>
				<div class="form-field-wrapper">
					<button>Submit</button>
				</div>
			</form>
		<?php endif; ?>
	</div>
</body>
<script type="text/javascript" src="./js/script.js"></script>
</html> 