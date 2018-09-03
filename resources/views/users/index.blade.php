@extends ('layouts.app')
@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h3>Listado de Usuarios <a href="users/create"><button class="btn btn-success">Nuevo</button></a></h3>
                @include('users.search')
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #8eb4cb">
                            <th class="col-lg-1">#id</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th>Opciones</th>
                        </thead>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td class="text-uppercase">{{$user->name}} {{$user->lastname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->role->nombre}}</td>
                                <td style="text-align: center">
                                    <a href="{{URL::action('UserController@edit',$user)}}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a>
                                    <a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                </td>
                            </tr>
                            @include('users.modal')
                        @endforeach
                    </table>
                </div>
            </div>
            {{$users->render()}}
        </div>
    </div>
@endsection