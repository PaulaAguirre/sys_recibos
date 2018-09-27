@extends ('layouts.app')
@section ('content')

    <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Datos del Usuario</div>

                <div class="panel-body">
                    {!!Form::open(array('url'=>'users','method'=>'POST','autocomplete'=>'off'))!!}
                    {{Form::token()}}

                        <input type="hidden" name="url" value="{{URL::previous ()}}">

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" required value="{{old('name')}}" class="form-control text-uppercase" placeholder="Nombre del usuario">
                        </div>


                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" name="lastname" required value="{{old('lastname')}}" class="form-control text-uppercase" placeholder="Apellido del usuario">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required class="form-control" placeholder="user@email.com">
                        </div>

                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="phone"  value="{{old('phone')}}" class="form-control" placeholder="09xx xxxxxx">
                        </div>

                        <div class="form-group">
                            <label>Rol</label>
                            <select class="form-control" name="role_id" title="Seleccione un rol">
                                <option value="2">Admin</option>
                                <option value="1" selected>User</option>
                            </select>
                        </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password"   class="form-control" placeholder="*****">
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