<?php
include "app.php";

$cupcakes=$db->select("*")->from("cupcakes")->order("name")->toList();

echo $blade->run("cupcakes.catalog"
	,['cupcakes'=>$cupcakes,'postfix'=>'mysql']);