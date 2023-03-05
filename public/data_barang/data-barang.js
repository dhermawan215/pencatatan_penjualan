$(document).ready(function () {
    // console.info(csrf_token);
    handleDataTables();
    handleFormModalSubmit();
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
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 - 0 dari 0 data",
            // infoFiltered: "",
            zeroRecords: "Data tidak di temukan",
            loadingRecords: "Loading...",
            processing: "Processing...",
        },
        // filter: true,
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
    $(".tfoot-seacrh").on("change", function () {
        var data_index = $(this).attr("data-index");
        table.columns(data_index).search($(this).val()).draw();
    });
    customFilter();
}

function customFilter() {
    table.ajax.reload(null, false);
}
