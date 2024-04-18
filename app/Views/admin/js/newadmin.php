

<script>
	document.addEventListener('DOMContentLoaded', function(e) {
		// Generate a simple captcha
		const form = document.getElementById('newAdmin');
		FormValidation.formValidation(form, {
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				name: {
					validators: {
						notEmpty: {
							message: 'User Name'
						}
					}
				},
				email: {
					validators: {
						notEmpty: {
							message: 'The email address is required'
						},
						emailAddress: {
							message: 'The input is not a valid email address'
						}
					}
				},
				password: {
					validators: {
						notEmpty: {
							message: 'The password is required'
						},
						stringLength: {
							min: 8,
							//max:20,
							message: 'The password must contain at least 8 characters.',
						},
					}
				},
				/* availability: {
					validators: {
						notEmpty: {
							message: 'The availability option is required'
						}
					}
				},*/
			},
			plugins: {
				trigger: new FormValidation.plugins.Trigger(),
				defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				bootstrap: new FormValidation.plugins.Bootstrap(),
				submitButton: new FormValidation.plugins.SubmitButton(),
				/* icon: new FormValidation.plugins.Icon({
					 valid: 'fa fa-check',
					 invalid: 'fa fa-times',
					 validating: 'fa fa-refresh',
				 }),*/
			},



		});
	});
</script>




