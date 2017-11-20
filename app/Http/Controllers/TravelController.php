<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Travel;



class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = Travel::all();
        
        return view('Travels.index', compact('travels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        
        $user = User::create([
                'name'      => $request['name'],                
                'email'     => $request['email'],
                'password'  => bcrypt($request['password']),
            ]);
             
            
        return redirect()->route('get_all_users')->with('message', 'New User Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = User::findOrFail($id);

       return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name      = $request['name'];                
        $user->email     = $request['email'];
        $user->password  = bcrypt($request['password']);
        
        $user->save();
             

        return redirect()->route('get_all_users')->withSuccess('New User Successfully Created');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $user = User::find($user_id);        
        $user->delete();
        
        return redirect()->route('get_all_users')->with(['success'=>'User successfully deleted!']);
    }
}
