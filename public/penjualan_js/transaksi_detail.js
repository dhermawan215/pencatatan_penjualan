var Index = (function () {
    var table;
    const csrf_token = $('meta[name="_token"]').attr("content");
    const trId = $("#transaksiId").val();

    var handleItemtransaksi = function () {
        table = $("#tableItemTransaksi").DataTable({
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
                url: HomeUrl + "/sales/transaksi_item",
                type: "POST",
                data: {
                    _token: csrf_token,
                    trId: trId,
                },
            },
            columns: [
                { data: "cbox", orderable: false },
                { data: "barang" },
                { data: "harga" },
                { data: "qty" },
                { data: "subtotal" },
            ],
            drawCallback: function (response) {
                const total = response.json.sum;
                handleTotal(total);
            },
        });
    };

    var handleBarangDropDown = function () {
        $("#barangId").change(function (e) {
            e.preventDefault();
            const idValue = $(this).val();

            $.ajax({
                type: "POST",
                url: HomeUrl + "/sales/barang",
                data: {
                    _token: csrf_token,
                    idvalue: idValue,
                },
                success: function (response) {
                    const harga = response.harga;
                    $("#hargaSatuan").val(harga);
                    handleSubTotal(harga);
                },
                error: function (response) {},
            });
        });
    };

    var handleSubTotal = function (harga) {
        $("#qtyBarang").change(function (e) {
            e.preventDefault();
            const valueQty = $(this).val();
            const subTotal = valueQty * harga;
            $("#subTotal").val(subTotal);
        });
    };

    var handleTotal = function (total) {
        const value_total = total;
        $("#total").val(value_total);
    };

    var handleSubmitDetailPembelian = function () {
        $("#formTransaksiDetail").submit(function (e) {
            e.preventDefault();

            const form = $(this);
            let formData = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: HomeUrl + "/sales/simpan_transaksi_detail",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    const json = JSON.stringify(response);
                    let obj = JSON.parse(json);
                    toastr.success("Data Berhasil Ditambahkan", "Success");
                    table.ajax.reload(null, false);
                },
                error: function (response) {
                    $.each(response.responseJSON, function (key, value) {
                        toastr.error(value);
                    });
                },
            });
        });
    };

    return {
        init: function () {
            handleItemtransaksi();
            handleBarangDropDown();
            handleSubmitDetailPembelian();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
