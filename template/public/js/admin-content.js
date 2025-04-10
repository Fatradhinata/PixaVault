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

    // deleteButtons.forEach(button => {
    //     button.addEventListener('click', function(event) {
    //         const itemId = this.getAttribute('data-id');
    //         const itemType = this.getAttribute('data-type');
    //         const confirmationMessage = `Are you sure you want to delete this ${itemType}?`;

    //         Swal
    //         if (confirm(confirmationMessage)) {
    //             fetch(`/admin/${itemType}/${itemId}`, {
    //                 method: 'DELETE',
    //                 headers: {
    //                     'Content-Type': 'application/json',
    //                     'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //                 }
    //             })
    //             .then(response => {
    //                 if (response.ok) {
    //                     alert(`${itemType} deleted successfully.`);
    //                     window.location.reload();
    //                 } else {
    //                     alert(`Failed to delete ${itemType}.`);
    //                 }
    //             })
    //             .catch(error => {
    //                 console.error('Error:', error);
    //             });
    //         }
    //     });
    // });
});