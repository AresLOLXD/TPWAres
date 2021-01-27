<?php require dirname(dirname(__FILE__)) . "/Util/verifyAdmin.php";?>
<!DOCTYPE html>

<html lang="es">

<head>
  <base href="/TPW/">
  <meta charset="UTF-8">
  <title>Admin | Busca & lista</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <!-- Barra de navegacion de admin -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Proyecto de TPW - - - Administrador</a>
      <input type="button" class="btn btn-secondary" onclick="window.location.assign('logout.php')" value="Cerrar sesión">
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
            <a class="nav-link" aria-current="page" onclick="editUser(0)">Registrar usuario</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>

  <div class="container-md">
    <!-- Busqueda de usuarios -->
    <br>
    <form class="d-flex shadow p-3 mb-5 bg-white rounded" id="searchForm">
      <input id="search" class="form-control me-2" type="search" placeholder="Nombre de usuario" aria-label="Search">
      <button class="btn btn-outline-success" type="submit" >Buscar usuario</button>
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
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody id="tbody">
        <tr>
          <!-- Llenar datos de usuario y meter en loop -->
          <!-- select * from usuario, si se busca usar where -->
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
            <!-- Llenar input con el ID de usuario -->
              <button type="button" class="btn btn-primary"  >Editar</button>
              <button type="button" class="btn btn-primary"  >Borrar</button>
          </td>
        </tr>
      </tbody>
    </table>

  </div>

  <div class="container shadow p-3 mb-5 bg-white rounded text-center">
    <button type="button" class="btn btn-primary" onclick="editUser(0)" >Crear nuevo usuario</button>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/generic.js"></script>
  <script>
    initialize(()=>
    {
      search();
      getterID("searchForm").onsubmit = function() {
        return search();
      };
    });

    function deleteUser(id)
    {
      const params={idUsuario:id};
      if(confirm("¿Esta seguro de borrar el usuario?\nEsta accion no se puede deshacer"))
      {
        makePost("API/Admin/deleteUser.php",params,(data)=>
        {
          if(data.Estado=="ok")
          {
            search();
          }else{
            alert(data.Descripcion);
          }
        },
        err=>
        {
          console.error(err);
        })
      }
    }
    function editUser(id)
    {
      window.location.assign("Admin/usuario.php?idUsuario="+id)
    }
    function search()
    {
      const params={texto:getterID("search").value};
      makePost("API/Admin/listUsers.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          let salida="";
          data.Registros.forEach(val=>
          {
            salida+=`<tr>`+
                  `  <td>${val.username}</td>`+
                  `  <td>${val.nombre}</td>`+
                  `  <td>${val.apPat}</td>`+
                  `  <td>${val.apMat}</td>`+
                  `  <td>${(val.tipo==0?"Alumno":(val.tipo==1?"Profesor":"Admin"))}</td>`+
                  `  <td>`+
                  `    <button type='button' class='btn btn-primary' onclick="editUser('${val.idUsuario}')" >Editar</button>`+
                  `    <button type='button' class='btn btn-primary' onclick="deleteUser('${val.idUsuario}')" >Borrar</button>`+
                  `  </td>`+
                  `</tr>`;
          })
          getterID("tbody").innerHTML=salida;
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
