<?php



include "app_doc.php";

$id=intval(@$_GET['id']);

$cupcake=$doc->get("cupcake_".$id);

var_dump($cupcake);

echo $blade->run("cupcakes.detail",['cupcake'=>$cupcake,'postfix'=>'document']);