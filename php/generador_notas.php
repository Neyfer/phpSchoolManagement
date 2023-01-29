<?php


require("fpdf/fpdf.php");

    class PDF extends FPDF{
        function Header(){
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
            $this -> Cell(250, 5, "Tel. Bol.Calif. 1601-2005-01012", 0, 1, 'C');
        }
    }


$pdf = new PDF();
$pdf -> AddPage();
$pdf -> SetMargins(25.4, 25.4 , 25.4, 25.4);
$pdf -> SetFont("Times", "B", 14);
$pdf -> Cell(180, 10, "BOLETA DE CALIFICACIONES", 0, 1, 'C');
$pdf -> SetFont("Arial", "B", 10);
$pdf -> Cell(30, 5, "Nombre del alumno: Neyfer Enrique Coto Pineda", 0, 0);
$pdf -> Cell(120, 5, "Reg. 1601-2005-01012", 60, 1, "R");
$pdf -> Cell(30, 5, "Decimo grado de Bachillerato Tecnico Profesional", 0, 0);
$pdf -> Cell(101.5, 5, "Año 2021",  60, 1, "R");
$pdf -> Cell(101.5, 5, "Año 2021", 1,  60, 1, 0, "C");

$pdf -> Output();
