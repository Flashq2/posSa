<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use Illuminate\Http\Request;
use App\Models\Modelcategory;
use App\Models\Modelitemgroup;
use App\Models\Permissionmodel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ItemGroupController extends Controller
{

    public function index()

    {
        $get = SettingModel::latest()->first();
        $lastesd = SettingModel::latest()->first('language');
        $lan = $lastesd->language;
        App::setlocale($lan);
        $datanew = Modelcategory::all();
        $getpermissioncode=Permissionmodel::where('code','=',Auth::user()->permission_code)->get();
        return view('item-group.item-group', compact('datanew','getpermissioncode','get'));
    }

    public function create(Request $request)
    {
        $data = new Modelitemgroup();
        $data->code = $request->input('code');
        $data->description = $request->input('mdes');
        $data->description_2 = $request->input('mdes2');
        $data->item_category_code = $request->input('category');
        $data->item_brand_code = $request->input('brandcode');
        $data->inactived = $request->input('active');
        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|unique:item_groups',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'status' => $validator->errors()->toArray()
            ]);
        }


        $data->save();
        return response()->json([]);
    }
    // public function store(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Modelitemgroup::latest()->get();
    //         return DataTables::eloquent(Modelitemgroup::query())
    //             ->addIndexColumn()

    //             ->addColumn('action', function ($row) {
    //                 $actionBtn = '<button class="edit" > Edit</button> <button class="delete"> Delete</button>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             //  rawColumns(['product_brand_logo'])
    //             ->make(true);
    //     }
    // }
    public function store(Request $request)
    {

        if ($request->ajax()) {
            $lastesd = SettingModel::latest()->first('language');
            $ge = Permissionmodel::where('code', '=', Auth::user()->permission_code)->get();
            $lan = $lastesd->language;
            if ($lan == 'en') {



                if ($ge[0]->update == 1 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(Modelitemgroup::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" > Edit</button> <button class="delete"> Delete  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 0 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(Modelitemgroup::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > Edit <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete"> Delete   </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 1 && $ge[0]->delete == 0) {
                  
                    return DataTables::eloquent(Modelitemgroup::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit"  > Edit </button> <button class="delete" style="pointer-events: none;"> Delete  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else {
                  
                    return DataTables::eloquent(Modelitemgroup::query())
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
                  
                    return DataTables::eloquent(Modelitemgroup::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" > កែប្រែ</button> <button class="delete"> លុប  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 0 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(Modelitemgroup::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > កែប្រែ <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete"> លុប  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 1 && $ge[0]->delete == 0) {
                  
                    return DataTables::eloquent(Modelitemgroup::query())
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit"  > កែប្រែ </button> <button class="delete" style="pointer-events: none;"> លុប  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else {
                     
                    return DataTables::eloquent(Modelitemgroup::query())
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


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = Modelitemgroup::find($id);
        return response()->json([
            'data' => $data
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = Modelitemgroup::find($id);
        $data->code = $request->input('code');
        $data->description = $request->input('mdes');
        $data->description_2 = $request->input('mdes2');
        $data->item_category_code = $request->input('category');
        $data->item_brand_code = $request->input('brandcode');
        $data->inactived = $request->input('active');
        $data->update();
        return response()->json([]);
    }


    public function destroy($id)
    {
        $data = Modelitemgroup::find($id);
        $data->delete();
        return response()->json([]);
    }
}
