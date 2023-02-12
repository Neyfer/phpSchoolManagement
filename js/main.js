$(document).ready(function(){
    //Make the teachers option blue on the aside
    if(document.URL.includes("teachers.php")){
        $("#teachers-dash").addClass("active");
        let edit_btn = $(".edit");
        let delete_btn = $(".delete")

            //EEEDIIIITTTT
        /// FILL THE CURRENT TEACHER DATA INTO THE FORM 
        edit_btn.click(function(){
            let id = this.id;
            $.ajax(`../php/server.php?teacher_info=${id}`, {
                success: function(data){
                    let info = JSON.parse(data);

                    $("#name")[0].value = info.name;
                    $("#tel")[0].value = info.tel;
                    $("#mail")[0].value = info.email;
                    $("#area")[0].value = info.area;
                    $("#id")[0].value = info.id;

                    

                 }
            })
        })

            //SEND THE REQUEST TO DELETE A TEACHER

            delete_btn.click(function(){
                let id = this.id;
                fetch(`../php/server.php?teacher_info=${this.id}`)
                .then(response => response.json())
                .then(data=>{
                    $("#delete_id")[0].value = data.id;
                })
            })

    }
    else if(document.URL.includes("parents.php")){
        $("#parents-dash").addClass("active");
    }

    if(document.URL.includes("students.php")){
        $("#students-dash").addClass("active");
    }
    
    if(document.URL.includes("matricula.php")){
        $("#matricula-dash").addClass("active");
    }

    if(document.URL.includes("generar_calificaciones.php")){
        $("#calificaciones-dash").addClass("active");
    }

    if(document.URL.includes("ingresar_notas.php")){

        //ESTA FUNCION SE ENCARGA DE ACTUALIZAR LAS NOTAS EN LA TABLA HTML CON DATOS DE MYSQL

        function update_notas(){

            $.ajax({
                url: `../php/server.php?students_table`,
                type: "post",
                data: {'subject': $('#subject')[0].value, 'grade': grade[0].value, 'semester': $('#parcial')[0].value},
                success: function(data){

                    //LLENAR LA TABLA CON LOS DATOS DE LOS ALUMNOS
                    $("#body-students-table").html(`${data}`);


                //INHABILITAR EL CAMBIO NATURAL DE VALORES UNA VEZ LA NOTA SE ESCUENTRA EN LA BASE DE DATOS

                $(".notaaa").each(function(){
                    if(this.value != ""){
                        $(this).attr("disabled", "");
                    }
                })

                //Llamar la funcion editar para preparar todos los eventos necesarios para editar los datos
                editar();
                }
            })


        }

        //PERMITIR LA EDICION DE LA NOTA HAACIENDO USO DE UN PROMPT PARA AHORRAR RECURSOS
        function editar(){
            $(".nota-div").each(function(){
                $(this).dblclick(()=>{
                    let parcial_string;

                    //DEFINIR EL NOMBRE DE LA TABLA DONDE SE EDITARA EL DATO
                    if($(this).hasClass("primer")){
                        parcial_string = "primer_parcial";
                    }else if($(this).hasClass("segundo")){
                        parcial_string = "segundo_parcial";
                    }else if($(this).hasClass("tercero")){
                        parcial_string = "tercer_parcial";
                    }else if($(this).hasClass("cuarto")){
                        parcial_string = "cuarto_parcial";
                    }

                    //ENVIAR LA REQUEST AL SERVIDOR PARA EDITAR LA NOTA DE CIERTO ALUMNO

                    let newval = prompt("Ingrese el nuevo valor: ");
                    let id = $(this)[0].id;

                    if(newval === ""){
                        //ELIMINAR EL RECORD PARA DEJAR CIERTA CASILLA EN BLANCO!!!

                        let double_check = confirm("¿Seguro(a) que quiere dejar esta nota en blanco?");

                        if(double_check == true){
                            $.ajax({
                                url: "../php/server.php?delete_record_grade",
                                type: "post",
                                data: {'id': id, 'tabla': parcial_string},
                                success: function(){
                                    update_notas();
                                }
                            })
                        }
                        
                    }else{
                        $.ajax({
                            url: '../php/server.php?edit_grades',
                            type: "post",
                            data: {'id': id, 'nota': newval, 'tabla': parcial_string},
                            success: function(res){
                                //ACTUALIZAR LOS DATOS EN LA TABLA
                                update_notas();
                            }
                        })
                    }

                })
            })  
        }

        //ESTA VARIAABLE DEFINE SI LA TABLA DE REGISTRO DE NOTAS DEBERA TENER 2 O 4 PARCIALES DEPENDIENDO SI LA MODALIDAD SELECCIONADA ES CICLO O BTP
        let btp = false;


        $("#notas-dash").addClass("active");

        let grade = $("#grado");
        let parcial = $("#parcial")
        let subject = $("#subject");

        if(grade[0].value == "7" || "8" || "9"){
            console.log("ciclo")
        }

        function get_subjects(){

            function write_subjects(data){
                subject.html("<option value='0'></option>");
                console.log(data);
                fetch(`../php/server.php?subjects=${data}`)
                .then(response => response.json())
                .then(data=>{
                    subject.removeAttr('disabled');
                    subject.removeAttr('aria-label');
                    console.log(data);
                    data.forEach(item => {
                        subject[0].innerHTML += `<option>${item["subject"]}</option>`;
                    });
                })
            }

            if(grade[0].value == "7" || grade[0].value == "8" || grade[0].value == "9"){
                write_subjects(grade[0].value);
                $("#semester-selector").hide();
                // SE ESTABLECE LA VARIABLE BTP A FALSE PARA ESTABLECES LOS AJUSTES A CICLO COMUN
                btp = false;
                
            }else if(grade[0].value == "10" || grade[0].value == "11" || grade[0].value == "12"){
                // SE ESTABLECE LA VARIABLE BTP A TRUE PARA CAMBIAR LA APARIENCIA DE LA TABLA
                btp = true;

                let grade2;

                //ACTIVAR EL SELECTRO DE SEMESTRE PARA DETEREMINAR LAS CLASES CURSADAS EN BTP
                $("#semester-selector").show();

                //VER QUE SEMESTRE ESTA BTP
                if(grade[0].value == "10" && parcial[0].value == "2"){
                    grade2 = "10.5";
                }else if(grade[0].value == "11" && parcial[0].value == "2"){
                    grade2 = "11.5";
                }else if(grade[0].value == "12" && parcial[0].value == "2"){
                    grade2 = "12.5";
                }
                else{
                    grade2 = grade[0].value;
                }

                write_subjects(grade2);
            }
        }

        grade.change(function(){
            $(".t-c").html(``);
            
                parcial.html(`<option value='1'>I Semestre</option>
                                    <option value='2'>II Semestre</option>`)

            if(grade != "" && this != ""){
                get_subjects(grade[0].value);
            }
        })

        parcial.change(function(){
            if(grade != "" && this != ""){
                $(".t-c").html(``);
                get_subjects(grade[0].value);
            }
        })

        subject.change(function(){
            if(subject[0].value != "0"){

                if(btp == false){
                                $(".t-c").html(`
                        <table class="table table-bordered" style='border-collapse: collapse; overflox-x: scroll;'>
                            <thead class="bg-dark text-light text-center">
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Alumno</th>
                                    <th scope="col">I Parcial</th>
                                    <th scope="col">II Parcial</th>
                                    <th scope="col">III Parcial</th>
                                    <th scope="col">IV Parcial</th>
                                    <th scope="col">Promedio</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="body-students-table">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>EDITAR</td>
                                    <td>EDITAR</td>
                                    <td>EDITAR</td>
                                    <td>EDITAR</td>
                                </tr>
                            </tbody>
                        </table>
                            `)
                }else{
                    $(".t-c").html(`
                    <table class="table table-bordered" style='border-collapse: collapse; overflox-x: scroll;'>
                        <thead class="bg-dark text-light text-center">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Alumno</th>
                                <th scope="col">I Parcial</th>
                                <th scope="col">II Parcial</th>
                                <th scope="col">Promedio</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="body-students-table">
                            <tr>
                                <td></td>
                                <td></td>
                                <td>EDITAR</td>
                                <td>EDITAR</td>
                                <td>EDITAR</td>
                                <td>EDITAR</td>
                            </tr>
                        </tbody>
                    </table>
                        `)
                }
                
                //LLENAR LOS DATOS DE LA TABLA DE NOTAS
                update_notas();



            }
        })




        //GUARDAR LAS NOTAS EN LA BASE DE DATOS

        let btn_save = $("#ingresar_notas");

        btn_save.click(function(e){
            e.preventDefault();
            
            





            //SUBIR NOTAS A LA BASE DE DATOS

            //SI LAS NOTAS SON PARA CICLO SE HARA LA ITERACION EN AMBOS SEMESTRES
            if(parseInt(grade[0].value) < 10){
                console.log("ciclo")
                primer_semestre();
                segundo_semestre();
            }else{
                console.log("btp");
                if(parseInt($("#parcial")[0].value) > 1){
                    segundo_semestre();
                }else{
                    primer_semestre();
                }
            }


            function primer_semestre(){

                let p_parcial = document.querySelectorAll(".p_parcial");
                let s_parcial = document.querySelectorAll(".s_parcial");

                p_parcial_counter = 0;
                s_parcial_counter = 0;

                let student_name = document.querySelectorAll(".student_name");
                let student_id = document.querySelectorAll(".student_id");
                let subject = document.getElementById("subject").value;


                        //Checar si se ingresaron datos!!!

                        //Checar los records del primer parcial
                    p_parcial.forEach(name=>{
                        if(name.value != ""){
                            p_parcial_counter++;
                        }

                        console.log(p_parcial_counter);
                    })

                    //Checar los reords del segundo parcial
                    s_parcial.forEach(name=>{
                        if(name.value != ""){
                            s_parcial_counter++;
                        }

                        console.log(s_parcial_counter);
                    })

                //Subir los datos del primer parcial

                    if(p_parcial_counter > 0){
                        for(i = 0; i < p_parcial.length; i++){
                            console.log(student_name[i]);
                            if(p_parcial.value != ""){
                                console.log(p_parcial[i]);
                                if(p_parcial[i].hasAttribute("disabled") == false){
                                    $.ajax({
                                        url: '../php/server.php?notas',
                                        type: 'post',
                                        data: {'nota': p_parcial[i].value, 'subject': subject, 'name': student_name[i].textContent, 'sudent_id': student_id[i].value, 'grade': grade[0].value},
                    
                                        success: function(res){
                                            console.log("SENT");
                                            update_notas();
                                        }
                                    })
                                    
                                }
                                
                            }
                        }
                    }else{
                        console.log("NO RECORDS FOR FIRST PARCIAL")
                    }


                    //Subir datos del segundo parcial

                    if(s_parcial_counter > 0){
                        for(i = 0; i < s_parcial.length; i++){
                            if(s_parcial.value != ""){
                                if(s_parcial[i].hasAttribute("disabled") == false){
                                $.ajax({
                                    url: '../php/server.php?notas2',
                                    type: 'post',
                                    data: {'nota': s_parcial[i].value, 'subject': subject, 'name': student_name[i].textContent, 'sudent_id': student_id[i].value, 'grade': grade[0].value},
                
                                    success: function(res){
                                        console.log("SENT");
                                        update_notas();
                                    }
                                })
                            }
                            }
                        }
                    }else{
                        console.log("NO RECORDS FOR SECCOND PARCIAL")
                    }
            }

            

            //LA CONDICIONAL HARA QUE SE ITERE EN EL TECER Y CUARTO PARCIAL SOLAMENTE SI LA MODALIDAD ESCOGIDA ES CICLO

            function segundo_semestre(){
                
                let t_parcial = document.querySelectorAll(".t_parcial");
                let c_parcial = document.querySelectorAll(".c_parcial");

                
                t_parcial_counter = 0;
                c_parcial_counter = 0;

                let student_name = document.querySelectorAll(".student_name");
                let student_id = document.querySelectorAll(".student_id");

                let subject = document.getElementById("subject").value;

                    //checar si s eingresaron datos
                     //Checar los records del tercer parcial
                        t_parcial.forEach(name=>{
                            if(name.value != ""){
                                t_parcial_counter++;
                            }

                            console.log(t_parcial_counter);
                        })

                        //Checar los records del cuarto parcial
                        c_parcial.forEach(name=>{
                            if(name.value != ""){
                                c_parcial_counter++;
                            }

                            console.log(c_parcial_counter);
                        })


                //Subir datos del tercer parcial

                if(t_parcial_counter > 0){
                    for(i = 0; i < t_parcial.length; i++){
                        if(t_parcial.value != ""){
                            if(t_parcial[i].hasAttribute("disabled") == false){
                            $.ajax({
                                url: '../php/server.php?notas3',
                                type: 'post',
                                data: {'nota': t_parcial[i].value, 'subject': subject, 'name': student_name[i].textContent, 'sudent_id': student_id[i].value, 'grade': grade[0].value},
            
                                success: function(res){
                                    console.log("SENT");
                                    update_notas();
                                }
                            })
                        }
                    }
                    }
                }else{
                    console.log("NO RECORDS FOR THIRD PARCIAL")
                }

                //Subir datos del cuarto parcial

                if(c_parcial_counter > 0){
                    for(i = 0; i < c_parcial.length; i++){
                        if(c_parcial.value != ""){
                            if(c_parcial[i].hasAttribute("disabled") == false){
                            $.ajax({
                                url: '../php/server.php?notas4',
                                type: 'post',
                                data: {'nota': c_parcial[i].value, 'subject': subject, 'name': student_name[i].textContent, 'sudent_id': student_id[i].value, 'grade': grade[0].value},
            
                                success: function(res){
                                    console.log("SENT");
                                    update_notas();
                                }
                            })
                        }
                        }
                    }
                }else{
                    console.log("NO RECORDS FOR FOURTH PARCIAL")
                }


            }
                    
        })
    }

    if(document.URL.includes("Materias.php")){
        $("#materias-dash").addClass("active");
        
        //REDIRECCIONAR SEGUN E CURSO ELEGIDO CON EL SELECT
        $("#grade-s").change(function(){
            location.href = `Materias.php?id=${this.value}`;
        })

        id = $("#grade-s").value;

        $("#flexCheckChecked").change(function(e){
            if(this.checked){
                $("#add-subject").attr('data-bs-dismiss', 'modal');
            }else{
                $("#add-subject").removeAttr('data-bs-dismiss');
            }
        })

        $("#add-subject").click(function(e){
            e.preventDefault();
            $.ajax({
                url: `../php/server.php?add`,
                type: "post",
                data: $("#add-sub-form").serialize(),
                success: function(res){
                    $(".materias-t").html(res);
                    $("#name")[0].value = "";
                    $("#teacher")[0].value = "";
                    $("#horas")[0].value = "";
                }
            })
        })
    }


    if(document.URL.includes("generar_calificaciones.php")){
        $("#name").hide();
        $("#semester").hide();
        let btp = false;
        let name_field = false;

        $("#grado").change(function(){
            if(parseInt(this.value) > 9 ){
                $("#semester").show();
                btp = true;
            }else{
                $("#semester").hide();
                btp = false;
            }
        });

        $("#type").change(function(){
            if(parseInt(this.value) == 2 ){
                $("#name").show();
                name_field = true;
            }else{
                $("#name").hide();
                $("#name").value = "";
                name_field = false;
            }
        });

        $("#generate").click(function(e){
            e.preventDefault();
            let grado = $("#grado");
            let semester = $(".semester_select");
            let name = $(".search_bar");
            let alumn = $("#type");
            if($("#grado")[0].value != "0" && $("#type")[0].value != "0"){

                if(parseInt(grado[0].value) > 9){
                //GENERAR NOTAS PARA TODO UN GRADO BTP
                //GENERAR PARA BTP PRIMER SEMESTRE

                if($("#type")[0].value == "1"){
                if(btp == true && semester[0].value == "1"){
                    window.open(`generador_notas_todo_btp.php?id=${grado[0].value}`, '_blank');
                }

                //GENERAR PARA BTP SEGUNDO SEMESTRE
                if(btp == true && semester[0].value == "2"){
                    window.open(`generador_notas_todo_btp2.php?id=${grado[0].value}`, '_blank');
                }
            }
            //GENERAR NOTAS PARA UN ALUMNO EN ESPECIFICO BTP

            if($("#type")[0].value == "2"){
                //GENERAR PARA BTP PRIMER SEMESTRE
                if(btp == true && semester[0].value == "1"){
                    window.open(`generador_notas_btp.php?id=${name[0].id}`, '_blank');
                }

                //GENERAR PARA BTP SEGUNDO SEMESTRE
                if(btp == true && semester[0].value == "2"){
                    window.open(`generador_notas_btp2.php?id=${name[0].id}`, '_blank');
                }
            }

        }

            if(parseInt(grado[0].value) < 10){
                //GENERAR NOTAS PARA TODO UN GRADO CICLO
                //GENERAR PARA BTP PRIMER SEMESTRE

                if($("#type")[0].value == "1"){
                    if(btp == false){
                        window.open(`generador_notas_todo_ciclo.php?id=${grado[0].value}`, '_blank');
                    }
                }

                if($("#type")[0].value == "2"){
                    if(btp == false){
                        window.open(`generador_notas_ciclo.php?id=${name[0].id}`, '_blank');
                    }
                }
            }
            }
                
            
        })
    }
})