<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padres</title>
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
                    <th scope="col">Nombre</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="text-center parents_body_table">
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
                          <button class='btn btn-sm edit btn-success text-light' id='$rows[id]' data-bs-toggle='modal' i data-bs-target='#add_teacher_container'><img src='../icons/edit.svg' width='16'height='16'></button>
                          <button class='btn btn-sm delete btn-danger text-light' id='$rows[id]'><img src='../icons/trash-2.svg' width='16'height='16'></button>
                      </td>
                    </tr>";
                  }
              ?>
            </tbody>
                </table> 
          </div>
            

              <div class="modal  fade" id="add_teacher_container" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5">Ingresar Nuevo Maestro</h1>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="teachers.php" method="post">
                      <div class="mb-3">
                        <label for="name" class="col-form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" id="recipient-name">
                      </div>
                      <div class="mb-3">
                        <label for="tel" class="col-form-label">Telefono:</label>
                        <input type="text" class="form-control" name="tel" id="">
                      </div>

                      <div class="mb4">
                        <label for="mail" class="col-form-label">Direccion</label>
                        <input type="text" name="mail" class="form-control">
                      </div>

                      <div class="mb5">
                        <label for="area" class="col-form-label">Area</label>
                        <input type="text" name="area" class="form-control">
                      </div>

                      </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-teacher" class="btn btn-success">Agregar</button>
                  </div>
                </div>
                    </form>
                  
              </div>
              </div>
                    </div>
                    </div>

                    <footer style="text-align:center;">Copyright &copy 2023 by Neyfer Coto - All Rights Reserved</footer>
                </div>



<script src="../js/main.js"></script>
<script src="../js/parents.js"></script>

<?php
    include("mysql.php");

    if(isset($_POST["add-teacher"])){
    $name = $_POST["name"];
    $tel = $_POST["tel"];
    $mail = $_POST["mail"];
    $area = $_POST["area"];

    mysqli_query($conn, "INSERT INTO teachers(`name`, `tel`, `email`, `area`) VALUES ('$name', '$tel', '$mail', '$area')");
    echo "<meta http-equiv='refresh' content='0'>";;
    }


?>
</body>
</html>