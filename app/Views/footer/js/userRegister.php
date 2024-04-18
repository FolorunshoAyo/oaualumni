

<script>
    document.addEventListener('DOMContentLoaded', function(e) {
		const randomNumber = function(min, max) {
			return Math.floor(Math.random() * (max - min + 1) + min);
		};
		const captchaEle = document.getElementById('captchaOperation');

		const generateCaptcha = function() {
			const random = [randomNumber(1, 10), randomNumber(1, 10)];
			captchaEle.innerHTML = [random[0], '+', random[1], '='].join(' ');
		};
		generateCaptcha();
        // Generate a simple captcha
        const form = document.getElementById('userRegistration');
        FormValidation.formValidation(form, {
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'First Name'
                        }
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: 'Last Name'
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: 'Address'
                        }
                    }
                },
                hobbies: {
                    validators: {
                        notEmpty: {
                            message: 'Hobbies'
                        }
                    }
                },
                occupation: {
                    validators: {
                        notEmpty: {
                            message: 'Occupation'
                        }
                    }
                },
                dp: {
                    validators: {
                        notEmpty: {
                            message: 'Please select an image'
                        },
                        file: {
                            extension: 'jpeg,jpg,png,JPEG',
                            type: 'image/jpeg,image/png',
                            message: 'The selected file is not valid'
                        },
                    }
                },
                captcha: {
					validators: {
						callback: {
							message: 'Wrong answer',
							callback: function(input) {
								const items = captchaEle.innerHTML.split(' ');
								const sum = parseInt(items[0]) + parseInt(items[2]);
								return input.value == sum;
							}
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
				ref_id: {
					validators: {
						regexp: {
							regexp: /^[a-z 0-9]+$/i,
							message: 'Please check your Referral ID and try again i.e 5stark500'
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
                conf_password: {
                    validators: {
                        identical: {
                            compare: function() {
                                return form.querySelector('[name="password"]').value;
                            },
                            message: 'The password and the confirmation are not the same'
                        }
                    }
                },

                accept: {
                    validators: {
                        notEmpty: {
                            message: 'Please accept our terms and conditions/privacy policy to proceed further'
                        }
                    }
                },

            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                bootstrap: new FormValidation.plugins.Bootstrap(),
                submitButton: new FormValidation.plugins.SubmitButton(),

            },



        })
			.on('core.form.invalid', function() {
				generateCaptcha();
			});
    });
</script>




