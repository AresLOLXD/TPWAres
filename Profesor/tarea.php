<?php require dirname(dirname(__FILE__)) . "/Util/verifyTeacher.php";?>
<!DOCTYPE html>

<html lang="es">

<head>
  <base href="/TPW/">
  <meta charset="UTF-8">
  <title>Profe | Crea y edita</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <!-- Barra de navegacion de admin -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Proyecto de TPW - - - Profesor</a>
      <input type="button" class="btn btn-secondary" onclick="window.location.assign('logout.php')" value="Cerrar sesión">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Profesor/Tareas.php">Lista de tareas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Profesor/Tarea.php">Crear tarea</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>

  <!-- ******************************* -->
  <!--      Para editar una tarea      -->
  <!-- necesario el id de la actividad -->
  <!-- ******************************* -->

  <div class="container shadow p-3 mb-5 bg-white rounded" >
    <!-- Registrar o editar tarea -->
    <br>
    <h1 class="display-5">Crear / edita tarea</h1>
    <br>
    <form class="form-floating" id="formulario">
      <div class="container">
        <div class="row g-2">
          <div class="col-6">
            <label for="txtTitulo" class="form-label">Título:</label>
            <input type="text" class="form-control" placeholder="Título de la tarea" id="txtTitulo" autofocus>
          </div>
          <div class="col-6">
            <label for="txtFechaEntrega" class="form-label">Fecha de entrega:</label>
            <input type="date" class="form-control" id="txtFechaEntrega">
          </div>
          <div class="col-6">
            <label for="txtPaginas" class="form-label">Paginas:</label>
            <input type="text" class="form-control" placeholder="Separa cada una con comas" id="txtPaginas">
          </div>
          <div class="col-6"></div>
          <div class="form-floating">
            <textarea class="form-control" placeholder="Descripción de la tarea" id="txtTexto" style="height: 100px"></textarea>
            <label for="txtTexto">De que trata la tarea?</label>
          </div>
        </div>
      </div>
      <div class="mb-3"></div>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    <script src="js/jquery.min.js"></script>
  <script src="js/generic.js"></script>
  <script>

    function findGetParameter(parameterName) {
        var result = null,tmp = [];
        location.search
          .substr(1)
          .split("&")
          .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
          });
        return result;
    }
    let idActividad=0;
    initialize(()=>
    {
      idActividad=findGetParameter("idActividad");
      if(idActividad!=0)
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
        idActividad,
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
        idActividad,
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
      if(idActividad!=0)
        updateUser();
      else uploadUser();
      return false;
    }
    function loadInfo()
    {
      const params={idActividad};
      makePost("API/Profesor/showAssignment.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          const tarea=data.Registro;
          getterID("txtTitulo").value=tarea.titulo;
          getterID("txtFechaEntrega").value=tarea.fechaEntrega;
          getterID("txtPaginas").value=JSON.parse(tarea.paginas).join(",");
          getterID("txtTexto").value=tarea.texto;
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
