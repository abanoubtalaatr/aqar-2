<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#tbl').on('click', '.btnChangeStatus[data-remote]', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = $(this).data('remote');
        var title = $(this).data('title')
        if(!title){
            var title = "{{ __('dashboard.Are you sure you want to change status this item?') }}"
        }

        Swal.fire({
            title: title,
            showDenyButton: true,
            // showCancelButton: true,
            confirmButtonText: "{{ __('dashboard.Yes') }}",
            denyButtonText: "{{ __('dashboard.Cancel') }}",
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        method: '_POST',
                        submit: true
                    }
                }).always(function(response) {

                    if (response == 1) {                        
                        Swal.fire("{{ __('dashboard.Status changed successfully!') }}", '', "success")

                        setTimeout(function() {
                            location.reload()
                        }, 1000);
                    } else
                        Swal.fire("{{ __('Not allowed to change status of this item!') }}", '', "error")
                });

            } else if (result.isDenied) {
                // Swal.fire('Changes are not saved', '', 'info')
            }
        })

    });
</script>
