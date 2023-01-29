<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calificaciones</title>
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
                            <form action="" method="post">
                                <label for="grade" class="form-label">Grado:</label><select name="grade" id="grado" class="form-select">
                                    <option value="0"></option>
                                    <option value="7">Septimo</option>
                                    <option value="8">Octavo</option>
                                    <option value="9">Noveno</option>
                                    <option value="10">Decimo</option>
                                    <option value="11">Undecimo</option>
                                    <option value="12">Duodecimo</option>
                                </select>

                                <label for="grade" class="form-label">ALumno:</label><select name="grade" id="grado" class="form-select">
                                    <option value="0"></option>
                                    <option value="7">Todo el grado</option>
                                    <option value="8">Alumno en especifico</option>
                                </select>

                            </form>
                    </div>


<script src="../js/main.js"></script>

</body>
</html>