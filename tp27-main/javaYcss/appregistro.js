$(document).ready(function () {
    console.log("la app esta funcionando");
  
  
// Validacion de registro

$("#formRegistro").submit(function (e) {
    e.preventDefault();
    var usuario = $.trim($("#usuario").val());
    var password = $.trim($("#password").val());
    var email = $.trim($("#email").val()); 

    if (usuario.length == "" || password.length == "") {
      swal.fire({
        icon: "warning",
        title: "Debe ingresar un usuario y/o contraseña!!!!!!",
      });
    } else {
      $.ajax({
        url: "logeo.php",
        type: "POST",
        datatype: "json",
        data: {
          usuario: usuario,
          password: password,
          email: email,
        },
        success: function (data) {
          if (data == "") {
            swal.fire({
              icon: "error",
              title: "usuario ya registrado",
            });
          } else {
            swal
              .fire({
                icon: "success",
                title: "Conexion Exitosa",
                confirmButtonText: "Ingresar",
              })
              .then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "app.js";
                }
              });
          }
        },
      });
    };
 });
