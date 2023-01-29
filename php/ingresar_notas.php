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
                <div class="container" style='width:90%;' id="add_teacher_container" tabindex="-1" aria-hidden="true">
                    <form action="" id="add_grades" method="post">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="grade" class="form-label">Grado:</label><select name="grade" id="grado" class="form-select">
                                <option value="0"></option>
                                <option value="7">Septimo</option>
                                <option value="8">Octavo</option>
                                <option value="9">Noveno</option>
                                <option value="10">Decimo</option>
                                <option value="11">Undecimo</option>
                                <option value="12">Duodecimo</option>
                                </select>
                            </div>
                            
                            <div class="col-sm-2" style="display: none;" id="semester-selector">
                                <label for="parcial" class="form-label">Semestre:</label><select class="form-select" name="1" id="parcial">
                                <option value=""></option>
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label for="parcial" class="form-label">Asignatura:</label><select class="form-select" aria-label="Disabled" disabled name="1" id="subject">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-sm-2"></div>

                            <div class="col-sm-2" style="width: min-content;">
                                
                                <input type="submit"  class="btn btn-success" id="ingresar_notas" value="Guardar">
                            </div>
                            
                            </div>
                    </form><br>

                    <div class="t-c">
                        
                    </div>
                </div>
                <footer style="text-align:center;">Copyright &copy 2023 by Neyfer Coto - All Rights Reserved</footer>
            </div>

            



<script src="../js/main.js"></script>

<?php
    include("mysql.php");
?>
</body>
</html>