<!DOCTYPE html>

<html lang="es">

<head>
  <base href="/TPW/">
  <meta charset="UTF-8">
  <title>Admin | Registra & edita</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <!-- Barra de navegacion de admin -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Proyecto de TPW - - - Administrador</a>
      <button type="button" class="btn btn-secondary">Cerrar sesión</button>
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
    <form action="">
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
            <select class="form-select">
              <option selected>Selecciona una opción ...</option>
              <option value="0">Alumno</option>
              <option value="1">Profe</option>
              <option value="2">Admin</option>
            </select>
          </div>
          <div class="col-6">
            <label for="txtUsuario" class="form-label">Usuario:</label>
            <input type="text" class="form-control" placeholder="Nombre de usuario" id="txtApPat">
          </div>
          <div class="col-6">
            <label for="txtPassword" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" placeholder="Su contraseña" id="txtApPat">
          </div>
        </div>
      </div>
      <div class="mb-3"></div>
      <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
  </div>

</body>

</html>