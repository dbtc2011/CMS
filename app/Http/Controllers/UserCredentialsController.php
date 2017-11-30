<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserCredentials;

class UserCredentialsController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */	
    public function index()
    {
        $userCreds = UserCredentials::latest()->paginate(100);
        return view('userCredentials.index',compact('userCreds'))
            ->with('i', (request()->input('page', 1) - 1) * 100);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userCredentials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	if ($request->hasFile('csv')) {

            $csvFile = $request->file('csv');
            $fileName = $csvFile->getClientOriginalName();
            $csvFile->move('uploads', $fileName);

            $path = base_path().'/public/uploads/'.$fileName;

            Excel::load('/public/uploads/'.$fileName, function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $newUC = new UserCredentials;
                    $newUC->code = $row['code'];
                    $newUC->name = $row['name'];
                    $newUC->password = $row['password'];
                    $newUC->save();
                }
            });

       	 	return redirect()->route('userCredentials.index')
                        	->with('success','User Credentials imported successfully');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $userCredentials = DB::table('user_credentials')->where('code',$code)->first();
        return view('userCredentials.edit',compact('userCredentials'));
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
        request()->validate([
            'code' => 'required',
            'name' => 'required',
            'password' => 'required',
        ]);
        UserCredentials::find($id)->update($request->all());
        return redirect()->route('userCredentials.index')
                        ->with('success','User Credentials updated successfully');
    }
}
