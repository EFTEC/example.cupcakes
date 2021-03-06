<?php

use eftec\bladeone\BladeOne;
use eftec\DaoOne;
use eftec\DocumentStoreOne\DocumentStoreOne;

include "vendor/autoload.php";

// folder /db/cupcake
$doc=new DocumentStoreOne("db","cupcake",null, DocumentStoreOne::DSO_FOLDER,false);
$doc->neverLock=true; // if never lock, it increases the speed (we don't create a lock).
					  // however, it is dangerous for concurrency (write).
$doc->autoSerialize(true,"json_array"); // autoserialize the object using json
$doc->docExt=".json";


$blade=new BladeOne(); // it will create the folders compiles/ . The folder views/ must be created
					   // if they are not create then you should create it manually


