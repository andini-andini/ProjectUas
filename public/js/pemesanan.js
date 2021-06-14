$(function () {
    $("#table-pemesanan").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${APP_URL}/pemesanan`
        }, columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "4%", },
            { data: "code", name: "code" },
            { data: "kamar", name: "kamar" },
            { data: "check_in", name: "check_in", },
            { data: "check_out", name: "check_out", },
            { data: "guest", name: "guest", },
            { data: "total", name: "total", },
            { data: "status", name: "status", },
            { data: "action", name: "action", className: "text-center", orderable: false, searchable: false, }
        ]
    });

    $("#table-pemesanan").on("click", ".btn-show-pemesanan", function () {
        var id = $(this).attr('data-bs-id');
        $.ajax({
            type: "GET",
            url: `${APP_URL}/pemesanan/${id}`,
            beforeSend: function () {
                $('#showPemesananModal .body-status').hide();
                $('#showPemesananModal .loading').show();
            },
            success: function (res) {
                $('#showPemesananModal .loading').hide();
                $('#showPemesananModal .body-status').show();
                $('#showPemesananModal .body-status').html(res.html);
            }
        });
    });

    $("#table-pemesanan").on("click", ".btn-delete-pemesanan", function () {
        var id = $(this).attr('data-bs-id');
        $("#form-delete-pemesanan").on("submit", function (e) {
            var url = APP_URL + "/pemesanan/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                success: function (res) {
                    $("#deletePemesananModal").modal("hide");
                    $("#table-pemesanan").DataTable().ajax.reload();
                },
                error: (e, x, settings, exception) => {
                },
            });
            e.preventDefault();
        });
    });
})
