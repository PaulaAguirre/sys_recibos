<?php

namespace App\Http\Controllers;

use App\Recibo;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use function MongoDB\BSON\toJSON;
use DB;


class ReciboController extends Controller
{
    /**
     * ReciboController constructor.
     */
    public function __construct ()
    {
        return $this->middleware ('roles:2')->only (['edit', 'update']);
    }

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
            $clientes = DB::table ('users')->where ('tipo_user', '=', 'cliente')
                ->where ('name', 'like','%'.$query.'%')
                ->orWhere ('lastname', 'like','%'.$query.'%')
                ->select ('id');

            $recibos = Recibo::with ('cliente')->where('numero_recibo','like','%'.$query.'%' )
            ->orWhereIn('user_id', $clientes)
            ->orderBy ('numero_recibo', 'DESC')->paginate (7);

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

        if(!$ultimo_recibo)
        {
            $ultimo_numero = 0;
        }
        else
        {
            $ultimo_numero = $ultimo_recibo->numero_recibo;
        }

        $clientes = User::where('tipo_user', '=', 'cliente')->get ();
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

        if (!$recibo_anterior){
            $numero_anterior = 0;
        }
        else
        {
            $numero_anterior = $recibo_anterior->numero_recibo;
        }

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
        $fecha = $recibo->created_at->format('l jS \\of F Y');
        //$pdf = PDF::loadView ('recibos.show', ['recibo' => $recibo, 'cliente' => $cliente]);


        //return $pdf->stream();

        return view ('recibos.show', ['cliente'=>$cliente, 'recibo'=>$recibo, 'fecha'=>$fecha]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function edit(Recibo $recibo)
    {
        $clientes = User::where('tipo_user', '=', 'cliente')->get ();

        return view ('recibos.edit', ['recibo'=>$recibo, 'clientes'=>$clientes]);

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
        $recibo->fill ($request->all ());
        $recibo->update();

        return redirect ('recibos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recibo $recibo)
    {
        $recibo->delete ();
        return redirect ()->back ();
    }
}
