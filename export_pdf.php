<?php
require_once("../Model/post.php");
require_once('../tcpdf_6_3_2/tcpdf/tcpdf.php');
require_once("../Model/comment.php");
require_once('../tcpdf_6_3_2/tcpdf/tcpdf_import.php');


// Initialize TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('company');
$pdf->SetTitle('comments  and posts Data');
$pdf->SetSubject('comments  and posts Data');
$pdf->SetKeywords('TCPDF, PDF, comments, posts');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' ', PDF_HEADER_STRING);

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();
// Fetch data of transportations from the database
$commentModel = new comment();
$commentData = $commentModel ; // Implement this method to fetch data from your database

// Fetch data of emploi from the database
$postModel = new post();
$potsData = $postModel; // Implement this method to fetch data from your database

// Output the data in the PDF
$pdf->SetFont('helvetica', '', 12);

$pdf->Cell(0, 10, 'comment Data', 0, 1);
foreach ($commentData as $transport) {
    $pdf->Cell(0, 10, $comment['id'] . ' - ' . $comment['post_id'] . ' - ' . $comment['auteur'] . ' - ' . $comment['contenu_comment'], 0, 1);
}

$pdf->Cell(0, 10, 'post Data', 0, 1);
foreach ($postData as $post) {
    $pdf->Cell(0, 10, $post['id'] . ' - ' . $post['auteur'] . ' - ' . $post['titre'] . ' - ' . $post['contenu'] . ' - ' . $post['Email'] , 0, 1);
}

// Output the PDF to the browser
$pdf->Output('comment _ post _data.pdf', 'D');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des posts</title>
    <link rel="stylesheet" href="liste_employe.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>
<body>
<div class="container">
    <div class="box">
        <table id="myTable" class="RdvTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Auteur</th>
                    <th>Titre</th>
                    <th>contenu</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($postData as $post) {
                ?>
                <tr>
                    <td><?= $post['id']; ?></td>
                    <td><?= $post['auteur']; ?></td>
                    <td><?= $post['titre']; ?></td>
                    <td><?= $post['contenu']; ?></td>
                    
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- Move the button outside the PDF generation PHP block -->
        <button type="submit" name="GENERATEpdf">GENERATEpdf</button>
    </div>
</div>
</body>
</html>