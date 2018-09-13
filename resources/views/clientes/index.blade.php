@extends ('layouts.app')
@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">


                <h3>Listado de Clientes <a href="clientes/create"><button class="btn btn-success">Nuevo</button></a></h3>
                @include('clientes.search')
                @include('flash::message')
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
                            <th>Opciones</th>
                        </thead>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{$cliente->id}}</td>
                                <td class="text-uppercase">{{$cliente->name}} {{$cliente->lastname}}</td>
                                <td>{{$cliente->email}}</td>
                                <td>{{$cliente->phone}}</td>
                                <td style="text-align: center">
                                    <a href="{{URL::action('ClienteController@edit',$cliente)}}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a>
                                    <a href="" data-target="#modal-delete-{{$cliente->id}}" data-toggle="modal" data-placement="top" title="Eliminar"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                </td>
                            </tr>
                            @include('clientes.modal')

                        @endforeach
                    </table>
                </div>
            </div>
            {{$clientes->render()}}
        </div>
    </div>
@endsection