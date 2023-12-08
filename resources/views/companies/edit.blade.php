<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Resend Mail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Resend CFT Data for: {{$company->created_at}}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-danger" href="{{ route('companies.index') }}" enctype="multipart/form-data">Back</a>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CFT002:</strong>
                        <input type="text" name="name" disabled value="{{ $company->name }}" class="form-control"
                            placeholder="no data">
                        @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CFT003:</strong>
                        <input type="text" name="email" disabled class="form-control" placeholder="no data"
                            value="{{ $company->email }}">
                        @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CFT006:</strong>
                        <input type="text" name="address" disabled value="{{ $company->address }}" class="form-control"
                            placeholder="no data">
                        @error('address')
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
