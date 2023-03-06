$(document).ready(function () {
    // console.info(csrf_token);
    handleFormModalSubmit();
    handleDataTables();
    // customFilter();
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
            // infoFiltered: "",
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
            url: HomeUrl + "/admin/list_barang",
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
