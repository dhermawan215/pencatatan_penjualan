$(document).ready(function () {
    handleDataTables();
    handleFormModalSubmit();
    // customFilter();
    // handleDeleteData();
    handleDelete();
    handleEdit();
});

function handleFormModalSubmit() {
    $("#formTambahBarang").submit(function (e) {
        e.preventDefault();

        const form = $(this);
        const formData = new FormData(form[0]);

        $.ajax({
            type: "post",
            url: HomeUrl + "/admin/barang",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let obj = JSON.parse(response);
                toastr.success("Data Berhasil Disimpan", "Success");
                setTimeout(() => {
                    window.location.href = HomeUrl + "/admin/barang";
                }, 6000);
            },
            error: function (response) {
                $.each(response.responseJSON, function (key, value) {
                    toastr.error(value);
                });
            },
        });
    });
}

function handleDataTables() {
    let contentSelected = [];
    const csrf_token = $('meta[name="_token"]').attr("content");
    const table = $("#tableBarang").DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100],
        ],
        lengthChange: true,
        language: {
            emptyTable: "My Custom Message On Empty Table",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 - 0 dari 0 data",
            infoFiltered: "",
            zeroRecords: "Data tidak di temukan",
            loadingRecords: "Loading...",
            processing: "Processing...",
        },
        bFilter: true,
        info: true,
        processing: true,
        serverSide: true,
        order: [[1, "asc"]],
        ajax: {
            url: HomeUrl + "/admin/barang/list_barang",
            type: "POST",
            data: {
                _token: csrf_token,
                // kode: $("#tfoot-nobarang-search").val(),
                // nama: $("#tfoot-namabarang-search").val(),
                // harga: $("#tfoot-harga-search").val(),
            },
        },
        columns: [
            { data: "cbox", orderable: false },
            { data: "rnum", orderable: false },
            { data: "kode_barang" },
            { data: "nama_barang" },
            { data: "harga" },
            // { data: "aksi", orderable: false },
        ],
    });
    $("#tfootNoBarSr").on("change", function () {
        var data_index = $(this).attr("data-index");
        table.columns(2).search($(this).val()).draw();
        customFilter();
    });
    $("#tfootnNaBarSr").on("change", function () {
        var data_index = $(this).attr("data-index");
        table.columns(3).search($(this).val()).draw();
        customFilter();
    });
    $("#tfootHargaSr").on("change", function () {
        var data_index = $(this).attr("data-index");
        table.columns(4).search($(this).val()).draw();
        customFilter();
    });
}

function customFilter() {
    table.ajax.reload(null, false);
}

function handleDelete() {
    const csrf_token = $('meta[name="_token"]').attr("content");
    $(document).on("click", "#btndeletes", function () {
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
                    url: HomeUrl + "/admin/barang/" + id,
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
                        $("#tableBarang").DataTable().ajax.reload();
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Internal Server Error",
                        });
                    },
                });
                //

                //
            }
        });
    });
}
