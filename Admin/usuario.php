<?php require dirname(dirname(__FILE__)) . "/Util/verifyAdmin.php";?>
<!DOCTYPE html>

<html lang="es">

<head>
  <base href="/TPW/">
  <meta charset="UTF-8">
  <title>Admin | Registra & edita</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <!-- Barra de navegacion de admin -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Proyecto de TPW - - - Administrador</a>
      <input type="button" class="btn btn-secondary" value="Cerrar sesión" onclick="window.location.assign('logout.php')">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Admin/Usuarios.php">Lista de usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Admin/Usuario.php">Registrar usuario</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>

  <div class="container shadow p-3 mb-5 bg-white rounded" >
    <!-- Registrar o editar usuario -->
    <br>
    <h1 class="display-5">Registra / edita usuario</h1>
    <br>
    <form id="formulario">
      <div class="container">
        <div class="row g-2">
          <div class="col-6">
            <label for="txtNombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" placeholder="Nombre" id="txtNombre" autofocus>
          </div>
          <div class="col-6">
            <label for="txtApPat" class="form-label">Apellido Paterno:</label>
            <input type="text" class="form-control" placeholder="Apellido paterno" id="txtApPat">
          </div>
          <div class="col-6">
            <label for="txtApMat" class="form-label">Apellido Materno:</label>
            <input type="text" class="form-control" placeholder="Apellido materno" id="txtApMat">
          </div>
          <div class="col-6">
            <label for="txtTipo" class="form-label">Nivel de usuario:</label>
            <select class="form-select" id="txtTipo">
              <option selected disabled>Selecciona una opción ...</option>
              <option value="0">Alumno</option>
              <option value="1">Profe</option>
              <option value="2">Admin</option>
            </select>
          </div>
          <div class="col-6">
            <label for="txtUsuario" class="form-label">Usuario:</label>
            <input type="text" class="form-control" placeholder="Nombre de usuario" id="txtUsuario">
          </div>
          <div class="col-6">
            <label for="txtPassword" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" placeholder="Su contraseña (Si no desea cambiarla solo deje en blanco)" id="txtPassword">
          </div>
        </div>
      </div>
      <div class="mb-3"></div>
      <button type="submit" class="btn btn-primary">Registrar</button>
    </form>

  <script src="js/jquery.min.js"></script>
  <script src="js/generic.js"></script>
  <script>

    let idUsuario=0;
    initialize(()=>
    {
      idUsuario=findGetParameter("idUsuario");
      if(idUsuario!=0)
      {
        loadInfo();
      }
      getterID("formulario").onsubmit = function() {
        return submit();
      };
    });
    function updateUser()
    {
      const params={
        idUsuario,
        nombre:getterID("txtNombre").value,
        apPat:getterID("txtApPat").value,
        apMat:getterID("txtApMat").value,
        username:getterID("txtUsuario").value,
        tipo:getterID("txtTipo").value,
        password:getterID("txtPassword").value
      };
      makePost("API/Admin/updateUser.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          alert("Usuario actualizado");
          window.location.assign("Admin/usuarios.php");

        }else{
          alert(data.Descripcion);
        }
      },
      err=>
      {
        console.error(err);
      })
    }
    function uploadUser()
    {
      const params={
        idUsuario,
        nombre:getterID("txtNombre").value,
        apPat:getterID("txtApPat").value,
        apMat:getterID("txtApMat").value,
        username:getterID("txtUsuario").value,
        tipo:getterID("txtTipo").value,
        password:getterID("txtPassword").value
      };
      makePost("API/Admin/createUser.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          alert("Usuario registrado");
          window.location.assign("Admin/usuarios.php");
        }else{
          alert(data.Descripcion);
        }
      },
      err=>
      {
        console.error(err);
      })
    }
    function submit()
    {
      if(idUsuario!=0)
        updateUser();
      else uploadUser();
      return false;
    }
    function loadInfo()
    {
      const params={idUsuario};
      makePost("API/Admin/showUser.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          const user=data.Registro;
          getterID("txtNombre").value=user.nombre;
          getterID("txtApPat").value=user.apPat;
          getterID("txtApMat").value=user.apMat;
          getterID("txtUsuario").value=user.username;
          getterID("txtUsuario").disabled=true;

          getterID("txtTipo").value=user.tipo;
        }else{
          alert(data.Descripcion);
        }
      },
      err=>
      {
        console.error(err);
      })
    }

  </script>
  </div>

</body>

</html>
