var Index = (function () {
    const csrf_token = $('meta[name="_token"]').attr("content");

    var handleFormSubmit = function () {
        $("#formTambahStok").submit(function (e) {
            e.preventDefault();

            const form = $(this);
            let formData = new FormData(form[0]);

            $.ajax({
                type: "Post",
                url: HomeUrl + "/stok",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    let obj = JSON.parse(response);
                    toastr.success("Data Berhasil Disimpan", "Success");
                    setTimeout(() => {
                        window.location.href = HomeUrl + "/stok";
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
            handleFormSubmit();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
