<?php

namespace App\Http\Controllers;

use App\Models\Uommodel;
use App\Models\Itemmodel;
use Illuminate\Http\Request;
use App\Models\Permissionmodel;
use Illuminate\Support\Facades\Auth;

class Item_Stock extends Controller
{
    
//Return View

public function index()
{
    $item_no=Itemmodel::all();
    $uom=Uommodel::all();
    $getpermissioncode=Permissionmodel::where('code','=',Auth::user()->permission_code)->get();
   return view('Item_Stock.Stock',compact('item_no','uom','getpermissioncode'));
}
}
