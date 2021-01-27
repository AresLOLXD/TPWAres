<?php require "./Util/verifyLogged.php";?>
<!DOCTYPE html>

<html lang="es">

<head>
    <base href="/TPW/">
    <meta charset="UTF-8">
    <title>Login | Inicia sesión para empezar</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Barra de navegacion de usuario no logeado -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Proyecto de TPW - - - Login</a>
        </div>
    </nav>

    <div class="container shadow p-3 mb-5 bg-white rounded text-center position-absolute top-50 start-50 translate-middle">
        <br>
        <h1 class="display-3">Iniciar sesión:</h1>
        <br>
        <input id="username" class="input form-control" type="text" placeholder="Usuario">
        <br>
        <input id="password" class="input form-control" type="password" placeholder="Password">
        <br>
        <button id="enviar" type="button" class="btn btn-dark">Dark</button>
    </div>

    <script src="js/generic.js"></script>
    <script src="js/jquery.min.js"></script>
    <script>

        initialize(() => {
            addListener("enviar", login)
        })
        function login() {
            const params = {
                username: getterID("username").value,
                password: getterID("password").value
            };
            makePost("API/login.php", params,
                (data) => {
                    if (data.Estado === "ok") {
                        switch (data.tipo) {
                            case 0:
                                window.location.assign("Alumno/tareas.php");
                                break;
                            case 1:
                                window.location.assign("Profesor/tareas.php");
                                break;
                            case 2:
                                window.location.assign("Admin/usuarios.php");
                                break;
                            default:
                                window.location.reload();
                                break;
                        }
                    } else {
                        alert(data.Descripcion)
                    }
                },
                (err) => {
                    console.error(err);
                }
            );
        }
    </script>
</body>

</html>