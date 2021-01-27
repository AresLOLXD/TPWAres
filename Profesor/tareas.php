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

  <!-- Busqueda de tareas -->
  <div class="container-md">
    <br>
    <form class="d-flex shadow p-3 mb-5 bg-white rounded" id="searchForm">
      <input class="form-control me-2" type="search" placeholder="Nombre de la tarea" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Buscar tarea</button>
    </form>
  </div>

  <!-- Listado de tareas -->
  <div class="row row-cols-1 row-cols-md-3 g-4 shadow-none p-3 mb-5 bg-light rounded">
    <!-- Meter este div en loop -->
    <div class="col">
      <div class="card">
        <img src="img/libros.png" class="card-img-top" alt="libros">
        <div class="card-body">
          <!-- ID de la tarea -->
          <h5 class="card-text">ID: </h5>
          <!-- Titulo de la tarea -->
          <h4 class="card-title"> Titulo: </h4>
          <!-- Texto de la tarea -->
          <p class="card-text"> Descripción: </p>
          <!-- Fecha de entrega de la tarea -->
          <p class="card-text">Fecha de entrega: </p>

          <input class="btn btn-primary" type="submit" value="Editar">

          <input class="btn btn-secondary" type="submit" value="Ver entregas">

        </div>
      </div>
    </div>
    <!-- Aquí termina el div que se mete en el loop -->
  </div>
  <script src="js/generic.js"></script>
  <script src="js/jquery.min.js"></script>
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
