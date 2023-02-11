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
            

              <div class="container" style='width:80%;' id="add_teacher_container" tabindex="-1" aria-hidden="true">

              <h1>Matrícula</h1><br><br>
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    <form action="matricula.php" method="post">
                      <div class="row">
                        <div class="mb-3 col-sm-6">
                            <label for="name" class="col-form-label">Nombre Completo</label>
                            <input type="text" class="form-control text-m" name="name-a" id="recipient-name">
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label for="tel" class="col-form-label">Telefono del alumno</label>
                            <input type="text" class="form-control text-m" name="tel-a" id="">
                        </div>

                        <div class="mb-3 col-sm-2">
                            <label for="tel" class="col-form-label">Grado</label>
                            <input type="text" class="form-control text-m" name="grade" id="">
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="mb4 col-sm-5">
                            <label for="mail" class="col-form-label">Identidad</label>
                            <input type="text" name="ident" class="form-control text-m">
                        </div>

                        <div class="mb4 col-sm-5">
                            <label for="mail" class="col-form-label">Fecha de Nacimiento</label>
                            <input type="text" name="birth" class="form-control text-m">
                        </div>

                        <div class="mb4 col-sm-2">
                            <label for="mail" class="col-form-label">Edad</label>
                            <input type="text" name="age" class="form-control text-m">
                        </div>
                      </div>
                      

                      <div class="mb4">
                        <label for="mail" class="col-form-label">Direccion</label>
                        <input type="text" name="address" class="form-control text-m">
                      </div>

                      <div class="row">
                        <div class="mb5 col-sm-4">
                            <label for="area" class="col-form-label">Padre/Madre/Encargado</label>
                            <input type="text" name="encargado" class="form-control text-m">
                        </div>

                        <div class="mb5 col-sm-4">
                            <label for="area" class="col-form-label">Telefono del Padre</label>
                            <input type="text" name="tel-p" class="form-control text-m">
                        </div>

                        
                      

                      </div>

                      <br><br>
                  <div class="modal-footer">
                    <button type="submit" name="matricular" class="btn btn-success">Matricular</button>
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

<?php
    include("mysql.php");

    if(isset($_POST['matricular'])){
        $name_a = $_POST['name-a'];
        $tel_a = $_POST['tel-a'];
        $grade = $_POST['grade'];
        $ident = $_POST['ident'];
        $birth = $_POST['birth'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $encargado = $_POST['encargado'];
        $tel_p = $_POST['tel-p'];

        mysqli_query($conn, "INSERT INTO students (`name`, `tel_a`, `grade`, `ident`, `birth`, `age`, `address`, `encargado`, `tel_p`)
                               VALUES('$name_a', '$tel_a', '$grade', '$ident', '$birth', '$age', '$address', '$encargado', '$tel_p')");

        mysqli_query($conn, "INSERT INTO parents (`student_name`, `name`, `tel`, `address`) VALUES ('$name_a', '$encargado', '$tel_p', '$address')");
    }
?>
</body>
</html>