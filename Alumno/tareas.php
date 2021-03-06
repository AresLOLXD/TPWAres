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
  <!--   necesario el id del alumno    -->
  <!-- ******************************* -->

  <div class="container-md text-center">
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
      <tbody id="tbody1">
        <tr>
          <!-- Llenar datos de actividad y meter en loop -->
          <!-- select * from actividad where             -->
          <td></td>
          <td></td>
          <!-- Llenar input con el ID de la tarea -->
          <td>
              <button type="button" class="btn btn-primary" >Ver tarea</button>
          </td>
        </tr>

      </tbody>
    </table>
  </div>


  <div class="container-md text-center">
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
      <tbody id="tbody2">
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
  <script src="js/generic.js"></script>
  <script src="js/jquery.min.js"></script>
  <script>

    initialize(()=>
    {
      loadDelivered();
      loadNotDelivered();

    });

    function seeAssignment(id)
    {
      window.location.assign("Alumno/tarea.php?idActividad="+id)
    }

    function loadDelivered()
    {
      const params={};
      makePost("API/Alumno/listDeliveredAssignments.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          let salida="";
          data.Registros.forEach(val=>
          {
            salida+=`<tr>`+
                    `  <td>${val.fechaEntrega}</td>`+
                    `  <td>${val.nombre}</td>`+
                    `  <td>${val.calificacion?val.calificacion:"Sin calificar"}</td>`+
                    `</tr>`;
          })
          getterID("tbody2").innerHTML=salida;
        }else{
          alert(data.Descripcion);
        }
      },
      err=>
      {
        console.error(err);
      })
    }
    function loadNotDelivered()
    {
      const params={};
      makePost("API/Alumno/listNotDeliveredAssignments.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          let salida="";
          data.Registros.forEach(val=>
          {
            salida+=`<tr>`+
                    `  <td>${val.titulo}</td>`+
                    `  <td>${val.fechaEntrega}</td>`+
                    `  <td>`+
                    `      <button type="button" class="btn btn-primary" onclick="seeAssignment('${val.idActividad}')" >Ver tarea</button>`+
                    `  </td>`+
                    `</tr>`;
          })
          getterID("tbody1").innerHTML=salida;
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
