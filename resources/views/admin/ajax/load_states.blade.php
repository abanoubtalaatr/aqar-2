<script>
    $("#country_id").change(function() {
        var country_id = $(this).val();
        var city_id = $('#city_id').val(null);
        var _token = "{{ csrf_token() }}";
        var route_name = "{{ route('load_states') }}";

        $.ajax({
            type: 'POST',
            url: route_name,
            data: {
                _token: _token,
                country_id: country_id
            },
            success: function(response) {
                console.log(response); // Log the entire response to the console

                if (response && response.options) {
                    var optionsHtml = "<option value=''>" + "{{ __('Choose State') }}" + "</option>";
                    $.each(response.options, function(index, item) {
                        var name = "{{ myLang() == 'ar' ? 'name' : 'name' }}";

                        optionsHtml += "<option value='" + item.id + "'> " + item[name] + " </option>";
                    });

                    console.log(optionsHtml); // Log the final HTML to the console
                    $("#state_id").html(optionsHtml);
                }
            }
        });
    });
</script>
