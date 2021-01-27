<!DOCTYPE html>

<html lang="es">

<head>
  <base href="/TPW/">
  <meta charset="UTF-8">
  <title>Profe | Busca & lista</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <!-- Barra de navegacion de admin -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Proyecto de TPW - - - Profesor</a>
      <button type="button" class="btn btn-secondary">Cerrar sesión</button>
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

  <!-- Busqueda de tareas -->
  <div class="container-md">
    <br>
    <form class="d-flex shadow p-3 mb-5 bg-white rounded" action="">
      <input class="form-control me-2" type="search" placeholder="Nombre de la tarea" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Buscar tarea</button>
    </form>
  </div>

  <!-- Listado de tareas -->
  <div class="row row-cols-1 row-cols-md-3 g-4 shadow-none p-3 mb-5 bg-light rounded">
    <!-- Meter este div en loop -->
    <div class="col">
      <div class="card">
        <img src="../img/libros.png" class="card-img-top" alt="...">
        <div class="card-body">
          <!-- ID de la tarea -->
          <h5 class="card-text">ID: </h5>
          <!-- Titulo de la tarea -->
          <h4 class="card-title"> Titulo: </h4>
          <!-- Texto de la tarea -->
          <p class="card-text"> Descripción: </p>
          <!-- Fecha de entrega de la tarea -->
          <p class="card-text">Fecha de entrega: </p>
            <!-- Llenar input con el ID de la tarea -->
            <form action="">
              <input type="hidden" value="">
              <input id="editar" class="btn btn-primary" value="Editar">
              <input id="entregas" class="btn btn-secondary" value="Ver entregas">
            </form>
        </div>
      </div>
    </div>
    <!-- Aquí termina el div que se mete en el loop -->
  </div>
  

</body>

</html>