<?php
// Generate a new fullcalendar instance
$calendar = new \AliMehraei\FullcalendarScheduler\FullcalendarScheduler($view);

// Set the events and resources
$calendar->setEvents([
    ['id' => '1', 'resourceId' => 'b', 'start' => '2016-05-07T02:00:00', 'end' => '2016-05-07T07:00:00', 'title' => 'event 1'],
    ['id' => '2', 'resourceId' => 'c', 'start' => '2016-05-07T05:00:00', 'end' => '2016-05-07T22:00:00', 'title' => 'event 2'],
    ['id' => '3', 'resourceId' => 'd', 'start' => '2016-05-06', 'end' => '2016-05-08', 'title' => 'event 3'],
    ['id' => '4', 'resourceId' => 'e', 'start' => '2016-05-07T03:00:00', 'end' => '2016-05-07T08:00:00', 'title' => 'event 4'],
    ['id' => '5', 'resourceId' => 'f', 'start' => '2016-05-07T00:30:00', 'end' => '2016-05-07T02:30:00', 'title' => 'event 5'],
]);
// Add the resources
$calendar->setResources([
    ['id' => 'a', 'title' => 'Auditorium A'],
    ['id' => 'b', 'title' => 'Auditorium B', 'eventColor' => 'green'],
    ['id' => 'c', 'title' => 'Auditorium C', 'eventColor' => 'orange'],
    [
        'id'       => 'd',
        'title'    => 'Auditorium D',
        'children' => [
            ['id' => 'd1', 'title' => 'Room D1'],
            ['id' => 'd2', 'title' => 'Room D2'],
        ],
    ],
    ['id' => 'e', 'title' => 'Auditorium E'],
    ['id' => 'f', 'title' => 'Auditorium F', 'eventColor' => 'red'],
    ['id' => 'g', 'title' => 'Auditorium G'],
    ['id' => 'h', 'title' => 'Auditorium H'],
    ['id' => 'i', 'title' => 'Auditorium I'],
    ['id' => 'j', 'title' => 'Auditorium J'],
    ['id' => 'k', 'title' => 'Auditorium K'],
    ['id' => 'l', 'title' => 'Auditorium L'],
    ['id' => 'm', 'title' => 'Auditorium M'],
    ['id' => 'n', 'title' => 'Auditorium N'],
    ['id' => 'o', 'title' => 'Auditorium O'],
    ['id' => 'p', 'title' => 'Auditorium P'],
    ['id' => 'q', 'title' => 'Auditorium Q'],
    ['id' => 'r', 'title' => 'Auditorium R'],
    ['id' => 's', 'title' => 'Auditorium S'],
    ['id' => 't', 'title' => 'Auditorium T'],
    ['id' => 'u', 'title' => 'Auditorium U'],
    ['id' => 'v', 'title' => 'Auditorium V'],
    ['id' => 'w', 'title' => 'Auditorium W'],
    ['id' => 'x', 'title' => 'Auditorium X'],
    ['id' => 'y', 'title' => 'Auditorium Y'],
    ['id' => 'z', 'title' => 'Auditorium Z'],
]);

// Set options
$calendar->setOptions([
    'now'               => '2016-05-07',
    'editable'          => true, // enable draggable events
    'droppable'         => true, // enable draggable events
    'aspectRatio'       => 1.8,
    'scrollTime'        => '00:00', // undo default 6am scrollTime
    'header'            => [
        'left'   => 'today prev,next',
        'center' => 'title',
        'right'  => 'timelineDay,timelineThreeDays,agendaWeek,month',
    ],
    'defaultView'       => 'timelineDay',
    'views'             => [
        'timelineThreeDays' => [
            'type'     => 'timeline',
            'duration' => ['days' => 3],
        ],
    ],
    'resourceLabelText' => 'Rooms',
    // Add the callbacks
    'drop'              => new AliMehraei\FullcalendarScheduler\JsExpression("
            function(date, jsEvent, ui, resourceId) {
                console.log('drop', date.format(), resourceId);
                // is the \"remove after drop\" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the \"Draggable Events\" list
                    $(this).remove();
                }
            }
        "),
    'eventReceive'      => new AliMehraei\FullcalendarScheduler\JsExpression("
            function(event) { // called when a proper external event is dropped
                console.log('eventReceive', event);
            }
        "),
    'eventDrop'         => new AliMehraei\FullcalendarScheduler\JsExpression("
            function(event) { // called when an event (already on the calendar) is moved
                console.log('eventDrop', event);
            }
        "),
]);
?>

<script type="text/javascript">
    $(document).ready(function () {
        /* initialize the external events
         -----------------------------------------------------------------*/
        $('#external-events .fc-event').each(function () {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    });
</script>

<style>
    body {
        margin-top: 40px;
        text-align: center;
        font-size: 14px;
        font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
    }

    #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        border: 1px solid #ccc;
        background: #eee;
        text-align: left;
    }

    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
    }

    #external-events .fc-event {
        margin: 10px 0;
        cursor: pointer;
    }

    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
    }

    #external-events p input {
        margin: 0;
        vertical-align: middle;
    }
</style>

<div class="col-md-2">
    <div id='external-events'>
        <h4>Draggable Events</h4>
        <div class='fc-event'>My Event 1</div>
        <div class='fc-event'>My Event 2</div>
        <div class='fc-event'>My Event 3</div>
        <div class='fc-event'>My Event 4</div>
        <div class='fc-event'>My Event 5</div>
        <p>`
            <input type='checkbox' id='drop-remove'/>
            <label for='drop-remove'>remove after drop</label>
        </p>
    </div>
</div>

<div class="col-md-10">
    {!! $calendar->generate() !!}
</div>
