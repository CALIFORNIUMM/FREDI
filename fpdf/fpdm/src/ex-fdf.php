<?php

/***************************
  Sample using an FDF file
****************************/

require('fpdm.php');

$pdf = new FPDM('CERFA_vierge.pdf', 'fields.fdf');
$pdf->Merge();
$pdf->Output();
?>
