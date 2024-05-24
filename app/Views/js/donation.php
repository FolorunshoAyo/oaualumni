<script>
    $(document).ready(function() {
    var currentStep = 1;
    var loggedIn = <?php echo isset($userData)? "true" : "false" ?>;
    const donation_id = "<?php echo $checkProject[0]['project_id'] ?>";

    // Donation Button Click Event
    $('.donateButton').click(function() {
        $('#donationModal').modal('show');
    });

    // Radio Button Change Event
    $('input[type=radio][name=donationAmount]').change(function() {
        if (this.value) {
        $('#customAmount').val(this.value);
        }
    });

    // Next Button Click Event
    $('#nextButton').click(function() {
        if (currentStep === 1) {
            var selectedAmount = $("input[name='donationAmount']:checked").val() || $('#customAmount').val();
            if (selectedAmount) {
                if(loggedIn){
                    var amount = $("input[name='donationAmount']:checked").val() || $('#customAmount').val();
                    $('#summaryAmount').text('$' + amount);
                    $('#step1').hide();
                    $('#step3').show();
                    $('#nextButton').hide();
                    $('#prevButton').show();
                    $('#payNowButton').show();
                    currentStep = 3;
                }else{
                    $('#step1').hide();
                    $('#step2').show();
                    $('#prevButton').show();
                    currentStep = 2;
                }
            } else {
                alert('Please select a donation amount.');
            }
            } else if (currentStep === 2) {
                // If user is not logged in, get guest information
                var guestFirstName = $('#guestFirstName').val();
                var guestLastName = $('#guestLastName').val();
                var guestEmail = $('#guestEmail').val();
                var guestPhone = $('#guestPhone').val();
                if (guestFirstName && guestLastName && guestEmail && guestPhone) {
                    $('#step2').hide();
                    $('#step3').show();
                    $('#nextButton').hide();
                    $('#payNowButton').show();
                    currentStep = 3;
                    populateSummary(guestFirstName, guestLastName, guestEmail, guestPhone);
                } else {
                    alert('Please fill in all guest information.');
                }
            }
        });

    // Previous Button Click Event
    $('#prevButton').click(function() {
        if (currentStep === 2) {
        $('#step2').hide();
        $('#step1').show();
        $('#prevButton').hide();
        currentStep = 1;
        } else if (currentStep === 3) {
            if(loggedIn){
                $('#step3').hide();
                $('#step1').show();
                $('#prevButton').hide();
                $('#nextButton').show();
                $('#payNowButton').hide();
                currentStep = 1;
            }else{
                $('#step3').hide();
                $('#step2').show();
                $('#nextButton').show();
                $('#payNowButton').hide();
                currentStep = 2;
            }
        }
    });

    // Pay Now Button Click Event
    $('#payNowButton').click(function() {
        // Define the set of IDs to check
        var idsToCheck = ['summaryFirstName', 'summaryLastName', 'summaryEmail', 'summaryPhone', 'summaryAmount'];

        // Call the function to check if these elements are not empty
        var result = checkElementsNotEmpty(idsToCheck);
        // Remove dollar sign from amount
        result.summaryAmount = result.summaryAmount.replace(/\$/g, '');

        // Process payment here
        var form = document.createElement('form');

        // Set the form's attributes
        form.method = 'POST';
        form.action = '<?php echo site_url('donate/' . $checkProject[0]['project_id'])?>'; // The URL to submit to
        // form.target = '_blank';

        // Create hidden input fields with the data you want to submit
        var input1 = document.createElement('input');
        input1.type = 'hidden';
        input1.name = 'first_name';
        input1.value = result.summaryFirstName;
        form.appendChild(input1);

        var input2 = document.createElement('input');
        input2.type = 'hidden';
        input2.name = 'last_name';
        input2.value = result.summaryLastName;
        form.appendChild(input2);

        var input3 = document.createElement('input');
        input3.type = 'hidden';
        input3.name = 'email';
        input3.value = result.summaryEmail;
        form.appendChild(input3);

        var input4 = document.createElement('input');
        input4.type = 'hidden';
        input4.name = 'phone';
        input4.value = result.summaryPhone;
        form.appendChild(input4);

        var input5 = document.createElement('input');
        input5.type = 'hidden';
        input5.name = 'amount';
        input5.value = result.summaryAmount;
        form.appendChild(input5);

        // Append the form to the body
        document.body.appendChild(form);

        // Submit the form
        form.submit();

        // alert('Payment processed successfully!');
    });

    function populateSummary(first_name, last_name, email, phone) {
        $('#summaryFirstName').text(first_name);
        $('#summaryLastName').text(last_name);
        $('#summaryEmail').text(email);
        $('#summaryPhone').text(phone);
        var amount = $("input[name='donationAmount']:checked").val() || $('#customAmount').val();
        $('#summaryAmount').text('$' + amount);
    }

    function checkElementsNotEmpty(ids) {
        var nonEmptyValues = {};

        ids.forEach(function(id) {
            // Get the element by its ID
            var element = document.getElementById(id);
            if (element) {
                var value = '';

                value = element.textContent.trim();

                // Check if the element's text content is not empty
                if (value !== '') {
                    nonEmptyValues[id] = value;
                } else {
                    return false;
                }
            } else {
                console.log('Element with id', id, 'not found.');
            }
        });

        return nonEmptyValues;
    }

});

</script>