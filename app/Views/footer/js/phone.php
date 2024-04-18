<script type="text/javascript" src="<?php echo base_url('public/assets/phone/build/js/intlTelInput.js')?>"></script>
<!--<script src="<?php /*echo base_url('assets/phone/js/intlTelInput-jquery.min.js')*/?>"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    var input = document.querySelector("#phone");
    var output = document.querySelector("#output");
   // var skzNumber = document.querySelector("#output");
    var iti = window.intlTelInput(input, {
        // allowDropdown: false,
        // autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
         nationalMode: true,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
         preferredCountries: ['pk', 'us'],
        // separateDialCode: true,
        utilsScript: "<?php echo base_url('public/assets/phone/build/js/utils.js')?>",
    });

    var handleChange = function() {
        var text = (iti.isValidNumber()) ? "International: " + iti.getNumber() : "Please enter a number below";
        var textNode = document.createTextNode(text);
        output.innerHTML = "";
        input.innerHTML = "";
        //output.appendChild(textNode);
        if (iti.isValidNumber()) {
            $('#skzPhone').val(iti.getNumber())
        }
        else{
            $('#skzPhone').val(0);
        }
        //input.val(textNode);
        //$('#phone').val(iti.getNumber());
    };

    input.addEventListener('change', handleChange);
    input.addEventListener('keyup', handleChange);
</script>
