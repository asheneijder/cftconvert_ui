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
                <div class="pull-left">
                    <h2>Account Parameter Setup</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-warning" href="{{ route('accountparams.index') }}">Back</a>
                    <a class="btn btn-success" href="{{ route('accountparams.create') }}">Add New Account Number</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="pull-right mb-2">   
        <form class="form-inline my-2 my-lg-0" type="get" action="{{url('/search')}}">
            <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search Account No.">
            <button class="btn btn-outline-bold my-2 my-sm-0" type="submit">Search</button>
        </form>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <th>No.</th> --}}
                    <th>Account Numbers</th>
                    <th>Institutions</th>
                    <th>Remarks</th>
                    <th>Date Recorded</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        {{-- <td>{{$company->id }}</td> --}}
                        <td>{{$company->account_no}}</td>
                        <td>{{$company->institution}}</td>
                        <td>{{substr($company->remarks, 0, 10)}}</td>
                        <td>{{$company->created_at}}</td>
                        <td>
                            <form action="{{ route('accountparams.destroy', $company->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('accountparams.edit', $company->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
