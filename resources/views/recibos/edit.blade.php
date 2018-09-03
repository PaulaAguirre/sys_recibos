@extends ('layouts.app')
@section ('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Recibo #{{$recibo->numero_recibo}}</div>

                    <div class="panel-body">
                        {!!Form::model ($recibo, ['method'=>'PATCH', 'route'=>['recibos.update', $recibo]])!!}
                        {{Form::token()}}
                        <div class="form-group">
                            <label for="nombre">Cliente</label>
                            <select name="user_id" class="form-control text-uppercase selectpicker" title="Seleccione cliente" data-live-search="true" >
                                @foreach($clientes as $cliente)
                                @if($recibo->user_id == $cliente->id)
                                    <option value="{{$cliente->id}}" selected>{{$cliente->name .' '. $cliente->lastname}}</option>
                                @else
                                    <option value="{{$cliente->id}}">{{$cliente->name.' '.$cliente->lastname}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="descripcion">Concepto</label>
                            <input type="text" name="concepto" required value="{{$recibo->concepto}}" class="form-control text-uppercase" placeholder="Concepto">
                        </div>


                        <div class="form-group">
                            <label>Monto Efectivo</label>
                            <input type="number" name="efectivo" required value="{{$recibo->efectivo}}" class="form-control text-uppercase" placeholder="efectivo recibido">
                        </div>
                        <div class="form-group">
                            <label>Monto Cheque</label>
                            <input type="number" name="cheque" required value="{{$recibo->cheque}}" class="form-control text-uppercase" placeholder="cheque recibido">
                        </div>
                        <div class="form-group">
                            <label>Otros medios de pago</label>
                            <input type="number" name="otros" required value="{{$recibo->otros}}" class="form-control text-uppercase" placeholder="otros">
                        </div>

                        <div class="form-group">
                            <label>Monto Saldo</label>
                            <input type="number" name="monto_saldo" required value="{{$recibo->monto_saldo}}" class="form-control text-uppercase" placeholder="monto del saldo">
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" class="form-control">
                                    <option value="activo" selected>activo</option>

                                    <option value="anulado">anulado</option>
                            </select>
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