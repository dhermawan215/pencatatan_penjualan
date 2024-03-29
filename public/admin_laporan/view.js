var Index = (function () {
    var csrf_token = $('meta[name="_token"]').attr("content");
    var handleNoTransaksi = function () {
        $("#noTrsc")
            .select2({
                // minimumInputLength: 1,
                allowClear: true,
                placeholder: "masukkan nomer transaksi",
                ajax: {
                    method: "POST",

                    url: HomeUrl + "/admin/laporan/data_transaksi",

                    data: function (params) {
                        return {
                            _token: csrf_token,
                            search: params.term, // search term
                        };
                    },
                    processResults: function (data) {
                        // console.log(data);

                        // var objk = $.map(data, function (item) {
                        //     console.log({ item });
                        //     item.id = item.id;
                        //     item.text = item.no_transaksi;
                        //     return item;
                        // });
                        // // console.log(objk);
                        return {
                            // results: objk,
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.no_transaksi,
                                };
                            }),
                        };
                    },
                    // cache: true,
                },
            })
            .on("select2:select", function (evt) {
                const data = $("#noTrsc option:selected").text();
                toastr.success("berhasil di pilih", data);
            });
    };

    var handleNoTrsc = function () {
        $("#formNoTrsc").submit(function (e) {
            e.preventDefault();
            const form = $(this);
            let formData = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: HomeUrl + "/admin/laporan/laporan_transaksi",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    window.location.href =
                        HomeUrl + "/admin/laporan_download/" + response;
                },
                error: function (response) {
                    $.each(response.responseJSON, function (key, value) {
                        toastr.error(value);
                    });
                },
            });
        });
    };

    var handleHarian = function () {
        $("#formCariHarian").submit(function (e) {
            e.preventDefault();
            const form = $(this);
            let formData = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: HomeUrl + "/admin/laporan/laporan_harian",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    window.location.href =
                        HomeUrl + "/admin/laporan_download/" + response;
                },
                error: function (response) {
                    $.each(response.responseJSON, function (key, value) {
                        toastr.error(value);
                    });
                },
            });
        });
    };

    var handleMingguan = function () {
        $("#formCariMingguan").submit(function (e) {
            e.preventDefault();
            const form = $(this);
            let formData = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: HomeUrl + "/admin/laporan/laporan_mingguan",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    window.location.href =
                        HomeUrl + "/admin/laporan_download/" + response;
                },
                error: function (response) {
                    $.each(response.responseJSON, function (key, value) {
                        toastr.error(value);
                    });
                },
            });
        });
    };

    var handleBulanan = function () {
        $("#pencarianBulan").select2({
            allowClear: true,
            placeholder: "pilih bulan",
            width: "resolve",
        });

        $("#formCariBulanan").submit(function (e) {
            e.preventDefault();
            const form = $(this);
            let formData = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: HomeUrl + "/admin/laporan/laporan_bulanan",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    window.location.href =
                        HomeUrl + "/admin/laporan_download/" + response;
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
            handleNoTransaksi();
            handleNoTrsc();
            handleHarian();
            handleBulanan();
            handleMingguan();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
