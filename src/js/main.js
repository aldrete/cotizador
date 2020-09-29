$(document).ready(function(){
    $('.formulario').submit(function(event) {
        var nombreUsuario = $('#nombre_usuario').val();
        var contrasena = $('#contrasena').val();
        $.ajax({
            type: "POST",
            url: 'api/usuario/login.php',
            data: {
                nombre_usuario: nombreUsuario,
                contrasena: contrasena
            },
            success: function(data)
            {
                window.location = 'dashboard.php';
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Usuario y/o Contraseña inválida intente de nuevo");
            },
            datatype: 'text'
            });
            event.preventDefault();
    });
});