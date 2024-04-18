


<!-- Required datatable js -->
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap4.min.js')?>"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url('assets/js/plugins/datatables/dataTables.buttons.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/buttons.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/jszip.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/pdfmake.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/vfs_fonts.js')?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/buttons.html5.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/buttons.print.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/buttons.colVis.min.js')?>"></script>


<!-- App js -->
<script src="<?php echo base_url('assets/js/jquery.core.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.app.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'colvis']
        });

        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    } );

</script>
