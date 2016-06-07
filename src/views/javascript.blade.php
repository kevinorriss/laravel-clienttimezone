<script>
    $(document).ready(function()
    {
        if({{ ClientTimezone::checking() ? "true" : "false" }})
        {
            var clienttime = new Date();
            var clienttimezone = -clienttime.getTimezoneOffset();
            $.ajax(
            {
                type: "POST",
                url: "{{url(ClientTimezone::getPostUrl()) }}",
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