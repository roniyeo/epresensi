$(document).ready(function () {
    $("#login").click(function (e) {
        e.preventDefault()
        var nik = $("#nik").val()
        var password = $("#password").val()
        var token = $("meta[name='csrf-token']").attr("content");
        if (nik.length == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'NIK Wajib Diisi !'
            });
        } else if (password.length == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Password Wajib Diisi !'
            });
        } else {
            $.ajax({
                url: "proses-login",
                type: "POST",
                dataType: "JSON",
                cache: false,
                data: {
                    "nik": nik,
                    "password": password,
                    "_token": token
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Berhasil!',
                            text: 'Anda akan di arahkan dalam 3 Detik',
                            timer: 3000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                            .then(function () {
                                window.location.href = "dashboard";
                            });
                    } else {
                        console.log(response.success);
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal!',
                            text: 'silahkan coba lagi!'
                        });
                    }
                    console.log(response);
                },
                error: function (response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Opps!',
                        text: 'server error!'
                    });
                    console.log(response);
                }
            })
        }
    })
})
