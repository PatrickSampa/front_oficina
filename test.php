<?php
require ('config.php');
$res = mysqli_query($conn, "select idMunicipio from municipio where Municipio like 'Ananindeua';");
$idmun = mysqli_fetch_all($res, MYSQLI_ASSOC);
$idmun = $idmun[0]['idMunicipio'];



?>