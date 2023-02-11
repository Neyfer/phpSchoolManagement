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

            <br><br>
          <div class="t-c" style="max-width: 100vw; overflow-x: auto;">
          <table class="table table-bordered">
                <thead class="bg-dark text-light text-center">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Alumno</th>
                </tr>
            </thead>

            <tbody class="text-center" id="parents_body_table">
              <?php
              include('mysql.php');
                  $query = mysqli_query($conn, "SELECT * FROM parents");
                  $num = mysqli_num_rows($query);
                  $i = 0;
                  while($rows = mysqli_fetch_assoc($query)){
                    $i++;
                    echo "<tr>
                      <td>$i</td>
                      <td>$rows[name]</td>
                      <td>$rows[tel]</td>
                      <td>$rows[address]</td>
                      <td>$rows[student_name]</td>
                    </tr>";
                  }
              ?>
            </tbody>
                </table> 
          </div>
            

                    <footer style="text-align:center;">Copyright &copy 2023 by Neyfer Coto - All Rights Reserved</footer>
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
    echo "<meta http-equiv='refresh' content='0'>";;
    }


?>
</body>
</html>