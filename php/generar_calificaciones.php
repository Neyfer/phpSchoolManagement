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
                            <form action="" method="post" class="grades_form">
                                <h5>Generar boleta de calificaciones</h5>
                                <label for="grade" class="form-label" >Grado:</label><select name="grade" id="grado" class="form-select">
                                    <option value="0"></option>
                                    <option value="7">Septimo</option>
                                    <option value="8">Octavo</option>
                                    <option value="9">Noveno</option>
                                    <option value="10">Decimo</option>
                                    <option value="11">Undecimo</option>
                                    <option value="12">Duodecimo</option>
                                </select>

                                <div id="semester">
                                    <label for="semester" class="form-label">Semestre:</label><select name="semester" id="semester" class="form-select semester_select">
                                        <option value="0"></option>
                                        <option value="1">I Semestre</option>
                                        <option value="2">II Semestre</option>
                                    </select>
                                </div>
                                

                                <label for="grade" class="form-label">Alumno:</label><select name="type" id="type" class="form-select">
                                    <option value="0"></option>
                                    <option value="1">Todo el grado</option>
                                    <option value="2">Alumno en especifico</option>
                                </select>

                                <div id="name">
                                    <label for="name" class="form-label">Nombre:</label>
                                    <input type="text" name="name" id="" autocomplete="off" class="form-control search_bar" placeholder="">
                                    <div class="form-control" id="recomendations"></div>
                                </div>

                                <button class="form-control btn  btn-dark" id="generate">Generar</button>

                            </form>
                    </div>

                    <style>
                        .grades_form{
                            width: 500px;
                            height: max-content;
                            padding: 33px;
                            background-color: #fafafa;
                            margin: auto;
                            margin-top: 6%;
                            border-radius: 3%;
                        }

                        h5{
                            text-align: center;
                        }

                        .form-select{
                            margin-bottom: 10px;
                        }

                        .btn{
                            margin-top: 20px;
                        }

                        #recomendations{
                            max-height: 85.6;
                            height: 85.6;
                            overflow-y: scroll; 
                        }

                        .names_r:hover{
                            cursor: pointer;
                            color:blue;
                        }

                        .names_r{
                            display: block;
                            width: 100%;
                        }

                        
                    </style>

<script src="../js/main.js"></script>
<script src="../js/busquedas.js"></script>

</body>
</html>