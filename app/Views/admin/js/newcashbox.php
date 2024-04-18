

<script>
	document.addEventListener('DOMContentLoaded', function(e) {
		// Generate a simple captcha
		const form = document.getElementById('newcashbox');
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
				mydate: {
					validators: {
						notEmpty: {
							message: 'Date is Required'
						},
						date: {
							format: 'YYYY-MM-DD',
							message: 'The date is not valid',
							// min and max options can be strings or Date objects
							/*min: '2000/01/01',
							max: '2020/12/30'*/
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




