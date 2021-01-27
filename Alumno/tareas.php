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
            <a class="nav-link active" aria-current="page" href="Admin/Usuarios.php"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Admin/Usuario.php">Registrar usuario</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>

  <!-- ******************************* -->
  <!--      Para esta pagina es        -->
  <!--   necesario el id del alumno    -->
  <!-- ******************************* -->

  <div class="container-md">
    <br>
    <h1 class="display-6">Tareas pendientes:</h1>
  </div>

  <!-- Listado de tareas pendientes -->
  <div class="container shadow p-3 mb-5 bg-white rounded">
    <br>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Tarea</th>
          <th scope="col">Fecha de entrega</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <!-- Llenar datos de actividad y meter en loop -->
          <!-- select * from actividad where             -->
          <td></td>
          <td></td>
          <!-- Llenar input con el ID de entrega -->
          <td>
            <form method="get" action="Alumno/Tarea.php">
              <input type="hidden" value="">
              <input type="submit" class="btn btn-primary" value="Ver tarea">
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


  <div class="container-md">
    <br>
    <h1 class="display-6">Tareas entregadas:</h1>
  </div>

  <!-- Listado de entregas -->
  <div class="container shadow p-3 mb-5 bg-white rounded">
    <br>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Fecha de entrega</th>
          <th scope="col">Nombre de archivo</th>
          <th scope="col">Calificacion</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <!-- Llenar datos de entrega y meter en loop   -->
          <!-- select * from actividad where idActividad -->
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>

</body>

</html>
