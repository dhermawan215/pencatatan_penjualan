var Index = (function () {
    const csrf_token = $('meta[name="_token"]').attr("content");

    var handleFormUpdate = function () {
        $("#formTambahUser").submit(function (e) {
            e.preventDefault();

            const form = $(this);
            let formData = new FormData(form[0]);

            $.ajax({
                type: "POST",
                url: HomeUrl + "/admin/users/register",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // console.log(response);
                    // let obj = JSON.parse(response);
                    toastr.success("Data Berhasil Disimpan", "Success");
                    setTimeout(function () {
                        $("#user_modal").modal("toggle");
                        table.ajax.reload(null, false);
                    }, 3000);
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
            handleFormUpdate();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
