<html>
<head>
    <style>
        body{
            font-family: sans-serif;
        }
        @page {
            margin: 160px 50px;
        }
        header { position: fixed;
            left: 2px;
            top: -150px;
            right: 2px;
            height: 120px;
            background-color: #ddd;
            text-align: center;
        }
        header h1{
            margin: 10px 0;
        }
        header h2{
            margin: 0 0 10px 0;
            float: left;
        }
        footer {
            position: fixed;
            left: 0px;
            bottom: -50px;
            right: 0px;
            height: 40px;
            border-bottom: 2px solid #ddd;
        }
        footer .page:after {
            content: counter(page);
        }
        footer table {
            width: 100%;
        }
        footer p {
            text-align: right;
        }
        footer .izq {
            text-align: left;
        }

        #izquierda{
            float: left;
            margin-left: 0px;
           margin-top: 10%;
        }

        #derecha{
            float: right;
            margin-right: 50px;
            margin-left:50px;
        }
         .alineacion_izquierda{
             float: left;
             margin-left:50px;
         }

        .top{
            margin-top: 30%;
            text-align: center;
        }



    </style>
<body>
<header>
    <h1>Recibo de Dinero</h1>
        <h2 >Número de Recibo: {{$recibo->numero_recibo}}</h2>
        <h2 style="float: right" >Fecha: {{$recibo->created_at->format('d-m-Y')}}</h2>


</header>
<footer>
    <table>
        <tr>
            <td>
                <p class="izq">
                    Nombre de la Empresa
                </p>
            </td>
            <td>
                <p class="page">
                    Copia
                </p>
            </td>
        </tr>
    </table>
</footer>
<div id="content">
    <div class="alineacion_izquierda">
        <b>Recibí del Sr: </b><p>{{$cliente->name. ' '. $cliente->lastname}}</p>
        <b>La suma de Gs. </b><p>{{$recibo->monto_recibo}}</p>
        <b>En concepto de:</b><p>{{$recibo->concepto}}</p>
        <div>
            <div id="izquierda"><b>Monto Recibo:</b><p>20000</p></div>
            <div id="derecha"><b>Monto Saldo:</b><p>10000</p></div>
            <div class="top" >
                <p>..................................................</p><b>Firma</b>
            </div>
        </div>

    </div>

    <div class="container" style="page-break-before: always">

        <div class="alineacion_izquierda">
            <b>Recibí del Sr: </b><p>{{$cliente->name. ' '. $cliente->lastname}}</p>
            <b>La suma de Gs. </b><p>{{$recibo->monto_recibo}}</p>
            <b>En concepto de:</b><p>{{$recibo->concepto}}</p>
            <div>
                <div id="izquierda"><b>Monto Recibo:</b><p>20000</p></div>
                <div id="derecha"><b>Monto Saldo:</b><p>10000</p></div>
                <div class="top" >
                    <p>..................................................</p><b>Firma</b>
                </div>
            </div>

        </div>

    </div>
</div>
</body>
</html>