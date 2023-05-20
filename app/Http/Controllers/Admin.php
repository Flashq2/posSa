<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Saleline;
use App\Models\Getcustomer;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class Admin extends Controller
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
        $topproduct=Saleline::select('item_description',DB::raw('sum(quantity) AS total_quantity'))
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->groupby('item_no')
        ->orderby('total_quantity','desc')
        ->limit(10)
        ->get();
       return response()->json([
        'topproduct'=>$topproduct,
       ]);
    }
     public function ProductSales(Request $request)
     {
        $date=now("Asia/Phnom_Penh")->format('Y-m-d');
        if($request->ajax()){
            return DataTables::eloquent(Saleline::query()
            ->where('created_at','like','%'.$date.'%'))
                ->addIndexColumn()
             //  rawColumns(['product_brand_logo'])
                ->make(true);
        }
     }


     public function adminchangeheader(Request $request)
     {
        $customer=Getcustomer::
            where('created_at','like','%'.$request->date.'%')
           ->get();
           $item_sale=Saleline::select(DB::raw('sum(unit_price) as total_unitprice'))
            ->where('created_at','like','%'.$request->date.'%')
           ->get();
           $totalqty=Saleline::select(DB::raw('sum(quantity) as qty'))
            -> where('created_at','like','%'.$request->date.'%')
           ->get();
           return response()->json([
            'customer'=>$customer,
            'item_sale'=>$item_sale,
            'totalqty'=>$totalqty,
           ]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     public function FilterTopproduct(Request $request)
     {
        $topproduct=Saleline::select('item_description',DB::raw('sum(quantity) AS total_quantity'))
        ->where('created_at','like','%'.$request->date.'%')
        ->groupby('item_no')
        ->orderby('total_quantity','desc')
        ->limit(10)
        ->get();
       return response()->json([
        'topproduct'=>$topproduct,
       ]);
     }
    public function income(Request $request)
    {
        $income=Saleline::select(DB::raw("DATE_FORMAT(created_at, '%Y-%M') as date"),DB::raw('sum(unit_price) AS total'))
        ->groupby(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
        ->get();
       return response()->json([
        'income'=>$income,
       ]);
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
        //
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
