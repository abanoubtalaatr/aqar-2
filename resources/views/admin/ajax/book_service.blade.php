@php
    $route_name = route('admin.reservations.book');
@endphp

<script>
    $("#book").click(function() {

        var store_service_id = $("#service_id").val();
        var _token = "{{ csrf_token() }}";

        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {
                _token: _token,
                store_service_id: store_service_id
            },
            success: function(response) {
                if (response)
                    $("#userServices").append(response);
            }
        });
    });
</script>
