@extends ('layouts.app')
@section ('content')

    <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Recibo #{{$ultimo_numero+1}}</div>

                <div class="panel-body">
                    {!!Form::open(array('url'=>'recibos','method'=>'POST','autocomplete'=>'off'))!!}
                    {{Form::token()}}
                        <div class="form-group">
                            <label for="nombre">Cliente</label>
                            <select name="user_id" class="form-control text-uppercase selectpicker" title="Seleccione cliente" data-live-search="true" >
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{strtoupper ($cliente->name.' '.$cliente->lastname)}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="descripcion">Concepto</label>
                            <input type="text" name="concepto" required value="{{old('concepto')}}" class="form-control text-uppercase" placeholder="Concepto">
                        </div>


                        <div class="form-group">
                            <label>Monto Efectivo</label>
                            <input type="number" name="efectivo" required value="{{old('efectivo')}}" class="form-control text-uppercase" placeholder="monto efectivo recibido">
                        </div>
                    <div class="form-group">
                        <label>Monto Cheque</label>
                        <input type="number" name="cheque" required  value="{{old('cheque')}}" class="form-control text-uppercase" placeholder="monto cheque recibido">
                    </div>
                    <div class="form-group">
                        <label>Otros medios de pago</label>
                        <input type="number" name="otros" required value="{{old('otros')}}" class="form-control text-uppercase" placeholder="monto otros medios de pago">
                    </div>

                        <div class="form-group">
                            <label>Monto Saldo</label>
                            <input type="number" name="monto_saldo" required value="{{old('monto_saldo')}}" class="form-control text-uppercase" placeholder="monto del saldo">
                        </div>


                        <div class="form-group">
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