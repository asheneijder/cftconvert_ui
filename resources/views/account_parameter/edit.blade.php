<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit for account number created at: {{$company->created_at}}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-danger" href="{{ route('accountparams.index') }}" enctype="multipart/form-data">Back</a>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('accountparams.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Account Number:</strong>
                        <input type="text" name="account_no" disabled value="{{ $company->account_no }}" class="form-control"
                            placeholder="no data">
                        @error('account_no')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Institution:</strong>
                        <input type="text" name="institution" disabled value="{{ $company->institution }}"> class="form-control" placeholder="no data"
                        @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Remarks:</strong>
                        <input type="text" name="remarks" disabled value="{{ $company->address }}" class="form-control"
                            placeholder="no data">
                        @error('remarks')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success ml-3">Send</button>
            </div>
        </form>
    </div>
</body>

</html>
