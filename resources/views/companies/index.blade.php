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
                <div class="pull-left">
                    <h2>CFT Files Microservices</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('companies.create') }}">Add CFT Data</a>
                    {{-- <a class="btn btn-info" href="{{ route('accountparams.index') }}">Account Parameters Setup</a> --}}
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>CFT002</th>
                    <th>CFT003</th>
                    <th>CFT006</th>
                    <th>Date Processed</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ Str::substr($company->name, 0, 20) }}</td>
                        <td>{{ Str::substr($company->email, 0, 20) }}</td>
                        <td>{{ Str::substr($company->address, 0, 20) }}</td>
                        <td>{{ $company->created_at }}</td>
                        <td>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('companies.edit', $company->id) }}">Send Email</a>
                                @csrf
                                {{-- @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button> --}}
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $companies->links() !!}
    </div>
</body>

</html>
