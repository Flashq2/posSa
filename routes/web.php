<?php

use Whoops\Run;
use Carbon\Carbon;
use App\Models\Posmodel;
use App\Models\Saleline;
use App\Models\Uommodel;
use App\Models\Itemmodel;
use App\Models\Getcustomer;
use App\Models\SettingModel;
use App\Http\Controllers\User;
use App\Http\Controllers\Admin;
use App\Http\Controllers\ItemUom;
use App\Http\Controllers\Mainpos;
use App\Http\Controllers\Customer;
use App\Http\Controllers\UserRole;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PosReport;
use Illuminate\Support\Facades\App;
use Livewire\Commands\TouchCommand;
use App\Http\Controllers\HoldSystem;
use App\Http\Controllers\Item_Stock;
use App\Http\Controllers\Permission;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UomControll;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemCategory;
use App\Http\Controllers\ItemController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ItemGroupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        $usertype = Auth::user()->inactived;
        $get = SettingModel::latest()->first();
        $lastesd = SettingModel::latest()->first('language');
        $lan = $lastesd->language;
        App::setlocale($lan);
        if ($usertype == '1') {
            if (Auth::user()->user_role_code == "User") {
                $customer = Getcustomer::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->get();
                $item = Itemmodel::all();
                $item_sale = Saleline::select(DB::raw('sum(unit_price) as total_unitprice'))
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->get();
                $totalqty = Saleline::select(DB::raw('sum(quantity) as qty'))
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->get();
                return view('User_Dashboard', compact('customer', 'item', 'item_sale', 'totalqty','get'));
            } else if(Auth::user()->user_role_code == "Admin") {
                $customer = Getcustomer::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->get();
                $item = Itemmodel::all();
                $item_sale = Saleline::select(DB::raw('sum(unit_price) as total_unitprice'))
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->get();
                $totalqty = Saleline::select(DB::raw('sum(quantity) as qty'))
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->get();
                return view('admin', compact('customer', 'item', 'item_sale', 'totalqty','get'));
            }
            else if(Auth::user()->user_role_code == "Seller"){
                $usertype = Auth::user();
                return view('sellerpage.seller',compact('usertype'));
            }
        } else {
            return view('dashboard');
        }
    })->name('dashboard');
});
Route::get('/Iferror', function () {
    return view('If_UserRole_Not_Responce');
});



// Route::middleware(['checkRole:admin'])->group(function(){
//     //Your routes  
//   });

Route::group(['middleware' => ['group:admin']], function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::get('students', [Customer::class, 'getStudents'])->name('customer.list');
        Route::resource('customer', Customer::class);
        Route::post('addcustomer', [Customer::class, 'store']);
        Route::get('editcustomer/{id}', [Customer::class, 'show']);
        Route::post('submitedit/{id}', [Customer::class, 'submitedit']);
        Route::get('delete/{id}', [Customer::class, 'destroy']);
    });
    Route::group(['prefix' => 'userrole'], function () {
        Route::get("/userrole", [UserRole::class, 'index']);
        Route::get('userrolelist', [UserRole::class, 'getuserrole'])->name('userrole.list');
        Route::post("adduserrole", [UserRole::class, 'create']);
        Route::post('edituserrole/{id}', [UserRole::class, 'edit']);
        Route::get('deleteuserrole/{id}', [UserRole::class, 'destroy']);
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('/permission', [Permission::class, 'index']);
        Route::get('getpermission', [Permission::class, 'create'])->name('permission.list');
        Route::post('addpermission', [Permission::class, 'store']);
        Route::post('editpermission/{id}', [Permission::class, 'edit']);
        Route::get('deletepermission/{id}', [Permission::class, 'destroy']);
    });
   
    
    Route::group(['prefix' => 'user'], function () {
        Route::get('/user', [User::class, 'index']);
        Route::get('/getuser', [User::class, 'getuser']);
        Route::post('/adduser', [User::class, 'store']);
        Route::get('/deleteuser/{id}', [User::class, 'destroy']);
        Route::post('/edit/{id}', [User::class, 'update']);
        Route::get('/showdatauser/edit/{id}', [User::class, 'showdate_edit']);
        Route::get('userlist', [User::class, 'getuser'])->name('userlist.list');
    });
    
    Route::group(['prefix' => 'item'], function () {
        Route::resource('newitem', ItemController::class);
        Route::get('itemlist', [ItemController::class, 'getitem'])->name('itemlist.list');
        Route::post('additem', [ItemController::class, 'store']);
        Route::get('edititem/{id}', [ItemController::class, 'edit']);
        Route::post('edititempost/{id}', [ItemController::class, 'update']);
        Route::post('deleteidtem/{id}', [ItemController::class, 'destroy']);
    });
    
    Route::group(['prefix' => 'itemgroup'], function () {
        Route::resource('itemgroup', ItemGroupController::class);
        Route::get('itemgrouplist', [ItemGroupController::class, "store"])->name('itemgrouplist.list');
        Route::post('additemgroup', [ItemGroupController::class, 'create']);
        Route::get('showinfo/{id}', [ItemGroupController::class, 'edit']);
        Route::post('editpostgroup/{id}', [ItemGroupController::class, 'update']);
        Route::post('deletgroup/{id}', [ItemGroupController::class, 'destroy']);
    });
    
    Route::group(['prefix' => 'itemcategory'], function () {
        Route::resource('itemcategory', ItemCategory::class);
        Route::get("itemcatelist", [ItemCategory::class, 'create'])->name('itemcatelist.list');
        Route::post('addicate', [ItemCategory::class, 'store']);
        Route::get('showinfocate/{id}', [ItemCategory::class, 'edit']);
        Route::post('editpostcate/{id}', [ItemCategory::class, 'update']);
        Route::post('deletcate/{id}', [ItemCategory::class, 'destroy']);
    });
    Route::group(['prefix' => 'itemuom'], function () {
        Route::resource('itemuomI', ItemUom::class);
        Route::get('showdatauom', [ItemUom::class, 'store'])->name('showdatauom.list');
        Route::post('showdatauom/addtitemuom', [ItemUom::class, 'create']);
        Route::get('showinfouom/{id}', [ItemUom::class, 'edit']);
        Route::post('itemuom/edit/{id}', [ItemUom::class, 'update']);
        Route::post('deletuom/{id}', [ItemUom::class, 'destroy']);
    });
    
    Route::group(['prefix' => 'uom'], function () {
        Route::get('uommenu', [UomControll::class, 'index'])->name('uommenu');
        Route::get('showuom', [UomControll::class, 'create'])->name('showuom.list');
        Route::post('showdatauom/adduom', [UomControll::class, 'store']);
        Route::get('showinfouomlist/{id}', [UomControll::class, 'edit']);
        Route::post('uom/edit/{id}', [UomControll::class, 'update']);
        Route::post('deletuoms/{id}', [UomControll::class, 'destroy']);
    });
    
    
    Route::group(['prefix' => 'report'], function () {
        Route::get('/reportdata', [PosReport::class, 'index']);
        Route::get('dialyreport', [PosReport::class, 'Daily_Report']);
        Route::get('/date/showitembydate/{date}', [PosReport::class, 'show']);
        Route::get('/date/Daily_Report_Search/{search}', [PosReport::class, 'Daily_Report_Search']);
        Route::get('/month/search', [PosReport::class, 'Monthsearch']);
        Route::get('/monthdate/datafilter/{id}', [PosReport::class, 'datefilter']);
        Route::get('/salereport/salereportpage', [PosReport::class, 'Sale_Report'])->name('salereport.list');
        Route::get('/salereport/Monthlyreport', [PosReport::class, 'Monthly_report'])->name('monthlyreport.list');
        Route::get('/salereport/return', [PosReport::class, 'product_return'])->name('returnSale.list');
        Route::get('/salereport/filter_data_by_query/{customername}/{saleperson}/{fromdate}/{todate}', [PosReport::class, 'filter_sale_report']);
        Route::get('/return/retrun_report/{id}',[PosReport::class,'return_filter']);
        Route::get('/return/retrun_allproduct/{id}',[PosReport::class,'return_productPrice']);
        Route::get('/return/topproductthismonth',[PosReport::class,'Top_product_thismonth']);

    });
    
    
    Route::group(['prefix' => 'barcode'], function () {
        Route::get('/barcode-page', [BarcodeController::class, 'index'])->name('generate.barcode');
        Route::get('/show/showbarcode', [BarcodeController::class, 'showbarcode']);
        Route::get('/show/uom', [BarcodeController::class, 'showuom']);
        Route::get('/show/barcode_code', [BarcodeController::class, 'barcode_code']);
    });
    
    
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/datatable_saletoday', [Admin::class, 'ProductSales'])->name('sale_report.list');
        Route::get('/returntopproduct', [Admin::class, 'index']);
        Route::get('/saleincome', [Admin::class, 'income']);
        Route::get('/FilterTopProduct', [Admin::class, 'FilterTopproduct']);
        Route::get('/AdminChangeHeaderDate', [Admin::class, 'adminchangeheader']);
    });
    
    Route::group(['prefix' => 'stock'], function () {
        Route::resource('item_stock', Item_Stock::class);
    });
    Route::group(['prefix' => 'setting'], function () {
        Route::resource('setting',SettingController::class);
        Route::post('submit',[SettingController::class,'create']);
    });
    //Sales and Return 
    Route::get('posname', [Mainpos::class, 'index'])->name('posname');
    Route::get('itemonline', [Mainpos::class, 'create'])->name('itemonline.list');
    Route::get('search', [Mainpos::class, 'search']);
    Route::get('scanbarcode', [Mainpos::class, 'scan']);
    Route::get('setlimit', [Mainpos::class, 'limit']);
    Route::get('filtercatagory', [Mainpos::class, 'category']);
    Route::post('adminaddcustomer', [Mainpos::class, 'addcustomer']);
    Route::post('additemtosaleline', [Mainpos::class, 'addsaleline']);
    Route::post('additemtohold', [Mainpos::class, 'additemtohold']);
    Route::post('addtosaleheader/{id}', [Mainpos::class, 'addtosaleheader']);
    Route::post('register', [Mainpos::class, 'open_register']);
    Route::post('close_register', [Mainpos::class, 'close_register']);
    Route::post('update_register', [Mainpos::class, 'update_register']);
    Route::get('changeuom', [Mainpos::class, 'search_uom']);
    Route::get('ShowUomByitemNo', [Mainpos::class, 'filteruom']);
    Route::get('ReturnProduct', [Mainpos::class, 'returnproduct']);
    Route::post('SubmitReturnProduct', [Mainpos::class, 'submitreturn']);
    Route::post('ReturnwithSaleheader', [Mainpos::class, 'sale_return_customer']);
    //For Hold Item
    Route::get("holditem/{id}", [HoldSystem::class, 'index']);
    Route::post("holdaddcustomer", [HoldSystem::class, 'addcustomers']);
    Route::post("/holdaddtosaleline", [HoldSystem::class, 'holdaddtosaleline']);
    Route::post("/holdaddtosaleheader/{id}", [HoldSystem::class, 'holdaddtosaleheader']);
    Route::post('deletitemafterload/{id}', [HoldSystem::class, 'destroy']);
    Route::get('/holdlimititem', [HoldSystem::class, 'holdlimititem']);
    Route::get('/holdtosearchitem', [HoldSystem::class, 'holdtosearchitem']);
    Route::get('/scanbarcodeItem', [HoldSystem::class, 'holdscan']);
    Route::get('clearholditem', [HoldSystem::class, 'clearsession']);
    Route::post('/holdSaveSession', [HoldSystem::class, 'sessions']);
    Route::get('ShowChangeUom', [HoldSystem::class, 'returnuom']);
    Route::get('ShowItemByCategory', [HoldSystem::class, 'getcategory']);
    Route::get("SetNewUOm", [HoldSystem::class, 'newuom']);
});



Route::group(['middleware' => ['group:admin,usercode']], function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::get('students', [Customer::class, 'getStudents'])->name('customer.list');
        Route::resource('customer', Customer::class);
        Route::post('addcustomer', [Customer::class, 'store']);
        Route::get('editcustomer/{id}', [Customer::class, 'show']);
        Route::post('submitedit/{id}', [Customer::class, 'submitedit']);
        Route::get('delete/{id}', [Customer::class, 'destroy']);
    });
    
    Route::group(['prefix' => 'user'], function () {
        Route::get('/user', [User::class, 'index']);
        Route::get('/getuser', [User::class, 'getuser']);
        Route::post('/adduser', [User::class, 'store']);
        Route::get('/deleteuser/{id}', [User::class, 'destroy']);
        Route::post('/edit/{id}', [User::class, 'update']);
        Route::get('/showdatauser/edit/{id}', [User::class, 'showdate_edit']);
        Route::get('userlist', [User::class, 'getuser'])->name('userlist.list');
    });
    
    Route::group(['prefix' => 'item'], function () {
        Route::resource('newitem', ItemController::class);
        Route::get('itemlist', [ItemController::class, 'getitem'])->name('itemlist.list');
        Route::post('additem', [ItemController::class, 'store']);
        Route::get('edititem/{id}', [ItemController::class, 'edit']);
        Route::post('edititempost/{id}', [ItemController::class, 'update']);
        Route::post('deleteidtem/{id}', [ItemController::class, 'destroy']);
    });
    
    Route::group(['prefix' => 'itemgroup'], function () {
        Route::resource('itemgroup', ItemGroupController::class);
        Route::get('itemgrouplist', [ItemGroupController::class, "store"])->name('itemgrouplist.list');
        Route::post('additemgroup', [ItemGroupController::class, 'create']);
        Route::get('showinfo/{id}', [ItemGroupController::class, 'edit']);
        Route::post('editpostgroup/{id}', [ItemGroupController::class, 'update']);
        Route::post('deletgroup/{id}', [ItemGroupController::class, 'destroy']);
    });
    
    Route::group(['prefix' => 'itemcategory'], function () {
        Route::resource('itemcategory', ItemCategory::class);
        Route::get("itemcatelist", [ItemCategory::class, 'create'])->name('itemcatelist.list');
        Route::post('addicate', [ItemCategory::class, 'store']);
        Route::get('showinfocate/{id}', [ItemCategory::class, 'edit']);
        Route::post('editpostcate/{id}', [ItemCategory::class, 'update']);
        Route::post('deletcate/{id}', [ItemCategory::class, 'destroy']);
    });
    
    
    
    Route::group(['prefix' => 'itemuom'], function () {
        Route::resource('itemuomI', ItemUom::class);
        Route::get('showdatauom', [ItemUom::class, 'store'])->name('showdatauom.list');
        Route::post('showdatauom/addtitemuom', [ItemUom::class, 'create']);
        Route::get('showinfouom/{id}', [ItemUom::class, 'edit']);
        Route::post('itemuom/edit/{id}', [ItemUom::class, 'update']);
        Route::post('deletuom/{id}', [ItemUom::class, 'destroy']);
    });
    
    Route::group(['prefix' => 'uom'], function () {
        Route::get('uommenu', [UomControll::class, 'index'])->name('uommenu');
        Route::get('showuom', [UomControll::class, 'create'])->name('showuom.list');
        Route::post('showdatauom/adduom', [UomControll::class, 'store']);
        Route::get('showinfouomlist/{id}', [UomControll::class, 'edit']);
        Route::post('uom/edit/{id}', [UomControll::class, 'update']);
        Route::post('deletuoms/{id}', [UomControll::class, 'destroy']);
    });
    
    
    // Route::group(['prefix' => 'report'], function () {
    //     Route::get('/reportdata', [PosReport::class, 'index']);
    //     Route::get('dialyreport', [PosReport::class, 'Daily_Report']);
    //     Route::get('/date/showitembydate/{date}', [PosReport::class, 'show']);
    //     Route::get('/date/Daily_Report_Search/{search}', [PosReport::class, 'Daily_Report_Search']);
    //     Route::get('/month/search', [PosReport::class, 'Monthsearch']);
    //     Route::get('/monthdate/datafilter/{id}', [PosReport::class, 'datefilter']);
    //     Route::get('/salereport/salereportpage', [PosReport::class, 'Sale_Report'])->name('salereport.list');
    //     Route::get('/salereport/Monthlyreport', [PosReport::class, 'Monthly_report'])->name('monthlyreport.list');
    //     Route::get('/salereport/return', [PosReport::class, 'product_return'])->name('returnSale.list');
    //     Route::get('/salereport/filter_data_by_query/{customername}/{saleperson}/{fromdate}/{todate}', [PosReport::class, 'filter_sale_report']);
    //     Route::get('/return/retrun_report/{id}',[PosReport::class,'return_filter']);
    //     Route::get('/return/retrun_allproduct/{id}',[PosReport::class,'return_productPrice']);
    //     Route::get('/return/topproductthismonth',[PosReport::class,'Top_product_thismonth']);

    // });
    
    
    Route::group(['prefix' => 'barcode'], function () {
        Route::get('/barcode-page', [BarcodeController::class, 'index'])->name('generate.barcode');
        Route::get('/show/showbarcode', [BarcodeController::class, 'showbarcode']);
        Route::get('/show/uom', [BarcodeController::class, 'showuom']);
        Route::get('/show/barcode_code', [BarcodeController::class, 'barcode_code']);
    });
    
    
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/datatable_saletoday', [Admin::class, 'ProductSales'])->name('sale_report.list');
        Route::get('/returntopproduct', [Admin::class, 'index']);
        Route::get('/saleincome', [Admin::class, 'income']);
        Route::get('/FilterTopProduct', [Admin::class, 'FilterTopproduct']);
        Route::get('/AdminChangeHeaderDate', [Admin::class, 'adminchangeheader']);
    });
    
    
    //Sales and Return 
    Route::get('posname', [Mainpos::class, 'index'])->name('posname');
    Route::get('itemonline', [Mainpos::class, 'create'])->name('itemonline.list');
    Route::get('search', [Mainpos::class, 'search']);
    Route::get('scanbarcode', [Mainpos::class, 'scan']);
    Route::get('setlimit', [Mainpos::class, 'limit']);
    Route::get('filtercatagory', [Mainpos::class, 'category']);
    Route::post('adminaddcustomer', [Mainpos::class, 'addcustomer']);
    Route::post('additemtosaleline', [Mainpos::class, 'addsaleline']);
    Route::post('additemtohold', [Mainpos::class, 'additemtohold']);
    Route::post('addtosaleheader/{id}', [Mainpos::class, 'addtosaleheader']);
    Route::post('register', [Mainpos::class, 'open_register']);
    Route::post('close_register', [Mainpos::class, 'close_register']);
    Route::post('update_register', [Mainpos::class, 'update_register']);
    Route::get('changeuom', [Mainpos::class, 'search_uom']);
    Route::get('ShowUomByitemNo', [Mainpos::class, 'filteruom']);
    Route::get('ReturnProduct', [Mainpos::class, 'returnproduct']);
    Route::post('SubmitReturnProduct', [Mainpos::class, 'submitreturn']);
    Route::post('ReturnwithSaleheader', [Mainpos::class, 'sale_return_customer']);
    //For Hold Item
    Route::get("holditem/{id}", [HoldSystem::class, 'index']);
    Route::post("holdaddcustomer", [HoldSystem::class, 'addcustomers']);
    Route::post("/holdaddtosaleline", [HoldSystem::class, 'holdaddtosaleline']);
    Route::post("/holdaddtosaleheader/{id}", [HoldSystem::class, 'holdaddtosaleheader']);
    Route::post('deletitemafterload/{id}', [HoldSystem::class, 'destroy']);
    Route::get('/holdlimititem', [HoldSystem::class, 'holdlimititem']);
    Route::get('/holdtosearchitem', [HoldSystem::class, 'holdtosearchitem']);
    Route::get('/scanbarcodeItem', [HoldSystem::class, 'holdscan']);
    Route::get('clearholditem', [HoldSystem::class, 'clearsession']);
    Route::post('/holdSaveSession', [HoldSystem::class, 'sessions']);
    Route::get('ShowChangeUom', [HoldSystem::class, 'returnuom']);
    Route::get('ShowItemByCategory', [HoldSystem::class, 'getcategory']);
    Route::get("SetNewUOm", [HoldSystem::class, 'newuom']);
});
Route::fallback(function(){
return view('not_found');
});







Route::group(['middleware' => ['group:seller,admin,usercode']], function () {
    Route::get('posname', [Mainpos::class, 'index'])->name('posname');
    Route::get('itemonline', [Mainpos::class, 'create'])->name('itemonline.list');
    Route::get('search', [Mainpos::class, 'search']);
    Route::get('scanbarcode', [Mainpos::class, 'scan']);
    Route::get('setlimit', [Mainpos::class, 'limit']);
    Route::get('filtercatagory', [Mainpos::class, 'category']);
    Route::post('adminaddcustomer', [Mainpos::class, 'addcustomer']);
    Route::post('additemtosaleline', [Mainpos::class, 'addsaleline']);
    Route::post('additemtohold', [Mainpos::class, 'additemtohold']);
    Route::post('addtosaleheader/{id}', [Mainpos::class, 'addtosaleheader']);
    Route::post('register', [Mainpos::class, 'open_register']);
    Route::post('close_register', [Mainpos::class, 'close_register']);
    Route::post('update_register', [Mainpos::class, 'update_register']);
    Route::get('changeuom', [Mainpos::class, 'search_uom']);
    Route::get('ShowUomByitemNo', [Mainpos::class, 'filteruom']);
    Route::get('ReturnProduct', [Mainpos::class, 'returnproduct']);
    Route::post('SubmitReturnProduct', [Mainpos::class, 'submitreturn']);
    Route::post('ReturnwithSaleheader', [Mainpos::class, 'sale_return_customer']);
    //For Hold Item
    Route::get("holditem/{id}", [HoldSystem::class, 'index']);
    Route::post("holdaddcustomer", [HoldSystem::class, 'addcustomers']);
    Route::post("/holdaddtosaleline", [HoldSystem::class, 'holdaddtosaleline']);
    Route::post("/holdaddtosaleheader/{id}", [HoldSystem::class, 'holdaddtosaleheader']);
    Route::post('deletitemafterload/{id}', [HoldSystem::class, 'destroy']);
    Route::get('/holdlimititem', [HoldSystem::class, 'holdlimititem']);
    Route::get('/holdtosearchitem', [HoldSystem::class, 'holdtosearchitem']);
    Route::get('/scanbarcodeItem', [HoldSystem::class, 'holdscan']);
    Route::get('clearholditem', [HoldSystem::class, 'clearsession']);
    Route::post('/holdSaveSession', [HoldSystem::class, 'sessions']);
    Route::get('ShowChangeUom', [HoldSystem::class, 'returnuom']);
    Route::get('ShowItemByCategory', [HoldSystem::class, 'getcategory']);
    Route::get("SetNewUOm", [HoldSystem::class, 'newuom']);
});
