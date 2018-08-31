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
                            <th>Estado</th>
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
                                <td>{{$recibo->estado}}</td>
                                <td>{{$recibo->created_at->format('d-m-Y')}}</td>
                                <td style="text-align: center">
                                    <a href="{{URL::action('ReciboController@show',$recibo)}}"><button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Imprimir"><i class="fa fa-print" aria-hidden="true"></i></button></a>
                                    <a href="{{URL::action('ReciboController@edit',$recibo)}}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{$recibos->render()}}
            </div>
        </div>
    </div>
@endsection