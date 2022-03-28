<?php
    include("./Funciones/fpdf/fpdf.php");
    include("./Acceso/Factura.php");

    session_start();

    $facturaClass = new Factura();

    if(isset($_GET['id']) && isset($_SESSION['permisos'])){
        $id = $_GET['id'];

        if($lista = $facturaClass->mostrarDatosFactura($_SESSION['permisos'], $id)){
            $pdf = new FPDF();

            $pdf->AddPage();

            $pdf->SetTitle("Factura Electronica: ".$lista[5]);

            $pdf->SetAuthor("MiniMercado");

            $pdf->SetCreator("MiniMercado");

            //titulo
            $pdf->SetFont("Arial", "B", 24);

            $pdf->Cell(0, 10, "".$lista[0]."", 0, 1);

            $pdf->Ln();

            //cuerpo
            $pdf->SetFont('Arial', '', 12);

            $pdf->MultiCell(0, 7, utf8_decode("Realizado por: ".$lista[1]), 0, 1);
        
            $pdf->Ln(); 

            //separar productos por coma
            $productos = explode(",", $lista[2]);

            $productos = implode("\n", $productos);

            $pdf->MultiCell(0, 7, utf8_decode("Por la compra de:"."\n".$productos), 0, 1);
        
            $pdf->Ln();

            $pdf->MultiCell(0, 7, utf8_decode("Por un precio total de: ".$lista[3]), 0, 1);
        
            $pdf->Ln();

            $pdf->MultiCell(0, 7, utf8_decode("Entregar a: ".$lista[4]), 0, 1);
        
            $pdf->Ln();

            $pdf->Output("", "Factura Electronica.pdf");
        }

    }else{
        header("Location: index.php");
    }
?>