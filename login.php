
<?php require "./Util/verifyTeacher.php"; ?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <base href="/">
        <meta charset="UTF-8">
        <title>Inicio de sesión</title>
        <link rel="stylesheet" href="css/bulma.min.css">
    </head>
    <body>
        
        <div>
            <input type="text" id="username" class="" >
            <input type="password" id="password" class="">
            <button type="button" onclick="login" class="">Iniciar sesion</button>
        </div>
        
        
        <script src="js/fontawesome.js"></script>
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/generic.js"></script>
        <script>
            function login()
            {
                const params={
                    username:getterID("username").value,
                    password:getterID("password").value
                };
                makePost("API/login.php",params,
                    (data)=>{
                        if(data.Estado==="ok")
                        {
                            switch(data.tipo)
                            {
                                case 0:
                                    window.location.assign("Alumno/inicio.php");
                                    break;
                                case 1:
                                    window.location.assign("Profesor/inicio.php");
                                    break;
                                case 2:
                                    window.location.assign("Admin/inicio.php");
                                    break;
                                default:
                                    window.location.reload();
                                    break;
                            }
                        }else
                        {
                            
                        }
                    },
                    (err)=>
                    {
                        console.error(err);
                    }
                );
            }
        
        </script>
    </body>
</html>
