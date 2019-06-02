<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        $loggedUser=Auth::User();
        return view('admin.users.index',compact('users','loggedUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loggedUser=Auth::User();
        return view('admin.users.create',compact('loggedUser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required'
        ]);
        $input=$request->all();
        $input['password']=Hash::make($request->password);
        User::Create($input);
        $request->session()->flash('created_user','User has been created successfully');
        return redirect('admin/users');
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
    public function edit($id)
    {
        $user=User::findOrFail($id);
        $loggedUser=Auth::User();
        return view('admin.users.edit',compact('user','loggedUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
            'name'=>'required',
            'email'=>'required',
        ]);
        $input=[];
        $input['name']=$request->name;
        $input['email']=$request->email;
        if($request->password){
        $input['password']=$request->password;
        }
        $input['role']=$request->role;
        User::where('id',$id)->update($input);
        $request->session()->flash('updated_user','User has been updated successfully');
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $posts=Post::where('user_id',$id)->get();
        foreach($posts as $post){
            $post->delete();
        }
        User::where('id',$id)->delete();
        $request->session()->flash('deleted_user','User has been deleted successfully');
        return redirect('admin/users');
    }
}
