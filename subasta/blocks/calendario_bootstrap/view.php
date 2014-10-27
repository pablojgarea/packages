<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>

<?php
$subastas = array();
foreach ($lista_subastas as $subasta):
	$subastas[]=$subasta->getCalendarJSON();
endforeach;
?>
<div class="container">
	<div class="page-header">

		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
				<button class="btn" data-calendar-nav="today">Today</button>
				<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
			</div>
			<div class="btn-group">
				<button class="btn btn-warning" data-calendar-view="year">Year</button>
				<button class="btn btn-warning active" data-calendar-view="month">Month</button>
				<button class="btn btn-warning" data-calendar-view="week">Week</button>
				<button class="btn btn-warning" data-calendar-view="day">Day</button>
			</div>
		</div>

		<h3></h3>
		<small>To see example with events navigate to march 2013</small>
	</div>

    <div id="calendar"></div>
</div>
    <script type="text/javascript">
	var options = {
        tmpl_path: "/webc5/packages/subasta/blocks/calendario_bootstrap/tmpls/",
//        events_source: function () {  return  [<?php echo json_encode(array('success' => 1, 'result' => $subastas)); ?>];},
		events_source: '/webc5/packages/subasta/blocks/calendario_bootstrap/events.json.php',
//		events_source: '/webc5/packages/subasta/blocks/calendario_bootstrap/tools/carga_calendario.php',

		view: 'month',
		tmpl_path: "/webc5/packages/subasta/blocks/calendario_bootstrap/tmpls/",
		tmpl_cache: false,
		day: '2013-03-12',
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');

			$.each(events, function(key, val) {
				$(document.createElement('li'))
					.html('<a href="' + val.url + '">' + val.title + '</a>')
					.appendTo(list);
			});
		},
		onAfterViewLoad: function(view) {
			$('.page-header h3').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};

	var calendar = $('#calendar').calendar(options);


		// $(document).ready(function(){
  //       var calendar = $("#calendar").calendar(
  //           {
  //               language: 'es-ES',
  //               day: '2013-03-12',
  //               tmpl_path: "/webc5/packages/subasta/blocks/calendario_bootstrap/tmpls/",
  //               events_source: function () {  return  [<?php echo json_encode(array('success' => 1, 'result' => $subastas)); ?>];},
  //               events_url:''
  //           });         	
  //   });
    </script>

