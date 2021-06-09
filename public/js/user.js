$(function () {
    $("#table-users").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${APP_URL}/user`
        }, columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "4%", },
            { data: "name", name: "name", },
            { data: "email", name: "email", },
            { data: "address", name: "address", },
            { data: "phone", name: "phone", },
            { data: "action", name: "action", className: "text-center", orderable: false, searchable: false, }
        ]
    });

    $("#table-users").on("click", ".btn-delete-user", function () {
        var id = $(this).attr('data-bs-id');
        $("#form-delete-user").on("submit", function (e) {
            var url = APP_URL + "/user/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                success: function (res) {
                    $("#deleteUserModal").modal("hide");
                    $("#table-users").DataTable().ajax.reload();
                },
                error: (e, x, settings, exception) => {
                },
            });
            e.preventDefault();
        });
    });

})
