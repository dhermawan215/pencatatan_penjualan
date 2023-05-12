var Index = (function () {
    const csrf_token = $('meta[name="_token"]').attr("content");

    var handleFormUpdate = function () {
        $("#formUpdatePassword").submit(function (e) {
            e.preventDefault();

            const form = $(this);
            let formData = new FormData(form[0]);

            const id = $("#idValue").val();

            $.ajax({
                type: "POST",
                url: HomeUrl + "/admin/users/update_password/" + id,
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // console.log(response);
                    // let obj = JSON.parse(response);
                    toastr.success("Password berhasil diupdate", "Success");
                    setTimeout(() => {
                        window.location.href = HomeUrl + "/admin/users";
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
            handleFormUpdate();
        },
    };
})();

$(document).ready(function () {
    Index.init();
});
