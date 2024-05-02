<script type="text/javascript" src="<?php echo base_url('public/assets/phone/build/js/intlTelInput.js')?>"></script>
<!--<script src="<?php /*echo base_url('assets/phone/js/intlTelInput-jquery.min.js')*/?>"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();

    // Initialize first input
    var input1 = document.querySelector("#phone1");
    var output1 = document.querySelector("#skzPhone1");
    var iti1 = window.intlTelInput(input1, {
        nationalMode: true,
        preferredCountries: ['us', 'cn'],
        utilsScript: "<?php echo base_url('public/assets/phone/build/js/utils.js')?>",
    });

    // Initialize second input
    var input2 = document.querySelector("#phone2");
    var output2 = document.querySelector("#skzPhone2");
    var iti2 = window.intlTelInput(input2, {
        nationalMode: true,
        preferredCountries: ['us', 'cn'],
        utilsScript: "<?php echo base_url('public/assets/phone/build/js/utils.js')?>",
    });

    // Function to handle input change
    var handleChange = function(input, output) {
        var iti = (input === input1) ? iti1 : iti2;
        var text = (iti.isValidNumber()) ? "International: " + iti.getNumber() : "Please enter a number below";
        output.innerHTML = "";
        if (iti.isValidNumber()) {
            output.value = iti.getNumber();
        } else {
            output.value = "0";
        }
    };

    // Bind change event to first input
    input1.addEventListener('change', function() {
        handleChange(input1, output1);
    });

    // Bind keyup event to first input
    input1.addEventListener('keyup', function() {
        handleChange(input1, output1);
    });

    // Bind change event to second input
    input2.addEventListener('change', function() {
        handleChange(input2, output2);
    });

    // Bind keyup event to second input
    input2.addEventListener('keyup', function() {
        handleChange(input2, output2);
    });
});

</script>
