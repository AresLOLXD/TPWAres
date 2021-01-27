<!DOCTYPE html>

<html lang="es">

<head>
  <base href="/TPW/">
  <meta charset="UTF-8">
  <title>Alumno | Actividades asignadas</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <!-- Barra de navegacion de Alumno -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Proyecto de TPW - - - Alumno</a>
      <input type="button" class="btn btn-secondary" onclick="window.location.assign('logout.php')" value="Cerrar sesión">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Alumno/Tareas.php">Lista de tareas</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>

  <!-- ******************************* -->
  <!--      Para esta pagina es        -->
  <!-- necesario el id de la actividad -->
  <!-- ******************************* -->

  <!-- Titulo de la tarea elegida -->
  <div class="container-md text-center">
    <br>
    <h1 class="display-3">Tarea: <span id="titulo"></span></h1>
  </div>

  <!-- Descripción de la tarea elegida -->
  <div class="container shadow p-3 mb-5 bg-white rounded">
    <br>
    <p class="card-text">Páginas: <span id="paginas"></span></p>
    <br>
    <p class="card-text">Descripción: <span id="texto"></span></p>
    <br>
  </div>

  <!-- Poner en src la fuente de la actividad -->
  <div class="container shadow-lg p-3 mb-5 bg-white rounded ratio ratio-16x9">
    <iframe src="" id="iframe" title="Tarea a entregar" allowfullscreen></iframe>
  </div>

  <div class="container shadow p-3 mb-5 bg-white rounded">
    <form class="row g-3" id="formulario">
      <div class="mb-3">
        <label for="formFileMultiple" class="form-label">Selecciona el archivo a subir:</label>
        <input class="form-control" type="file" id="formFileMultiple">
      </div>
      <input type="submit" class="btn btn-primary" value="Entregar">
    </form>
  </div>
<script src="js/jquery.min.js"></script>
  <script src="js/generic.js"></script>
  <script>

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
    function uploadAssignment()
    {
      const params={
        idActividad,
        titulo:getterID("txtTitulo").value,
        fechaEntrega:getterID("txtFechaEntrega").value,
        paginas:getterID("txtPaginas").value.split(","),
        texto:getterID("txtTexto").value,
      };
      makePost("API/Profesor/uploadAssignment.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          alert("Tarea registrada");
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
      uploadAssignment();
      return false;
    }
    function loadInfo()
    {
      const params={idActividad};
      makePost("API/Alumno/showAssignment.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          const tarea=data.Registro;
          getterID("titulo").innerHTML=tarea.titulo;
          getterID("paginas").innerHTML=JSON.parse(tarea.paginas).join(",");
          getterID("texto").innerHTML=tarea.texto;
          getterID("iframe").src="API/Alumno/showPDFFromAssignment.php?idActividad="+idActividad;
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
</body>

</html>
