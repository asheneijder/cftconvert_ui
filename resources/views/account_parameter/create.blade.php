<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Account Parameter Setup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Insert New Account Number</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-danger" href="{{ route('accountparams.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('accountparams.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Account Number:</strong>
                        <input type="text" name="account_no" class="form-control" placeholder="Please insert Account Number">
                        @error('account_no')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Institution:</strong>
                        <input type="text" name="institution" class="form-control" placeholder="Please insert the institution -> example: PNB">
                        @error('institution')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Remarks:</strong>
                        <input type="text" name="remarks" class="form-control" placeholder="Remarks (Optional)">
                        @error('remarks')
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
