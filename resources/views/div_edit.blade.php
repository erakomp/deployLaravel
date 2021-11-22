<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                
                <div class="card-body">
                    <a href="/div" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    
 
                    <form method="post" action="/div/update/{{ $div->id }}">
 
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
 
                        <div class="form-group">
                            <label>Division</label>
                            <input type="text" name="division" class="form-control" placeholder="Division" value=" {{ $div->id }}">
 
                            @if($errors->has('division'))
                                <div class="text-danger">
                                    {{ $errors->first('division')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" placeholder="{{ $div->description }}"> {{ $div->description }} </textarea>
 
                             @if($errors->has('descriptiion'))
                                <div class="text-danger">
                                    {{ $errors->first('descriptiion')}}
                                </div>
                            @endif
 
                        </div>
 
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>
 
                    </form>
 
                </div>
            </div>
        </div>
    </body>
</html>