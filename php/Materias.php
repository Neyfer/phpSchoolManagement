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
                    <div class="row">
                        <div class="col-sm-3">
                            <select name="" id="grade-s" class="form-select">
                                <option value="7">Septimo</option>
                                <option value="8">Octavo</option>
                                <option value="9">Noveno</option>
                                <option value="10">Decimo I Semestre</option>
                                <option value="10.5">Decimo II Semestre</option>
                                <option value="11">Undecimo I Semestre</option>
                                <option value="11.5">Undecimo II Semestre</option>
                                <option value="12">Duodecimo I Semestre</option>
                                <option value="12.5">Duodecimo II Semestre</option>o
                            </select>
                                <script>
                                    let grade = "<?php echo $_REQUEST['id']?>";
                                    document.getElementById("grade-s").value = grade;
                                </script>
                        </div>

                        <div class="col-sm-7"></div>

                        <div class="col-sm-2">
                            <button class="btn btn-sm btn-success" data-bs-toggle='modal' i data-bs-target='#add_subject_container'>Agregar</button>
                        </div>
                    </div>
<br>
               <div class="t-c" style="max-width: 100vw; overflow-x: auto;">
          <table class="table table-bordered">
                <thead class="bg-dark text-light text-center">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Maestro</th>
                    <th scope="col">Horas semanales</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="materias-t text-center">
              <?php
              include('mysql.php');
                  if(isset($_REQUEST['id'])){
                    $grade =  $_REQUEST['id'];
                  }else{
                    $grade = 7;
                  }
                  $query = mysqli_query($conn, "SELECT * FROM asignaturas WHERE grade = $grade");
                  $num = mysqli_num_rows($query);
                  $i = 0;
                  while($rows = mysqli_fetch_assoc($query)){
                    $i++;
                    echo "<tr>
                      <td>$i</td>
                      <td>$rows[subject]</td>
                      <td>$rows[teacher]</td>
                      <td>$rows[hours]</td>
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
               </div>


                   <!--REGISTRAR NUEVA ASIGNATURA EN LA BASE DE DATOS-->
          <div class="modal  fade" id="add_subject_container" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5">Agregar Nueva Asignatura</h1>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form id="add-sub-form" method="post">
                      <div class="mb-3">
                        <label for="name" class="col-form-label">Nombre</label>
                        <input required type="text" class="form-control" name="name" id="name">
                      </div>

                      <div class="mb4">
                        <label for="mail" class="col-form-label">Maestro</label>
                        <input required type="text" name="teacher" id ="teacher" class="form-control">
                      </div>

                      <div class="mb5">
                        <label for="area" class="col-form-label">Horas/semana (opcional)</label>
                        <input type="text"  name="horas" id="horas" class="form-control">
                      </div>

                      <input type="hidden" id='grade' name="grade">

                      <script>
                        document.getElementById('grade').value = document.getElementById('grade-s').value;
                      </script>
                      </div>
                  <div class="modal-footer" class="row">

                  <div class="form-check col-sm-5">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                      Cerrar formulario al agregar
                    </label>
                  </div>

                  <div class="col-sm-1"></div>

                    <button type="button" class="btn btn-secondary col-sm-2" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add-subject" id="add-subject" data-bs-dismiss="modal" class="btn btn-success col-sm-2">Agregar</button>
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

    if(isset($_REQUEST['grade'])){
        if(isset($_REQUEST['id'])){
            echo $_REQUEST['id'];
        }
        
    }

?>
</body>
</html>