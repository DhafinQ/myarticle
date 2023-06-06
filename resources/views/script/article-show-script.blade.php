<script>
    $(document).on('click', '#del-btn', function () {
        var id = $(this).data('id');
        Swal.fire({
            icon: 'question',
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#28C76F',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    'url': '{{url('article/'.$article->id)}}',
                    'type': 'POST',
                    'data': {
                        '_method': 'DELETE',
                        '_token': '{{csrf_token()}}',
                    },
                    success: function (response) {
                        if (response.message) {
                           window.location.href = "/article";
                        }
                    }
                });
            } else {
                console.log(`dialog was dismissed by ${result.dismiss}`)
            }
        });
});
</script>