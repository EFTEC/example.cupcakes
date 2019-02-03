# example.cupcakes
Example of a catalog of cupcakes made with php

## Composer

### Initialize

![docs/composer_init.jpg](docs/composer_init.jpg)

It will create the file called composer.json

🗎 composer.json

You could edit this file if you are pleased to.


### Installation of composer

![docs/composer_install.jpg](docs/composer_install.jpg)

It will create the folder

📁 \vendor

### Installation of libraries

![docs/composer_require.jpg](docs/composer_require.jpg)

Now, we will use 3 libraries: 

* eftec/bladeone for the templates
* eftec/daoone for the database (if we want to use the database)
* eftec/documentstoreone if we want to use the filesystem (instead of database)


📁 \vendor


## OK, let's code (Mysql Version)

### Application file

Here, we will set the autoload (Composer), the database and the bladeone library.

The bladeone library will be used as a template system. It uses the language "blade" (the same than uses Laravel)  

The class DaoOne will connect to the database.


```php
<?php

use eftec\bladeone\BladeOne;
use eftec\DaoOne;

include "vendor/autoload.php";

// we created the new connection to the database :-)
// database located at 127.0.0.1, user root and password: abc.123, schema = cupcakes
$db=new DaoOne("127.0.0.1","root","abc.123","cupcakes");
$db->open();

$blade=new BladeOne(); // it will create the folders compiles/ . The folder views/ must be created
					   // if they are not create then you should create it manually
```

### Initilizing the data createtable.php

For Mysql, we will need to create the table and add some information.
 
> We must call this page once. If we execute the page more than once, then it will generate an error (because the table exists).

I create a file called createtable.php that creates the table and add 9 cupcakes to the table.  


```php
<?php

include "app.php";

$sql=<<<TAG
CREATE TABLE `cupcakes` (
  `IdCupcake` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NULL,
  `Image` VARCHAR(45) NULL,
  `Price` DECIMAL(10,2) NULL,
  `Description` VARCHAR(2000) NULL,
  PRIMARY KEY (`IdCupcake`))
TAG;
$rows=<<<TAG
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Chocolate', 'cupcake1.jpg', '20', 'Chocolate');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Cupcake Normal', 'cupcake2.jpg', '30', 'Cupcake Normal');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Gourmet', 'cupcake3.jpg', '35.5', 'Gourmet');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Apple Pie', 'cupcake4.jpg', '43.3', 'Apple Pie');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Sprinkles', 'cupcake5.jpg', '24.3', 'Sprinkles');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Butter', 'cupcake6.jpg', '32.2', 'Butter');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Lemon', 'cupcake7.jpg', '22.3', 'Lemon');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Brownies', 'cupcake8.jpg', '32.2', 'Brownies');
INSERT INTO `cupcakes`.`cupcakes` (`Name`, `Image`, `Price`, `Description`) VALUES ('Bubbly', 'cupcake9.jpg', '33.2', 'Bubbly');
TAG;

$db->runRawQuery($sql);

$db->runMultipleRawQuery($rows);
```

### Controller (catalog_mysql.php)

Now, let's show the catalog.  We will do the next operations:

* Read the list of cupcakes from the database.
* Sends the list to the template

```php
<?php
include "app.php";

$cupcakes=$db->select("*")->from("cupcakes")->order("name")->toList();

echo $blade->run("cupcakes.catalog"
	,['cupcakes'=>$cupcakes,'postfix'=>'mysql']);
```

We are also passing the variable postfix. It is used to create the link to the right version.

### View (views/cupcakes/catalog.blade.php)

Ok, it is a bit long, I started with the startup page of Bootstrap, I added some cards and I added a @foreach cycle

The images exists in the folder 

📁  \img   

This template must exist in the folder

📁 \views   
..... 📁 \cupcakes   
..... ..... 📝 catalog.blade.php   

Why?, the views folder is the default folder of the view (BladeOne)

The second folder and the file comes from the line:

> echo $blade->run("cupcakes.catalog",...

where cupcakes is a folder, and catalog is the file (plus extension .blade.php)


```html
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <h1>Cupcakes World
        <small class="text-muted">Pick your cupcake</small>
    </h1>
    <div class="row">
        @foreach($cupcakes as $cupcake)
        <div class="col-md-4">
            <div class="card">
                <a href="detail_{{$postfix}}.php?id={{$cupcake['IdCupcake']}}">
                    <img src="img/{{$cupcake['Image']}}" class="card-img-top" alt="{{$cupcake['Image']}}">
                </a>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <h5 class="card-title">{{$cupcake['Name']}}</h5>
                        </div>
                        <div class="col-md-5 text-right">
                            <p class="card-text">Price ${{$cupcake['Price']}}</p>
                        </div>
                    </div>
                    <a href="detail_{{$postfix}}.php?id={{$cupcake['IdCupcake']}}" class="btn btn-primary">Eat Me</a>
                </div>
            </div>
            <br>
        </div>
        
        @endforeach()
          
    </div>
</div>
</body>
</html>
```

The magic is done using the annotation of Blade @operator

> @foreach($cupcakes as $cupcake)

It generates a loop of the variable $cupcakes. Where it comes from?. From here:

> echo $blade->run("cupcakes.catalog",['cupcakes'=>$cupcakes,'postfix'=>'mysql']);

Next, we should each value using the annotation of Blade {{}}

> <img src="img/{{$cupcake['Image']}}" ...>

