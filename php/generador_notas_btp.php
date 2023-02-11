<?php

include "mysql.php";
$id = $_GET["id"];
$alumn_data = null;

$alumnos = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");

while($rows = mysqli_fetch_assoc($alumnos)){
    $alumn_data[] = $rows; 
}


require("fpdf/fpdf.php");

    class PDF extends FPDF{
        
        function Header(){
            include "mysql.php";
            $id = $_GET["id"];
            $alumn_data = null;

            $alumnos = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");

            while($rows = mysqli_fetch_assoc($alumnos)){
                $alumn_data[] = $rows; 
            }

            $this -> SetFont("Arial", "B", 11);
            $this -> Cell(180, 5, "Secretaria de educacion", 0, 1, 'C');
            $this -> Cell(180, 5, "Direccion Departamental de Santa Barbara", 0, 1, 'C');
            $this -> SetFont("Arial", "B", 16);
            $this -> Cell(180, 10, 'CEMG. "MARCO AURELIO SOTO"', 0, 1, 'C');
            $this -> SetFont("Arial", "B", 11);
            $this -> Cell(180, 5, "El Zapote Santa Barbara Honduras C.A.", 0, 1, 'C');
            $this -> SetFont("Arial", "", 11);
            $this -> Cell(180, 5, "Tel. 96742223//97012137", 0, 1, 'C');
            $this -> SetLineWidth(0.1);
            $this -> Line(30, 40, 170, 40);

            $this->Image("../img/mono.png", 35, 15, -1250);
            $this->Image("../img/mono.png", 147, 15, -1250);

            $this -> SetFont("Arial", "B", 11);
            $this -> Cell(250, 5, "Bol.Calif. " . $alumn_data[0]['ident'], 0, 1, 'C');
        }
    }

    $grade = $alumn_data[0]['grade'];
    $grade2 = null;

    switch ($grade) {
        case '12':
            $grade2 = "Doceavo";
            break;
        
        case '11':
            $grade2 = "Onceavo";
            break;

        case '10':
            $grade2 = "Decimo";
            break; 
            
        case '9':
            $grade2 = "Noveno";
            break;

        case '8':
            $grade2 = "Octavo";
            break;

        case '7':
            $grade2 = "Septimo";
            break;

        default:
            # code...
            break;
    }

$pdf = new PDF();
$pdf -> AddPage("P", "Letter");
$pdf -> SetMargins(25.4, 25.4 , 25.4, 25.4);
$pdf -> SetFont("Times", "B", 14);
$pdf -> Cell(180, 10, "BOLETA DE CALIFICACIONES", 0, 1, 'C');
$pdf -> SetFont("Arial", "B", 10);
$pdf -> Cell(30, 5, "Nombre del alumno: " . $alumn_data[0]['name'], 0, 0);
$pdf -> Cell(120, 5, "Reg. " . $alumn_data[0]['ident'], 60, 1, "R");
$pdf -> Cell(30, 5, $grade2 . " grado de Bachillerato Tecnico Profesional", 0, 0);
$pdf -> Cell(101.5, 5, "Año 2021",  60, 1, "R");
$pdf -> Ln(10);


$pdf -> SetX(80);
$pdf -> Cell(100, 10, "Nota por Parcial I Semestre", 1,  100, 1, 0, "C");
$pdf -> SetX(26);
$pdf -> Cell(10, 10, "N`", 1,  0, "C", 0, 0);
$pdf -> Cell(62, 10, "Asignatura", 1,  0, "C",  0, 0);
$pdf -> Cell(16, 10, "I", 1,  0, "C",  0, 0);
$pdf -> Cell(16, 10, "II", 1,  0, "C",  0, 0);
$pdf -> Cell(22, 10, "Promedio", 1,  0, "C",  0, 0);
$pdf -> Cell(28, 10, "Recuperacion", 1,  1, "C",  0, 0);

$grade = $alumn_data[0]['grade'];

$subjects = mysqli_query($conn, "SELECT * FROM asignaturas WHERE grade = $grade");

while($rows = mysqli_fetch_assoc($subjects)){
    $pdf -> SetX(26);
    $pdf -> Cell(10, 10, "1", 1,  0, "C",  0, 0);

    $fontSize = 10;
    $tempFontSize = $fontSize;

    $scaleWidth = 62;


    while($pdf -> GetStringWidth($rows['subject']) > $scaleWidth){
        $pdf -> SetFontSize($tempFontSize -= 0.2);
    }

    $pdf -> Cell($scaleWidth, 10, $rows['subject'], 1,  0, "C",  0, 0);
    $tempFontSize = $fontSize;
    $pdf -> SetFontSize($fontSize);

    $pp_checker = false;
    $sp_checker = false;

    $subject = $rows['subject'];
    $notas = mysqli_query($conn, "SELECT * FROM primer_parcial WHERE student_id = $id AND `subject` = '$subject'");
    if(mysqli_num_rows($notas) > 0){
        $pp = mysqli_fetch_Assoc($notas);
        $pdf -> Cell(16, 10, $pp['nota'] . "%", 1,  0, "C",  0, 0);
        $pp_checker = true;
    }else{
        $pdf -> Cell(16, 10,"", 1,  0, "C",  0, 0);
    }

    $notas2 = mysqli_query($conn, "SELECT * FROM segundo_parcial WHERE student_id = $id AND `subject` = '$subject'");
    if(mysqli_num_rows($notas2) > 0){
        $sp = mysqli_fetch_Assoc($notas2);
        $pdf -> Cell(16, 10, $sp['nota'] . "%", 1,  0, "C",  0, 0);
        $sp_checker = true;
    }else{
        $pdf -> Cell(16, 10, "", 1,  0, "C",  0, 0);
    }

    if($pp_checker == true && $sp_checker == true){
        $promedio = (intval($pp['nota'] + intval($sp['nota'])) / 2);
        $pdf -> Cell(22, 10, $promedio . "%", 1,  0, "C",  0, 0);
    }else{
        $pdf -> Cell(22, 10, "", 1,  0, "C",  0, 0);
    }

    
    $pdf -> Cell(28, 10, "", 1,  1, "C",  0, 0);
}



$pdf -> Output();