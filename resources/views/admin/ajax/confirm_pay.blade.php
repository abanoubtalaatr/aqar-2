<script src="{{ dashboardAsset('cdn/sweetalert2.js') }}"></script>

<script>
    $('#pay-commission-div').on('click', '#confirmPay[data-remote]', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = $(this).data('remote');
        var pay_commission = $(".pay_commission:checked").val();
 
        Swal.fire({
            title: "{{ __('Are you sure you want to bear the commission instead of the client?') }}",
            showDenyButton: true,
            // showCancelButton: true,
            confirmButtonText: "{{ __('Yes') }}",
            denyButtonText: "{{ __('Cancel') }}",
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        method: '_POST',
                        submit: true,
                        pay_commission: pay_commission
                    }
                }).always(function(response) {
                    if (response == 1) {
                        // $('#tbl').DataTable().draw(false);

                        Swal.fire("{{ __('Confirmed Successfully!') }}", '', "success")

                        setTimeout(function() {
                            location.reload()
                        }, 1000);
                    } else
                        Swal.fire(
                            "{{ __('Somethig wrong happened, please try again later!') }}", '',
                            "error")
                });

            } else if (result.isDenied) {
                // Swal.fire('Changes are not saved', '', 'info')
            }
        })

    });
</script>
