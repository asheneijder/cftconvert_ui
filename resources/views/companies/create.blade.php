<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CFT Files Microservices</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>CFT Data for {{Carbon\Carbon::now()->toDateTimeString()}}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-danger" href="{{ route('companies.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CFT002:</strong>
                        <input class="form-control" name="cft002" type="file" id="formFile">
                        @error('cft002')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CFT003:</strong>
                        <input class="form-control" name="cft003" type="file" id="formFile">
                        @error('cft003')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CFT006</strong>
                        <input class="form-control" name="cft006" type="file" id="formFile">
                        @error('cft006')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success ml-3">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
