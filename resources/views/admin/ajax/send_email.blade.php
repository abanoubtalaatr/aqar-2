<!-- ... existing code ... -->

<script>
    $(document).ready(function () {
        $('#verifyOtp').on('click', function () {
            var otp = $('#otp').val();
            var email = $("#email").val();

            // Perform AJAX request to verify OTP
            $.ajax({
                url: "{{route('admin.admins.verify_code')}}",
                method: 'POST',
                data: {
                    otp: otp,
                    email:email,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    alert(response.message)
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert(JSON.parse(xhr.responseText).message);
                    console.error(xhr.responseText);
                },
            });
        });
    });
</script>

<!-- ... existing code ... -->
