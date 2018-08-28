<?php

namespace App\Http\Controllers;

use App\Recibo;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;


class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request)
        {
            $query = trim ($request->get ('searchText'));
            $recibos = Recibo::all();

        }
        return view ('recibos.index', ['recibos'=> $recibos, 'searchText'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ultimo_recibo = Recibo::all ()->last();
        $ultimo_numero = $ultimo_recibo->numero_recibo;
        $clientes = User::where('tipo_user', '=', 'cliente')->get ();
       // dd ($ultimo_numero);
        return view ('recibos.create', ['clientes'=>$clientes, 'ultimo_numero'=>$ultimo_numero]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recibo_anterior = Recibo::all ()->last();
        $numero_anterior = $recibo_anterior->numero_recibo;

        $recibo = new Recibo($request->all ());
        $recibo->numero_recibo =$numero_anterior+1;
        $recibo->fecha = Carbon::now ();
        $recibo->save ();
        return redirect ('recibos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function show(Recibo $recibo)
    {
        $cliente = $recibo->cliente;
        $pdf = PDF::loadView ('recibos.show', ['recibo' => $recibo, 'cliente' => $cliente]);


        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function edit(Recibo $recibo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recibo $recibo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recibo $recibo)
    {
        //
    }
}
