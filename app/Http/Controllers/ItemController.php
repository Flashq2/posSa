<?php
namespace App\Http\Controllers;
use App\Models\Itemmodel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use App\Models\Modelcategory;
use App\Models\Modelitemgroup;
use App\Models\Permissionmodel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class Itemcontroller extends Controller
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
        $data=Modelcategory::all()->where('inactived','=','Yes');
        $data2=Modelitemgroup::all()->where('inactived','=','Yes');
        $getpermissioncode=Permissionmodel::where('code','=',Auth::user()->permission_code)->get();
         return view('item.item',compact('data','data2','getpermissioncode','get'));
        // return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    // public function getitem(Request $request){
            
    //     if ($request->ajax()) {
    //         $data = Itemmodel::latest()->get();
    //         return DataTables::eloquent(Itemmodel::query())
    //             ->addIndexColumn()
    //             ->addColumn('product_brand_logo', function ($product_brand) {
    //                 if($product_brand->picture==null){
    //                     $url=asset("/img/blue1.webp");
    //                 }
    //                 else{
    //                       $url=asset("/tos/$product_brand->picture"); 
    //                 }
                  
    //                 return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
    //          })
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<button class="edit" > Edit</button> <button class="delete"> Delete</button>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action','product_brand_logo'])
    //          //  rawColumns(['product_brand_logo'])
    //             ->make(true);
    //     }
    // }
    public function getitem(Request $request)
    {

        if ($request->ajax()) {
            $lastesd = SettingModel::latest()->first('language');
            $ge = Permissionmodel::where('code', '=', Auth::user()->permission_code)->get();
            $lan = $lastesd->language;
            if ($lan == 'en') {



                if ($ge[0]->update == 1 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(Itemmodel::query())
                        ->addIndexColumn()
                        ->addColumn('product_brand_logo', function ($product_brand) {
                            if($product_brand->picture==null){
                                $url=asset("/img/blue1.webp");
                            }
                            else{
                                  $url=asset("/tos/$product_brand->picture"); 
                            }
                          
                            return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
                     })
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" > Edit</button> <button class="delete"> Delete  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action','product_brand_logo'])
                        ->make(true);
                } else if ($ge[0]->update == 0 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(Itemmodel::query())
                        ->addIndexColumn()
                        ->addColumn('product_brand_logo', function ($product_brand) {
                            if($product_brand->picture==null){
                                $url=asset("/img/blue1.webp");
                            }
                            else{
                                  $url=asset("/tos/$product_brand->picture"); 
                            }
                          
                            return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
                     })
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > Edit <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete"> Delete   </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action','product_brand_logo'])
                        ->make(true);
                } else if ($ge[0]->update == 1 && $ge[0]->delete == 0) {
                  
                    return DataTables::eloquent(Itemmodel::query())
                        ->addIndexColumn()
                        ->addColumn('product_brand_logo', function ($product_brand) {
                            if($product_brand->picture==null){
                                $url=asset("/img/blue1.webp");
                            }
                            else{
                                  $url=asset("/tos/$product_brand->picture"); 
                            }
                          
                            return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
                     })
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit"  > Edit </button> <button class="delete" style="pointer-events: none;"> Delete  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action','product_brand_logo'])
                        ->make(true);
                } else {
                  
                    return DataTables::eloquent(Itemmodel::query())
                        ->addIndexColumn()
                        ->addColumn('product_brand_logo', function ($product_brand) {
                            if($product_brand->picture==null){
                                $url=asset("/img/blue1.webp");
                            }
                            else{
                                  $url=asset("/tos/$product_brand->picture"); 
                            }
                          
                            return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
                     })
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > Edit <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete" style="pointer-events: none;"> Delete  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action','product_brand_logo'])
                        ->make(true);
                }
            } else {


                if ($ge[0]->update == 1 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(Itemmodel::query())
                        ->addIndexColumn()
                        ->addColumn('product_brand_logo', function ($product_brand) {
                            if($product_brand->picture==null){
                                $url=asset("/img/blue1.webp");
                            }
                            else{
                                  $url=asset("/tos/$product_brand->picture"); 
                            }
                          
                            return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
                     })
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" > កែប្រែ</button> <button class="delete"> លុប  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action','product_brand_logo'])
                        ->make(true);
                } else if ($ge[0]->update == 0 && $ge[0]->delete == 1) {
                  
                    return DataTables::eloquent(Itemmodel::query())
                        ->addIndexColumn()
                        ->addColumn('product_brand_logo', function ($product_brand) {
                            if($product_brand->picture==null){
                                $url=asset("/img/blue1.webp");
                            }
                            else{
                                  $url=asset("/tos/$product_brand->picture"); 
                            }
                          
                            return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
                     })
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > កែប្រែ <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete"> លុប  </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action','product_brand_logo'])
                        ->make(true);
                } else if ($ge[0]->update == 1 && $ge[0]->delete == 0) {
                  
                    return DataTables::eloquent(Itemmodel::query())
                        ->addIndexColumn()
                        ->addColumn('product_brand_logo', function ($product_brand) {
                            if($product_brand->picture==null){
                                $url=asset("/img/blue1.webp");
                            }
                            else{
                                  $url=asset("/tos/$product_brand->picture"); 
                            }
                          
                            return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
                     })
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit"  > កែប្រែ </button> <button class="delete" style="pointer-events: none;"> លុប  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action','product_brand_logo'])
                        ->make(true);
                } else {
                     
                    return DataTables::eloquent(Itemmodel::query())
                        ->addIndexColumn()
                        ->addColumn('product_brand_logo', function ($product_brand) {
                            if($product_brand->picture==null){
                                $url=asset("/img/blue1.webp");
                            }
                            else{
                                  $url=asset("/tos/$product_brand->picture"); 
                            }
                          
                            return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />'; 
                     })
                        ->addColumn('action', function ($row) {

                            $actionBtn = '<button class="edit" style="pointer-events: none;" > កែប្រែ <i class="fa-solid fa-ban" style="color: #ff0000;" ></i></button> <button class="delete" style="pointer-events: none;"> លុប  <i class="fa-solid fa-ban" style="color: #ff0000;" ></i> </button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['action','product_brand_logo'])
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

        $validator = Validator::make($request->all(), [
            'no' => 'required|unique:items|max:255',
            
             
          ]);
          
          if ($validator->fails()) {
            return response()->json([
                'status'=>$validator->errors()->toArray(),
            ]);
          }


        $data=new Itemmodel();
        $data->no=$request->input('no');
       
        $data->no_2=$request->input('no2');
        $data->description=$request->input('des');
        $data->description_2=$request->input('des2');
        $data->item_group_code=$request->input('item-gcode');
        $data->item_category_code=$request->input('itemCcode');
        $data->unit_price=$request->input('unitprice');
        $data->	remark=$request->input('remark');
        $data->inactived=$request->input('active');
        if($request->has('image')){
        $file=$request->file('image');
        $extension=$file->getClientOriginalExtension();
        $filename=time().'.'.$extension;
        $file->move(public_path('tos'),$filename);
        $data->picture=$filename;
        }
        $data->save();
        
        return response()->json([

        ]);
        //  return redirect()->back();
     
    //     $data=new Itemmodel();
        
    //   //  $name = $request->file('image')->getClientOriginalName();
    //     if($request->hasFile('image')) {
    //         // $image = $request->file('image');
    //         // $filename = $image->getClientOriginalName();
    //         // $name='12';
    //         // request()->$image->move(public_path('images/users'), $filename);
    //         // $sounds->image = $request->file('sound_file')->getClientOriginalName();
    //          $file=$request->file('image');
    //     $extension=$file->getClientOriginalExtension();
    //     $filename=time().'.'.$extension;
    //     $file->move('/pos/pos/public/img',$filename);
    //     $data->picture="1234.png";
    //     $filename="1238";
    //     }
       
        
       
        
         

        // $imageName=time().'.'.$request->picture->getClientOriginalExtension();
        // $request->picture->move(public_path('img'),$imageName);
        
        // $data->no=$request->no;
        // $data->save();
        //  return returnSelf();
    


        
    }
    // $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);
        
    //     $imageName = time().'.'.$request->image->extension();  
         
    //     $request->image->move(public_path('images'), $imageName);
      
    //     Image::create(['name' => $imageName]);
        
    //     return response()->json('Image uploaded successfully');
    // }

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
        $data=Itemmodel::find($id);
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
        $data =Itemmodel::find($id);
        // $data->no=$request->input('mno');
        
         $data->no_2=$request->input('mno2');
         $data->description=$request->input('mdes');
         $data->description_2=$request->input('mdes2');
         $data->item_group_code=$request->input('mitem-gcode');
         $data->item_category_code=$request->input('mitemCcode');
         $data->unit_price=$request->input('munitprice');
         $data->	remark=$request->input('mremark');
        // $data->picture=$request->input('picture');
         $data->inactived=$request->input('mactive');
         if($request->has('mimage')){
            $file=$request->file('mimage');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move(public_path('tos'),$filename);
            $data->picture=$filename;
            }


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
        $data =Itemmodel::find($id);
        $data->delete();
        return response()->json([

        ]);
    }
}
