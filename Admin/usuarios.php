<!DOCTYPE html>

<html lang="es">

<head>
  <base href="/TPW/">
  <meta charset="UTF-8">
  <title>Admin | Busca & lista</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
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

  <div class="container-md">
    <!-- Busqueda de usuarios -->
    <br>
    <form class="d-flex shadow p-3 mb-5 bg-white rounded" >
      <input class="form-control me-2" type="search" placeholder="Nombre de usuario" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Buscar usuario</button>
    </form>
  </div>

  <div class="container shadow p-3 mb-5 bg-white rounded">
    <br>
    <!-- Listado de usuarios -->
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Usuario</th>
          <th scope="col">Nombre</th>
          <th scope="col">Ap. Paterno</th>
          <th scope="col">Ap. Materno</th>
          <th scope="col">Tipo de usuario</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <!-- Llenar datos de usuario -->
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
          <!-- Llenar input con el ID de usuario -->
          <form>
            <input type="hidden" value="">
            <input type="submit" class="btn btn-primary" value="Editar" >
          </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</body>

</html>