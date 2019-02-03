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
                <a href="detail_mysql.php?id={{$cupcake['IdCupcake']}}">
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
                    <a href="detail_mysql.php?id={{$cupcake['IdCupcake']}}" class="btn btn-primary">Eat Me</a>
                </div>
            </div>
            <br>
        </div>
        
        @endforeach()
          
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>