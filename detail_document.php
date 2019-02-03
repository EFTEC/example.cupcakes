<?php



include "app_doc.php";

$id=intval(@$_GET['id']);

$cupcake=$doc->get("cupcake_".$id);



echo $blade->run("cupcakes.detail",['cupcake'=>$cupcake,'postfix'=>'document']);