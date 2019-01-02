<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\User;
use App\Students;
use Session;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
           return Students::orderBy('id', 'desc')->paginate($request->perPage);
        }
        return view('student.student');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required|numeric',
            ], [
                'name.required' => 'The Name field is required.',
                'email.required' => 'The Email field is required.',
                'mobile.required' => 'The Mobile field is required.',
            ]);

        try {
            DB::beginTransaction();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
        ];
        Students::create($data);

        DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Save student info']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Something Error Found !, Please try again']);
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return Students::FindOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required|numeric',
            ], [
                'name.required' => 'The Name field is required.',
                'email.required' => 'The Email field is required.',
                'mobile.required' => 'The Mobile field is required.',
            ]);

        try {
            DB::beginTransaction();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
        ];
        Students::FindOrFail($id)->update($data);

        DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Update student info']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Something Error Found !, Please try again']);
        }
    }

    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            Students::find($id)->delete(); 

            DB::commit();
            return response()->json(['status'=>'success','message'=>'Student Info successfully deleted !']);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['status'=>'error','message'=>'Something Error Found !, Please try again']);
        }
    } 

    public function deleteMarkData(Request $request)
    {
     
        try{
            DB::beginTransaction();
            Students::whereIn('id', $request->all())->delete(); 

            DB::commit();
            return response()->json(['status'=>'success','message'=>'Student Info successfully deleted !']);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['status'=>'error','message'=>'Something Error Found !, Please try again']);
        }
    }
}
