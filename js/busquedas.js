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

})