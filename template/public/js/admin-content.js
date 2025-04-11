document.addEventListener('DOMContentLoaded', function() {
    const formDelete = document.querySelector('#form-delete');

    $('.btn-delete').click(function() {
        formDelete.querySelector('input[name="id"]').value = $(this).data('id');

        Swal.fire({
            title: 'Caution!',
            html: 'Are you sure want to delete this content?<br><span class="text-danger">(This action cannot be undone)</span>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            cancelButtonColor: "#000000",
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                formDelete.submit();
            }
        });
    });
});