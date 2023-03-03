$(document).ready(function () {
    handleFormModalSubmit();
});

function handleFormModalSubmit() {
    $("#formTambahBarang").submit(function (e) {
        e.preventDefault();

        const form = $(this);
        const formData = new FormData(form[0]);

        $.ajax({
            type: "post",
            url: HomeUrl + "/admin/barang",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let obj = JSON.parse(response);
                toastr.success("Data Berhasil Disimpan", "Success");
                setTimeout(() => {
                    window.location.href = HomeUrl + "/admin/barang";
                }, 6000);
            },
            error: function (response) {
                $.each(response.responseJSON, function (key, value) {
                    toastr.error(value);
                });
            },
        });
    });
}
