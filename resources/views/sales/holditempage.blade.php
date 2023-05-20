<a name="top">
    @extends('hader')
    @section('contain')
    @endsection
    <p class="showurl"></p>
    {{-- ៊SweetAlert --}}
    <template id="my-template">
        <swal-title>
            Order first
        </swal-title>
        <swal-icon type="info" color="skyblue"></swal-icon>
        <swal-button type="confirm">
            <a href="">OK</a>
        </swal-button>
        <swal-param name="allowEscapeKey" value="false" />
        <swal-param name="customClass" value='{ "popup": "my-popup" }' />
        <swal-function-param name="didOpen" value="popup => console.log(popup)" />
    </template>
    <div class="payment-confirm">
        <div class="payment-redirectback">
            {{(__('pos.paymentsuccess'))}}
            <img src="{{ asset('tos/success.png') }}" alt="">
            <a href="{{route('posname')}}"><button>{{(__('pos.returntopos'))}}</button></a>
        </div>
    </div>
    <div class="modal fade" id="change_uom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{(__('pos.select'))}}</h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <select name="stockuom" id="stockuom" class="form-control">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary setuom">Set Uom</button>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item"><a class="nav-link" href="{{ url('dashboard') }}">ADMIN </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('user/user') }}">USER </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('customer.index') }}">CUSTOMER </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('itemgroup.index') }}">ITEM GROUP </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('itemcategory.index') }}">ITEM CATEGORY </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('newitem.index') }}">ITEM </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('itemuomI.index') }}">ITEM UOM </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('uommenu') }}">UOM </a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('report/reportdata') }}">POS REPORT<i
                            class="fa-solid fa-file-csv"></i> </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ url('barcode/barcode-page') }}">GENERATE BARCODE
                        <i class="fa-solid fa-barcode"></i></a></li>

            </ul>
        </div>
    </div>

    <nav class="navbar navbar-expand navbar-light fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item"><a class="nav-link" href="{{route('posname')}}">Return To POS</a></li>

                    {{-- <li class="nav-item"><a class="nav-link" href="{{ url('report/reportdata') }}">POS REPORT<i
                                class="fa-solid fa-file-csv"></i> </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('barcode/barcode-page') }}">GENERATE
                            BARCODE
                            <i class="fa-solid fa-barcode"></i></a></li>
                    <li class="nav-item"><a class="nav-link closes" href="">Close Register</a></li> --}}



                </ul>

                <ul class="navbar-nav flex-row">
                    <!-- Icons -->
                    <li class="nav-item">

                        <i class="fa-solid fa-key short"></i>

                    </li>


                </ul>
            </div>
            <!-- Collapsible wrapper -->

        </div>
        <!-- Container wrapper -->
    </nav>
    </div>
    </div>
    </div>

    <!-- Navbar -->
    <div class="container-fluid">
        <div class="row">

            <div class="titleandsearch">
                <div class="post">
                    <div class="row">
                        <div class="col-xl-3 col-lg-8 col-md-8 col-sm-12 col-8">
                            <div class="btn-group left" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{(__('pos.hold'))}} <i class="fas fa-bell"></i>
                                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                                </button>
                                <ul class="dropdown-menu appendd" aria-labelledby="btnGroupDrop1">
                                    @foreach ($hold as $document)
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ url("holditem/$document->document_no") }}">{{ $document->document_no }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-8 col-md-8 col-sm-12 col-8">
                            <input type="text" name="scan" id="scan" class="form-control"
                                placeholder="{{(__('pos.barcode'))}}" autocomplete="off">
                        </div>
                        <div class="col-xl-3 col-lg-8 col-md-8 col-sm-12 col-8">
                            <input type="search" name="searchitem" id="searchitem" class="form-control"
                                placeholder="{{(__('pos.search'))}}" autocomplete="off">
                        </div>
                        <div class="col-xl-3 col-lg-8 col-md-8 col-sm-12 col-8">
                            <select name="category" id="category" class="form-control">
                                <option value="0">{{(__('pos.selectcate'))}}</option>
                                <option value="Show_All_Category">{{(__('pos.allcate'))}}</option>
                                @foreach ($category as $categorys)
                                    <option value="{{ $categorys->item_category_code }}">
                                        {{ $categorys->item_category_code }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>




                </div>

            </div>

        </div>
        <div class="action-payment showpaymentoption">
            Table Payment <i class="fa-solid fa-table"></i>
        </div>
        <div class="action-payment menusideleft" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
            Menu
        </div>

        <div class="item">
            @foreach ($datatest as $itemd)
                <div class="card1">
                    <div class="information">{{(__('pos.uom'))}}:
                        {{ $itemd->unit_of_measure_code }}
                    </div>
                    <div class="image">


                        @if ($itemd->picture == null)
                            <img src="{{ asset('img/blue1.webp') }}" alt="">
                        @else
                            <img src="{{ asset('tos/' . $itemd->picture) }}" alt="">
                        @endif
                    </div>
                    <div class="list">
                        <h6 class="id">{{ $itemd->id }}</h6>
                        <h6 class="code">{{ $itemd->item_no }}</h6>
                        <h6 class="price">{{ $itemd->unit_price }}</h6>
                        <h6 class="des">{{ $itemd->description }}</h6>
                        <h6 class="des1">{{ $itemd->description_2 }}</h6>
                        <h6 class="uom">{{ $itemd->unit_of_measure_code }}</h6>
                        <h6 class="qtyuom">{{ $itemd->qty_per_unit }}</h6>
                        <h6 class="itemgcode">{{ $itemd->item_group_code }}</h6>
                        <h6 class="itemccode">{{ $itemd->item_category_code }}</h6>
                        <div class="row">

                            <div class="left-title">
                                Price: {{ Str::limit($itemd->unit_price, 7, 0) }}$
                            </div>
                            <div class="right-title">
                                Name:{{ Str::limit($itemd->description) }}
                            </div>

                        </div>
                        <p class="buy">{{(__('pos.add'))}}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="row">
        <div class="col-4">

            <div class="contain">
                <h2>{{(__('pos.noproduct'))}}!</h2>
                <div class="row">

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="" class="form-label">VAT</label>
                            <input type="text" id="vat" class="form-control" value="10%">
                        </div>


                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="" class="form-label">{{(__('pos.exchange'))}}</label>
                            <input type="number" id="exchanges" class="form-control"
                                placeholder="Enter exchanges Rate" value="4000">
                        </div>

                    </div>
                </div>
                <div class="mb-3">
                    <p><b>{{(__('pos.customername'))}}</b><button class="adminaduder">{{(__('pos.addnewcustomer'))}}</button></p>

                    <select name="customer" id="customer" class="customers">
                        @foreach ($customer as $cus)
                            <option value="{{ $cus->id }}">
                                {{ $cus->name }}

                            </option>
                        @endforeach

                    </select>
                </div>
                <div class="mb-3">
                    <div class="controlaction">
                        <div class="action-payment payment">
                            {{(__('pos.payment'))}} <i class="fa-regular fa-credit-card"></i>
                        </div>
                        <div class="action-payment print" id="print" onclick="PrintPdf()">
                            {{(__('pos.print'))}} <i class="fa-solid fa-print"></i>
                        </div>
                        <div class="action-payment hold">
                            {{(__('pos.hold'))}} <i class="fa-solid fa-pen-fancy"></i>
                        </div>
                        <div class="action-payment clear">
                            {{(__('pos.clear'))}} <i class="fa-regular fa-trash-can"></i>
                        </div>
                        <a href="#top">
                            <div class="action-payment">

                                {{(__('pos.to_top'))}} <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            </div>
                        </a>
                        <div class="action-payment table-payment">
                            {{(__('pos.table'))}} <i class="fa-solid fa-table"></i>
                        </div>

                    </div>

                </div>



                <table class="table" id="printtable">
                    <thead>
                        <tr class="">

                            <th>{{(__('pos.item_no'))}}</th>
                            <th>{{(__('pos.price'))}}</th>
                            <th>{{(__('pos.qty'))}}</th>
                            <th>{{(__('pos.dis'))}} <select name="discount_type" id="discount_type"  style="border:1px solid skyblue;width:60px;border-radius:2px">
                                <option value="1">%</option>
                                <option value="2">$</option>
                                </select></th>
                            <th>Uom</th>
                            <th>{{(__('pos.subtotal'))}}</th>
                            <th>{{(__('pos.clear'))}}</th>

                        </tr>
                    </thead>
                    <tbody  >
                        @foreach ($table as $datalist)
                 
                        <tr>
                            <td>{{ $datalist->item_no }}</td>
                            <td>{{ Str::substr($datalist->unit_price, 0, 4) }}</td>
                            <td><input type="number" class="hello" name="{{ $datalist->item_no }}"
                                    id="{{ $datalist->item_no }}" value={{Str::limit( $datalist->quantity,4,0) }}>
                            </td>
                            <th><input type="number" id="${id}p" value="{{Str::limit($datalist->discount_percentage,4,0)}}" class="thdiscount" ></th>
                            <th><span class="click">{{$datalist->unit_of_measure}}</span></th>

                            <td class="{{ $datalist->item_no }}s">{{ Str::substr($datalist->amount, 0, 4) }}</td>
                            <td class="{{ $datalist->item_no }}d" id="none" class="none">
                                {{ $datalist->amount }}</td>
                            <td><i class="fa-solid fa-xmark"></i></td>
                            <td class="none">{{ $datalist->item_description }}</td>
                            <td class="none">{{ $datalist->item_description_2 }}</td>
                            <td class="none">{{ $datalist->unit_of_measure }}</td>
                            <td class="none">{{ $datalist->qty_per_unit_of_measure }}</td>
                            <td class="none">{{ $datalist->item_group_code }}</td>
                            <td class="none">{{ $datalist->item_category_code }}</td>
                            <td class="none">{{ $datalist->unit_price }}</td>
                            <th class="none">{{ $datalist->id}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="total ">
                {{(__('pos.totalitem'))}}: <span>0</span>


            </div>
            <div class="totalprice">
                <table>
                    <tr>
                        <th style="width:40%">{{(__('pos.net'))}}</th>
                        <th style="width:30%">{{(__('pos.groos'))}}</th>
                        <th>{{(__('pos.dis'))}}</th>

                    </tr>
                    <tr>
                        <td> <span>0</span>$ </td>
                        <td>
                            <p>0</p>
                        </td>
                        <td>
                            <h6 class="desamount">0</h6>
                        </td>
                    </tr>
                </table>
                <br>


            </div>
            <div class="actionbutton">

                {{-- <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-primary payment">Payment</button>
                <button type="button" class="btn btn-primary print">Print Bill</button>
                <button type="button" class="btn btn-primary order">Print Order</button>
                <button type="button" class="btn btn-warning hold">Hold</button>
                <button type="button" class="btn btn-danger  clear">Clear</button>
                <button type="button" class="btn btn-danger back"><a href="#top">To top</a></button>



            </div> --}}
            </div>



        </div>
    </div>


    <div class="readmore">
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-primary getmore"> More.. <span class="countitem">60</span> of
                {{ $count->count() }}</button>


            <div class="btn-group gro" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Select Limit
                </button>
                <ul class="dropdown-menu dataopt" aria-labelledby="btnGroupDrop1">
                    <li data-opt="10">10
</a></li>
<li data-opt="20">20</a></li>
<li data-opt="50">50</a></li>
<li data-opt="100">100</a></li>
<li data-opt="200">200</a></li>
</ul>
</div>
</div>

</div>
{{-- <div class="spinners">
    <svg viewBox="25 25 50 50" class="circular">
        <circle stroke-miterlimit="10" stroke-width="3" fill="none" r="20" cy="50"
            cx="50" class="path"></circle>
    </svg>
</div> --}}

<div class="showshortcut">
    <div class="top-short">
        ShortCut Key
        <i class="fa-solid fa-arrow-right-long flo"></i>
    </div>

    {{-- ======= --}}
    <div class="short-right">
        <b>ShortCut Keys</b>
    </div>
    <div class="short-left">
        <b> Action</b>
    </div>
    {{-- ======= --}}
    <div class="short-right">
        Payment
    </div>
    <div class="short-left">
        Alt+p
    </div>

    {{-- ======= --}}
    <div class="short-right">
        Print Order
    </div>
    <div class="short-left">
        Alt+p
    </div>
    {{-- ======= --}}
    <div class="short-right">
        Show FullScreen
    </div>
    <div class="short-left">
        Alt+f
    </div>
    {{-- ======= --}}
    <div class="short-right">
        Hold Item
    </div>
    <div class="short-left">
        Alt+h
    </div>
    {{-- ======= --}}
</div>

</div>
@include('sales.modaladdcustomer')
@include('sales.modalpayment')
@include('sales.hold')


{{-- <button class="readmore"> <p class="countitem">60</p><p>{{$cott->count()}}</p></button> --}}

<iframe id="printf" name="printf">
</iframe>
</div>
@include('script')
@include('sales.holdscript')