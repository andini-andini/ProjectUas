$(function () {
    $("#table-kamar").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${APP_URL}/kamar`
        }, columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "4%", },
            { data: "image", name: "image", className: "text-center", width: "8%", },
            { data: "name", name: "name", },
            { data: "price", name: "price", },
            { data: "action", name: "action", className: "text-center", orderable: false, searchable: false, }
        ]
    });

    $("#table-kamar").on("click", ".btn-delete-kamar", function () {
        var id = $(this).attr('data-bs-id');
        $("#form-delete-kamar").on("submit", function (e) {
            var url = APP_URL + "/kamar/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                success: function (res) {
                    $("#deleteKamarModal").modal("hide");
                    $("#table-kamar").DataTable().ajax.reload();
                },
                error: (e, x, settings, exception) => {
                },
            });
            e.preventDefault();
        });
    });

})
