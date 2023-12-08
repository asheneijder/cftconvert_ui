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
                    <a class="btn btn-success" href="{{ route('accountparams.create') }}">Add CFT Data</a>
                    <a class="btn btn-info" href="{{ route('accountparams.index') }}">Account Parameters Setup</a>
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
                    <th>Account Number</th>
                    <th>Institution</th>
                    <th>Remarks</th>
                    <th>Date Recorded</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->id}}</td>
                        <td>{{ $company->account_no}}</td>
                        <td>{{ $company->institution}}</td>
                        <td>{{ $company->remarks}}</td>
                        <td>{{ $company->created_at}}</td>
                        <td>
                            <form action="{{ route('accountparams.destroy', $company->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('accountparams.edit', $company->id) }}">Resend Mail</a>
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
