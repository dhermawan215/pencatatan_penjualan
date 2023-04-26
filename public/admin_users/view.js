var Index = (function () {
    const csrf_token = $('meta[name="_token"]').attr("content");
    var table;

    var handleDataUser = function () {
        table = $("#adminUsers").DataTable({
            responsive: false,
            autoWidth: false,
            pageLength: 5,
            searching: true,
            paging: true,
            lengthMenu: [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100],
            ],
            language: {
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 - 0 dari 0 data",
                infoFiltered: "",
                zeroRecords: "Data tidak di temukan",
                loadingRecords: "Loading...",
                processing: "Processing...",
            },
            columnsDefs: [
                { searchable: false, target: [0, 1] },
                { orderable: false, target: [0, 1] },
            ],
            order: [[1, "asc"]],
            processing: true,
            serverSide: true,
            ajax: {
                url: HomeUrl + "/admin/users/get_data_users",
                type: "POST",
                data: {
                    _token: csrf_token,
                },
            },
            columns: [
                { data: "cbox", orderable: false },
                { data: "rnum", orderable: false },
                { data: "name" },
                { data: "email" },
            ],
        });
        $(".tfoot-seacrh").on("change", function () {
            var data_index = $(this).attr("data-index");
            table.columns(data_index).search($(this).val()).draw();
            table.ajax.reload(null, false);
        });
    };

    var handleFormAddUser = function () {
        $("#formTambahUser").submit(function (e) {
            e.preventDefault();

            const form = $(this);
            let formData = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: HomeUrl + "/admin/users/register",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // console.log(response);
                    // let obj = JSON.parse(response);
                    toastr.success("Data Berhasil Disimpan", "Success");
                    setTimeout(function () {
                        $("#user_modal").modal("toggle");
                        table.ajax.reload(null, false);
                    }, 3000);
                },
                error: function (response) {
                    $.each(response.responseJSON, function (key, value) {
                        toastr.error(value);
                    });
                },
            });
        });
    };

    var handleDelete = function () {
        $(document).on("click", ".btndel", function () {
            let id = $(this).data("id");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: HomeUrl + "/admin/users/" + id,
                        data: {
                            _token: csrf_token,
                            // ids: id,
                        },
                        success: function (response) {
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                            table.ajax.reload();
                        },
                        error: function (response) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Internal Server Error",
                            });
                        },
                    });
                }
            });
        });
    };

    return {
        init: function () {
            handleDataUser();
            handleFormAddUser();
            handleDelete();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
