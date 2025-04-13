document.addEventListener('DOMContentLoaded', function() {
    const formDelete = document.querySelector('#form-delete');
    const formModal = document.querySelector('#formModal form');

    $(document).on('click', '.btn-delete', function() {
        formDelete.querySelector('input[name="id"]').value = $(this).data('id');

        Swal.fire({
            title: 'Warning!',
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

    $(document).on('click', '.btn-edit', function() {
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
                $('#name').val(data.name)
                $('#full_name').val(data.full_name)
                $('#role').val(data.role)
                $('#email').val(data.email)
                $('#phone_number').val(data.phone_number)
                $('#free_limit').val(data.free_limit)
                if (data.verified_at) {
                    let verified_at = (new Date(data.verified_at)).toISOString().slice(0, 16);
                    $('#verified_at').val(verified_at)
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
    
    $('.btn-submit').on('click', function() {
        formModal.checkValidity() ? formModal.submit() : formModal.reportValidity();
    });
});