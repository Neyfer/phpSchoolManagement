$(document).ready(function(){

    //BUSQUEDA DE MAESTROS

    if(document.URL.includes("teachers.php")){
        let search_bar = $("#search-bar");

        search_bar.keyup(function(){
            $.ajax({
                url: `../php/server.php?search_teachers`,
                type: "post",
                data: {'name': search_bar[0].value},
                success: function(res){
                    $("#teachers_body_table").html(res);
                }
            })
        })
    }

    //BUSQUEDA DE PADRES

    if(document.URL.includes("parents.php")){
        let search_bar = $("#search-bar");

        search_bar.keyup(function(){
            $.ajax({
                url: `../php/server.php?search_parents`,
                type: "post",
                data: {'name': search_bar[0].value},
                success: function(res){
                    $("#parents_body_table").html(res);
                }
            })
        })
    }

    //BUSQUEDA DE ALUMNOS

    if(document.URL.includes("students.php")){
        let search_bar = $("#search-bar");
        let grado = $("#grado");
        let age = $("#edad");

        function buscar(){

            if(search_bar[0].value == "" & grado[0].value == "0" & age == ""){
                alert("realod")
                location.reload();
            }else{
                $.ajax({
                    url: `../php/server.php?search_students`,
                    type: "post",
                    data: {'name': search_bar[0].value, 'grade': grado[0].value, 'age': age[0].value},
                    success: function(res){
                        console.log(res);
                        $("#students_body_table").html(res);
                    }
                })
            }
        }

        search_bar.keyup(buscar);
        grado.change(buscar);
        age.keyup(buscar);
    }


    //BUSQUEDA DE ALUMNOS AL GENERAR NOTAS

    if(document.URL.includes("generar_calificaciones.php")){
        let search_bar = $(".search_bar");
        let grade = $("#grado");
        $("#recomendations").html(``);
        $("#recomendations").hide(); 
        search_bar.keyup(function(){
            $.ajax({
                url: `../php/server.php?search_alumns_grades`,
                type: "post",
                data: {'name': search_bar[0].value, 'grade': grade[0].value},
                success: function(res){
                    $("#recomendations").show(); 
                    $("#recomendations").html(res);

                    if(res != ""){
                        $(".names_r").each(function(){
                            $(this).click(()=>{
                                console.log("clicked")
                                search_bar[0].value = this.textContent;
                                search_bar[0].id = this.id;
                                $("#recomendations").html(``); 
                                $("#recomendations").hide(); 
                            })
                        })
                    }
                }
            })

            if(search_bar[0].value == undefined){
                $("#recomendations").html(``);
                $("#recomendations").hide(); 
            }
        })
    }

})