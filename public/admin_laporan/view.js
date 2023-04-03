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
        });
    };
    return {
        init: function () {
            handleNoTransaksi();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
