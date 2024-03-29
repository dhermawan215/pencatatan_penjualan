var Index = (function () {
    var editSubmit = function () {
        $("#formEditStok").submit(function (e) {
            e.preventDefault();

            const form = $(this);
            let formData = new FormData(form[0]);

            let id = $("#idValue").val();

            $.ajax({
                type: "POST",
                url: HomeUrl + "/stok/" + id,
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.info(response);
                    toastr.success("Data Berhasil Diperbaharui", "Success");
                    setTimeout(() => {
                        window.location.href = HomeUrl + "/stok";
                    }, 5000);
                },
                error: function (response) {
                    console.info(response);
                    $.each(response.responseJSON, function (key, value) {
                        toastr.error(value);
                    });
                },
            });
        });
    };
    return {
        init: function () {
            editSubmit();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
