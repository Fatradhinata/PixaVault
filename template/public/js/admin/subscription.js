document.addEventListener('DOMContentLoaded', function() {
    const formDelete = document.querySelector('#form-delete');
    const formModal = document.querySelector('#formModal form');

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

    $('.btn-edit').on('click', function() {
        const id = $(this).data('id'); 
        const baseurl = formModal.getAttribute('action');

        fetch(`${baseurl}/${id}`)
            .then(res => {
                if (!res.ok) throw new Error("Network response wasn't ok " + res.statusText);
                return res.json();
            })
            .then(res => {
                let data = res.data;

                $('#id').val(data.id);
                $('#plans').val(data.plans);
                $('#status').val(data.status);
                let date_limit = (new Date(data.date_limit)).toISOString().slice(0, 16);
                $('#date_limit').val(date_limit);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    $('.btn-submit').on('click', function() {
        formModal.checkValidity() ? formModal.submit() : formModal.reportValidity();
    });
});