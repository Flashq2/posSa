<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Saleline;
use App\Models\Getcustomer;
use App\Models\SalesHeader;
use Illuminate\Support\Str;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Facades\DataTables;

class PosReport extends Controller
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
        $customer = Getcustomer::all();
        
        $sale_persioncode=SalesHeader::select('salesperson_code')
        ->groupby('salesperson_code')
        ->get();
        $date=now("Asia/Phnom_Penh")->format('Y-m-d');
        //Count Monthly Report

        $quantitymonth=Saleline::select(DB::raw('sum(quantity) AS total_count')
        ,DB::raw('sum(unit_price*quantity) AS totalprice') ,DB::raw('sum(discount_amount) AS discountamount'),DB::raw('sum(unit_price) AS unit_prices')
        ,DB::raw('sum(unit_price*quantity)-sum(discount_amount) as netamount')   )
        ->whereMonth('created_at', Carbon::now()->month)
       -> where('created_at','not like','%'.'hold'.'%')
       ->get();
       $returnPrice=Saleline::select(DB::raw('sum(quantity) AS total_count')
       ,DB::raw('sum(unit_price*quantity) AS totalprice') ,DB::raw('sum(discount_amount) AS discountamount'),DB::raw('sum(unit_price) AS unit_prices')
       ,DB::raw('sum(unit_price*quantity)-sum(discount_amount) as netamount')   )
       ->whereDay('created_at', Carbon::now()->day)
       ->whereMonth('created_at', Carbon::now()->month)
       ->whereYear('created_at', Carbon::now()->year)
        -> where('document_no','like','%'.'return')
      ->get();
        
        $month=now("Asia/Phnom_Penh")->format('m');
        $user=User::where('inactived','=','1')->get();
        $getdatainweek  = Saleline::select('*')
                        ->whereBetween('created_at', 
                            [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
                        ->get();
        $saleline=Saleline::select('*',DB::raw('sum(quantity) AS total_count')
        ,DB::raw('sum(unit_price*quantity) AS totalprice'))
       -> where('created_at','like','%'.$date.'%')
       -> where('document_no','not like','%'.'hold'.'%')
       -> where('document_no','not like','%'.'return'.'%')
       ->groupby('item_no','unit_of_measure')
        
        ->get();
        
        $SaleMonth = Saleline::select('*',DB::raw('sum(quantity) AS total_count'),DB::raw('sum(unit_price*quantity) AS totalprice'),DB::raw('sum(discount_amount) AS desprice'),DB::raw('sum(unit_price*quantity - discount_amount)  AS priceafterdes'),DB::raw('sum(unit_price) AS unit_prices'))
        -> orderBy('created_at')
        ->whereMonth('created_at', Carbon::now()->month)
        
        ->groupby('item_no')
        ->get();
        $LastMonth = Saleline::select('*')->
        whereMonth('created_at', Carbon::now()->month-1)
          ->get();
 
        $SumMonth=Saleline::whereMonth('created_at', Carbon::now()->month-1)
        ->get();
   
     
        
    // Top Product
   
    
    $chart2=Saleline::select('*',DB::raw('sum(quantity) AS total_quantity'))
    ->whereBetween('created_at', 
    [Carbon::now()->subMonth(3), Carbon::now()]
    )
    ->groupby('item_no')
    ->orderby('total_quantity','desc')
    ->limit(10)
    ->get();
     

    $chart3=Saleline::select('item_no',DB::raw('sum(quantity) AS total_quantity'))
    ->whereBetween('created_at', 
                            [Carbon::now()->subMonth(3), Carbon::now()]
                        )
    ->groupby('item_no')
    ->orderby('total_quantity','desc')
    ->limit(10)
    ->get();
     

    $chart4=Saleline::select('item_no',DB::raw('sum(quantity) AS total_quantity'))
    ->whereMonth('created_at', Carbon::now()->month-4)
    ->groupby('item_no')
    ->orderby('total_quantity','desc')
    ->limit(10)
    ->get();


        return view('sales.SaleReport1',compact('get','user','saleline','getdatainweek','SaleMonth','customer','sale_persioncode','quantitymonth','returnPrice'),['unitprice'=>$LastMonth->sum('unit_price'),'quantity'=>$LastMonth->sum('quantity'),
        'desprice'=>$LastMonth->sum('discount_amount'),'groos'=>$LastMonth->sum('amount')]
        

    );
    }
    public function Top_product_thismonth()
    {
        $chart1=Saleline::select('*',DB::raw('sum(quantity) AS total_quantity'))
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        -> where('document_no','not like','%'.'hold'.'%')
       -> where('document_no','not like','%'.'return'.'%')
        ->groupby('item_no')
        ->orderby('total_quantity','desc')
        ->limit(10)
        ->get();
       
        $chart2=Saleline::select('*',DB::raw('sum(quantity) AS total_quantity'))
        ->whereMonth('created_at', Carbon::now()->month-1)
        ->whereYear('created_at', Carbon::now()->year)
        -> where('document_no','not like','%'.'hold'.'%')
       -> where('document_no','not like','%'.'return'.'%')
        ->groupby('item_no')
        ->orderby('total_quantity','desc')
        ->limit(10)
        ->get();
        $chart3=Saleline::select('*',DB::raw('sum(quantity) AS total_quantity'))
    ->whereBetween('created_at', 
                            [Carbon::now()->subMonth(3), Carbon::now()]
                        )
    ->groupby('item_no')
    ->orderby('total_quantity','desc')
    ->limit(10)
    ->get();
    $chart4=Saleline::select('*',DB::raw('sum(quantity) AS total_quantity'))
    ->whereBetween('created_at', 
    [Carbon::now()->subMonth(6), Carbon::now()])
    ->groupby('item_no')
    ->orderby('total_quantity','desc')
    ->limit(10)
    ->get();
        return response()->json([
            'chart1'=>$chart1,
            'chart2'=>$chart2,
            'chart3'=>$chart3,
            'chart4'=>$chart4
        ]);
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
    public function Monthsearch(Request $request)
    {
        if($request->ThisValue==null){
            $MonthSearch = Saleline::select('*',DB::raw('sum(quantity) AS total_count'),DB::raw('sum(unit_price*quantity) AS totalprice'),DB::raw('sum(discount_amount) AS desprice'),DB::raw('sum(unit_price*quantity - discount_amount)  AS priceafterdes'),DB::raw('sum(unit_price) AS unit_prices'))
            -> orderBy('created_at')
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('document_no','=','invoice')
            ->groupby('item_no')
            ->get(); 
        }
        else{
          $MonthSearch = Saleline::select('*',DB::raw('sum(quantity) AS total_count'),DB::raw('sum(unit_price*quantity) AS totalprice'),DB::raw('sum(discount_amount) AS desprice'),DB::raw('sum(unit_price*quantity - discount_amount)  AS priceafterdes'),DB::raw('sum(unit_price) AS unit_prices'))
        ->whereMonth('created_at', Carbon::now()->month)
        ->where('item_no', 'like', '%' . $request->ThisValue . '%' ,'&&','document_no','=','invoice', '||','item_description', 'like', '%' . $request->ThisValue . '%' )
        ->groupby('item_no')
        ->get();    
        }
        


        return response()->json([
            'monthsearch'=>$MonthSearch,
        ]);
    }



    public function Sale_Report(Request $request)
    {
        if ($request->ajax()) {
             
            return DataTables::eloquent(SalesHeader::query())
                ->addIndexColumn()
             //  rawColumns(['product_brand_logo'])
                ->make(true);
        }

    }
    public function filter_sale_report(Request $request,$customername,$saleperson,$fromdate,$todate)
    {
        if ($request->ajax()) {
            if($fromdate==null || $fromdate=='' || $todate==null || $todate==''){
                return DataTables::eloquent(SalesHeader::query()
            ->where('customer_name','=',$customername)
            ->where('salesperson_code','=',$saleperson))
                ->addIndexColumn()
             //  rawColumns(['product_brand_logo'])
                ->make(true);
            }
            // elseif($customername==null || $customername=='' ){
            //     return DataTables::eloquent(SalesHeader::query()
            // ->where('customer_name','=',$customername)
            // ->where('salesperson_code','=',$saleperson)
            // ->whereBetween('created_at', [$fromdate, $todate]))
            //     ->addIndexColumn()
            //  //  rawColumns(['product_brand_logo'])
            //     ->make(true);
            // }
            else{
                   return DataTables::eloquent(SalesHeader::query()
            ->where('customer_name','=',$customername)
            ->where('salesperson_code','=',$saleperson)
            ->whereBetween('created_at', [$fromdate, $todate]))
                ->addIndexColumn()
             //  rawColumns(['product_brand_logo'])
                ->make(true); 
            }
             
        
        }
    }


    public function Daily_Report(Request $request,$customername,$saleperson,$fromdate,$todate)
    {
        if ($request->ajax()) {
                $date=now("Asia/Phnom_Penh")->format('Y-m-d');
                return DataTables::eloquent(Saleline::query()
                ->where('created_at','like','%'.$date.'%')->get())
                ->addIndexColumn()
             //  rawColumns(['product_brand_logo'])
                ->make(true);
        
             
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date)

    {
        $showbydate=Saleline::select('*',DB::raw('sum(quantity) AS total_count')
        ,DB::raw('sum(unit_price*quantity) AS totalprice'))
       -> where('created_at','like','%'.$date.'%')
       ->groupby('item_no','unit_of_measure')
        ->get();
        return response()->json([
            'showbydate'=>$showbydate,
        ]);
    }



    public function Daily_Report_Search($search)

    {
        $showbydate=Saleline::select('*',DB::raw('sum(quantity) AS total_count')
        ,DB::raw('sum(unit_price*quantity) AS totalprice'))
       -> where('item_no','like','%'.$search.'%')
       ->groupby('item_no','unit_of_measure')
        ->get();
        return response()->json([
            'showbydate'=>$showbydate,
        ]);
    }
    public function datefilter($id,Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(Saleline::select('*',DB::raw('sum(quantity) AS total_count'),DB::raw('sum(unit_price*quantity) AS totalprice'),DB::raw('sum(discount_amount) AS desprice'),DB::raw('sum(unit_price*quantity - discount_amount)  AS priceafterdes'),DB::raw('sum(unit_price) AS unit_prices'))
            -> orderBy('created_at')
            ->where('created_at','like','%'.$id.'%')
            ->groupby('item_no','unit_of_measure')
            )
                ->addIndexColumn()
             //  rawColumns(['product_brand_logo'])
                ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Monthly_report(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(Saleline::select('*',DB::raw('sum(quantity) AS total_count'),DB::raw('sum(unit_price*quantity) AS totalprice'),DB::raw('sum(discount_amount) AS desprice'),DB::raw('sum(unit_price*quantity - discount_amount)  AS priceafterdes'),DB::raw('sum(unit_price) AS unit_prices'))
            -> orderBy('created_at')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupby('item_no','unit_of_measure')
            )
                ->addIndexColumn()
             //  rawColumns(['product_brand_logo'])
                ->make(true);
        }
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
        //
    }
    public function product_return(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(Saleline::select('*',DB::raw('sum(quantity) AS total_count'),DB::raw('sum(unit_price*quantity) AS totalprice'),DB::raw('sum(discount_amount) AS desprice'),DB::raw('sum(unit_price*quantity - discount_amount)  AS priceafterdes'),DB::raw('sum(unit_price) AS unit_prices'))
            -> orderBy('created_at')
            ->whereDay('created_at', Carbon::now()->day)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('document_no','LIKE','%'.'return')
            ->groupby('item_no','unit_of_measure')
            )
                ->addIndexColumn()
             //  rawColumns(['product_brand_logo'])
                ->make(true);
        }
    }
    public function return_filter(Request $request,$id)
    {

        if ($request->ajax()) {
            return DataTables::eloquent(Saleline::select('*',DB::raw('sum(quantity) AS total_count'),DB::raw('sum(unit_price*quantity) AS totalprice'),DB::raw('sum(discount_amount) AS desprice'),DB::raw('sum(unit_price*quantity - discount_amount)  AS priceafterdes'),DB::raw('sum(unit_price) AS unit_prices'))
            -> orderBy('created_at')
            ->where('created_at','like','%'.$id.'%')
            ->where('document_no','LIKE','%'.'return')
            ->groupby('item_no','unit_of_measure')
            )
                ->addIndexColumn()
             //  rawColumns(['product_brand_logo'])
                ->make(true);
        }
       
    }
    public function return_productPrice($id)
    {
         
        $returnPrice=Saleline::select(DB::raw('sum(quantity) AS total_count')
        ,DB::raw('sum(unit_price*quantity) AS totalprice') ,DB::raw('sum(discount_amount) AS discountamount'),DB::raw('sum(unit_price) AS unit_prices')
        ,DB::raw('sum(unit_price*quantity)-sum(discount_amount) as netamount')   )
        ->where('created_at','like','%'.$id.'%')
         -> where('document_no','like','%'.'return')
       ->get();
       return response()->json([
        'status'=>$returnPrice,
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
