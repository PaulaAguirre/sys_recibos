@extends ('layouts.app')
@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h3>Listado de Recibos <a href="recibos/create"><button class="btn btn-success">Nuevo</button></a></h3>
                @include('recibos.search')
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #8eb4cb">
                            <th class="col-lg-1">#Recibo</th>
                            <th>Cliente</th>
                            <th>Concepto</th>
                            <th>Monto Recibo</th>
                            <th>Monto Saldo</th>
                            <th>Fecha</th>
                            <th>Opciones</th>
                        </thead>
                        @foreach($recibos as $recibo)
                            <tr>
                                <td>{{$recibo->numero_recibo}}</td>
                                <td>{{$recibo->cliente->name}} {{$recibo->cliente->lastname}}</td>
                                <td>{{$recibo->concepto}}</td>
                                <td>{{$recibo->monto_recibo}}</td>
                                <td>{{$recibo->monto_saldo}}</td>
                                <td>{{$recibo->created_at->format('d-m-Y')}}</td>
                                <td>
                                    <a href="{{URL::action('ReciboController@show',$recibo)}}"><button class="btn btn-info">Imprimir</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection