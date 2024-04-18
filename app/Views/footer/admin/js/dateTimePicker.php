<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	/*$( function() {
		$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	} );*/

	$(function() {
		$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd',
			onSelect: function(datetext){
				var d = new Date(); // for now
				var h = d.getHours();
				h = (h < 10) ? ("0" + h) : h ;

				var m = d.getMinutes();
				m = (m < 10) ? ("0" + m) : m ;

				var s = d.getSeconds();
				s = (s < 10) ? ("0" + s) : s ;

				datetext = datetext + " " + h + ":" + m + ":" + s;
				$('.datepicker').val(datetext);
			},
		});
	});

	//$(document).ready(function(){
	/*$(".datepicker" ).datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'HH:mm:ss',
		onShow: function () {
			this.setOptions({
				maxDate:$('.datepicker').val()?$('.datepicker').val():false,
				maxTime:$('.datepicker').val()?$('.datepicker').val():false
			});
		}
	}).attr('readonly', 'readonly');*/
	/*$( ".datepicker" ).datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'HH:mm:ss',
		onShow: function () {
			this.setOptions({
				minDate:$('.datepicker').val()?$('.datepicker').val():false,
				minTime:$('.datepicker').val()?$('.datepicker').val():false
			});
		}
	}).attr('readonly', 'readonly');*/
	//var date = $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val();
</script>
