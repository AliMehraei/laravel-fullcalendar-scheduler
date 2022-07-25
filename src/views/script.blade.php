@if($include_scripts)
    @include('fullcalendar-scheduler::files')
@endif

<script type="text/javascript">
    $(document).ready(function () {
        $('#{{ $id }}').fullCalendar({!! $options !!});
    });
</script>
