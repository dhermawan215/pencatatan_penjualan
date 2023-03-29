var Index = (function () {
    var handleBuatTransaksi = function () {
        $("#formBuatTransaksi").submit(function (e) {
            e.preventDefault();

            const form = $(this);
            let formData = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: HomeUrl + "/sales/simpan",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    const json = JSON.stringify(response);
                    let obj = JSON.parse(json);

                    let noTransaksi = obj["no_transaksi"];

                    toastr.success("Data Berhasil Disimpan", "Success");
                    setTimeout(() => {
                        window.location.href =
                            HomeUrl + "/sales/transaksi_detail/" + noTransaksi;
                    }, 5000);
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
            handleBuatTransaksi();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
