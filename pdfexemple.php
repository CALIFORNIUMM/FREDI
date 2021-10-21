<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ht2</title>
    
</head>
<body>
    <style>
        @charset "utf-8";

/* -- Visualisation des bordures de tableau -- */

table, th, td {
  border-style: solid;
  border-width: 1px;
  border-color : black;
  border-collapse: collapse;
}
/* -- Taille des cellules -- */
td {
  width : 50px;
  height : 100px;
}

/* -- Couleurs du drapeau -- */

td.bleu {
  background-color: blue;
}
td.blanc {
  background-color: white;
}
td.rouge {
  background-color: red;
}
td.vert {
  background-color: rgb(34, 168, 16);
}
td.noir {
  background-color: rgb(0, 0, 0);
}
td.jaune {
  background-color: rgb(221, 190, 15);
}
td.orange {
  background-color: rgb(228, 133, 8);
}
td.violet {
  background-color: rgb(115, 8, 177);
}
.gay{
  width : 160px;
  height : 10px;
}
    </style>
    <h1>ht12 : drapeau français</h1>

    <h4>Drapeau français</h4>
    <table>
        <tr>
            <td class="bleu"></td>
            <td class="blanc"></td>
            <td class="rouge"></td>
        </tr>
    </table>
    <h4>Drapeau belge</h4>
    <table>
        <tr>
            <td class="noir"></td>
            <td class="jaune"></td>
            <td class="rouge"></td>
        </tr>
    </table>
    <h4>Drapeau italien</h4>
    <table>
        <tr>
            <td class="vert"></td>
            <td class="blanc"></td>
            <td class="rouge"></td>
        </tr>
    </table>

    <?php
        $a = array(
            "test" => 1121212,
            "tefezfzst" => 1121212,
            "teezfezfst" => 1145752,
            "tefzefst" => 1175752,
            "tezfezfest" => 12,
    );
    foreach ($a as $key => $b){
        echo $key." at ". $b."<br>";
    }
    ?>
    
    <p><a href="https://www.google.fr/">tg</a></p>
</body>
</html>
<?php
$html = ob_get_clean();

    // include autoloader
    require_once 'app/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
    //Lien de la doc
    //http://eclecticgeek.com/dompdf-info/

?>