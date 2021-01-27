<?php require dirname(dirname(__FILE__)) . "/Util/verifyTeacher.php";?>
<!DOCTYPE html>

<html lang="es">

<head>
  <base href="/TPW/">
  <meta charset="UTF-8">
  <title>Profe | Lista de entragas por tarea</title>
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
  <!-- necesario el id de la actividad -->
  <!-- ******************************* -->

  <!-- Poner el título de la tarea -->
  <div class="container-md">
    <br>
    <h1 class="display-4">Lista de entregas de <span id='titulo'></span></h1>
  </div>

  <!-- Listado de entregas -->
  <div class="container shadow p-3 mb-5 bg-white rounded">
    <br>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">Usuario</th>
          <th scope="col">Fecha de entrega</th>
          <th scope="col">Archivo</th>
          <th scope="col">Calificacion</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody id="tbody">
        <tr>
          <!-- Llenar datos de entrega y meter en loop   -->
          <!-- select * from actividad where idActividad -->
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <!-- Llenar input con el ID de entrega -->
          <td>
              <button type="button" class="btn btn-primary" >Calificar/Cambiar calificación</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <script src="js/generic.js"></script>
  <script src="js/jquery.min.js"></script>
  <script>

    let idActividad=0;
    initialize(()=>
    {
      idActividad=findGetParameter("idActividad");
      load();
    });
    function seeDelivery(usuario)
    {
      window.location.assign("Profesor/entrega.php?idActividad="+idActividad+"&idUsuario="+usuario)
    }
    function load()
    {
      const params={idActividad};
      makePost("API/Profesor/listDeliveriesFromAssignment.php",params,(data)=>
      {
        if(data.Estado=="ok")
        {
          let salida="";
          data.Registros.forEach(val=>
          {
            salida+=`<tr>`+
                      `<td>${val.username}</td>`+
                      `<td>${val.fechaEntrega}</td>`+
                      `<td><a download href="API/Profesor/showFileUploaded.php?idArchivo=${val.idArchivo}">Descargar</a></td>`+
                      `<td>${val.calificacion?val.calificacion:"Sin calificar"}</td>`+
                      `<td>`+
                        `<button type="button" class="btn btn-primary" onclick="seeDelivery('${val.idUsuario}')">Calificar/Cambiar calificación</button>`+
                      `</td>`+
                    `</tr>`;
            getterID("titulo").innerHTML=val.titulo
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
