@php
    $route_name = route('load_categories');
@endphp

<script>
    $("#industry_id").change(function() {

        var industry_id = $(this).val();
        var _token = "{{ csrf_token() }}";

        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {
                _token: _token,
                industry_id: industry_id
            },
            success: function(response) {
                if (response)
                    $("#category_id").html(response);
            }
        });
    });
</script>
