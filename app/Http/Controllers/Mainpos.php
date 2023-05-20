<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Saleline;
use App\Models\Uommodel;
use App\Models\Itemmodel;
use App\Models\Getcustomer;
use App\Models\SalesHeader;
use Illuminate\Support\Str;
use App\Models\Itemuommodel;
use App\Models\Modelgetuser;
use App\Models\RegisterOpen;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Models\Permissionmodel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class Mainpos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastesdd = SettingModel::latest()->first('language');
        $lan = $lastesdd->language;
        App::setlocale($lan);
        $lastesd=SalesHeader::latest()->first('id');
        $customer = Getcustomer::
        where('inactived','yes')
        ->orderBy('id')
        ->get();
        ;
// Doday Sales

$Cash_Sales=Saleline::select(DB::raw('sum(unit_price*quantity) AS totalprice') 
   )
->whereDay('created_at', Carbon::now()->day)
->whereMonth('created_at', Carbon::now()->month)
->whereYear('created_at', Carbon::now()->year)
-> where('created_at','not like','%'.'hold'.'%')
-> where('created_at','not like','%'.'return'.'%')
->get();


///




        $getpermissioncode=Permissionmodel::where('code','=',Auth::user()->permission_code)->get();
        $uom=Uommodel::all();
        $hold = DB::table('sales_lines')
            ->select('document_no')
            ->where('document_no', 'like', '%' . 'hold' . '%')
            ->groupBy('document_no')
            ->get();
        $category = Itemmodel::select('item_category_code')
            ->groupby('item_category_code')
            ->get();
        $count = Itemuommodel::all();
        $datatest = DB::table('item_unit_of_measures')
            ->select('items.no', 'item_unit_of_measures.item_no', 'item_unit_of_measures.id', 'item_unit_of_measures.price', 'items.picture', 'items.unit_price', 'items.description', 'items.description_2', 'item_unit_of_measures.unit_of_measure_code', 'item_unit_of_measures.qty_per_unit', 'items.item_category_code', 'items.item_group_code')
            ->join('items', 'items.no', '=', 'item_unit_of_measures.item_no')
            ->join('unit_of_measures', 'item_unit_of_measures.unit_of_measure_code', '=', 'unit_of_measures.code')
            ->offset(0)
            ->limit(60)
            ->groupBy('item_unit_of_measures.item_no')
            ->orderBy('item_unit_of_measures.id')
            ->get();

        return view('sales.mainpos', compact('datatest', 'customer', 'hold', 'count', 'category','uom','getpermissioncode','Cash_Sales','lastesd'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }
    public function limit(Request $request)
    {
        $lastesdd = SettingModel::latest()->first('language');
        $lan = $lastesdd->language;
        if($lan=='en'){
            $add="Add";
            $price="Price:";
            $uom="UOM:";
        }
        else{
            $add="ទិញ";
            $price="តម្លៃ:";
            $uom="ខ្នាត:"; 
        }



        if ($request->ajax()) {
            $showlimit = "";
            if ($request->category == 0 || $request->category == 'Show_All_Category') {
                $pos = DB::table('item_unit_of_measures')
                    ->select('items.no', 'item_unit_of_measures.item_no', 'item_unit_of_measures.id', 'item_unit_of_measures.price', 'items.picture', 'items.unit_price', 'items.description', 'items.description_2', 'item_unit_of_measures.unit_of_measure_code', 'item_unit_of_measures.qty_per_unit', 'items.item_category_code', 'items.item_group_code')
                    ->join('items', 'items.no', '=', 'item_unit_of_measures.item_no')
                    ->join('unit_of_measures', 'unit_of_measures.code', '=',   'item_unit_of_measures.unit_of_measure_code')
                    ->offset($request->ofs)
                    ->limit($request->limit)

                    ->get();
            } else {
                $pos = DB::table('item_unit_of_measures')
                    ->select('items.no', 'item_unit_of_measures.item_no', 'item_unit_of_measures.id', 'item_unit_of_measures.price', 'items.picture', 'items.unit_price', 'items.description', 'items.description_2', 'item_unit_of_measures.unit_of_measure_code', 'item_unit_of_measures.qty_per_unit', 'items.item_category_code', 'items.item_group_code')
                    ->join('items', 'items.no', '=', 'item_unit_of_measures.item_no')
                    ->join('unit_of_measures', 'unit_of_measures.code', '=',   'item_unit_of_measures.unit_of_measure_code')
                    ->where('items.item_category_code', '=', $request->category)
                    ->offset($request->ofs)
                    ->limit($request->limit)

                    ->get();
            }


 
            foreach ($pos as $key => $poss) {
                if ($poss->picture == null) {
                    $url = asset("img/blue1.webp");
                } else {
                    $url = asset("tos/$poss->picture");
                }
              

                $cut = Str::substr($poss->unit_price, 0, 8);
                $showlimit .=

                    '<div class="card1">' .
                    '<div class="information">'.$uom.''
                    . $poss->unit_of_measure_code.
                    '</div>' .
                    '<div class="image">' .
                    '<img src=' . $url . ' alt="">' .
                    '</div>' .
                    '<div class="list"> ' .
                    '<h6 class="id">' . $poss->id . '</h6>' .
                    '<h6 class="code">' . $poss->item_no . '</h6>' .
                    '<h6 class="price">' . $cut . '</h6>' .
                    '<h6 class="des">' . $poss->description . '</h6>' .
                    '<h6 class="des1">' . $poss->description_2 . '</h6>' .
                    '<h6 class="uom">' . $poss->unit_of_measure_code . '</h6>' .
                    '<h6 class="qtyuom">' . $poss->qty_per_unit . '</h6>' .
                    '<h6 class="itemgcode">' . $poss->item_group_code . '</h6>' .
                    '<h6 class="itemccode">' . $poss->item_category_code . '</h6>' .
                    '<div class="row">'.
                    '<div class="left-title">'.$price.' '.$cut.'</div>'.
                    '<div class="right-title">'.$poss->description.'</div>'.
                    '<div class="buttom_img">'.'<img src=' . $url . ' alt="">' .'</div>'.
                    '<div class="buttom_img">'.'<img src=' . $url . ' alt="">' .'</div>'.
                    '<div class="buttom_img">'. '<img src=' . $url . ' alt="">' .'</div>'.
                    '<p class="buy">'.$add.'</p>' .
                    '</div>' .
                    '</div>' .
                    '</div>';
            }
        }

        return Response($showlimit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filteruom(Request $request)
    {
        $filter=Itemuommodel::select('unit_of_measure_code')
        ->where('item_unit_of_measures.item_no', '=',$request->itemcode)
        ->get();
        return response()->json([
            'status'=>$filter,
            'item_no'=>$request->itemcode,
        ]);
    }
    public function search(Request $request)
    {
        $lastesdd = SettingModel::latest()->first('language');
        $lan = $lastesdd->language;
        if($lan=='en'){
            $add="Add";
            $price="Price:";
            $uom="UOM:";
        }
        else{
            $add="ទិញ";
            $price="តម្លៃ:";
            $uom="ខ្នាត:"; 
        }
        $output = "";
        $pos = DB::table('item_unit_of_measures')
            ->select('items.no', 'item_unit_of_measures.item_no', 'item_unit_of_measures.id', 'item_unit_of_measures.price', 'items.picture', 'items.unit_price', 'items.description', 'items.description_2', 'item_unit_of_measures.unit_of_measure_code', 'item_unit_of_measures.qty_per_unit', 'items.item_category_code', 'items.item_group_code')
            ->join('items', 'items.no', '=', 'item_unit_of_measures.item_no')
            ->join('unit_of_measures', 'item_unit_of_measures.unit_of_measure_code', '=', 'unit_of_measures.code')
            ->offset(0)
            ->limit(60)
            ->groupBy('item_unit_of_measures.item_no')
            ->orderBy('item_unit_of_measures.id')
            ->where('item_unit_of_measures.item_no', 'like','%'. $request->search.'%')
            ->get();

        foreach ($pos as $key => $poss) {
                if ($poss->picture == null) {
                    $url = asset("img/blue1.webp");
                } else {
                    $url = asset("tos/$poss->picture");
                }
              

                $cut = Str::substr($poss->unit_price, 0, 8);
                $output .=

                    '<div class="card1">' .
                    '<div class="information">'.$uom.''
                    . $poss->unit_of_measure_code.
                    '</div>' .
                    '<div class="image">' .
                    '<img src=' . $url . ' alt="">' .
                    '</div>' .
                    '<div class="list"> ' .
                    '<h6 class="id">' . $poss->id . '</h6>' .
                    '<h6 class="code">' . $poss->item_no . '</h6>' .
                    '<h6 class="price">' . $cut . '</h6>' .
                    '<h6 class="des">' . $poss->description . '</h6>' .
                    '<h6 class="des1">' . $poss->description_2 . '</h6>' .
                    '<h6 class="uom">' . $poss->unit_of_measure_code . '</h6>' .
                    '<h6 class="qtyuom">' . $poss->qty_per_unit . '</h6>' .
                    '<h6 class="itemgcode">' . $poss->item_group_code . '</h6>' .
                    '<h6 class="itemccode">' . $poss->item_category_code . '</h6>' .
                    '<div class="row">'.
                    '<div class="left-title">'.$price.' '.$cut.'</div>'.
                    '<div class="right-title">'.$poss->description.'</div>'.
                    '<div class="buttom_img">'.'<img src=' . $url . ' alt="">' .'</div>'.
                    '<div class="buttom_img">'.'<img src=' . $url . ' alt="">' .'</div>'.
                    '<div class="buttom_img">'. '<img src=' . $url . ' alt="">' .'</div>'.
                    '<p class="buy">'.$add.'</p>' .
                    '</div>' .
                    '</div>' .
                    '</div>';
            }

        return Response($output);
    }
    public function search_uom(Request $request)
    { 
        $filter=Itemuommodel::where('item_unit_of_measures.item_no', '=',$request->itemcode)
        ->where('item_unit_of_measures.unit_of_measure_code', '=',$request->index)
        ->get();
        return response()->json([
            'status'=>$filter,
        ]);
    }
    public function scan(Request $request)
    {
        $output = "";
        $pos = DB::table('item_unit_of_measures')
            ->select('items.no', 'item_unit_of_measures.item_no', 'item_unit_of_measures.id', 'item_unit_of_measures.price', 'items.picture', 'items.unit_price', 'items.description', 'items.description_2', 'item_unit_of_measures.unit_of_measure_code', 'item_unit_of_measures.qty_per_unit', 'items.item_category_code', 'items.item_group_code')
            ->join('items', 'items.no', '=', 'item_unit_of_measures.item_no')
            ->join('unit_of_measures', 'item_unit_of_measures.unit_of_measure_code', '=', 'unit_of_measures.code')
            ->where('item_unit_of_measures.identifier_code', '=', $request->scan)
            ->groupBy('item_unit_of_measures.item_no')
            ->get();

        return response()->json([
            'pos' => $pos
        ]);
    }
    // ---------------------------------------------------Add new function
    // addcustomer
    public function addcustomer(Request $request)
    {
        
        // $validator = Validator::make($request->all(), [
        //     'item_no' => 'required',
            
             
        //   ]);
          
        //   if ($validator->fails()) {
        //     return response()->json([
        //         'status'=>$validator->errors()->toArray(),
        //     ]);
        //   }



        $validate=Validator::make($request->all(),[
            'id'=> 'required|unique:customers',
            'name'=>'required',
        ]);
        if($validate->fails()){
            return response()->json([
                'status'=>$validate->errors()->toArray(),
            ]);
        }
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
        $upload->save();
        return response()->json([
            'status' => 'true',

        ]);
    }


    //Add item to item Saleline
    public function addsaleline(Request $request)
    {
        $lastesd=SalesHeader::latest()->first('id');
        $data = new Saleline();
        
        $CheckSale = $request->input('salepersion');
        if ($CheckSale == null) {
            $data->created_by = Auth::user()->salesperson_code;
        } else {
            $data->created_by = $request->input('created');
        }
        $data->item_no = $request->input('itemno');
        $data->quantity = $request->input('qty');
        $data->unit_price = $request->input('unitprice');
        $data->unit_price_lcy = $request->input('pricelcy');
        $data->amount = $request->input('amount');
        $data->item_description = $request->input('itemdes');
        $data->item_description_2 = $request->input('itemdes2');
        $data->amount_lcy = $request->input('amountlcy');
        $data->unit_of_measure = $request->input('uom');
        $data->qty_per_unit_of_measure = $request->input('qtyuom');
        $data->item_group_code = $request->input('itemgcode');
        $data->item_category_code = $request->input('itemccode');
        $data->amount_lcy = $request->input('amountlcy');
        $data->document_no ="#000".($lastesd->id);
        $data->discount_percentage = $request->input('desper');
        $data->discount_amount = $request->input('desamount');

        $data->save();
        return response()->json([]);
    }
    public function addtosaleheader(Request $request, $id)
    {
        // now()->format('H:i:s') 
        // now()->format('H:i:s') 
        $lastesd=SalesHeader::latest()->first('id');
        $CheckSale = $request->input('salepersion');
        $customer = Getcustomer::find($id);
        $sale = new SalesHeader();
        $sale->customer_name = $customer->name;
        $sale->customer_no = $customer->id;
        $sale->customer_name_2 = $customer->name_2;
        $sale->address = $customer->address;
        $sale->address_2 = $customer->address_2;
        $sale->document_type = $request->input("docno");
        $sale->no="#000".($lastesd->id +1);
        if ($CheckSale == null) {
            $sale->salesperson_code = Auth::user()->salesperson_code;
        } else {
            $sale->salesperson_code = $request->input('salepersion');
        }
        $sale->payment_discount_amount = $request->input('desamount');
        $sale->payment_discount_percentage = $request->input('desper');
        $sale->payment_method_code = $request->input('payment');
        $sale->order_date = now("Asia/Phnom_Penh")->format('Y-m-d');
        $sale->order_datetime = now("Asia/Phnom_Penh")->format('Y-m-d H:i:s');
        $sale->save();
        return response()->json([]);
    }
    public function additemtohold(Request $request)
    {
        $data = new Saleline();
        $time = now("Asia/Phnom_Penh")->format('H:i:');
        $data->item_no = $request->input('itemno');
        $data->quantity = $request->input('qty');
        $data->unit_price = $request->input('unitprice');
        $data->unit_price_lcy = $request->input('pricelcy');
        $data->amount = $request->input('amount');
        $data->item_description = $request->input('itemdes');
        $data->item_description_2 = $request->input('itemdes2');
        $data->amount_lcy = $request->input('amountlcy');
        $data->unit_of_measure = $request->input('uom');
        $data->qty_per_unit_of_measure = $request->input('qtyuom');
        $data->item_group_code = $request->input('itemgcode');
        $data->item_category_code = $request->input('itemccode');
        $data->amount_lcy = $request->input('amountlcy');
        $data->document_no = 'hold' . $request->input('refer');
        $data->discount_percentage = $request->input('desper');
        $data->discount_amount = $request->input('desamount');

        $data->save();
        return response()->json([]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    public function category(Request $request)
    {

        $lastesdd = SettingModel::latest()->first('language');
        $lan = $lastesdd->language;
        if($lan=='en'){
            $add="Add";
            $price="Price:";
            $uom="UOM:";
        }
        else{
            $add="ទិញ";
            $price="តម្លៃ:";
            $uom="ខ្នាត:"; 
        }

        $output = "";
        if ($request->category == 0 || $request->category == 'Show_All_Category') {
            $pos = DB::table('item_unit_of_measures')
                ->select('items.no', 'item_unit_of_measures.item_no', 'item_unit_of_measures.id', 'item_unit_of_measures.price', 'items.picture', 'items.unit_price', 'items.description', 'items.description_2', 'item_unit_of_measures.unit_of_measure_code', 'item_unit_of_measures.qty_per_unit', 'items.item_category_code', 'items.item_group_code')
                ->join('items', 'items.no', '=', 'item_unit_of_measures.item_no')
                ->join('unit_of_measures', 'item_unit_of_measures.unit_of_measure_code', '=', 'unit_of_measures.code')
                ->offset(0)
                ->limit(60)
                // ->orderBy('item_unit_of_measures.item_no')
                ->get();
        } else {
            $pos = DB::table('item_unit_of_measures')
                ->select('items.no', 'item_unit_of_measures.item_no', 'item_unit_of_measures.id', 'item_unit_of_measures.price', 'items.picture', 'items.unit_price', 'items.description', 'items.description_2', 'item_unit_of_measures.unit_of_measure_code', 'item_unit_of_measures.qty_per_unit', 'items.item_category_code', 'items.item_group_code')
                ->join('items', 'items.no', '=', 'item_unit_of_measures.item_no')
                ->join('unit_of_measures', 'item_unit_of_measures.unit_of_measure_code', '=', 'unit_of_measures.code')
                ->offset(0)
                ->limit(60)
                ->where('items.item_category_code', '=', $request->category)
                ->get();
        }


        foreach ($pos as $key => $poss) {
            if ($poss->picture == null) {
                $url = asset("img/blue1.webp");
            } else {
                $url = asset("tos/$poss->picture");
            }

            $cut = Str::substr($poss->unit_price, 0, 8);
            $output .=

            '<div class="card1">' .
            '<div class="information">'.$uom.''
            . $poss->unit_of_measure_code.
            '</div>' .
            '<div class="image">' .
            '<img src=' . $url . ' alt="">' .
            '</div>' .
            '<div class="list"> ' .
            '<h6 class="id">' . $poss->id . '</h6>' .
            '<h6 class="code">' . $poss->item_no . '</h6>' .
            '<h6 class="price">' . $cut . '</h6>' .
            '<h6 class="des">' . $poss->description . '</h6>' .
            '<h6 class="des1">' . $poss->description_2 . '</h6>' .
            '<h6 class="uom">' . $poss->unit_of_measure_code . '</h6>' .
            '<h6 class="qtyuom">' . $poss->qty_per_unit . '</h6>' .
            '<h6 class="itemgcode">' . $poss->item_group_code . '</h6>' .
            '<h6 class="itemccode">' . $poss->item_category_code . '</h6>' .
            '<div class="row">'.
            '<div class="left-title">'.$price.' '.$cut.'</div>'.
            '<div class="right-title">'.$poss->description.'</div>'.
            '<div class="buttom_img">'.'<img src=' . $url . ' alt="">' .'</div>'.
            '<div class="buttom_img">'.'<img src=' . $url . ' alt="">' .'</div>'.
            '<div class="buttom_img">'. '<img src=' . $url . ' alt="">' .'</div>'.
            '<p class="buy">'.$add.'</p>' .
            '</div>' .
            '</div>' .
            '</div>';
        }
        return Response($output);
    }
    public function open_register(Request $request)
    {
        $user = Auth()->user()->name;
        $register = new RegisterOpen();
        $register->user_name = $user;
        $register->cash_inhand = $request->cash;
        $register->open = now("Asia/Phnom_Penh")->format('Y-m-d H:i:s');
        $register->save();
        $request->session()->put('openregister', 'value');
        return redirect()->back();
    }
    public function close_register(Request $request)
    {
        $getlatest = RegisterOpen::latest()->first();
        $closes = RegisterOpen::find($getlatest->id);
        $closes->id = $getlatest->id;
        $closes->close = now("Asia/Phnom_Penh")->format('Y-m-d H:i:s');
        $closes->update();
        $request->session()->forget('openregister');
        return redirect()->back();
        // return response()->json([
        //     'status'=>$getlatest->id
        // ]);
    }
    public function update_register(Request $request)
    {
        $getlatest = RegisterOpen::latest()->first();
        $closes = RegisterOpen::find($getlatest->id);
        $closes->id = $getlatest->id;
        $closes->total_sales_without_cash_inhand=$request->input('totalprice')+$getlatest->total_sales_without_cash_inhand;
        $closes->total_sales_wit_cash_inhand=($request->input('totalprice')+$getlatest->total_sales_without_cash_inhand)+$getlatest->cash_inhand;
        $closes->close = now("Asia/Phnom_Penh")->format('Y-m-d H:i:s');
        $closes->update();
       return response()->json([
        'data'=>$request->payment
       ]);
        // return response()->json([
        //     'status'=>$getlatest->id
        // ]);
    }


 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function returnproduct(Request $request)
    {
        $returnback=Saleline::where('document_no','#'.$request->invoice)
        ->get();
        return response()->json([
            'status'=>$returnback,
        ]);
    }
    public function submitreturn(Request $request)
    {
        $lastesd=SalesHeader::latest()->first('id');
       $ss=Saleline::where('document_no','#'.$request->invoice)->where('item_no',$request->item_no)
       ->update(['document_no' => '#'.($lastesd->id +1).'return']);
       
       return response()->json([
       ]);
     
    }

    public function sale_return_customer(Request $request)
    {
       $customer=SalesHeader::where('no','#'.$request->invoice)->get();
       $sale = new SalesHeader();
       $lastesd=SalesHeader::latest()->first('id');
       $sale->customer_name = $customer[0]->customer_name;
       $sale->customer_no = $customer[0]->customer_no;
       $sale->customer_name_2 = $customer[0]->customer_name_2;
       $sale->address = $customer[0]->address;
       $sale->address_2 = $customer[0]->address_2;
       $sale->document_type ='Cr';
      $sale->no="#000".($lastesd->id +1);
        $sale->salesperson_code = Auth::user()->salesperson_code;
       $sale->order_date = now("Asia/Phnom_Penh")->format('Y-m-d');
       $sale->order_datetime = now("Asia/Phnom_Penh")->format('Y-m-d H:i:s');
       $sale->save();
       return response()->json([
        'trua'=>$lastesd->id,
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
        //
    }
}