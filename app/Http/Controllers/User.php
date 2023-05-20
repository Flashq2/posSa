<?php

namespace App\Http\Controllers;

use App\Models\Modelgetuser;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use App\Models\Modeluserrole;
use App\Models\Permissionmodel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get = SettingModel::latest()->first();
        $lastesd=SettingModel::latest()->first('language');
        $lan=$lastesd->language;
        
        App::setlocale($lan);
        $alluser=Modelgetuser::all();
        $userrole=Modeluserrole::all();
        $lastesd=Modelgetuser::latest()->first();
        $permiss=Permissionmodel::where('inactived','yes')
        ->get();
         return view('user',compact('alluser','userrole','lastesd','permiss','get'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $add=new Modelgetuser();
        // $add->id=
        
    }
    // public function getuser(Request $request){
    //     $data="";
    //     if ($request->ajax()) {
    //         $data =Modelgetuser::latest()->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<button class="edit" > Edit</button> <button class="delete"> Delete</button>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
        
    // }
    public function getuser(Request $request)
    {

        if ($request->ajax()) {
            $lastesd = SettingModel::latest()->first('language');
            $ge = Permissionmodel::where('code', '=', Auth::user()->permission_code)->get();
            $lan = $lastesd->language;
            if ($lan == 'en') {



                if ($ge[0]->update == 1 && $ge[0]->delete == 1) {
                    $data = Modelgetuser::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" > Edit</button> <button class="delete"> Delete  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 0 && $ge[0]->delete == 1) {
                    $data = Modelgetuser::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > Edit <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete"> Delete   </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 1 && $ge[0]->delete == 0) {
                    $data = Modelgetuser::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit"  > Edit </button> <button class="delete" style="pointer-events: none;"> Delete  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else {
                    $data = Modelgetuser::latest()->get();
                    return Datatables::of($data)
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
                    $data = Modelgetuser::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" > កែប្រែ</button> <button class="delete"> លុប  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 0 && $ge[0]->delete == 1) {
                    $data = Modelgetuser::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > កែប្រែ <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete"> លុប  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 1 && $ge[0]->delete == 0) {
                    $data = Modelgetuser::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit"  > កែប្រែ </button> <button class="delete" style="pointer-events: none;"> លុប  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else {
                    $data = Modelgetuser::latest()->get();
                    return Datatables::of($data)
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
       
        
        $add =new Modelgetuser();
        $add->email=$request->input('email');
        $add->name=$request->input('name');
        $add->gender=$request->input('gender');
        $add->salesperson_code=$request->input('salesperson_code');
        $add->status=$request->input('status');
        $add->city=$request->input('city');
        $add->country_code=$request->input('contry');
        $add->address_2=$request->input('address2');
        $add->address=$request->input('address');
        $add->permission_code=$request->input('permission');
        $add->user_role_code=$request->input('userrole');
        $add->phone_no=$request->input('phone');
        $add->id_card_no=$request->input('idcare');
        $add->inactived	=$request->input('active');
        $add->date_of_birth=$request->date('date');
        $add->password=bcrypt($request->input('password'));
       
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|max:255',
            'salesperson_code' => 'required|unique:users|max:255',
            'name'=>'required',
            'password'=>'required',
             
          ]);
          
          if ($validator->fails()) {
            return response()->json([
                'status'=>$validator->errors()->toArray(),
            ]);
          }
          $add->save();
        return response()->json([
             'status'=>'true',
            
    ]);

        
    }
    public function showdate_edit($id)
    {
        $showedit=Modelgetuser::find($id);
        return response()->json([
            'showedit'=>$showedit
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
         $edit=Modelgetuser::find($id);

        // $edit->edit();
        // return redirect()-back();
        // return view('edituser',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $add=Modelgetuser::find($id);
        
        $add->email=$request->input('email');
        $add->name=$request->input('name');
        $add->gender=$request->input('gender');
        $add->salesperson_code=$request->input('salesperson_code');
        $add->status=$request->input('status');
        $add->city=$request->input('city');
        $add->country_code=$request->input('contry');
        $add->address_2=$request->input('address2');
        $add->address=$request->input('address');
        $add->permission_code=$request->input('permission');
        $add->user_role_code=$request->input('userrole');
        $add->phone_no=$request->input('phone');
        $add->id_card_no=$request->input('idcare');
        $add->inactived	=$request->input('active');
        $add->date_of_birth=$request->date('date');
        $add->password=bcrypt($request->input('password'));
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|unique:users|max:255',
        //     'salesperson_code' => 'required|unique:users|max:255',
        //     'name'=>'required',
        //     'password'=>'required',
             
        //   ]);
          
        //   if ($validator->fails()) {
        //     return response()->json([
        //         'status'=>$validator->errors()->toArray(),
        //     ]);
        //   }
        $add->update();
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
        $delete=Modelgetuser::find($id);
        $delete->delete();
        return redirect()->back();
    }
}
