<?php

namespace App\Http\Controllers;

use App\Recibo;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Jenssegers\Date\Date;
use function MongoDB\BSON\toJSON;
use DB;
use Validator;

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

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect ( 'recibos/create' )
                ->withErrors ( $validator )
                ->withInput ();
        }

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
        $recibo->monto_recibo = $request->get ('efectivo')+ $request->get ('cheque') + $request->get ('otros');
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

        $fecha = new Date($recibo->created_at);


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
        $recibo->monto_recibo = $request->get ('efectivo')+ $request->get ('cheque') + $request->get ('otros');
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
