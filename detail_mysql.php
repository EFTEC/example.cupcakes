<?php

use eftec\DocumentStoreOne\DocumentStoreOne;

include "app.php";

$id=intval(@$_GET['id']);

$cupcake=$db->select("*")->from("cupcakes")->where(["IdCupcake"=>$id])->first();

$doc=new DocumentStoreOne("db","cupcake",null, DocumentStoreOne::DSO_FOLDER,false);
$doc->autoSerialize(true,"json_array"); // autoserialize the object using json
$doc->docExt=".json";

$doc->insertOrUpdate("cupcake_".$cupcake['IdCupcake'],$cupcake);

echo $blade->run("cupcakes.detail",['cupcake'=>$cupcake,'postfix'=>'mysql']);