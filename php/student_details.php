<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
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
           

            <?php
              include('mysql.php');
              $id = $_REQUEST['id'];
                  $query = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
                  $num = mysqli_num_rows($query);
                  $i = 0;
                  while($rows = mysqli_fetch_assoc($query)){
                        echo "
                            <h5 class='text-center'>Informacion del alumno</h5>

                            <h6>Nombre: $rows[name]</h6><br>
                            <h6>Grado: $rows[grade]</h6><br>
                            <h6>Telefono del alumno: $rows[tel_a]</h6><br>
                            <h6>Padre/encardado: $rows[encargado]</h6><br>
                            <h6>Telefono del padre: $rows[tel_p]</h6><br>
                            <h6>Direccion: $rows[address]</h6><br>
                            <h6>Identidad: $rows[ident]</h6><br>
                            <h6>Fecha de nacimiento: $rows[birth]</h6><br>
                            <h6>Edad: $rows[age]</h6><br>
                        ";
                  }
                  ?>

<footer style="text-align:center;">Copyright &copy 2023 by Neyfer Coto - All Rights Reserved</footer>
            </div>

<script src="../js/main.js"></script>

<?php
    include("mysql.php");
?>