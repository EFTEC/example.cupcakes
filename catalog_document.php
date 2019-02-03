<?php

include "app_doc.php";

$cupcakes=$doc->get("cupcakes");

echo $blade->run("cupcakes.catalog",['cupcakes'=>$cupcakes,'postfix'=>'document']);