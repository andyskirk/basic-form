// Form validation
var formElement = document.getElementById('registration-form');
formElement.addEventListener("submit", function(event){
	event.preventDefault();
	// Check the validation - set to true if we fail any step
	var bolValidationFailed = false; 
	
	// Get the required fields (class .required) in the form
	var formFields = this.querySelectorAll('input.required');
	
	for(var i = 0; i < formFields.length; i++){
		if(formFields[i].value.length === 0){
			formFields[i].classList.add('field-required');
			bolValidationFailed = true;
		} else {
			formFields[i].classList.remove('field-required');
		}
	}
	
	// Now submit the form
	if(!bolValidationFailed){
		this.submit();
	}
	
}, false);


