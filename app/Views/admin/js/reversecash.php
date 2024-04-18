

<script>
	document.addEventListener('DOMContentLoaded', function(e) {
		// Generate a simple captcha
		const form = document.getElementById('reverscashbox');
		FormValidation.formValidation(form, {
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				userId: {
					validators: {
						notEmpty: {
							message: 'User ID is Required'
						}
					}
				},
				currency: {
					validators: {
						notEmpty: {
							message: 'Currency is Required'
						}
					}
				},
				reason: {
					validators: {
						notEmpty: {
							message: 'Reason is required'
						}
					}
				},
				amount: {
					validators: {
						notEmpty: {
							message: 'Amount is Required'
						},
						numeric: {
							message: 'The value is not a number',
							// The default separators
							thousandsSeparator: '',
							decimalSeparator: '.'
						}
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




