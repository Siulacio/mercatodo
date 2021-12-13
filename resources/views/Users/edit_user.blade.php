<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--    <script src="https://cdn.tailwindcss.com"></script>--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin dashboard</title>
</head>
<body>

<div class="container">

    <div class="row text-center mt-4">
        <div class="col-md-12">
            <h4>Edit User {{$user->name}}</h4>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-sm-4">&nbsp;</div>
        <div class="col-sm-4">

            <form action="{{route('user.update')}}" method="post">
                @csrf
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
                </div>

                <div class="mt-3">
                    <label for="last_name">Last name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{$user->last_name}}">
                </div>

                <div class="mt-3">
                    <label for="identification">Identification</label>
                    <input type="text" id="identification" name="identification" class="form-control" value="{{$user->identification}}" disabled>
                </div>

                <div class="mt-3">
                    <label for="phone">Address</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{$user->address}}">
                </div>

                <div class="mt-3">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{$user->phone}}">
                </div>

                <div class="mt-3">
                    <label for="name">Email</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$user->email}}" disabled>
                </div>

                <div class="mt-4">
                    <input type="submit" class="btn btn-sm btn-outline-primary" value="Guardar">
                    <a href="{{route('admin.index')}}" class="btn btn-sm btn-outline-danger">Regresar</a>
                </div>

                <input type="hidden" name="id" id="id" value="{{$user->id}}">

            </form>
        </div>
        <div class="col-sm-4">&nbsp;</div>
    </div>
</div>
</body>
</html>
