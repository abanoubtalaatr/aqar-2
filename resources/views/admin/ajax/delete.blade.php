<script src="{{ dashboardAsset('cdn/sweetalert2.js') }}"></script>

<script>
    
    $('#tbl').on('click', '.btn-danger[data-remote]', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = $(this).data('remote');

        Swal.fire({
            title: "{{ __('dashboard.Are you sure you want to delete this item?') }}",
            showDenyButton: true,
            // showCancelButton: true,
            confirmButtonText: "{{ __('dashboard.Yes') }}",
            denyButtonText: "{{ __('dashboard.Cancel') }}",
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        method: '_DELETE',
                        submit: true
                    }
                }).always(function(response) {
                    if (response == 1) {
                        // $('#tbl').DataTable().draw(false);

                        Swal.fire("{{ __('dashboard.Deleted Successfully!') }}", '', "success")

                        setTimeout(function() {
                            location.reload()
                        }, 1000);
                    } else
                        Swal.fire("{{ __('dashboard.Not allowed to delete this item!') }}", '', "error")
                });

            } else if (result.isDenied) {
                // Swal.fire('Changes are not saved', '', 'info')
            }
        })

    });
</script>
