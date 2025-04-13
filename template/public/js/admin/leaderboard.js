document.addEventListener("DOMContentLoaded", function () {
    const formModal = document.querySelector('#formModal form');

    document.querySelectorAll(".datatable-init").forEach((table) => {
        new simpleDatatables.DataTable(table);
    });

    $("#toggle-tab-likes").on("click", function () {
        $(".tab").removeClass("active");
        $(".tab-content").removeClass("active");

        $(this).addClass("active");
        $("#tab-likes").addClass("active");
    });

    $("#toggle-tab-downloads").on("click", function () {
        $(".tab").removeClass("active");
        $(".tab-content").removeClass("active");

        $(this).addClass("active");
        $("#tab-downloads").addClass("active");
    });

    $(document).on('click', '.fa-gift', function () {
        const id = $(this).data("id");

        formModal.reset();
        $('#extend-sub').removeClass('show');
        $("#id").val(id);
    });

    $("#with-token").on("change", function () {
        if ($(this)[0].checked) {
            $('#extend-sub').addClass('show');
        } else {
            $('#extend-sub').removeClass('show');
        }
    });

    $('.btn-submit').on('click', function() {
        formModal.checkValidity() ? formModal.submit() : formModal.reportValidity();
    });
});
