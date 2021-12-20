<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Admin dashboard</title>
</head>
<body>

<div class="container">

    @if(session('message'))
        <div class="alert alert-success mt-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="row text-center">
        <div class="col-md-12 mt-4">
            <h3>Admin dashboard</h3>
        </div>
    </div>

    <div class="row-sm-12 mt-4">
        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="users/edit/{{$user->id}}" class="btn btn-outline-primary btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="app">
    <vue-example-name></vue-example-name>
</div>

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
