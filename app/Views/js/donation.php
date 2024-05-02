<script>
    $(document).ready(function() {
    var currentStep = 1;
    var loggedIn = <?php echo isset($userData)? "true" : "false" ?>;
    const donation_id = "<?php echo $checkProject[0]['project_id'] ?>";
    // Donation Button Click Event
    $('.donateButton').click(function() {
        $('#donationModal').modal('show');
    });

    console.log(baseurl);

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
        // Process payment here
        alert('Payment processed successfully!');
    });

    function populateSummary(first_name, last_name, email, phone) {
        $('#summaryFirstName').text(first_name);
        $('#summaryLastName').text(last_name);
        $('#summaryEmail').text(email);
        $('#summaryPhone').text(phone);
        var amount = $("input[name='donationAmount']:checked").val() || $('#customAmount').val();
        $('#summaryAmount').text('$' + amount);
    }

    function fetchUserDetails(amount) {
        $.ajax({
            url: 'backend_endpoint_to_fetch_user_details',
            method: 'GET',
            success: function(response) {
                // Replace placeholders with actual user data
                var userData = response.data; // Assuming response contains user data
                $('#summaryName').text(userData.name);
                $('#summaryEmail').text(userData.email);
                $('#summaryPhone').text(userData.phone);
                $('#summaryAmount').text('$' + amount);
                $('#donationSummary').show();
            },
            error: function(xhr, status, error) {
            // Handle error
            console.error(error);
            }
        });
        }
});

</script>