<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\UserInfo;
use App\Cv;
use XBase\Table;
use Excel;
use Input;

class UserInfoController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $userInfo = Cv::latest()->paginate(100);
        return view('userInfo.index',compact('userInfo'))
            ->with('i', (request()->input('page', 1) - 1) * 100);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userInfo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate([
          //  'title' => 'required',
            //'body' => 'required',
        //]);
        // For DBF
        // if ($request->hasFile('dbf')) {
        //     $dbfFile = $request->file('dbf');
        //     $fileName = $dbfFile->getClientOriginalName();

        //     $dbfFile->move('uploads', $fileName);
        //     $table = new Table(dirname(base_path()).'/CMS/public/uploads/'.$fileName, array('mem_code', 'acc_code','debit', 'credit', 'chk_no', 'doc_date'));
        //     while ($record = $table->nextRecord()) {
        //         $newCV = new Cv;
        //         $newCV->mem_code = $record->getChar("mem_code");
        //         $newCV->acc_code = $record->getChar("acc_code");
        //         $newCV->credit = $record->getChar("credit");
        //         $newCV->debit = $record->getChar("debit");
        //         $newCV->chk_no = $record->getChar("chk_no");
        //         $newCV->doc_date = $record->getChar("doc_date");
        //         $newCV->save();
        //     }
        // }

        if ($request->hasFile('csv')) {

            $csvFile = $request->file('csv');
            $fileName = $csvFile->getClientOriginalName();
            $csvFile->move('uploads', $fileName);

            $path = base_path().'/public/uploads/'.$fileName;

            Excel::load('/public/uploads/'.$fileName, function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    
                    echo $key;
                    echo $row[0];

                }
                exit();
            });

        }
        return redirect()->route('userInfo.index')
                        ->with('success','User Info created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = UserInfo::find($id);
        return view('userInfo.show',compact('userInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = UserInfo::find($id);
        return view('userInfo.edit',compact('userInfo'));
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
            'title' => 'required',
            'body' => 'required',
        ]);
        UserInfo::find($id)->update($request->all());
        return redirect()->route('userInfo.index')
                        ->with('success','User Info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();
        return redirect()->route('userInfo.index')
                        ->with('success','User Info deleted successfully');
    }
}
