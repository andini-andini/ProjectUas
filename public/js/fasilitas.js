$(function () {
    $("#table-fasilitas").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${APP_URL}/fasilitas`
        }, columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "4%", },
            { data: "name", name: "name", },
            { data: "action", name: "action", className: "text-center", orderable: false, searchable: false, }
        ]
    });

    $("#table-fasilitas").on("click", ".btn-delete-fasilitas", function () {
        var id = $(this).attr('data-bs-id');
        $("#form-delete-fasilitas").on("submit", function (e) {
            var url = APP_URL + "/fasilitas/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                success: function (res) {
                    $("#deleteFasilitasModal").modal("hide");
                    $("#table-fasilitas").DataTable().ajax.reload();
                },
                error: (e, x, settings, exception) => {
                },
            });
            e.preventDefault();
        });
    });

})
