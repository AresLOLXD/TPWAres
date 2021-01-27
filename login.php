
<?php require "./Util/verifyLogged.php";?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <base href="/TPW/">
        <meta charset="UTF-8">
        <title>Inicio de sesión</title>

    </head>
    <body>
    <!--
        Banner de inicio
    -->
    <section class="hero has-background-info">
        <div class="hero-body">
            <figure class="image">
                <a href="login.php">
                    <img class="is-rounded" src="img/titulo.png" alt="Titulo" style="max-width:150px;" >
                </a>
            </figure>
        </div>
    </section>

    <!-- Contenido del inicio de sesion-->
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-one-third is-offset-one-third">
                    <h1 class="title is-size-3">Inicio de sesión</h1>
                    <div class="container">
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input id="username" class="input" type="text" placeholder="Usuario">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input id="password" class="input" type="password" placeholder="Password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control">
                                <button id="enviar" class="button is-success">
                                Login
                                </button>
                            </p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>



        <script src="js/generic.js"></script>
        <script src="js/jquery.min.js"></script>
        <script>

            initialize(()=>
            {
                addListener("enviar",login)
            })
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
                        }else
                        {
                            alert(data.Descripcion)
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
