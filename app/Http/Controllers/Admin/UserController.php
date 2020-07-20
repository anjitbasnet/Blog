<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\admin;
use App\Model\admin\role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');

    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = admin::all(); 
        return view('admin.user.show',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (Auth::user()->can('posts.addAdminUser')) {
            $roles = role::all();
            return view('admin.user.create',compact('roles'));
        }

            return redirect(route('admin.home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
            // 'image' =>'required',
        ]);

        // if ($request->hasFile('image')) {

        //    $imageName = $request->image->store('public');
        // }

        $request['password'] = bcrypt($request->password);
        $user = admin::create($request->all());
        // dd($user);
        $user->roles()->sync($request->role);
        return redirect(route('user.index'))->with('message','User Created Successfully');
        // $user = new admin();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->phone = $request->phone;
        // $user->password = bcrypt($request->password);
        // $user->save();

        // return redirect(route('user.index'));
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
        if (Auth::user()->can('posts.updateAdminUser')) {
            $user = admin::find($id);
            $roles = role::all();
            return view ('admin.user.edit',compact('user','roles'));
        }

            return redirect(route('admin.home'));
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
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
        ]);

        // if ($request->hasFile('image')) {

        //    $imageName = $request->image->store('public');
        // }

        $request->status? : $request['status']=0;
        $user = admin::where('id',$id)->update($request->except('_token','_method','role'));
        admin::find($id)->roles()->sync($request->role);
        return redirect(route('user.index'))->with('message','User Updated Successfully');

        // $user = admin::find($id);


        // $user->name = $request->name;

        // $user->email = $request->email;

        // $user->phone = $request->phone;

        // $user->status = $request->status;

        // $user->image = $imageName;

        // $user->roles()->sync($request->roles);
        
        // $user->save();

        //  return redirect(route('user.index'))->with('message','User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        admin::where('id',$id)->delete();
        return redirect()->back()->with('message','User Deleted Successfully');
    }
}
