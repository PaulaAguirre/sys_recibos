@extends ('layouts.app')
@section ('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Datos del cliente</div>

                    <div class="panel-body">
                        {!!Form::model ($cliente, ['method'=>'PATCH', 'route'=>['clientes.update', $cliente]])!!}
                        {{Form::token()}}


                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" required value="{{$cliente->name}}" class="form-control text-uppercase" placeholder="Nombre del cliente">
                        </div>


                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" name="lastname" required value="{{$cliente->lastname}}" class="form-control text-uppercase" placeholder="Apellido del cliente">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email"  value="{{$cliente->email}}" class="form-control" placeholder="cliente@email.com">
                        </div>

                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="phone"  value="{{$cliente->phone}}" class="form-control" placeholder="09xx xxxxxx">
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