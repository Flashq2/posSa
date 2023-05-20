<?php

namespace App\Http\Controllers;

use App\Models\Itemmodel;
use App\Models\Itemuommodel;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_no=Itemuommodel::all();
        return view('barcode.BarcodeGen',compact('item_no'));
    }
    public function showbarcode()
    {
        $datatest = DB::table('item_unit_of_measures')
        ->select('item_unit_of_measures.identifier_code')
        ->join('items', 'items.no', '=', 'item_unit_of_measures.item_no')
        ->join('unit_of_measures', 'item_unit_of_measures.unit_of_measure_code', '=', 'unit_of_measures.code')
        ->where('item_unit_of_measures.identifier_code','!=','null')
        ->limit(100)
        ->orderBy('item_unit_of_measures.id')
        ->get();
        // $show=[];
        // foreach($datatest as  $key => $datas){
        //    $show[].=
           
        //    '<div class="col-2">' .
        //    '<svg id="barcode">'.
             
        //     '<svg>'.
        //    '</div>' ;
           
        // }
        return response()->json([
            'datatest'=>$datatest,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showuom(Request $request)
    {
        $filter=Itemuommodel::select('unit_of_measure_code')
        ->where('item_unit_of_measures.item_no', '=',$request->ethis)
        ->get();
        return response()->json([
            'status'=>$filter,
            'item_no'=>$request->ethis,
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
    public function barcode_code(Request $request)
    {
        $select=Itemuommodel::where('item_no',$request->input('item'))
        ->where('unit_of_measure_code',$request->uom)
        ->get();
        return response()->json([
            'select'=>$select,
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
