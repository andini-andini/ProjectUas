$(function () {
    $("#table-reservasi").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${APP_URL}/reservasi`
        }, columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "4%", },
            { data: "code", name: "code" },
            { data: "name", name: "name" },
            { data: "kamar", name: "kamar" },
            { data: "check_in", name: "check_in", },
            { data: "check_out", name: "check_out", },
            { data: "guest", name: "guest", },
            { data: "total", name: "total", },
            { data: "status", name: "status", },
            { data: "action", name: "action", className: "text-center", orderable: false, searchable: false, }
        ]
    });

    $("#table-reservasi").on("click", ".btn-delete-reservasi", function () {
        var id = $(this).attr('data-bs-id');
        $("#form-delete-reservasi").on("submit", function (e) {
            var url = APP_URL + "/reservasi/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                success: function (res) {
                    $("#deleteReservasiModal").modal("hide");
                    $("#table-reservasi").DataTable().ajax.reload();
                },
                error: (e, x, settings, exception) => {
                },
            });
            e.preventDefault();
        });
    });

    var id = "";
    var status = 0;

    $("#table-reservasi").on("click", ".btn-edit-status", function () {
        $("#form-edit-status")[0].reset();
        id = $(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: `${APP_URL}/api/reservasi/get-status/${id}`,
            success: function (res) {
                res.data.status == 1 ? $("#status").attr("checked", true) : $("#status").attr("checked", false);
                status = res.data.status
            }
        });
    });

    $("#status").on('change', function () {
        $(this).is(':checked') ? status = 1 : status = 0;
    });

    $("#form-edit-status").on("submit", function (e) {
        e.preventDefault();
        var url = APP_URL + "/reservasi/edit-status/" + id;

        $.ajax({
            type: "PUT",
            url: url,
            data: {
                'status': status
            },
            success: function (res) {
                $("#table-reservasi").DataTable().ajax.reload();
                $("#form-edit-status")[0].reset();
                $("#editStatusModal").modal("hide")
            },
            error: (e, x, settings, exception) => {
                // $("#form-edit-status .btn-loading").hide();
                // $("#form-edit-status .btn-submit").show();
                // handle.errorhandle(e, x, settings, exception);
            },
        });
    });

})
