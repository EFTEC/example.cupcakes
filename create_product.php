<?php



include "app_doc.php";


$validaton=new \eftec\ValidationOne("frm_");

$button=$validaton->def("")->post("button");

function validation($cupcake) {
	// returns true or false
}


if ($button) {

	$cupcake['Name'] = $validaton
		->def("")// what if the value is not read?, we should show something (or null)
		->ifFailThenDefault(false)// if fails then we show the same value however it triggers an error
		->type("varchar")// it is required to ind
		->condition("req", "this value (%field) is required")
		->condition("minlen", "The minimum lenght is 3", 3)
		->condition("maxlen", "The maximum lenght is 100", 100)
		->post('name'); // frm_name.  It also generates a message container called "name".
	
	$cupcake['Image'] = $validaton
		->def("")
		->ifFailThenDefault(false)// if fails then we show the same value however it triggers an error
		->type("file")
		->condition("image", "The file is not a right image")
		->condition("ext", "The file is incorrect", ['jpg', 'png'])
		->condition("req", "this value (%field) is required")
		->getFile('image', false); // it returns an array [filename,filetmp]


	$cupcake['Price'] = $validaton
		->def("")// what if the value is not read?, we should show something (or null)
		->ifFailThenDefault(false)// if fails then we show the same value however it triggers an error
		->type("decimal")
		->condition("req", "this value (%field) is required")
		->condition("gt", "The price must be great than 0", 0)
		
		->condition("between", "The price must be between %first and %second", [0,1000])
		->post('price'); // frm_price

	$cupcake['Description'] = $validaton
		->def("")// what if the value is not read?, we should show something (or null)
		->ifFailThenDefault(false)// if fails then we show the same value however it triggers an error
		->type("varchar")
		->condition("req", "this value (%field) is required")
		->post('description'); // frm_description

	if (empty($validaton->getMessages())) {
		// 1) the button was pressed, there is not error.
		$sec= $doc->getNextSequence("seq",-1,100,1); // we create a new sequence -1 =always tries to create, 100 we start with 100 with 1 step.
		//var_dump($sec);
		$cupcake['IdCupcake']=$sec;
		$cupcake['Image'][0]=$sec.'_'.$cupcake['Image'][0];
		move_uploaded_file($cupcake['Image'][1],'img/'.$cupcake['Image'][0]);

		$cupcake['Image']=$cupcake['Image'][0]; // now Image is only the name, not an array
		$nameDoc="cupcake_".$cupcake['IdCupcake']; // namedoc could be anything but it must be unique
		$doc->insert($nameDoc,$cupcake); // insertamos el cupcake como unico

		$allCupcakes=$doc->get("cupcakes"); // we read the list of cupcakes
		$allCupcakes[]=$cupcake; // we add our cupcake to the list of cupcakes
		$doc->insertOrUpdate("cupcakes",$allCupcakes); // we store the cupcakes back.
		header("Location:catalog_document.php");
	}
	
	
} else {
	$cupcake=["IdCupcake"=>"","Name"=>"","Image"=>"","Price"=>"","Description"=>""];
}




echo $blade->run("cupcakes.form",['cupcake'=>$cupcake,'postfix'=>'document','validaton'=>$validaton]);