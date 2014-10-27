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
        $(document).ready(function (){
        var options = {
        tmpl_path: "/webc5/packages/subasta/blocks/calendario_bootstrap/tmpls/",
//        events_source: function () {  return  [<?php echo json_encode(array('success' => 1, 'result' => $subastas)); ?>];},
//              events_source: '/blocks/calendario_bootstrap/events.json.php',
                events_source: '<?php echo $tool_name ?>',

                view: 'month',
                tmpl_path: "/blocks/calendario_bootstrap/tmpls/",
                tmpl_cache: false,
                day: '2014-10-24',
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

        $('.btn-group button[data-calendar-nav]').each(function() {
                var $this = $(this);
                $this.click(function() {
                        calendar.navigate($this.data('calendar-nav'));
                });
        });

        $('.btn-group button[data-calendar-view]').each(function() {
                var $this = $(this);
                $this.click(function() {
                        calendar.view($this.data('calendar-view'));
                });
        });

        $('#first_day').change(function(){
                var value = $(this).val();
                value = value.length ? parseInt(value) : null;
                calendar.setOptions({first_day: value});
                calendar.view();
        });

        $('#language').change(function(){
                calendar.setLanguage($(this).val());
                calendar.view();
        });

        $('#events-in-modal').change(function(){
                var val = $(this).is(':checked') ? $(this).val() : null;
                calendar.setOptions({modal: val});
        });
        $('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
                //e.preventDefault();
                //e.stopPropagation();
        });



        });
    </script>
