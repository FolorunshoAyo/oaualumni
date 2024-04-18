
<!-- ================================================
Summernote
================================================ -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/summernote/summernote.min.js')?>"></script>

<!-- ================================================
Flot Chart
================================================ -->
<!-- main file -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/flot-chart/flot-chart.js')?>"></script>
<!-- time.js')?> -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/flot-chart/flot-chart-time.js')?>"></script>
<!-- stack.js')?> -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/flot-chart/flot-chart-stack.js')?>"></script>
<!-- pie.js')?> -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/flot-chart/flot-chart-pie.js')?>"></script>
<!-- demo codes -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/flot-chart/flot-chart-plugin.js')?>"></script>

<!-- ================================================
Chartist
================================================ -->
<!-- main file -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/chartist/chartist.js')?>"></script>
<!-- demo codes -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/chartist/chartist-plugin.js')?>"></script>

<!-- ================================================
Easy Pie Chart
================================================ -->
<!-- main file -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/easypiechart/easypiechart.js')?>"></script>
<!-- demo codes -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/easypiechart/easypiechart-plugin.js')?>"></script>

<!-- ================================================
Sparkline
================================================ -->
<!-- main file -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/sparkline/sparkline.js')?>"></script>
<!-- demo codes -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/sparkline/sparkline-plugin.js')?>"></script>

<!-- ================================================
Rickshaw
================================================ -->
<!-- d3 -->
<script src="<?php echo base_url('public/assets/admin/js/rickshaw/d3.v3.js')?>"></script>
<!-- main file -->
<script src="<?php echo base_url('public/assets/admin/js/rickshaw/rickshaw.js')?>"></script>
<!-- demo codes -->
<script src="<?php echo base_url('public/assets/admin/js/rickshaw/rickshaw-plugin.js')?>"></script>

<!-- ================================================
Data Tables
================================================ -->
<script src="<?php echo base_url('public/assets/admin/js/datatables/datatables.min.js')?>"></script>

<!-- ================================================
Sweet Alert
================================================ -->
<script src="<?php echo base_url('public/assets/admin/js/sweet-alert/sweet-alert.min.js')?>"></script>

<!-- ================================================
Kode Alert
================================================ -->
<script src="<?php echo base_url('public/assets/admin/js/kode-alert/main.js')?>"></script>

<!-- ================================================
Gmaps
================================================ -->
<!-- google maps api -->
<script src="https://maps.google.com/maps/api/js?sensor=true"></script>
<!-- main file -->
<script src="<?php echo base_url('public/assets/admin/js/gmaps/gmaps.js')?>"></script>
<!-- demo codes -->
<script src="<?php echo base_url('public/assets/admin/js/gmaps/gmaps-plugin.js')?>"></script>

<!-- ================================================
jQuery UI
================================================ -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/jquery-ui/jquery-ui.min.js')?>"></script>

<!-- ================================================
Moment.js')?>
================================================ -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/moment/moment.min.js')?>"></script>

<!-- ================================================
Full Calendar
================================================ -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/full-calendar/fullcalendar.js')?>"></script>

<!-- ================================================
Bootstrap Date Range Picker
================================================ -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/date-range-picker/daterangepicker.js')?>"></script>

<!-- ================================================
Below codes are only for index widgets
================================================ -->
<!-- Today Sales -->
<script>

	// set up our data series with 50 random data points

	var seriesData = [ [], [], [] ];
	var random = new Rickshaw.Fixtures.RandomData(20);

	for (var i = 0; i < 110; i++) {
		random.addData(seriesData);
	}

	// instantiate our graph!

	var graph = new Rickshaw.Graph( {
		element: document.getElementById("todaysales"),
		renderer: 'bar',
		series: [
			{
				color: "#33577B",
				data: seriesData[0],
				name: 'Photodune'
			}, {
				color: "#77BBFF",
				data: seriesData[1],
				name: 'Themeforest'
			}, {
				color: "#C1E0FF",
				data: seriesData[2],
				name: 'Codecanyon'
			}
		]
	} );

	graph.render();

	var hoverDetail = new Rickshaw.Graph.HoverDetail( {
		graph: graph,
		formatter: function(series, x, y) {
			var date = '<span class="date">' + new Date(x * 1000).toUTCString() + '</span>';
			var swatch = '<span class="detail_swatch" style="background-color: ' + series.color + '"></span>';
			var content = swatch + series.name + ": " + parseInt(y) + '<br>' + date;
			return content;
		}
	} );

</script>

<!-- Today Activity -->
<script>
	// set up our data series with 50 random data points

	var seriesData = [ [], [], [] ];
	var random = new Rickshaw.Fixtures.RandomData(20);

	for (var i = 0; i < 50; i++) {
		random.addData(seriesData);
	}

	// instantiate our graph!

	var graph = new Rickshaw.Graph( {
		element: document.getElementById("todayactivity"),
		renderer: 'area',
		series: [
			{
				color: "#9A80B9",
				data: seriesData[0],
				name: 'London'
			}, {
				color: "#CDC0DC",
				data: seriesData[1],
				name: 'Tokyo'
			}
		]
	} );

	graph.render();

	var hoverDetail = new Rickshaw.Graph.HoverDetail( {
		graph: graph,
		formatter: function(series, x, y) {
			var date = '<span class="date">' + new Date(x * 1000).toUTCString() + '</span>';
			var swatch = '<span class="detail_swatch" style="background-color: ' + series.color + '"></span>';
			var content = swatch + series.name + ": " + parseInt(y) + '<br>' + date;
			return content;
		}
	} );
</script>

