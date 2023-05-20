<!DOCTYPE html>
<html lang="en">
<title>POS Report</title>
<script src="https://kit.fontawesome.com/bca9825c0c.js" crossorigin="anonymous"></script>

{{-- <link rel="icon" href="{{ asset('tos/1677044236.jpg') }}" type="image/gif" sizes="16x16"> --}}
@extends('hader')
@section('contain')
@endsection


<body>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab"
                    aria-controls="nav-home" aria-selected="true">{{(__('report.daily'))}}</a>

                <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab"
                    aria-controls="nav-profile" aria-selected="false">{{(__('report.monthly'))}}</a>

                <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab"
                    aria-controls="nav-contact" aria-selected="false">{{(__('report.sale'))}}</a>
                <a class="nav-link" id="nav-topproduct-tab" data-bs-toggle="tab" href="#nav-top-product" role="tab"
                    aria-controls="nav-top-product" aria-selected="false">{{(__('report.top_product'))}}</a>
                <a class="nav-link" id="nav-productreport-tab" data-bs-toggle="tab" href="#nav-product-report"
                    role="tab" aria-controls="nav-contact" aria-selected="false">{{(__('report.return'))}}</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                {{-- Daily  Report  --}}
                <div class="row">
                    <div class="col-2">
                        <label for="" class="form-label">{{(__('report.select_date'))}}:</label>
                        <input type="date" class="form-control " id="changedate">
                    </div>
                    <div class="col-2">
                        <label for="" class="form-label">{{(__('report.search_product'))}}</label>
                        <input type="text" class="form-control" placeholder="{{(__('report.enter_item_code'))}}" id="dailySaleSearch">
                    </div>


                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <div class="cardreport">
                                <div class="showvalue itemsale">
                                    <h3>450</h3>
                                </div>
                                <div class="headingimg">{{(__('report.total_item'))}}
                                    <div class="author"> By <span class="name">Blue
                                            Technology</span><br>{{ date('Y-m-d H:i:s') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="cardreport">
                                <div class="showvalue sale">
                                    <h3>450</h3>
                                </div>
                                <div class="headingimg">{{(__('report.sale_value'))}}
                                    <div class="author"> By <span class="name">Blue Technology
                                        </span><br>{{ date('Y-m-d H:i:s') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="cardreport">
                                <div class="showvalue desprices">
                                    <h3>0</h3>
                                </div>
                                <div class="headingimg">{{(__('report.discount'))}}
                                    <div class="author"> By <span class="name">Blue
                                            Technology</span><br>{{ date('Y-m-d H:i:s') }}</div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="mar">
                    <button class="print">Print</button>
                    <button onclick="ExportToExcel('xlsx','table','POSDailyReport')">Excell</button>
                    <button>PDF</button>

                </div>
                <div class="container">
                    <div class="row">
                        <table class="table table-bordered" id="table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">{{(__('report.create_by'))}}</th>
                                    <th>Uom</th>
                                    <th scope="col">{{(__('report.item_code'))}}</th>
                                    <th scope="col">{{(__('report.item_name'))}}</th>
                                    <th scope="col">{{(__('report.category'))}}</th>
                                    <th scope="col">{{(__('report.qty'))}}</th>
                                    <th scope="col">{{(__('report.unit_price'))}}</th>
                                    <th scope="col">{{(__('report.discountprice'))}}</th>
                                    <th scope="col">{{(__('report.totalprice'))}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($saleline as $item)
                                    <tr>

                                        <th scope="row"> {{ date('d-M-Y ') }}</th>
                                        <td>{{ $item->created_by }}</td>
                                        <th>{{ $item->unit_of_measure }}</th>
                                        <td>{{ $item->item_no }}</td>
                                        <td>{{ $item->item_description }}</td>
                                        <td>{{ $item->item_category_code }}</td>
                                        <td>{{ Str::substr($item->total_count, 0, 4) }}</td>
                                        <td>{{ Str::substr($item->unit_price, 0, 5) }}$</td>
                                        @if ($item->discount_amount == 0)
                                            <td>0$</td>
                                        @else
                                            <td>{{ Str::substr($item->discount_amount, 0, 7) }}$</td>
                                        @endif
                                        <td>{{ Str::substr($item->totalprice, 0, 4) }}$</td>
                                    </tr>
                                @endforeach
                                <tr>

                                    <th colspan="6" class="table-secondary">{{(__('report.grandtotal'))}}</th>
                                    <th class="table-success qty">00</th>
                                    <th class="table-info price">00</th>
                                    <th class="table-primary desprice">00</th>
                                    <th class="table-danger totald">00</th>


                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


                <iframe id="printdaily" name="printdaily">

                </iframe>
            </div>

            {{-- End Block Dialy Report --}}

            <div class="tab-pane fade " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="cardreport color01">
                                        <div class="showvalue monthitemqty">
                                            <h4 style="display:block ">{{ round($quantitymonth[0]->total_count, 3) }}
                                            </h4>
                                        </div>
                                        <div class="headingimg">{{(__('report.qty'))}}
                                            <div class="author"> By <span class="name">Blue
                                                    Technology</span><br>{{ date('Y-m-d H:i:s') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="cardreport">
                                        <div class="showvalue monthsale">
                                            <h4>{{ round($quantitymonth[0]->unit_prices, 3) }}$</h4>
                                        </div>
                                        <div class="headingimg">{{(__('report.unit_price'))}}
                                            <div class="author"> By <span class="name">Blue Technology
                                                </span><br>{{ date('Y-m-d H:i:s') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="cardreport color02">
                                        <div class="showvalue monthdesprice">
                                            <h4>{{ round($quantitymonth[0]->discountamount, 3) }}$</h4>
                                        </div>
                                        <div class="headingimg">{{(__('report.discount'))}}
                                            <div class="author"> By <span class="name">Blue
                                                    Technology</span><br>{{ date('Y-m-d H:i:s') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="cardreport">
                                        <div class="showvalue monthgroos">
                                            <h4>{{ round($quantitymonth[0]->totalprice, 3) }}$</h4>
                                        </div>
                                        <div class="headingimg">Groos Amount
                                            <div class="author"> By <span class="name">Blue
                                                    Technology</span><br>{{ date('Y-m-d H:i:s') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="cardreport color03">
                                        <div class="showvalue monthnet">
                                            <h4>{{ round($quantitymonth[0]->netamount, 3) }}$</h4>
                                        </div>
                                        <div class="headingimg">Net Amount
                                            <div class="author"> By <span class="name">Blue
                                                    Technology</span><br>{{ date('Y-m-d H:i:s') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="border">
                                    <div class="col-12">
                                        <div id="MonthChart" style="width: 100%; height: 300px;"></div>
                                    </div>
                                    <div class="col-12">
                                        <div id="quantitychart" style="width: 100%; height: 400px;">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                {{-- Action Button (Print PDF , Print Excell,Print) --}}
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-4">
                            <div class="FilterDate">
                                <span><b>{{(__('report.selectmonth'))}}</b></span>
                                <input type="month" name="datefilter" id="datefilter" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <table id="monthreport" class="table table-striped table-bordered dt-responsive nowrap"
                    style="width:100%">
                    <thead>
                        <th>Date</th>
                        <th>{{(__('report.item_code'))}}</th>
                        <th>UOM</th>
                        <th>{{(__('report.item_name'))}}</th>
                        <th>{{(__('report.qty'))}}</th>
                        <th>{{(__('report.unit_price'))}}</th>
                        <th>{{(__('report.discountprice'))}}</th>
                        <th class="table-primary">{{(__('report.pricebefor'))}}</th>
                        <th class="table-info">{{(__('report.priceafter'))}}</th>

                    </thead>


                    <tbody>

                        <tr>
                            <th class="table-danger totalpricebeforedes" id="monthtotalprice">00</th>
                            <th class="table-danger totalpriceafterdes" id="monthtotalpriceafterdes">00</th>
                            <p id="monthunitprice" style="display: none">{{ round($quantitymonth[0]->unit_prices, 3) }}</p>
                            <p id="monthdesprice" style="display: none">{{ round($quantitymonth[0]->discountamount, 3) }}</p>
                            <p id="monthtotalprice" style="display: none">{{ round($quantitymonth[0]->totalprice, 3) }}</p>
                            <p id="monthtotalpriceafterdes" style="display: none">{{ round($quantitymonth[0]->netamount, 3) }}</p>
                            <p id="monthqty" style="display: none">{{ round($quantitymonth[0]->total_count, 3) }}</p>
                        </tr>
                    </tbody>
                </table>
                <p id="Lastunitprice" style="display: none">{{ $unitprice }}</p>
                <p id="Lastquantity" style="display: none">{{ $quantity }}</p>
                <p id="Lastdesprice" style="display: none">{{ $desprice }}</p>
                <p id="Lastgroos" style="display: none">{{ $groos }}</p>
                <p id="Lastnet" style="display: none"></p>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="row">
                    <div class="col-4">
                        <div class="full-list">
                            <div class="list-select-input">
                                <label for="" class="form-label"></label>
                                <select name="customer" id="customer-salereport"
                                    class="form-control customers-salereport">
                                    <option value="0">{{(__('report.selectcustomer'))}}</option>
                                    @foreach ($customer as $cus)
                                        <option value="{{ $cus->name }}">
                                            {{ $cus->name }}

                                        </option>
                                    @endforeach

                                </select>
                                <label for="" class="form-label"> </label>
                                <select name="sale_persioncode" id="sale_persioncode" name="sale_persioncode"
                                    class="form-control">
                                    <option value="0"> {{(__('report.selectsalesperson'))}} </option>
                                    @foreach ($sale_persioncode as $persioncode)
                                        <option value="{{ $persioncode->salesperson_code }}">
                                            {{ $persioncode->salesperson_code }}</option>
                                    @endforeach
                                </select>
                                <label for="" class="form-label"></label>
                                {{(__('report.from'))}} <input type="date" class="form-control fromdate">
                                <label for="" class="form-label"></label>
                                {{(__('report.to'))}}  <input type="date" class="form-control todate">

                                <button class="salesubmit">{{(__('report.submit'))}} </button>
                            </div>


                            <button class="view-more-btn">{{(__('report.select_option'))}}  <i
                                    class="fa-solid fa-arrows-up-down"></i></i></button>
                        </div>
                    </div>
                </div>

                <table class="table" id="sale_returntable"
                    class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th>{{(__('report.orderdate'))}} </th>
                            <th>{{(__('report.customer_name'))}} </th>
                            <th>{{(__('report.customer_name'))}}  2</th>
                            <th>{{(__('report.selectsalesperson'))}} </th>
                            <th>{{(__('report.currency'))}} </th>
                            <th>{{(__('report.payment_method'))}} </th>
                        </tr>

                    </thead>

                    <tbody>

                    </tbody>

                </table>

            </div>
            <div class="tab-pane fade" id="nav-payment" role="tabpanel" aria-labelledby="nav-payment-tab">

            </div>

            {{-- TOP PRODUCT --}}
            <div class="tab-pane fade" id="nav-top-product" role="tabpanel" aria-labelledby="nav-topproduct-tab">

                <div class="row">
                    <div class="col-6">
                        <div class="card-h3">
                            <h6><u>{{(__('report.thismonth'))}} </u> </h6>
                        </div>
                        <div class="chart-top-product1">

                            <div id="chartdiv"></div>
                        </div>


                    </div>
                    <div class="col-6">
                        <div class="card-h3">
                            <h6><u>{{(__('report.lastmonth'))}} </u> </h6>
                        </div>
                        <div class="chart-top-product1">
                            <div id="chartdiv2"></div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="card-h3">
                            <h6><u>{{(__('report.last3month'))}} </u> </h6>
                        </div>
                        <div class="chart-top-product1">
                            <div id="chartdiv3"></div>
                        </div>

                    </div>
                    <div class="col-6 cleartop">
                         
                          <div class="card-h3">
                            <h6><u>{{(__('report.last6month'))}} </u> </h6>
                        </div>
                        <div class="chart-top-product1">
                            <div id="chartdiv4"></div>
                        </div>  
                         
                        

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-product-report" role="tabpanel"
                aria-labelledby="nav-productreport-tab">
                <div class="container">
                    <div class="row">

                        <div class="col-4">
                            <div class="return_filter">
                                {{(__('report.select_date'))}}  <input type="date" name="" class="form-control"
                                    id="change_date_return">
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="cardreport">
                                <div class="showvalue">

                                    <h3 class="return_item">{{ round($returnPrice[0]->total_count, 0, 2) }}</h3>
                                </div>
                                <div class="headingimg">{{(__('report.total_item'))}} 
                                    <div class="author"> By <span class="name">Blue
                                            Technology</span><br>{{ date('Y-m-d H:i:s') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="cardreport">
                                <div class="showvalue ">
                                    <h3 class="return_prices">{{ round($returnPrice[0]->totalprice, 3) }}$</h3>
                                </div>
                                <div class="headingimg">{{(__('report.price_return'))}} 
                                    <div class="author"> By <span class="name">Blue Technology
                                        </span><br>{{ date('Y-m-d H:i:s') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <div class="return_filter">
                                Product Return : <b></b>

                            </div>

                        </div>
                        <div class="col-4"></div>
                    </div>
                    <table id="return_table" class="table table-striped table-bordered dt-responsive nowrap"
                        style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>{{(__('report.item_code'))}} </th>
                                <th>UOM</th>
                                <th>{{(__('report.item_name'))}} </th>
                                <th>{{(__('report.qty'))}} </th>
                                <th>{{(__('report.unit_price'))}} </th>
                                <th>{{(__('report.discount'))}} </th>
                                <th class="table-primary">{{(__('report.pricebefor'))}} </th>
                                <th class="table-info">{{(__('report.priceafter'))}} </th>
                            </tr>

                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
    </main>
</body>
<div class="center">
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
  </div>
</html>

@extends('layouts.slide-left')
@section('container')
@endsection
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ asset('/js/jbarcode/scriptsalereport.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
{{-- Data table for Sale Report --}}

<script>
    var datatable
    $(function() {
        datatable = $('#sale_returntable').DataTable({
            responsive: true,
            destroy: true,
            autoWidth: false,
            dom: "Blfrtip",
            buttons: [

                {
                    extend: 'copy',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },



            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('salereport.list') }}",

            columns: [{
                    data: 'order_date',
                    name: 'order_date'
                },
                {
                    data: 'customer_name',
                    name: 'customer_name'
                },
                {
                    data: 'customer_name_2',
                    name: 'customer_name_2'
                },
                {
                    data: 'currency_code',
                    name: 'currency_code',
                    render: function(data, type, row) {

                        if (row.currency_code == null) {

                            return 'Dollar'

                        } else {
                            return row.currency_code
                        }
                    }
                },
                {
                    data: 'salesperson_code',
                    name: 'salesperson_code',
                    render: function(data, type, row) {

                        if (row.salesperson_code == null || row.salesperson_code == '') {

                            return 'Not Found'

                        } else {
                            return row.salesperson_code
                        }
                    }
                },
                {
                    data: 'payment_method_code',
                    name: 'payment_method_code'
                },

            ],
        });

    });
</script>
{{-- Monthly Report Datatable --}}
<script>
    var MonthDatatable
    $(function() {
        MonthDatatable = $('#monthreport').DataTable({
            responsive: true,
            destroy: true,
            autoWidth: false,
            dom: "Blfrtip",
            buttons: [

                {
                    extend: 'copy',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },



            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('monthlyreport.list') }}",

            columns: [{
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        return (row.created_at).substring(10, 0);
                    }
                },
                {
                    data: 'item_no',
                    name: 'item_no'
                },

                {
                    data: 'unit_of_measure',
                    name: 'unit_of_measure'
                },
                {
                    data: 'item_description',
                    name: 'item_description'
                },

                {
                    data: 'total_count',
                    name: 'item_description',
                    search: 'none',
                    render: function(data, type, row) {
                        return Number(row.total_count).toFixed(2)


                    },
                },

                {
                    search: 'none',
                    data: 'unit_price',
                    name: 'unit_price',
                    render: function(data, type, row) {
                        return Number((row.unit_price)).toFixed(2)


                    },
                },

                {
                    data: 'discount_amount',
                    name: 'discount_amount',
                    render: function(data, type, row) {
                        return Number((row.discount_amount)).toFixed(4)


                    },
                },
                {
                    search: 'none',
                    render: function(data, type, row) {
                        return Number((row.unit_price) * (row.total_count)).toFixed(2)
                    },
                },

                {
                    search: 'none',
                    render: function(data, type, row) {
                        return (Number((row.unit_price) * (row.total_count)) - Number((row
                            .discount_amount))).toFixed(2)
                    },
                },



            ],
        });

    });
</script>

<script>
    var MonthDatatable
    $(function() {
        MonthDatatable = $('#return_table').DataTable({
            responsive: true,
            destroy: true,
            autoWidth: false,
            dom: "Blfrtip",
            buttons: [

                {
                    extend: 'copy',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },



            ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('returnSale.list') }}",

            columns: [{
                    data: 'document_no',
                    name: 'document_no',

                },
                {
                    data: 'item_no',
                    name: 'item_no'
                },

                {
                    data: 'unit_of_measure',
                    name: 'unit_of_measure'
                },
                {
                    data: 'item_description',
                    name: 'item_description'
                },

                {
                    data: 'total_count',
                    name: 'item_description',
                    search: 'none',
                    render: function(data, type, row) {
                        return Number(row.total_count).toFixed(2)


                    },
                },

                {
                    search: 'none',
                    data: 'unit_price',
                    name: 'unit_price',
                    render: function(data, type, row) {
                        return Number((row.unit_price)).toFixed(2)


                    },
                },

                {
                    data: 'discount_amount',
                    name: 'discount_amount',
                    render: function(data, type, row) {
                        return Number((row.discount_amount)).toFixed(4)


                    },
                },
                {
                    search: 'none',
                    render: function(data, type, row) {
                        return Number((row.unit_price) * (row.total_count)).toFixed(2)
                    },
                },

                {
                    search: 'none',
                    render: function(data, type, row) {
                        return (Number((row.unit_price) * (row.total_count)) - Number((row
                            .discount_amount))).toFixed(2)
                    },
                },



            ],
        });

    });
</script>
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }

    #chartdiv2 {
        width: 100%;
        height: 500px;
    }
    #chartdiv3 {
        width: 100%;
        height: 500px;
    }

    #chartdiv4 {
        width: 100%;
        height: 500px;
    }
</style>





<!-- Resources -->


<!-- Chart code -->

<script>
    
</script>

<script>
    $(document).ready(function() {

        $('.center').css({'display':'flex'})

            setTimeout(() => {
            $('.center').css({'display':'none'})
            }, 1000);
        $.ajax({
            url: 'return/topproductthismonth',
            type: 'GET',
            dataType: "json",
            beforeSend: function() {
                //work before success    
            },
            success: function(datap) {
                /// Chart1 1
                am5.ready(function() {


                    // Create root element
                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                    var root = am5.Root.new("chartdiv");


                    // Set themes
                    // https://www.amcharts.com/docs/v5/concepts/themes/
                    root.setThemes([
                        am5themes_Animated.new(root)
                    ]);


                    // Create chart
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                    var chart = root.container.children.push(am5xy.XYChart.new(root, {
                        panX: true,
                        panY: true,
                        wheelX: "panX",
                        wheelY: "zoomX",
                        pinchZoomX: true
                    }));

                    // Add cursor
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                    cursor.lineY.set("visible", false);


                    // Create axes
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                    var xRenderer = am5xy.AxisRendererX.new(root, {
                        minGridDistance: 30
                    });
                    xRenderer.labels.template.setAll({
                        rotation: -90,
                        centerY: am5.p50,
                        centerX: am5.p100,
                        paddingRight: 15
                    });

                    xRenderer.grid.template.setAll({
                        location: 1
                    })

                    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                        maxDeviation: 0.3,
                        categoryField: "country",
                        renderer: xRenderer,
                        tooltip: am5.Tooltip.new(root, {})
                    }));

                    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                        maxDeviation: 0.3,
                        renderer: am5xy.AxisRendererY.new(root, {
                            strokeOpacity: 0.1
                        })
                    }));


                    // Create series
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                        name: "Series 1",
                        xAxis: xAxis,
                        yAxis: yAxis,
                        valueYField: "value",
                        sequencedInterpolation: true,
                        categoryXField: "country",
                        tooltip: am5.Tooltip.new(root, {
                            labelText: "{valueY}"
                        })
                    }));

                    series.columns.template.setAll({
                        cornerRadiusTL: 5,
                        cornerRadiusTR: 5,
                        strokeOpacity: 0
                    });
                    series.columns.template.adapters.add("fill", function(fill, target) {
                        return chart.get("colors").getIndex(series.columns.indexOf(
                            target));
                    });

                    series.columns.template.adapters.add("stroke", function(stroke,
                        target) {
                        return chart.get("colors").getIndex(series.columns.indexOf(
                            target));
                    });


                    // Set data
                    var data = [];
                    datap.chart1.forEach(element => {
                        var val = Number(element.total_quantity).toFixed(0)
                        var datad = {
                            country: element.item_description,
                            value: Number(val)
                        };

                        data.push(datad)

                    });

                    xAxis.data.setAll(data);
                    series.data.setAll(data);


                    // Make stuff animate on load
                    // https://www.amcharts.com/docs/v5/concepts/animations/
                    series.appear(1000);
                    chart.appear(1000, 100);

                });
                //Chart 2

                am5.ready(function() {


                    // Create root element
                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                    var root = am5.Root.new("chartdiv2");


                    // Set themes
                    // https://www.amcharts.com/docs/v5/concepts/themes/
                    root.setThemes([
                        am5themes_Animated.new(root)
                    ]);


                    // Create chart
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                    var chart = root.container.children.push(am5xy.XYChart.new(root, {
                        panX: true,
                        panY: true,
                        wheelX: "panX",
                        wheelY: "zoomX",
                        pinchZoomX: true
                    }));

                    // Add cursor
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                    cursor.lineY.set("visible", false);


                    // Create axes
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                    var xRenderer = am5xy.AxisRendererX.new(root, {
                        minGridDistance: 30
                    });
                    xRenderer.labels.template.setAll({
                        rotation: -90,
                        centerY: am5.p50,
                        centerX: am5.p100,
                        paddingRight: 15
                    });

                    xRenderer.grid.template.setAll({
                        location: 1
                    })

                    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                        maxDeviation: 0.3,
                        categoryField: "country",
                        renderer: xRenderer,
                        tooltip: am5.Tooltip.new(root, {})
                    }));

                    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                        maxDeviation: 0.3,
                        renderer: am5xy.AxisRendererY.new(root, {
                            strokeOpacity: 0.1
                        })
                    }));


                    // Create series
                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                        name: "Series 1",
                        xAxis: xAxis,
                        yAxis: yAxis,
                        valueYField: "value",
                        sequencedInterpolation: true,
                        categoryXField: "country",
                        tooltip: am5.Tooltip.new(root, {
                            labelText: "{valueY}"
                        })
                    }));

                    series.columns.template.setAll({
                        cornerRadiusTL: 5,
                        cornerRadiusTR: 5,
                        strokeOpacity: 0
                    });
                    series.columns.template.adapters.add("fill", function(fill, target) {
                        return chart.get("colors").getIndex(series.columns.indexOf(
                            target));
                    });

                    series.columns.template.adapters.add("stroke", function(stroke,
                        target) {
                        return chart.get("colors").getIndex(series.columns.indexOf(
                            target));
                    });


                    // Set data
                    var data = [];
                    datap.chart2.forEach(element => {
                        var val = Number(element.total_quantity).toFixed(0)
                        var datad = {
                            country: element.item_description,
                            value: Number(val)
                        };

                        data.push(datad)

                    });
                    console.log(data)
                    xAxis.data.setAll(data);
                    series.data.setAll(data);


                    // Make stuff animate on load
                    // https://www.amcharts.com/docs/v5/concepts/animations/
                    series.appear(1000);
                    chart.appear(1000, 100);

                });




                 //Chart 3

                 am5.ready(function() {


// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv3");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
    am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX",
    pinchZoomX: true
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
cursor.lineY.set("visible", false);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, {
    minGridDistance: 30
});
xRenderer.labels.template.setAll({
    rotation: -90,
    centerY: am5.p50,
    centerX: am5.p100,
    paddingRight: 15
});

xRenderer.grid.template.setAll({
    location: 1
})

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
    maxDeviation: 0.3,
    categoryField: "country",
    renderer: xRenderer,
    tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    maxDeviation: 0.3,
    renderer: am5xy.AxisRendererY.new(root, {
        strokeOpacity: 0.1
    })
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: "Series 1",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "value",
    sequencedInterpolation: true,
    categoryXField: "country",
    tooltip: am5.Tooltip.new(root, {
        labelText: "{valueY}"
    })
}));

series.columns.template.setAll({
    cornerRadiusTL: 5,
    cornerRadiusTR: 5,
    strokeOpacity: 0
});
series.columns.template.adapters.add("fill", function(fill, target) {
    return chart.get("colors").getIndex(series.columns.indexOf(
        target));
});

series.columns.template.adapters.add("stroke", function(stroke,
    target) {
    return chart.get("colors").getIndex(series.columns.indexOf(
        target));
});


// Set data
var data = [];
datap.chart3.forEach(element => {
    var val = Number(element.total_quantity).toFixed(0)
    var datad = {
        country: element.item_description,
        value: Number(val)
    };

    data.push(datad)

});
console.log("This ")
console.log(data)
xAxis.data.setAll(data);
series.data.setAll(data);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

});






 //Chart 4

 am5.ready(function() {


// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv4");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
    am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX",
    pinchZoomX: true
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
cursor.lineY.set("visible", false);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, {
    minGridDistance: 30
});
xRenderer.labels.template.setAll({
    rotation: -90,
    centerY: am5.p50,
    centerX: am5.p100,
    paddingRight: 15
});

xRenderer.grid.template.setAll({
    location: 1
})

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
    maxDeviation: 0.3,
    categoryField: "country",
    renderer: xRenderer,
    tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    maxDeviation: 0.3,
    renderer: am5xy.AxisRendererY.new(root, {
        strokeOpacity: 0.1
    })
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: "Series 1",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "value",
    sequencedInterpolation: true,
    categoryXField: "country",
    tooltip: am5.Tooltip.new(root, {
        labelText: "{valueY}"
    })
}));

series.columns.template.setAll({
    cornerRadiusTL: 5,
    cornerRadiusTR: 5,
    strokeOpacity: 0
});
series.columns.template.adapters.add("fill", function(fill, target) {
    return chart.get("colors").getIndex(series.columns.indexOf(
        target));
});

series.columns.template.adapters.add("stroke", function(stroke,
    target) {
    return chart.get("colors").getIndex(series.columns.indexOf(
        target));
});


// Set data
var data = [];
datap.chart4.forEach(element => {
    var val = Number(element.total_quantity).toFixed(0)
    var datad = {
        country: element.item_description,
        value: Number(val)
    };

    data.push(datad)

});
console.log('This')
console.log(data)
xAxis.data.setAll(data);
series.data.setAll(data);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

});

            }
        });


    });
</script>
