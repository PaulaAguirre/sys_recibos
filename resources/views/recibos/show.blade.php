<html lang="es">
<head>
   <style>
       body{
           background-color:#DEDEDE;
           padding-top:20px;
           padding-bottom:20px;
           font-family:"Arial";
       }
       #page1{
           width:165mm; /*210-40*/
           height:237.4mm; /*297.4-60*/
           background-color:white;
           padding:20mm 20mm 20mm 20mm;
           margin-left:auto;
           margin-right:auto;
           box-shadow: 0 0 50px #888888;
       }

       header{height:18%;border-bottom:1px solid #000000;}
       header>div{float:left;padding-top:8px;}
       header div.left, header div.right{width:40%;}
       header div.center{width:calc(20% - 2px);border-left:1px solid #000000; border-right:1px solid #000000;}
       section{padding-top:20px;padding-bottom:20px;}
       section, pre{margin:0px;}
       .bordeRecibo section{padding:20px;}
       footer{position:absolute; bottom:0;left:0;right:0;padding:20px 0px 20px 0px;} /*Para que el footer llegue hasta abajo*/
       img{margin-bottom:2px;height:85px;max-width:208;}

       .column{height: calc(100% - 8px);}
       .row{left:0;right:0;position:relative;}
       .text-center{text-align:center;}
       .text-left{text-align:left;}
       .text-right{text-align:right;}
       .negrita{font-weight:bold;}
       .preimpreso{color:#999999;text-transform:uppercase;}
       .h1{font-size:25px;}
       .h2{font-size:20px;}
       .h3{font-size:12px;}
       .container{margin:0 20px 0 20px;}
       .bordeRecibo{border:1px solid #000000;margin:0;padding:0;height:100%;position:relative;} /*Para que el footer llegue hasta abajo*/
       .pull-right{position:absolute;right:0;}

       #tipoComprobante{font-size:50px;}
       #leyendaTipoComprobante{font-size:10px;}
       #tipoComprobante, #lblComprobante{line-height:70%;}
       #lblNroCmp{line-height:200%;}
       #hr{width:30%;border-top:1px solid #000000;height:1px;position:absolute;right:20px;}
       #firma{padding-top:30mm;position:relative;}

       .importeEnPesos:before{content:'$';}

       @media screen{
           body{background-color:#DEDEDE;}
           #page1{box-shadow: 0 0 50px #888888;padding:20mm 18mm 18mm 20mm;}
       }
       @media print{
           body{background-color:#FFFFFF;/*font-family:"Verdana";*/}
           #page1{box-shadow:none;padding:0;}
           button, #botonera{display:none;}
       }


       /*BOTONERA*/
       button{
           color:#FFFFFF;
           background-color:#428BCA;
           border: 1px solid #357EBD;
           padding:6px 12px;
           margin-bottom:5px;
           text-align: center;
           cursor: pointer;
           font-weight:bold;
       }

       #botonera{
           z-index:999;
           position:absolute;
           left:10px;
           top:10px;
       }
   </style>
</head>

<body>
<div id="botonera">
    <button onClick="javascript:window.print();">Imprimir</button>
</div>

<div id="page1">

    <div class="bordeRecibo">
        <header>

            <!-- Lado Izquierdo -->
            <div class="column left">
                <div class="container">
                   <h2>Consultora DC</h2>
                    <div class="row text-left negrita h3"></div>
                    <div class="row text-left h3">Jacaranda e/ Tajy</div>
                    <div class="row text-left h3">San Lorenzo - Paraguay</div>
                    <div class="row text-left h3">Telefono: (0981) 182 159</div>
                </div>
            </div>

            <!-- Lado Central -->
            <div class="column center text-center"> <span id="tipoComprobante">X</span>
                <br>
                <span id="leyendaTipoComprobante" class="preimpreso">DOCUMENTO<br>NO VALIDO<br>COMO<br>FACTURA</span>
            </div>

            <!-- Lado Derecho -->
            <div class="column right">
                <div class="container">
                    <div id="lblComprobante" class="row text-center negrita h1">RECIBO</div>
                    <div id="lblNroCmp" class="row text-center negrita h2"><span class="preimpreso">Número </span>{{'000'.$recibo->numero_recibo}}</div>
                    <div class="row text-center h3">ORIGINAL</div>
                    <div class="row text-center h3">&nbsp;</div>
                    <div class="row text-left h3">FECHA <span class="pull-right">{{$recibo->created_at->format('d-m-Y')}}</span></div>
                    <div class="row text-left h3">Monto Recibo <span class="pull-right">{{number_format ($recibo->monto_recibo,0, ",", ".")}}</span></div>

                </div>
            </div>
        </header>

        <section>{{$fecha}}
            <br>
            <br>
            <span class="preimpreso">Recibimos de</span> Sr Juan Martinez
            <br>
            <span class="preimpreso">la cantidad de </span><span id="importeEnLetras">20.000 Gs</span>
        </section>

        <section id="sectionMedioPago">
            <span class="preimpreso">Mediante</span>
            <div class="row">
                <span>Efectivo</span>
                <span class="pull-right negrita importeEnPesos">500.000</span>
            </div>
            <div class="row">
                <span>Transferencia Bancaria</span>
                <span class="pull-right negrita importeEnPesos">0</span>
            </div>
        </section>

        <section>
            <span class="preimpreso">En concepto de</span>
            <div class="row">
                <span>producto y servicio</span>
                <span name="a" class="pull-right negrita importeEnPesos">500.000</span>
            </div>


        </section>

        <footer>

            <section id="son"> <span class="preimpreso">SON:</span>
                <output id="totalRecibo" class="negrita importeEnPesos">500.000</output>
            </section>

            <section id="firma">
                <div id="hr" class="pull-right">&nbsp;</div>
                <p class="text-right">firma</p>
            </section>

        </footer>
    </div><!-- bordeRecibo -->
</div><!-- Page1 -->

<div id="page1" style="page-break-before: always">

    <div class="bordeRecibo">
        <header>

            <!-- Lado Izquierdo -->
            <div class="column left">
                <div class="container">
                    <h2>Consultora DC</h2>
                    <div class="row text-left negrita h3"></div>
                    <div class="row text-left h3">Jacaranda e/ Tajy</div>
                    <div class="row text-left h3">San Lorenzo - Paraguay</div>
                    <div class="row text-left h3">Telefono: (0981) 182 159</div>
                </div>
            </div>

            <!-- Lado Central -->
            <div class="column center text-center"> <span id="tipoComprobante">X</span>
                <br>
                <span id="leyendaTipoComprobante" class="preimpreso">DOCUMENTO<br>NO VALIDO<br>COMO<br>FACTURA</span>
            </div>

            <!-- Lado Derecho -->
            <div class="column right">
                <div class="container">
                    <div id="lblComprobante" class="row text-center negrita h1">RECIBO</div>
                    <div id="lblNroCmp" class="row text-center negrita h2"><span class="preimpreso">Nro</span> 0001 - 00000168</div>
                    <div class="row text-center h3">ORIGINAL</div>
                    <div class="row text-center h3">&nbsp;</div>
                    <div class="row text-left h3">FECHA <span class="pull-right">12/11/2013</span></div>
                    <div class="row text-left h3">CUIT <span class="pull-right">22-22222222-2</span></div>
                    <div class="row text-left h3">INGRESOS BRUTOS <span class="pull-right">33-33333333-3</span></div>
                    <div class="row text-left h3">INICIO DE ACTIVIDADES <span class="pull-right">01/01/1759</span></div>
                </div>
            </div>
        </header>

        <section>Rosario, 11 de Noviembre de 2013
            <br>
            <br>
            <span class="preimpreso">Recibimos de</span> Sr Juan Martinez
            <br>
            <span class="preimpreso">la cantidad de </span><span id="importeEnLetras">20.000 Gs</span>
        </section>

        <section id="sectionMedioPago">
            <span class="preimpreso">Mediante</span>
            <div class="row">
                <span>Efectivo</span>
                <span class="pull-right negrita importeEnPesos">500.000</span>
            </div>
            <div class="row">
                <span>Transferencia Bancaria</span>
                <span class="pull-right negrita importeEnPesos">0</span>
            </div>
        </section>

        <section>
            <span class="preimpreso">En concepto de</span>
            <div class="row">
                <span>producto y servicio</span>
                <span name="a" class="pull-right negrita importeEnPesos">500.000</span>
            </div>


        </section>

        <footer>

            <section id="son"> <span class="preimpreso">SON:</span>
                <output id="totalRecibo" class="negrita importeEnPesos">500.000</output>
            </section>

            <section id="firma">
                <div id="hr" class="pull-right">&nbsp;</div>
                <p class="text-right">firma</p>
            </section>

        </footer>
    </div><!-- bordeRecibo -->
</div><!-- Page1 -->
</body>
</html>