<!doctype html>
<html lang="en">

@extends('hader')
@section('contain')
@endsection

<body>
 
    @extends('layouts.side-left-user')
    @section('container')
    @endsection
   
    <style>
        button {
            background-color: aquamarine
        }

        #chartdiv {
            width: 100%;
            height: 500px;
        }

        #chartdiv1 {
            width: 100%;
            height: 500px;
        }

        #chartdiv2 {
            width: 100%;
            height: 150px;
            max-width: 100%;
        }
    </style>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
 {{-- {{auth()->user()->user_role_code}} --}}

 
        <div class="pan1">
            <x-app-layout>

            </x-app-layout>

        </div>
        <div class="pan2">

             
        </div>
        {{-- @foreach ($topproduct as $item)
    <p>{{$item->total_quantity}}</p>
@endforeach --}}
       


        <div class="row">
            <div class="col-6">
                <div class="top-product-admin">
                    <div class="admin-topduct-title">
                        <h3>Top Product</h3>


                    </div>
                    <div class="arm">
                      <div id="chartdiv"></div>  
                    </div>
                    
                    <div class="admin-clear-licence">
                    </div>
                    <div class="row">


                        <div class="col-6">
                            <div class="admin-form-control">
                                <label for="" class="form-lable">Select Date</label>
                                <input type="month" name="date-topproduct" id="date-topproduct" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="admin-form-control">
                                <label for="" class="form-lable">Today </label>
                                <input type="text" class="form-control no-border" value="{{ date('Y M D') }}"
                                    readonly>

                            </div>

                        </div>
                    </div>
                </div>


            </div>
            {{-- <div class="col-6">
                <div class="top-product-admin">
                    <div class="admin-topduct-title">
                        <h3>User Info</h3>


                    </div>
                    <table id="user" class="table table-striped table-bordered dt-responsive nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">id </i></th>
                                <th scope="col">email</i></th>
                                <th scope="col">sales</i></th>
                                <th scope="col">name</i></th>
                                <th scope="col">gender</i></th>
                                <th scope="col">DAO</th>
                                <th scope="col">Userrole</th>
                                <th scope="col">Permission</th>
                                <th scope="col">address</th>
                                <th scope="col">address_2</th>

                                <th scope="col">city</th>
                                <th scope="col">status</th>
                                <th scope="col">inactived</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>

            </div> --}}
            <div class="col-6">
                <div class="top-product-admin">
                    <div class="admin-topduct-title">
                        <h3>Product Sold Today</h3>


                    </div>
                    <table id="salereport" class="table table-striped table-bordered dt-responsive nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Sale By</th>
                                <th scope="col">Items_Code</th>
                                <th scope="col">Items_Name</th>
                                <th scope="col">Catagory</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Descount Price</th>
                                <th scope="col">Total Price</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="row">
            
                <div class="col-6">
                    <div class="income-exspence">
                        <div class="income-exspence-title">
                            <p>Income</p>
                        </div>
                        <div id="income">

                        </div>
                        <div class="admin-clear-licence">
                        </div>
                        <div class="row">


                            <div class="col-6">
                                <div class="admin-form-control">
                                    <label for="" class="form-lable">Select Date</label>
                                    <select name="admin-select" id="admin-select" class="form-control">
                                        <option value="">This Week</option>
                                        <option value="">This Month</option>
                                        <option value="">last Month</option>
                                        <option value="">Last 3 Month</option>
                                        <option value="">Last 6 Month</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="admin-form-control">
                                    <label for="" class="form-lable">Today </label>
                                    <input type="text" class="form-control no-border" value="{{ date('Y M D') }}"
                                        readonly>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-6">
                    <div class="income-exspence">
                        <div class="income-exspence-title">
                            <p>Expence</p>
                        </div>
                        <div id="exspence">

                        </div>
                        <div class="admin-clear-licence">
                        </div>
                        <div class="row">


                            <div class="col-6">
                                <div class="admin-form-control">
                                    <label for="" class="form-lable">Select Date</label>
                                    <select name="admin-select" id="admin-select" class="form-control">
                                        <option value="">This Week</option>
                                        <option value="">This Month</option>
                                        <option value="">last Month</option>
                                        <option value="">Last 3 Month</option>
                                        <option value="">Last 6 Month</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="admin-form-control">
                                    <label for="" class="form-lable">Today </label>
                                    <input type="text" class="form-control no-border" value="{{ date('Y M D') }}"
                                        readonly>

                                </div>

                            </div>
                        </div>
                    </div>

              s
            </div>
        
        </div>
        {{-- <p class="pdoe">{{$topproduct}}</p> --}}
    </main>
    <script>
        //  .forEach(element => {
        //     console.log(element)
        //   });
    </script>
    @include('script')
    <script>
        $(document).ready(function() {
            Filter_Toptotal()
            Filter_Topproduct()

            function Filter_Toptotal() {
                $('#total-month').on('change', function() {
                    $.ajax({
                        url: 'admin/AdminChangeHeaderDate',
                        dataType: "json",
                        data: {
                            'date': $(this).val()
                        },
                        beforeSend: function() {
                            //work before success    
                        },
                        success: function(data) {
                            $('.totalcustomer').text(data.customer.length);
                            $('.totalsale').text(Number(data.item_sale[0].total_unitprice)
                                .toFixed(2));
                            $('.totalqty').text(Number(data.totalqty[0].qty).toFixed(2));
                             
                        }
                    });
                })
            }
            function Filter_Topproduct(){
                $('#date-topproduct').on('change',function(){
                    $.ajax({
                        url: 'admin/FilterTopProduct',
                        dataType: "json",
                        data: {
                            'date': $(this).val()
                        },
                        beforeSend: function() {
                            //work before success    
                        },
                        success: function(datap) {
                             $('.arm').empty()
                            $('.arm').append(` <div id="chartdiv"></div>  `)
                            
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
datap.topproduct.forEach(element => {
    var val = Number(element.total_quantity).toFixed(0)
    var datad = {
        country: element.item_description,
        value: Number(val)
    };

    data.push(datad)
});




xAxis.data.setAll(data);
series.data.setAll(data);

series.appear(1000);
chart.appear(1000, 100);

});
                        }
                    });
                })
            }
            //Top Product Chart
            $.ajax({
                url: 'admin/returntopproduct',
                //   contentType:false,
                //   cache:false,
                //   processData:false,
                dataType: "json",
                beforeSend: function() {
                    //work before success    
                },
                success: function(datap) {
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
                        datap.topproduct.forEach(element => {
                            var val = Number(element.total_quantity).toFixed(0)
                            var datad = {
                                country: element.item_description,
                                value: Number(val)
                            };

                            data.push(datad)
                        });
                        



                        xAxis.data.setAll(data);
                        series.data.setAll(data);

                        series.appear(1000);
                        chart.appear(1000, 100);

                    });

                }
            });


            //Income Chart

            $.ajax({
                url: 'admin/saleincome',
                //   contentType:false,
                //   cache:false,
                //   processData:false,

                dataType: "json",
                beforeSend: function() {
                    //work before success    
                },
                success: function(datax) {
                    var price = [];
                    var month = [];

                    datax.income.forEach(element => {
                        month.push(element.date)
                        price.push(Number(Number(element.total).toFixed(0)))
                    });

                    console.log(price)

                    var options = {
                        series: [{
                            name: "Total Price",
                            data: price

                        }],
                        chart: {
                            height: 300,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        title: {
                            text: 'Show Income By Month',
                            align: 'left'
                        },
                        grid: {
                            row: {
                                colors: ['#f3f3f3',
                                'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        xaxis: {
                            categories: month,
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#income"), options);
                    chart.render();

                }
            });

        });
    </script>





    <script type="text/javascript">
        var datatable;
        $(function() {
            datatable = $('#salereport').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('sale_report.list') }}",

                columns: [{
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            if ((row.created_at).length >= 10) {
                                return (row.created_at).substring(10, 0);
                            }


                        },
                    },
                    {
                        data: 'created_by',
                        name: 'created_by',
                        render: function(data, type, row) {
                            if (row.created_by == null) {
                                return "Pok Puthea"
                            } else {
                                return row.created_by
                            }



                        },
                    },
                    {
                        data: 'item_no',
                        name: 'item_no'
                    },
                    {
                        data: 'item_description',
                        name: 'item_description'
                    },

                    {
                        data: 'item_category_code',
                        name: 'item_category_code'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                        render: function(data, type, row) {

                            return Number(row.quantity).toFixed(2);

                        },
                    },

                    {
                        data: 'unit_price',
                        name: 'unit_price',
                        render: function(data, type, row) {

                            return Number(row.unit_price).toFixed(2) + '$';

                        },
                    },
                    {
                        data: 'discount_amount',
                        name: 'discount_amount',
                        render: function(data, type, row) {

                            return Number(row.discount_amount).toFixed(2) + '$';

                        },
                    },
                    {
                        data: null,
                        render: function(data, type, row) {

                            return Number(data.quantity * data.unit_price).toFixed(2);

                        },
                    }


                ],
            });

        });
    </script>

    <script type="text/javascript">
        var datatable;
        $(function() {
            datatable = $('#user').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('userlist.list') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'salesperson_code',
                        name: 'salesperson_code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'date_of_birth',
                        name: 'date_of_birth'
                    },
                    // {data: 'id_card_no', name: 'id_card_no'},
                    // {data: 'phone_no', name: 'phone_no'},
                    {
                        data: 'user_role_code',
                        name: 'user_role_code'
                    },
                    {
                        data: 'permission_code',
                        name: 'permission_code'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'address_2',
                        name: 'address_2'
                    },
                    // {data: 'country_code', name: 'country_code'},
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },

                    {
                        data: 'inactived',
                        name: 'inactived'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },


                ],
            });

        });
    </script>



    {{-- Income and Expence Chart --}}

    <script></script>

    <script>
        var options = {
            series: [{
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 10, 45, 89]
            }],
            chart: {
                height: 300,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Show Income By Month',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov', 'Oct', 'Dec'],
            }
        };

        var chart = new ApexCharts(document.querySelector("#exspence"), options);
        chart.render();
    </script>

</body>


</html>
