<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maestros</title>
    <script src="../js/jquery.js"></script>
    <link href="../bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/bootstrap.bundle.js"></script>
    <link href="../css/main.css" rel="stylesheet">
    <meta http-equiv=”refresh” content="60" />
</head>
<body>
 
    <div class="container-fluid">
        <div class="row no-glutters " style="height: 6vh;">
            <div class="no-glutters col-sm-12" style="padding: 0; position:fixed; z-index:300">
                <?php
                    include_once("components/header.php");
                ?>
            </div>
        </div>

        <div class="row">
            <div class='col-sm-2' id=''>
            <?php
                    include_once("components/aside.php");
                ?>
            </div>
            <div class=" col-sm-10 container padding-3"> <br>
<br>
              <div class="d-flex" role="search" style="width: 30%; position: relative; left: 65%;">
                <input class="form-control me-2" type="text" id='search-bar' placeholder="Buscar" aria-label="Search">
              </div>
              
            <button type="button" class="btn btn-success btn-sm text-light text-center" data-bs-toggle="modal" data-bs-target="#add_teacher_container">Agregar</button> 
            <br><br>
          <div class="t-c" style="max-width: 100vw; overflow-x: auto;">
          <table class="table table-bordered">
                <thead class="bg-dark text-light text-center">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Maestro</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Area</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="text-center" id='teachers_body_table'>
              <?php
              include('mysql.php');
                  $query = mysqli_query($conn, "SELECT * FROM teachers");
                  $num = mysqli_num_rows($query);
                  $i = 0;
                  while($rows = mysqli_fetch_assoc($query)){
                    $i++;
                    echo "<tr>
                      <td>$i</td>
                      <td>$rows[name]</td>
                      <td>$rows[tel]</td>
                      <td>$rows[email]</td>
                      <td>$rows[area]</td>
                      <td style='white-space:nowrap;'>
                          <button class='btn btn-sm edit btn-success text-light' id='$rows[id]' data-bs-toggle='modal' i data-bs-target='#edit_teacher_container'><img src='../icons/edit.svg' width='16'height='16'></button>
                          <button class='btn btn-sm delete btn-danger text-light' id='$rows[id]' data-bs-toggle='modal' i data-bs-target='#delete_teacher'><img src='../icons/trash-2.svg' width='16'height='16'></button>
                      </td>
                    </tr>";
                  }
              ?>
            </tbody>
                </table> 
          </div>

          <footer style="text-align:center;">Copyright &copy 2023 by Neyfer Coto - All Rights Reserved</footer>

          <!--REGISTRAR NUEVO MAESTRO EN LA BASE DE DATOS-->
          <div class="modal  fade" id="add_teacher_container" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5">Ingresar Nuevo Maestro</h1>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="teachers.php" id="" method="post">
                      <div class="mb-3">
                        <label for="name" class="col-form-label">Nombre</label>
                        <input required type="text" class="form-control" name="name" id="recipient-name">
                      </div>
                      <div class="mb-3">
                        <label for="tel" class="col-form-label">Telefono:</label>
                        <input type="text" class="form-control" name="tel" id="">
                      </div>

                      <div class="mb4">
                        <label for="mail" class="col-form-label">E-mail</label>
                        <input type="text" name="mail" class="form-control">
                      </div>

                      <div class="mb5">
                        <label for="area" class="col-form-label">Area</label>
                        <input type="text"  name="area" class="form-control">
                      </div>

                      </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-teacher"  class="btn btn-success">Agregar</button>
                  </div>
                </div>
                    </form>
                  
              </div>
              </div>
                    </div>
                    </div>
                </div>
            
                  <!-- EDITAR RECORDS DE MAESTR0S-->
              <div class="modal  fade" id="edit_teacher_container" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5">Editar Maestro</h1>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="teachers.php" id="form" method="post">
                      <div class="mb-3">
                        <label for="name" class="col-form-label">Nombre</label>
                        <input type="text" id='name' class="form-control" name="name">
                      </div>
                      <div class="mb-3">
                        <label for="tel" class="col-form-label">Telefono:</label>
                        <input type="text" id='tel' class="form-control" name="tel">
                      </div>

                      <div class="mb4">
                        <label for="mail" class="col-form-label">E-mail</label>
                        <input type="text" id='mail' name="mail" class="form-control">
                      </div>

                      <div class="mb5">
                        <label for="area" class="col-form-label">Area</label>
                        <input type="text" id='area' name="area" class="form-control">
                        <input type="hidden" id="id" name="id">
                      </div>

                      </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit-teacher" id="submit" class="btn btn-success">Editar</button>
                  </div>
                </div>
                    </form>
                  
              </div>
              </div>
                    </div>
                    </div>
                </div>


                <!-- DELETE TEACHER CONFIRMATION FORM-->
        <div class="modal" id='delete_teacher' tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <h5 class="text-danger">¿Seguro que quiere eliminar este maestro?</h5>
              </div>
              <div class="modal-footer">
                <form action="teachers.php" method="post">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <input type="hidden" id='delete_id' name="delete_id">
                    <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                </form>
              </div>
              
            </div>
                  
          </div>

          
        </div>



<script src="../js/main.js"></script>
<script src="../js/busquedas.js"></script>

<?php
    include("mysql.php");

    if(isset($_POST["add-teacher"])){
    $name = $_POST["name"];
    $tel = $_POST["tel"];
    $mail = $_POST["mail"];
    $area = $_POST["area"];

    mysqli_query($conn, "INSERT INTO teachers(`name`, `tel`, `email`, `area`) VALUES ('$name', '$tel', '$mail', '$area')");
    echo "<meta http-equiv='refresh' content='0'>";
    }

    if(isset($_POST['edit-teacher'])){
        $id = $_POST['id']; 
        $name = $_POST["name"];
        $tel = $_POST["tel"];
        $mail = $_POST["mail"];
        $area = $_POST["area"];

        mysqli_query($conn, "UPDATE teachers SET `name`='$name', tel = '$tel', email = '$mail', area = '$area' WHERE id = $id");
        echo "<meta http-equiv='refresh' content='0'>";
    
  }

  if(isset($_POST['delete'])){
    $id = $_POST['delete_id'];

    mysqli_query($conn, "DELETE FROM teachers WHERE id = $id");
    echo "<meta http-equiv='refresh' content='0'>";
  }

?>
</body>
</html>