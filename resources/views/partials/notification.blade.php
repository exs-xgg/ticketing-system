@if (session('status'))
    <script>
        $(function() {
            swal({
                // title: '{{ session('type') == 'success' ? 'Success!' : 'Oops!' }}',
                title: '{!! ucwords(session('status')) !!}!',
                type: '{!! session('type') !!}',
                confirmButtonText: 'Ok'
            })
        });
    </script>
@endif

@if ($errors->any())
<script>
    $(function() {
        swal({
            title: 'Oops!',
            text: '{!! $errors->first() !!}',
            type: 'error',
            confirmButtonText: 'Ok'
        })
    });
</script>
@endif
