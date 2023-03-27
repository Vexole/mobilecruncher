<?php

require_once('fpdf184/fpdf.php');

class Invoice extends FPDF
{
    // Set header with logo and the college name for the pdf
    function Header()
    {
        $this->Image(
            'images/conestogalogo.png',
            100,
            10,
            20,
            0,
            'JPEG'
        );
        $this->Ln(16);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'MOBILE CRUNCHERS', 0, 0, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', '', 13);
        $this->Cell(0, 10, 'NORTHTOWN S. C. 392 NORTHTOWN DRIVE NE', 0, 0, 'C');
        $this->Ln(8);
        $this->Cell(0, 10, 'MINNEAPOLIS, MN 55434', 0, 0, 'C');
        $this->Ln(8);
        $this->Cell(0, 10, '176-378-6362 x.1', 0, 0, 'C');
        $this->Ln(10);
        $this->Cell(
            0,
            10,
            '_______________________________________________________________________',
            0,
            0,
            'C'
        );
        $this->Ln(10);
    }

    // Set footer with page number for the pdf
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, $this->PageNo(), 0, 0, 'C');
    }

    public function generateInvoice($sale)
    {
        $this->AddPage();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(20, 1, '', 0, 0, 'C');
        $this->Cell(50, 20, 'Store: 6', 0, 0, 'L');
        $this->Cell(40, 20, 'Register: 1', 0, 0, 'L');
        $this->Ln(10);

        $this->Cell(20, 1, '', 0, 0, 'C');
        $this->Cell(12, 20, 'Date: ', 0, 0, 'L');
        $this->Cell(38, 20, date("Y-m-d"), 0, 0, 'L');

        $this->Cell(12, 20, 'Time: ', 0, 0, 'L');
        $this->Cell(
            28,
            20,
            date("h:i:sa"),
            0,
            0,
            'L'
        );

        $this->Ln(10);

        $this->Cell(20, 1, '', 0, 0, 'C');
        $this->Cell(20, 20, 'Cashier: ', 0, 0, 'L');
        $this->Cell(18, 20, 'Online', 0, 0, 'L');
        $this->Ln(10);

        $this->Cell(20, 1, '', 0, 0, 'C');
        $this->Cell(20, 20, 'Sold To: ', 0, 0, 'L');
        $this->Cell(18, 20, $sale->firstName . " " . $sale->lastName , 0, 0, 'L');
        $this->Ln(10);

        $this->Cell(20, 1, '', 0, 0, 'C');
        $this->Cell(35, 20, 'Payment Mode: ', 0, 0, 'L');
        $this->Cell(18, 20, $sale->paymentMode, 0, 0, 'C');
        $this->Ln(15);

        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 20, 'SALE INVOICE', 0, 0, 'C');
        $this->Ln(10);

        $this->Cell(
            0,
            10,
            '___________________________________________________________',
            0,
            0,
            'C'
        );

        $this->Ln(10);
        $this->SetFont('Arial', 'B', 14);

        $this->Cell(15, 1, '', 0, 0, 'C');
        $this->Cell(20, 20, 'S.N.', 0, 0, 'C');
        $this->Cell(40, 20, 'Model', 0, 0, 'C');
        $this->Cell(35, 20, 'Qty', 0, 0, 'C');
        $this->Cell(40, 20, 'Unit Price', 0, 0, 'C');
        $this->Cell(30, 20, 'Price', 0, 0, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', '', 12);

        foreach ($sale->items as $index => $item) {
            $this->Cell(15, 1, '', 0, 0, 'C');
            $this->Cell(20, 20, $index + 1, 0, 0, 'C');
            $this->Cell(40, 20, $item->name, 0, 0, 'C');
            $this->Cell(35, 20, $item->qty, 0, 0, 'C');
            $this->Cell(40, 20, "$$item->price", 0, 0, 'C');
            $this->Cell(30, 20, "$$item->qty * $item->price", 0, 0, 'C');
            $this->Ln(10);
        }

        $this->SetFont('Arial', 'B', 12);

        $this->Cell(150, 20, 'Tax', 0, 0, 'R');
        $this->Cell(30, 20, "$$sale->tax", 0, 0, 'C');
        $this->Ln(10);

        $this->Cell(150, 20, 'Total', 0, 0, 'R');
        $this->Cell(30, 20, "$$sale->total", 0, 0, 'C');
        $this->Ln(25);

        $this->SetFont('Arial', '', 12);

        $this->Cell(0, 20, 'Thank You for Shopping with Mobile Cruncher!', 0, 0, 'C');
        $this->Ln(20);

        $this->MultiCell(
            0,
            8,
            `Tell Us About Your Experience! Complete a short survey about this
        shopping experience and receive a coupon for 30% off one regular priced
        item* on a future purchase just by providing your review.`,
            0,
            'C'
        );

        $this->Output();
    }
}
