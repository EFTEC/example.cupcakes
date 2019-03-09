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
        <small class="text-muted">Add a new cupcake</small>
    </h1>
    <br><br>
    <div class="row">
        <div class="col-12">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control"
                           name="frm_name" id="frm_name" 
                           value="{{$cupcake['Name']}}">
                    <small class="form-text text-danger">
                        {{$validaton->getMessageId("name")->firstError()}}
                    </small>
                </div>

            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-9">

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="frm_image" id="frm_image">
                        <label class="custom-file-label" for="frm_image">Choose file</label>
                    </div>
                    <small class="form-text text-danger">
                        {{$validaton->getMessageId("image")->firstError()}}
                    </small>                    
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" 
                           name="frm_price" id="frm_price"
                           value="{{$cupcake['Price']}}">
                    <small class="form-text text-danger">
                        {{$validaton->getMessageId("price")->firstError()}}
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="frm_description"
                              id="frm_description">{{$cupcake['Description']}}</textarea>
                    <small class="form-text text-danger">
                        {{$validaton->getMessageId("description")->firstError()}}
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-3 col-form-label">&nbsp;</label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary" name="frm_button" value="submit">Submit</button>
                </div>
            </div>            
        </form>
        </div>
        <div class="col-12">
        <ul class="text-danger">
            @foreach($validaton->getMessages() as $error)
            <li>{{$error}}</li>    
            @endforeach
        </ul>
        </div>
          
    </div>
</div>


<script src="http://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="http://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>