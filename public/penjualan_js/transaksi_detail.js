var Index = (function () {
    var table;
    const trId = $("#transaksiId").val();

    var handleItemtransaksi = function () {
        table = $("#tableItemTransaksi").DataTable({
            responsive: false,
            autoWidth: false,
            pageLength: 5,
            searching: false,
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
                { data: "rnum", orderable: false },
                { data: "barang" },
                { data: "harga" },
                { data: "qty" },
            ],
        });
    };

    return {
        init: function () {
            handleItemtransaksi();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
