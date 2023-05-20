<?php

namespace App\Http\Controllers;

use App\Models\Uommodel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use App\Models\Permissionmodel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UomControll extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $get = SettingModel::latest()->first();

        $lastesd = SettingModel::latest()->first('language');
        $lan = $lastesd->language;
        App::setlocale($lan);
        $getpermissioncode=Permissionmodel::where('code','=',Auth::user()->permission_code)->get();
        return view('uom.uom',compact('getpermissioncode','get'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Uommodel::latest()->get();
    //         return DataTables::eloquent(Uommodel::query())
    //             ->addIndexColumn()
              
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<button class="edit" > Edit</button> <button class="delete"> Delete</button>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //          //  rawColumns(['product_brand_logo'])
    //             ->make(true);
    //     }
    // }
    public function create(Request $request)
    {

        if ($request->ajax()) {
            $lastesd = SettingModel::latest()->first('language');
            $ge = Permissionmodel::where('code', '=', Auth::user()->permission_code)->get();
            $lan = $lastesd->language;
            if ($lan == 'en') {



                if ($ge[0]->update == 1 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(
                        Uommodel::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" > Edit</button> <button class="delete"> Delete  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 0 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(
                        Uommodel::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > Edit <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete"> Delete   </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 1 && $ge[0]->delete == 0) {
                  
                    return DataTables::eloquent(
                        Uommodel::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit"  > Edit </button> <button class="delete" style="pointer-events: none;"> Delete  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else {
                  
                    return DataTables::eloquent(
                        Uommodel::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > Edit <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete" style="pointer-events: none;"> Delete  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
            } else {


                if ($ge[0]->update == 1 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(
                        Uommodel::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" > កែប្រែ</button> <button class="delete"> លុប  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 0 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(
                        Uommodel::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > កែប្រែ <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete"> លុប  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 1 && $ge[0]->delete == 0) {
                  
                    return DataTables::eloquent(
                        Uommodel::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit"  > កែប្រែ </button> <button class="delete" style="pointer-events: none;"> លុប  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else {
                     
                    return DataTables::eloquent(
                        Uommodel::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > កែប្រែ <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete" style="pointer-events: none;"> លុប  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new Uommodel();
        $data->code=$request->input('code');
        $data->description=$request->input('des');
         $data->description_2=$request->input('des2');
        $data->factor=$request->input('factor');
        $data->inactived=$request->input('active');
        $validator=Validator::make($request->all(),[
            'code'=>'required|unique:unit_of_measures'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>$validator->errors()->toArray()
            ]);
        }
        $data->save();
        return response()->json([

        ]);

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
        $data=Uommodel::find($id);
        return response()->json([
            'data'=>$data,
        ]);
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
        $data=Uommodel::find($id);
        $data->code=$request->input('code');
        $data->description=$request->input('des');
        $data->description_2=$request->input('des2');
        $data->factor=$request->input('factor');
        $data->inactived=$request->input('active');
        $data->update();
        return response()->json([

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Uommodel::find($id);
        $data->delete();
        return response()->json([

        ]);
    }

}
