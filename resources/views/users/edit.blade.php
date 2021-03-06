@extends ('layouts.app')
@section ('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Datos del user</div>

                    <div class="panel-body">
                        {!!Form::model ($user, ['method'=>'PATCH', 'route'=>['users.update', $user]])!!}
                        {{Form::token()}}


                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" required value="{{$user->name}}" class="form-control text-uppercase">
                        </div>


                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" name="lastname" required value="{{$user->lastname}}" class="form-control text-uppercase" >
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email"  value="{{$user->email}}" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="phone"  value="{{$user->phone}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Rol</label>
                            <select name="role_id" class="form-control">
                                @foreach($roles as $role)
                                    @if($user->role_id == $role->id)
                                        <option value="{{$role->id}}" selected>{{$role->nombre}}</option>
                                    @else
                                        <option value="{{$role->id}}" >{{$role->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <input name="_token" value="{{csrf_token()}}" type="hidden">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                            <button class="btn btn-danger" type="reset">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
@endsection