var Index = (function (param) {
    const csrf_token = $('meta[name="_token"]').attr("content");
    var table;

    var handleDataStok = function () {
        table = $("#tableStokBarang").DataTable({
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
                url: HomeUrl + "/admin/stok/all",
                type: "POST",
                data: {
                    _token: csrf_token,
                },
            },
            columns: [
                { data: "cbox", orderable: false },
                { data: "rnum", orderable: false },
                { data: "barang" },
                { data: "qty" },
                { data: "tgl" },
            ],
        });
        $(".tfoot-seacrh").on("change", function (e) {
            var data_index = $(this).attr("data-index");
            table.columns(data_index).search($(this).val()).draw();
            table.ajax.reload(null, false);
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
                        url: HomeUrl + "/admin/stok/" + id,
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
            handleDataStok();
            handleDelete();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
