
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#skzINtrstr").select2({
            maximumSelectionLength: 20
        });
        $(document).ready(function () {
            $("#cities,#area,#regCity,#country,#mycities,#userID",'#newEvent').select2({
            });

        })
    });
</script>
