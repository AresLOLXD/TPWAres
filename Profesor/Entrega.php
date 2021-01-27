<?php require dirname(dirname(__FILE__)) . "/Util/verifyTeacher.php";?>
<!DOCTYPE html>

<html lang="es">

<head>
  <base href="/TPW/">
  <meta charset="UTF-8">
  <title>Profe | Entraga de una tarea</title>
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
            <a class="nav-link" aria-current="page" onclick="editAssignment(0)">Crear tarea</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>


  <!-- ******************************* -->
  <!--      Para esta pagina es        -->
  <!-- necesario el id de la entrega -->
  <!-- ******************************* -->

  <!-- Poner el título de la tarea -->
  <div class="container-md">
    <br>
    <h1 class="display-4">Entrega de <span id="nombre1"></span></h1>
  </div>

  <!-- Muestra de la entrega de la actividad -->
  <!-- obetener URL de la BD -->
  <div class="container shadow p-3 mb-5 bg-white rounded">
    <embed id="embed" src="public/example.pdf" type="application/pdf" width="100%" height="600px" />
  </div>

  <div class="container shadow p-3 mb-5 bg-white rounded">
    <!-- Poner debajo el nombre del alumno que la antregó -->
    <p>Trabajo de <span id="nombre2"></span></p>
    <form id="formulario" class="input-group mb-3">
      <input min="0" max="10" step="0.01" type="number" class="form-control" id="calificacion" placeholder="Calificación de este trabajo" >
    <button class="btn btn-outline-secondary" type="submit" id="asignaCalificacion">Guardar calificación</button>
    </form>
  </div>
  <script src="js/generic.js"></script>
  <script src="js/jquery.min.js"></script>
  <script>

    let idActividad=0,idUsuario=0;
    initialize(()=>
    {

      getterID("formulario").onsubmit = function() {
        return submit();
      };
      idActividad=findGetParameter("idActividad");
      idUsuario=findGetParameter("idUsuario");
      load();
    });
    function submit()
    {
      const params={
        idActividad,
        idUsuario,
        calificacion:getterID("calificacion").value
      };
      makePost("API/Profesor/rateDelivery.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          alert("Tarea calificada");
          window.location.assign("Profesor/entregas.php?idActividad="+idActividad);
        }else{
          alert(data.Descripcion);
        }
      },
      err=>
      {
        console.error(err);
      })
      return false;
    }
    function load()
    {
      const params={idActividad,idUsuario};
      makePost("API/Profesor/showDelivery.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          const info=data.Registro;
          getterID("nombre1").innerHTML=info.username
          getterID("nombre2").innerHTML=info.username
          getterID("calificacion").value=info.calificacion
          var source="API/Profesor/showFileUploaded.php?idArchivo="+info.idArchivo;
          var embed=getterID("embed");
          var clone=embed.cloneNode(true);
          clone.setAttribute('src',source);
          embed.parentNode.replaceChild(clone,embed)

        }else{
          alert(data.Descripcion);
        }
      },
      err=>
      {
        console.error(err);
      })
      return false;
    }
  </script>
</body>

</html>
