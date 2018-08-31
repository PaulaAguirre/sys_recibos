<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use DB;
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct ()
    {
        $this->middleware ('roles:2')->except ('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request)
        {
            $query = trim ( $request->get ( 'searchText' ) );
            $users = User::with ('role')->where ('tipo_user', '=', 'empresa')
                ->where ('name', 'like', '%'.$query.'%')
                ->paginate (7);
        }

        //dd ($users->first()->role->nombre);
        return view ('users.index', ['users'=>$users,'searchText' => $query ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User($request->all ());
        $password = $request->get ('password');
        $user->password = bcrypt ($password);
        $user->tipo_user = 'empresa';
        $user->save ();

        return redirect ('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all ();
        return view ('users.edit', ['user' =>$user, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill ($request->all ());
        $user->update ();
        return redirect ('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $user = User::findOrFail ($id);
        $user->delete ();
        return redirect ('users');
    }
}
