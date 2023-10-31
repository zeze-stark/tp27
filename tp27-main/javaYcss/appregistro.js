$(document).ready(function () {
  console.log("la app esta funcionando");

  // Validacion de registro

  $("#formRegistro").submit((e) => {
    e.preventDefault();
    var usuario = $.trim($("#usuario_registro").val());
    var password = $.trim($("#password_registro").val());
    var email = $.trim($("#email_registro").val());

    if (!usuario.length || !password.length) {
      Swal.fire({
        icon: "warning",
        title: "Debe ingresar un usuario y/o contraseña!",
      });
    } else {
      $.ajax({
        url: "./api/registro.php",
        type: "POST",
        datatype: "json",
        data: {
          usuario: usuario,
          password: password,
          email: email,
        },
        success: function (data) {
          if (data == "") {
            Swal.fire({
              icon: "error",
              title: data.message,
              timer: 2000,
            });
          } else {
            $("#formRegistro .close").click();
            Swal.fire({
              icon: "success",
              title: data.message,
              showConfirmButton: false,
              timer: 1500,
            });
          }
        },
      });
    }
  });
});
