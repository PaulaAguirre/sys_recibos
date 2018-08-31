<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Recibo;
use Laracasts\Flash\Flash;
class ClienteController extends Controller
{
    /**
     * ClienteController constructor.
     */
    public function __construct ()
    {
        $this->middleware ('roles:2')->except (['index', 'create', 'store', 'edit', 'update']);
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
            $clientes = User::where('tipo_user', '=', 'cliente')
                ->Where  ('name', 'like', '%'.$query.'%')
                ->orderBy ('id', 'ASC')->paginate (7);
        }

        //dd ($clientes);
        return view ('clientes.index', ['clientes'=>$clientes, 'searchText'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $anterior_url = $request->get ('url');
        $cliente = new User($request->all ());
        $cliente->save ();

        return redirect ($anterior_url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $cliente)
    {
        return view ('clientes.edit', ['cliente'=>$cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $cliente)
    {
        $cliente->fill ($request->all ());
        $cliente->update ();
        return redirect ('clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = User::findOrFail ($id);
        $recibos = Recibo::all ();

        if($recibos->contains ('user_id', $id))
        {
            Flash::error('Error: el cliente tiene recibos asociados');
            return redirect ()->back ()->with('error', 'El cliente tiene recibos asociados');
        }
        else
        {
            $cliente->delete ();
            return redirect ()->back ();
        }

    }
}
