$(document).ready(function () {
    handleEdit();
});

function handleEdit() {
    $("#formEditBarang").submit(function (e) {
        e.preventDefault();
        const form = $(this);
        const formData = new FormData(form[0]);

        let id = $("#idValue").val();
        // console.info(formData);

        $.ajax({
            type: "POST",
            url: HomeUrl + "/admin/barang/" + id,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.info(response);
                toastr.success("Data Berhasil Diperbaharui", "Success");
                setTimeout(() => {
                    window.location.href = HomeUrl + "/admin/barang";
                }, 6000);
            },
            error: function (response) {
                console.info(response);
                $.each(response.responseJSON, function (key, value) {
                    toastr.error(value);
                });
            },
        });
    });
}
