@php
    $route_name = route('load_cities');
@endphp

<script>
    $("#state_id").change(function() {
        var state_id = $(this).val();
        var _token = "{{ csrf_token() }}";

        $.ajax({
            type: 'POST',
            url: "{{ $route_name }}",
            data: {
                _token: _token,
                state_id: state_id
            },
            success: function(response) {
                if (response && response.options) {
                    var optionsHtml = "<option value=''>" + "{{ __('Choose City') }}" + "</option>";
                    $.each(response.options, function(index, item) {
                        var name = "{{ myLang() == 'ar' ? 'name' : 'name' }}";
                        optionsHtml += "<option value='" + item.id + "'> " + item[name] + " </option>";
                    });
                    $("#city_id").html(optionsHtml);
                }
            }
        });
    });
</script>
