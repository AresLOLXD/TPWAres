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

  <!-- ******************************* -->
  <!--      Para editar una tarea      -->
  <!-- necesario el id de la actividad -->
  <!-- ******************************* -->

  <div class="container shadow p-3 mb-5 bg-white rounded" >
    <!-- Registrar o editar tarea -->
    <br>
    <h1 class="display-5">Crear / edita tarea</h1>
    <br>
    <form class="form-floating" action="">
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
  </div>
  

</body>

</html>