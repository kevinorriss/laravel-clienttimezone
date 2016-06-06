<script>
    $(document).ready(function()
    {
        if({{ (ClientTimezone::check() ? "true" : "false") }})
        {
            var clienttime = new Date();
            var clienttimezone = -clienttime.getTimezoneOffset();
            $.ajax(
            {
                type: "POST",
                url: "{{ url(env('CLIENT_TIMEZONE_POST', ClientTimezone::CLIENT_TIMEZONE_POST)) }}",
                data:
                {
                    timezoneoffset: clienttimezone
                },
                success: function()
                {
                    location.reload();
                }
            });
        }
    });
</script>