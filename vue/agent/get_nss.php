<?php
session_start();
require_once "../../model/ModelClient.php";

$nom = $_POST["nom"];
$date_naissance = $_POST["date_naissance"];

$nss = ModelClient::NSSequivalent($nom, $date_naissance);
$_SESSION["NSS"]=$nss;
echo $nss;

?>
