<?php

namespace App\Http\Controllers;

use App\Models\Getcustomer;
use Illuminate\Http\Request;
use App\Models\Modeluserrole;
use App\Models\Permissionmodel;
use App\Models\SettingModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use BaconQrCode\Renderer\Path\Curve;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Validator;






class Customer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //  public function __construct(){
	//                 $this->middleware(['admin']);
                     
    // }
    public function index()
    {
      $ue=Auth::user();
    //   dd(Auth::user()->user_role_code);

    $get = SettingModel::latest()->first();

        $lastesd = SettingModel::latest()->first('language');
        $lan = $lastesd->language;

        App::setlocale($lan);
        $result = Getcustomer::all();
        // $getermissioncode = DB::table('users')
        // ->select('permissions.add,permissions.update,permissions.delete'
        // ->get();
        $getpermissioncode = Permissionmodel::where('code', '=', Auth::user()->permission_code)
            ->get();
        return view('customer.customer', compact('result', 'getpermissioncode','get','ue'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    public function getStudents(Request $request)
    {

        if ($request->ajax()) {
            $lastesd = SettingModel::latest()->first('language');
            $ge = Permissionmodel::where('code', '=', Auth::user()->permission_code)->get();
            $lan = $lastesd->language;
            if ($lan == 'en') {



                if ($ge[0]->update == 1 && $ge[0]->delete == 1) {
                    $data = Getcustomer::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" > Edit</button> <button class="delete"> Delete  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 0 && $ge[0]->delete == 1) {
                    $data = Getcustomer::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > Edit <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete"> Delete   </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 1 && $ge[0]->delete == 0) {
                    $data = Getcustomer::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit"  > Edit </button> <button class="delete" style="pointer-events: none;"> Delete  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else {
                    $data = Getcustomer::latest()->get();
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
                    $data = Getcustomer::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" > កែប្រែ</button> <button class="delete"> លុប  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 0 && $ge[0]->delete == 1) {
                    $data = Getcustomer::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > កែប្រែ <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete"> លុប  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else if ($ge[0]->update == 1 && $ge[0]->delete == 0) {
                    $data = Getcustomer::latest()->get();
                    return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit"  > កែប្រែ </button> <button class="delete" style="pointer-events: none;"> លុប  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                } else {
                    $data = Getcustomer::latest()->get();
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

        $upload = new Getcustomer();
        $upload->id = $request->input('id');
        $upload->name = $request->input('name');
        $upload->name_2 = $request->input('name2');
        $upload->address = $request->input('address');
        $upload->address_2 = $request->input('address2');
        $upload->phone_no = $request->input('phone');
        $upload->phone_no_2 = $request->input('phone2');
        $upload->salesperson_code = $request->input('sales');
        $upload->inactived = $request->input('active');
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|unique:customers',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'status' => $validator->errors()->toArray()
            ]);
        }
        $upload->save();
        return response()->json([]);
    }
    public function submitedit(Request $request, $id)
    {


        $upload = Getcustomer::find($id);
        $upload->id = $request->input('id');
        $upload->name = $request->input('name');
        $upload->name_2 = $request->input('name2');
        $upload->address = $request->input('address');
        $upload->address_2 = $request->input('address2');
        $upload->phone_no = $request->input('phone');
        $upload->phone_no_2 = $request->input('phone2');
        $upload->salesperson_code = $request->input('sales');
        $upload->inactived = $request->input('active');
        $upload->update();
        return response()->json([
            'status' => $request->input('active'),

        ]);
        //  return redirect('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit = Getcustomer::find($id);
        return response()->json([
            'status' => 'true',
            'edit' => $edit,

        ]);

        // return view('edite',compact('edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $edit=Getcustomer::find($id);
    //     return view('edit',compact('edit'));

    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $delete=Flight::find($no);
        $delete = Getcustomer::find($id);
        $delete->delete();
        return response()->json([
            'status' => 'true',


        ]);

        // $flight->delete();
        //  return redirect()->back();
        // return redirect()->route('link.index');


    }
}
