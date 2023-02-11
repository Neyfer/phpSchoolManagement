<?php

    include_once "mysql.php";
    if(isset($_REQUEST['teacher_info'])){
        $id = $_REQUEST['teacher_info'];
        $info = mysqli_query($conn, "SELECT * FROM `teachers` WHERE id = $id");
        while($rows = mysqli_fetch_assoc($info)){
            echo json_encode($rows);
        }
    }

    if(isset($_REQUEST["add"])){

        $name = $_POST['name'];
        $teacher = $_POST['teacher'];
        $hours = $_POST['horas'];
        $grade = $_POST['grade'];
        
        $query = mysqli_query($conn, "INSERT INTO asignaturas(`subject`,`teacher`, `hours`, `grade`) VALUES ('$name', '$teacher', '$hours', '$grade')");
        $info = mysqli_query($conn, "SELECT * FROM `asignaturas` WHERE grade = $grade");
        $i = 0;
        while($rows = mysqli_fetch_assoc($info)){
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
    }

    //GET THE LIST OF SUBJECTS
    if(isset($_REQUEST['subjects'])){
        $grade = $_REQUEST['subjects'];

        $data = null;
        $query = mysqli_query($conn, "SELECT * FROM asignaturas where grade = '$grade'");
        while($rows = mysqli_fetch_assoc($query)){
            $data[] = $rows;
        }
        echo json_encode($data);
    }

    //GET THE LIST OF STUDENTS
    if(isset($_REQUEST['students_table'])){
        $grade = $_POST['grade'];
        $subject = $_POST['subject'];
        $semester = $_POST['semester'];
        echo $subject;
        $i = 0;

        $query = mysqli_query($conn, "SELECT * FROM students where grade = '$grade'");

        //SI SE SELECCIONO LA MODALIDAD DE CICLO LUEGO DEL ELSE SI SE SELECCIONO LA MODALIDAD DE BTP

        if(intval($grade) < 10){
            while($rows = mysqli_fetch_assoc($query)){

                $student_id = $rows['id'];
                $nota_pp = null;
                $id_nota_pp = null;

                $nota_sp = null;
                $id_nota_sp = null;

                $nota_tp = null;
                $id_nota_tp = null;

                $nota_cp = null;
                $id_nota_cp = null;

                $p_p = mysqli_query($conn, "SELECT * FROM primer_parcial WHERE `student_id` = '$student_id' AND `subject` = '$subject'");
                        while($res = mysqli_fetch_assoc($p_p)){
                            $nota_pp = $res['nota'];
                            $id_nota_pp = $res['id'];
                        }

                $s_p = mysqli_query($conn, "SELECT * FROM segundo_parcial WHERE `student_id` = '$student_id' AND `subject` = '$subject'");
                        while($res2 = mysqli_fetch_assoc($s_p)){
                            $nota_sp = $res2['nota'];
                            $id_nota_sp = $res2['id'];
                            echo $nota_sp;
                        }

                $t_p = mysqli_query($conn, "SELECT * FROM tercer_parcial WHERE `student_id` = '$student_id' AND `subject` = '$subject'");
                while($res3 = mysqli_fetch_assoc($t_p)){
                    $nota_tp = $res3['nota'];
                    $id_nota_tp = $res3['id'];
                }

                $c_p = mysqli_query($conn, "SELECT * FROM cuarto_parcial WHERE `student_id` = '$student_id' AND `subject` = '$subject'");
                while($res4 = mysqli_fetch_assoc($c_p)){
                    $nota_cp = $res4['nota'];
                    $id_nota_cp = $res4['id'];
                }

                $i++;
                echo "
                <tr class='container'>
                          <td class='col-sm-1'>$i</td>
                          <input type='hidden' class='student_id' value='$rows[id]'>
                          <td class='col-sm-6 student_name' >$rows[name]</td>
                          <td class='col-sm-1 nota-div primer' id='$id_nota_pp'><input type='number' class='form-control p_parcial notaaa' style='padding: 0.375rem 0.65rem;' name='' value='$nota_pp' tabindex='1'></td>
                          <td class='col-sm-1 nota-div segundo' id='$id_nota_sp'><input type='number' class='form-control s_parcial notaaa' style='padding: 0.375rem 0.65rem;' name='' value='$nota_sp' tabindex='2'></td>
                          <td class='col-sm-1 nota-div tercero' id='$id_nota_tp'><input type='number' class='form-control t_parcial notaaa' style='padding: 0.375rem 0.65rem;' name='' value='$nota_tp' tabindex='3'></td>
                          <td class='col-sm-1 nota-div cuarto' id='$id_nota_cp'><input type='number' class='form-control c_parcial notaaa' style='padding: 0.375rem 0.65rem;' name='' value='$nota_cp' tabindex='4'></td>
                          
                          </tr>";
            }
        }else{
            while($rows = mysqli_fetch_assoc($query)){

                $student_id = $rows['id'];

                //DATOS QUE SE ENCIARAN SI SE SELECCIONA EL PRIMER SEMESTRE LUEGO DEL ELSE STATEMENT SE ENVIARAN DICHOS DATOS EN CASO DE QUE SE SELECCIONE EL SEGUNDO SEMESTRE

                if($semester == "1"){
                    $nota_pp = null;
                    $id_nota_pp = null;
    
                    $nota_sp = null;
                    $id_nota_sp = null;
    
                    $p_p = mysqli_query($conn, "SELECT * FROM primer_parcial WHERE `student_id` = '$student_id' AND `subject` = '$subject'");
                            while($res = mysqli_fetch_assoc($p_p)){
                                $nota_pp = $res['nota'];
                                $id_nota_pp = $res['id'];
                            }
    
                    $s_p = mysqli_query($conn, "SELECT * FROM segundo_parcial WHERE `student_id` = '$student_id' AND `subject` = '$subject'");
                            while($res2 = mysqli_fetch_assoc($s_p)){
                                $nota_sp = $res2['nota'];
                                $id_nota_sp = $res2['id'];
                                echo $nota_sp;
                            }
    
                    $i++;
                    echo "<tr class='container'>
                              <td class='col-sm-1'>$i</td>
                              <input type='hidden' class='student_id' value='$rows[id]'>
                              <td class='col-sm-6 student_name' >$rows[name]</td>
                              <td class='col-sm-1 nota-div primer' id='$id_nota_pp'><input type='number' class='form-control p_parcial notaaa' style='padding: 0.375rem 0.65rem;' name='' value='$nota_pp' tabindex='1' id=''></td>
                              <td class='col-sm-1 nota-div segundo' id='$id_nota_sp'><input type='number' class='form-control s_parcial notaaa' style='padding: 0.375rem 0.65rem;' name='' value='$nota_sp' tabindex='2' id=''></td>
                              <td class='col-sm-1'></td>
                            </tr>";
                } else if($semester == '2'){
                    $nota_pp = null;
                    $id_nota_pp = null;
    
                    $nota_sp = null;
                    $id_nota_sp = null;
    
                    $p_p = mysqli_query($conn, "SELECT * FROM tercer_parcial WHERE `student_id` = '$student_id' AND `subject` = '$subject'");
                            while($res = mysqli_fetch_assoc($p_p)){
                                $nota_pp = $res['nota'];
                                $id_nota_pp = $res['id'];
                            }
    
                    $s_p = mysqli_query($conn, "SELECT * FROM cuarto_parcial WHERE `student_id` = '$student_id' AND `subject` = '$subject'");
                            while($res2 = mysqli_fetch_assoc($s_p)){
                                $nota_sp = $res2['nota'];
                                $id_nota_sp = $res2['id'];
                                echo $nota_sp;
                            }
    
                    $i++;
                    echo "<tr class='container'>
                              <td class='col-sm-1'>$i</td>
                              <input type='hidden' class='student_id' value='$rows[id]'>
                              <td class='col-sm-6 student_name' >$rows[name]</td>
                              <td class='col-sm-1 nota-div tercero' id='$id_nota_pp'><input type='number' class='form-control t_parcial notaaa' style='padding: 0.375rem 0.65rem;' name='' value='$nota_pp' tabindex='1' id=''></td>
                              <td class='col-sm-1 nota-div cuarto' id='$id_nota_sp'><input type='number' class='form-control c_parcial notaaa' style='padding: 0.375rem 0.65rem;' name='' value='$nota_sp' tabindex='2' id=''></td>
                              <td class='col-sm-1'></td>
                            </tr>";
                }
            }
        }   
    
    }


    //SUBIR LAS NOTAS PRIMER PARCIAL

    if(isset($_REQUEST['notas'])){
        $nota = $_POST['nota'];
        $name = $_POST['name'];
        $id = $_POST['sudent_id'];
        $grade = $_POST['grade'];
        $subject = $_POST['subject'];

        mysqli_query($conn, "INSERT INTO primer_parcial(`name`, `student_id`, `nota`, `grade`, `subject`) VALUES('$name', '$id', $nota, '$grade', '$subject')");
    }

    //SUBIR LAS NOTATS SEGUNDO PARCIAL

    if(isset($_REQUEST['notas2'])){
        $nota = $_POST['nota'];
        $name = $_POST['name'];
        $id = $_POST['sudent_id'];
        $grade = $_POST['grade'];
        $subject = $_POST['subject'];

        mysqli_query($conn, "INSERT INTO segundo_parcial(`name`, `student_id`, `nota`, `grade`, `subject`) VALUES('$name', '$id', $nota, '$grade', '$subject')");
    }

    //SUBIR LAS NOTATS tercer PARCIAL

    if(isset($_REQUEST['notas3'])){
        $nota = $_POST['nota'];
        $name = $_POST['name'];
        $id = $_POST['sudent_id'];
        $grade = $_POST['grade'];
        $subject = $_POST['subject'];

        mysqli_query($conn, "INSERT INTO tercer_parcial(`name`, `student_id`, `nota`, `grade`, `subject`) VALUES('$name', '$id', $nota, '$grade', '$subject')");
    }

    //SUBIR LAS NOTATS SEGUNDO PARCIAL

    if(isset($_REQUEST['notas4'])){
        $nota = $_POST['nota'];
        $name = $_POST['name'];
        $id = $_POST['sudent_id'];
        $grade = $_POST['grade'];
        $subject = $_POST['subject'];

        mysqli_query($conn, "INSERT INTO cuarto_parcial(`name`, `student_id`, `nota`, `grade`, `subject`) VALUES('$name', '$id', $nota, '$grade', '$subject')");
    }


    //EDITAR LAS NOTAS QUE YA HAN SIDO REGISTRADAS EN LA BASE DE DATOS, HACIENDO USO DEL ID DE REGISTRO USADO ANTERIORMENTE!!

    if(isset($_REQUEST['edit_grades'])){
        $id = $_POST['id'];
        $nota = $_POST['nota'];
        $tabla = $_POST['tabla'];

        $query = mysqli_query($conn, "UPDATE `$tabla` SET `nota` = $nota WHERE id = $id");
    }

    //ELIMINAR RECORD PARA DEJAR KA CASILLA DE LA NOTA EN BLANCO

    if(isset($_REQUEST['delete_record_grade'])){
        $id = $_POST['id'];
        $tabla = $_POST['tabla'];

        mysqli_query($conn, "DELETE FROM `$tabla` WHERE id = $id");
    }



    // ALGORITMOS DE BUSQUEDA


//BUSUCAR MAESTROS
    if(isset($_REQUEST['search_teachers'])){
        $teacher = $_POST['name'];

        $query = mysqli_query($conn, "SELECT * FROM teachers WHERE `name` LIKE '%$teacher%'");
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

    }


//BUSCAR PADRES

        if(isset($_REQUEST['search_parents'])){
            $parent = $_POST['name'];

            $query = mysqli_query($conn, "SELECT * FROM parents WHERE `name` LIKE '%$parent%'");
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
            
        }

//BUSCAR ALUMNOS PARA GENERAR CALIFICACIONES

        if(isset($_REQUEST['search_alumns_grades'])){
            $student = $_POST['name'];
            $grado = $_POST['grade'];

            if($student != ""){

            $query = mysqli_query($conn, "SELECT * FROM students WHERE `name` LIKE '$student%' AND `grade` = '$grado'");
            $i = 0;

            while($rows = mysqli_fetch_assoc($query)){
                $i++;
                echo "<span class='names_r' id='$rows[id]'>$rows[name]</span>";
            }
        }
            
        }


//BUSCAR ALUMNOS

        if(isset($_REQUEST['search_students'])){
            $student = $_POST['name'];
            $grade = $_POST['grade'];
            $age = $_POST['age'];
            $and = false;

            $q1 = "SELECT * FROM students WHERE";

            //SI TODOS LOS VALORES ESTAN VACIOS SE REINICIARA LA PAGINA

            if($student == "" && $grade == "0" && $age == ""){

                $q1 = "SELECT * FROM students";

            }else{
                if($student != ""){
                    $query_name = "";
                    if($and == true){
                        $query_name = " AND `name` LIKE '%$student%'";
                    }else{
                        $query_name = " `name` LIKE '%$student%'";
                        $and = true;
                    }
                    $q1 .= $query_name;
    
                }
    
                if($grade != "0"){
                    $query_grade = "";
                    if($and == true){
                        $query_grade = " AND `grade` = $grade";
                    }else{
                        $query_grade = " `grade` = $grade";
                        $and = true;
                    }
                    $q1 .= $query_grade;
    
                }
    
                if($age != ""){
                    $query_age = "";
                    if($and == true){
                        $query_age = " AND `age` = $age";
                    }else{
                        $query_age = " `age` = $age";
                        $and = true;
                    }
                    $q1 .= $query_age;
    
                }
            }

            


            $query = mysqli_query($conn, $q1);

            $i = 0;

            if(mysqli_num_rows($query) > 0){
            while($rows = mysqli_fetch_assoc($query)){
                $i++;
                echo "<tr>
                      <td>$i</td>
                      <td>$rows[name]</td>
                      <td>$rows[tel_a]</td>
                      <td>$rows[grade]</td>
                      <td>$rows[age]</td>
                      
                      <td style='white-space:nowrap;'>
                          <a href='student_details.php?id=$rows[id]' target='blank'><button class='btn btn-sm delete btn-primary text-light' id='$rows[id]' data-bs-toggle='modal' i data-bs-target='#delete_teacher'><img src='../icons/eye.svg' width='16'height='16'></button></a>
                          <button class='btn btn-sm edit btn-success text-light' id='$rows[id]' data-bs-toggle='modal' i data-bs-target='#add_teacher_container'><img src='../icons/edit.svg' width='16'height='16'></button>
                          <button class='btn btn-sm delete btn-danger text-light' id='$rows[id]'><img src='../icons/trash-2.svg' width='16'height='16'></button>
                      </td>
                    </tr>";
            }
        }


            
        }
    



    