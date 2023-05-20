$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  function Sumtotalvalue() {
    var lengthd = $("#table tr").length;

    var qty = 0;
    var total = 0;
    var totalprice = 0;
    var todatdes = 0;
    var totaldesper = 0;
    var totalmainprice = 0;
    for (i = 1; i < $("#table tr").length - 1; i++) {
      qty = $("#table").find(`tr:eq(${i}) td:eq(4)`).text();
      var price = $("#table").find(`tr:eq(${i}) td:eq(5)`).text();
      var desprice = $("#table").find(`tr:eq(${i}) td:eq(6)`).text();
      var subprice = price.substring(Number(price.length) - 1, -1);
      var subdesprice = desprice.substring(
        Number(desprice.length) - 1,-1
      );
      var desper = $("#table").find(`tr:eq(${i}) td:eq(7)`).text();
      var subdes = desper.substring(Number(desper.length) - 1, -1);
      

      var mainprice = $("#table").find(`tr:eq(${i}) td:eq(7)`).text();
      var submain = mainprice.substring(Number(mainprice.length) - 1, -1);
      totaldesper += Number(subdes);
      totalprice += Number(subprice);
      todatdes += Number(subdesprice);
      total += Number(qty);
      totalmainprice += Number(submain);
    }
    var hello = totaldesper / lengthd;
    var tostring = `${hello}`;
    var sho = tostring.substring(5, 0);

    $("#table").find(`th.qty`).text(total);
    $("#table")
      .find(`th.price`)
      .text(totalprice.toFixed(4) + "$");
    $("#table")
      .find(`th.desprice`)
      .text(todatdes.toFixed(4) + "$");

    $("#table")
      .find(`th.totald`)
      .text(totalmainprice.toFixed(4) + "$");

    $(".itemsale").find("h3").text(total);
    $(".sale")
      .find("h3")
      .text(totalmainprice.toFixed(4) + "$");
    $(".desprices")
      .find("h3")
      .text(todatdes.toFixed(4) + "$");
    $(".despercentage")
      .find("h3")
      .text(sho + "%");
  }
  Sumtotalvalue();




  

  // Change Date And Show data
  var date = new Date().toISOString().slice(0, 10);
  $("#changedate").on("change", function () {
    date = $(this).val();
  
    $.ajax({
      url: "date/showitembydate/" + date,
      type: "GET",
      // contentType: false,
      // cache: false,
      // processData: false,
      dataType: "json",
      beforeSend: function () {
        //work before success
      },
      success: function (data) {
        let tr = "";
        for (var i = 0; i < data.showbydate.length; i++) {
          if (data.showbydate[i].discount_percentage == null) {
            data.showbydate[i].discount_percentage = "0%";
          }
          tr += `
             <tr>
            <th>${data.showbydate[i].created_at.substring(10, 0)}</th>
            <td>${data.showbydate[i].created_by}</td>
            <th>${data.showbydate[i].unit_of_measure}</th>
            <td>${data.showbydate[i].item_no}</td>
            <td>${data.showbydate[i].item_description}</td>
            <td>${data.showbydate[i].item_category_code}</td>
            <td>${Number(data.showbydate[i].total_count).toFixed(4)}</td>
            <td>${Number(data.showbydate[i].unit_price).toFixed(4)}</td>
            <td>${Number(data.showbydate[i].discount_amount).toFixed(4)}</td>
            
            <td>${Number(data.showbydate[i].totalprice).toFixed(4)}</td>
            </tr>  
            `;
        }
        $("#table tbody").html(
          tr +
          ` <tr>
                  
           <th colspan="6" class="table-secondary">Grand Total</th>
           <th class="table-success qty">00</th>
           <th class="table-info price">00</th>
           <th class="table-primary desprice">00</th>
           
             <th class="table-danger totald">00</th>
          
           
         </tr>`
        );
        Sumtotalvalue();
      },
    });
  });


  // Search Product in Daily Sale Report


  $("#dailySaleSearch").on("change", function () {
    var value = $(this).val();
    console.log(value)
     
    $.ajax({
      url: "date/Daily_Report_Search/" + value,
      type: "GET",
      // contentType: false,
      // cache: false,
      // processData: false,
      dataType: "json",
      beforeSend: function () {
        //work before success
      },
      success: function (data) {
        let tr = "";
        for (var i = 0; i < data.showbydate.length; i++) {
          if (data.showbydate[i].discount_percentage == null) {
            data.showbydate[i].discount_percentage = "0%";
          }
          tr += `
             <tr>
            <th>${data.showbydate[i].created_at.substring(10, 0)}</th>
            <td>${data.showbydate[i].created_by}</td>
            <th>${data.showbydate[i].unit_of_measure}</th>
            <td>${data.showbydate[i].item_no}</td>
            <td>${data.showbydate[i].item_description}</td>
            <td>${data.showbydate[i].item_category_code}</td>
            <td>${Number(data.showbydate[i].total_count).toFixed(4)}</td>
            <td>${Number(data.showbydate[i].unit_price).toFixed(4)}</td>
            <td>${Number(data.showbydate[i].discount_amount).toFixed(4)}</td>
            
            <td>${Number(data.showbydate[i].totalprice).toFixed(4)}</td>
            </tr>  
            `;
        }
        $("#table tbody").html(
          tr +
          ` <tr>
                  
           <th colspan="6" class="table-secondary">Grand Total</th>
           <th class="table-success qty">00</th>
           <th class="table-info price">00</th>
           <th class="table-primary desprice">00</th>
           
             <th class="table-danger totald">00</th>
          
           
         </tr>`
        );
        Sumtotalvalue();
      },
    });
  });







  // Print PDF
  $(".print").on("click", function () {
    var img = "/img/blue1.webp";
    var qty = $(".qty").text();
    var totalunit = $(".price").text();
    var desp = $(".desprice").text();
    var totalprice = $(".totald").text();
    var td = $("#table").find("tr").length;
    var tr = "";
    var total = `
   <tr>
                  
           <th colspan="5" class="table-secondary">Grand Total</th>
           <th class="table-success qty">00</th>
           <th class="table-info price">00</th>
           <th class="table-primary desprice">00</th>
           
             <th class="table-danger totald">00</th>
          
           
         </tr>
  `;
    for (let i = 1; i < td - 1; i++) {
      tr += `
<tr >
                       
<th>${$("#table")
          .find(`tr:eq(${Number(i)}) th:eq(0)`)
          .text()}</th>
<td>${$("#table")
          .find(`tr:eq(${Number(i)}) td:eq(0)`)
          .text()}</td>
<td> ${$("#table")
          .find(`tr:eq(${Number(i)}) td:eq(1) `)
          .text()}</td>
<td>${$("#table")
          .find(`tr:eq(${Number(i)}) td:eq(2)`)
          .text()}</td>
<td>${$("#table")
          .find(`tr:eq(${Number(i)}) td:eq(3)`)
          .text()}</td>
<td>${$("#table")
          .find(`tr:eq(${Number(i)}) td:eq(4)`)
          .text()}</td>
<td>${$("#table")
          .find(`tr:eq(${Number(i)}) td:eq(5)`)
          .text()}</td>
<td> ${$("#table")
          .find(`tr:eq(${Number(i)}) td:eq(6) `)
          .text()}</td>
<td>${$("#table")
          .find(`tr:eq(${Number(i)}) td:eq(7)`)
          .text()}</td>
</tr> 
`;
    }
    var newWin = window.frames["printdaily"];
    newWin.document.write(
      `
    <link rel="stylesheet" href="/css/bootstrap-5.2.3/dist/css/bootstrap.min.css">
    <link href="/css/stytle.css" rel="stylesheet">
  <body onload="window.print()">
<img src="${img}" alt=""  >
<h1>Daily Report on ( ${date})</h1>
<div class="table-responsive">
<table class="table table-bordered">
              <thead >
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
              </thead>
              <tbody>
              ${tr}
               <tr>
                  
           <th colspan="5" class="table-secondary">Grand Total</th>
           <th class="table-success qty">${qty}</th>
           <th class="table-info price">${totalunit}</th>
           <th class="table-primary desprice">${desp}</th>
           
             <th class="table-danger totald">${totalprice}</th>
          
           
         </tr>
              
              </tbody>
              </table> 
              </div>   
        </body>
 
 `
    );

    newWin.document.close();
  });

  //================================= Monthly Report ===========================
    // Datatable

    









  function SumTotalinMonthlyReport() {
    let tablemonth = $("#tablemonth tr").length;

    var qty = 0;
    var total = 0;
    var totalprice = 0;
    var totald = 0;
    var totaldes = 0;
    var unit_price = 0;
    var totalmainprice = 0;
    var totaldesper;
    var pricebeforedess = 0;
    var totalpriceafterdes = 0;
    for (i = 1; i < tablemonth - 1; i++) {
      qty = $("#tablemonth").find(`tr:eq(${i}) td:eq(4)`).text();
      var unitprice = $("#tablemonth")
        .find(`tr:eq(${i}) td:eq(5)`)
        .text();
      var unitpcs = $("#tablemonth").find(`tr:eq(${i}) th:eq(1)`).text();
      unitpcs = unitpcs.substring(Number(unitpcs.length) - 1, -1);

      var desprice = $("#tablemonth").find(`tr:eq(${i}) td:eq(6)`).text();
      var pricebeforedes = $("#tablemonth")
        .find(`tr:eq(${i}) td:eq(7)`)
        .text();
      var priceafterdes = $("#tablemonth")
        .find(`tr:eq(${i}) td:eq(8)`)
        .text();
      var subpriceberforedes = pricebeforedes.substring(
        Number(pricebeforedes.length) - 1,
        -1
      );
      var subpriceafterdes = priceafterdes.substring(
        Number(priceafterdes.length) - 1,
        -1
      );
      var subprice = unitprice.substring(
        Number(unitprice.length) - 1,
        -1
      );
      var subdesprice = desprice.substring(
        Number(desprice.length) - 1,
        -1
      );
      var desper = $("#tablemonth").find(`tr:eq(${i}) td:eq(7)`).text();
      var subdes = desper.substring(Number(desper.length) - 1, -1);

      var mainprice = $("#tablemonth")
        .find(`tr:eq(${i}) td:eq(7)`)
        .text();
      var submain = mainprice.substring(Number(mainprice.length) - 1, -1);
      totaldesper += Number(subdes);
      totalprice += Number(subprice);
      totaldes += Number(subdesprice);
      total += Number(qty);
      unit_price += Number(unitpcs);
      pricebeforedess += Number(subpriceberforedes);
      totalmainprice += Number(submain);
      totalpriceafterdes += Number(subpriceafterdes);
    }

    var hello = totaldesper / tablemonth;
    var tostring = `${hello}`;
    var sho = tostring.substring(5, 0);

    $("body").find(`#tablemonth th.qtymonth`).text(total);
    $("#tablemonth")
      .find(`th.unit_price`)
      .text(Number(unit_price).toFixed(3) + "$");
    $("#tablemonth")
      .find(`th.despricemonth`)
      .text(totaldes.toFixed(3) + "$");
    $("#tablemonth")
      .find(`th.unitpricemonth`)
      .text(totalprice.toFixed(3) + "$");
    $("#tablemonth")
      .find(`th.totalpricebeforedes`)
      .text(pricebeforedess.toFixed(3) + "$");
    $("#tablemonth")
      .find(`th.totalpriceafterdes`)
      .text((pricebeforedess - totaldes).toFixed(2) + "$");

    // $('.itemsale').find('h3').text(total)
    // $('.sale').find('h3').text((totalprice).toFixed(4)+'$')
    // $('.desprices').find('h3').text((todatdes).toFixed(4)+'$')
    // $('.despercentage').find('h3').text(sho+'%')
  }

  // Monthly Report Show Total on left box

  function LeftsideReport() {
    let leftqty = $("#tablemonth").find(`th.qtymonth`).text();
    let unitprice = $("#tablemonth").find(`th.unitpricemonth`).text();
    let desprice = $("#tablemonth").find(`th.despricemonth`).text();
    let groosamount = $("#tablemonth")
      .find(`th.totalpricebeforedes`)
      .text();
    let netamount = $("#tablemonth").find(`th.totalpriceafterdes`).text();
    $(".monthitemqty").find("h3").text(leftqty);
    $(".monthsale").find("h3").text(unitprice);
    $(".monthdesprice").find("h3").text(desprice);
    $(".monthgroos").find("h3").text(groosamount);
    $(".monthnet").find("h3").text(netamount);
  }

  //Chart
  google.charts.load("current", { packages: ["corechart", "bar"] });
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    let qty = $("#monthqty").text();
    let unit_price = $("#monthunitprice").text();
    let monthdesprice = $("#monthdesprice").text();
    let monthtotalprice = $("#monthtotalprice").text();
    let monthtotalpriceafterdes = $("#monthtotalpriceafterdes").text();
    console.log(monthdesprice)
    let lastdesprice = $("#Lastdesprice").text();
    let lastgroos = $("#Lastgroos").text();
    let lastuniprice = $("#Lastunitprice").text();
    let lastnet = lastgroos - lastdesprice;
    let lastquantity = $("#Lastquantity").text();
    unit_price = Number(unit_price.replace(/.$/, "")).toFixed(0);
    lastdesprice = Number(lastdesprice).toFixed(0);
    lastuniprice = Number(lastuniprice).toFixed(0);
    monthdesprice = monthdesprice.replace(/.$/, "");
    monthtotalprice = monthtotalprice.replace(/.$/, "");
    lastgroos = Number(lastgroos).toFixed(0);
    lastnet = Number(lastnet).toFixed(0);
    monthtotalpriceafterdes = monthtotalpriceafterdes.replace(/.$/, "");
    //  alert(lastdesprice)
    var data = google.visualization.arrayToDataTable([
      // Syntax [Buttonname,Blue Line Value ,Red Line Value]
      ["Year", "This Month", "Last Month"],

      //  ['Qunatity', ,dd ],
      ["Unit Price", Number(unit_price), Number(lastuniprice)],
      [
        "Total Discountprice",
        Number(monthdesprice),
        Number(lastdesprice),
      ],
      ["Gross Amount", Number(monthtotalprice), Number(lastgroos)],
      ["Net Amount", Number(monthtotalpriceafterdes), Number(lastnet)],
    ]);

    var options = { title: "Population (in millions)" };

    // Instantiate and draw the chart.
    var chart = new google.charts.Bar(
      document.getElementById("MonthChart")
    );
    chart.draw(data, options);
  }
  function QuantityChart() {
    let qty = $("#monthqty").text();
    let lastquantity = $("#Lastquantity").text();

    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    var data = google.visualization.arrayToDataTable([
      ["Task", "Quantity"],
      ["Item Quantity Sale This month", Number(qty)],
      ["Last Month", Number(lastquantity)],
    ]);

    var options = {
      title: "Quantity ",
      is3D: true,
    };

    var chart = new google.visualization.PieChart(
      document.getElementById("quantitychart")
    );
    chart.draw(data, options);
  }

  $("#nav-profile-tab").on("click", function () {
    SumTotalinMonthlyReport();
    drawChart();
    FindTotalNet();
    QuantityChart();
    LeftsideReport();
  });

  // Find Net Amount
  function FindTotalNet() {
    let lastdesprice = $("#Lastdesprice").text();
    let lastgroos = $("#Lastgroos").text();

    lastnet = $("p#Lastnet").text(
      (Number(lastgroos) - Number(lastdesprice)).toFixed(6)
    );
  }

  // Search Product By Item_description,Item_No,
  $("#Monthsearch").on("keyup", function () {
    var ThisValue = $(this).val();
    var data = {
      ThisValue: ThisValue,
    };
    $.ajax({
      url: "month/search",
      data: data,
      dataType: "json",
      beforeSend: function () { },
      success: function (data) {
        $("#tablemonth tbody").html(`

    `);
        // function show(index,item){

        // }

   
        let tr = "";
        let increas = 0;
        data.monthsearch.forEach((element) => {
          tr += `
      <tr> 
                    <th>${(increas += 1)}</th>
                    <td>${element.created_at.substring(10, -10)}</td> 
                      <td>${element.item_no}</td>
                      <td>${element.document_no}</td>
                      <td>${element.item_description}</td>
                      <td>${Number(element.total_count).toFixed(6)}</td>
                      <td>${Number(element.unit_prices).toFixed(6)}$</td> 
                      <td>${Number(element.desprice).toFixed(6)}$</td>
                      <td>${Number(element.totalprice).toFixed(6)}$</td>
                      <td>${Number(element.priceafterdes).toFixed(6)}$</td>
                     
                     
                  </tr>

      `;
        });
        $("#tablemonth tbody").html(
          tr +
          `
    <tr>  <th colspan="5" class="table-secondary">Grand Total For This Month</th>    
                  
    <th class="table-success qtymonth" id="monthqty">00</th>
    <th class="table-info unit_price" id="monthunitprice">00</th>
    <th class="table-info unitpricemonth" id="monthunitprice">00</th>
    <th class="table-primary despricemonth" id="monthdesprice">00</th>
   <th class="table-danger totalpricebeforedes" id="monthtotalprice">00</th>
   <th class="table-danger totalpriceafterdes" id="monthtotalpriceafterdes">00</th>
   </tr>
    `
        );
        SumTotalinMonthlyReport();
        FindTotalNet();
        LeftsideReport();
      },
    });
  });

  // Print Table
  $(".MonthPrint").on("click", function () {
    PrintMonthlyReport();
  });
  function PrintMonthlyReport() {
    var img = "/img/blue1.webp";
    var qty = $(".qtymonth").text();
    var totalunit = $(".unitpricemonth").text();
    var desp = $(".despricemonth").text();
    var totalpricebefore = $(".totalpricebeforedes").text();
    var totalpricebeafter = $(".totalpriceafterdes").text();
    var td = $("#tablemonth").find("tr").length;
    var tr = "";
    var total = `
   <tr>
                  
           <th colspan="5" class="table-secondary">Grand Total</th>
           <th class="table-success qty">00</th>
           <th class="table-info price">00</th>
           <th class="table-primary desprice">00</th>
           
             <th class="table-danger totald">00</th>
          
           
         </tr>
  `;
    for (let i = 1; i < td - 1; i++) {
      tr += `
<tr >
                       
<th>${$("#tablemonth")
          .find(`tr:eq(${Number(i)}) th:eq(0)`)
          .text()}</th>
<td>${$("#tablemonth")
          .find(`tr:eq(${Number(i)}) td:eq(0)`)
          .text()}</td>
<td> ${$("#tablemonth")
          .find(`tr:eq(${Number(i)}) td:eq(1) `)
          .text()}</td>
<td>${$("#tablemonth")
          .find(`tr:eq(${Number(i)}) td:eq(2)`)
          .text()}</td>
<td>${$("#tablemonth")
          .find(`tr:eq(${Number(i)}) td:eq(3)`)
          .text()}</td>
<td>${$("#tablemonth")
          .find(`tr:eq(${Number(i)}) td:eq(4)`)
          .text()}</td>
<td>${$("#tablemonth")
          .find(`tr:eq(${Number(i)}) td:eq(5)`)
          .text()}</td>
<td> ${$("#tablemonth")
          .find(`tr:eq(${Number(i)}) td:eq(6) `)
          .text()}</td>
<td>${$("#tablemonth")
          .find(`tr:eq(${Number(i)}) td:eq(7)`)
          .text()}</td>
<td>${$("#tablemonth")
          .find(`tr:eq(${Number(i)}) td:eq(8)`)
          .text()}</td>
</tr> 
`;
    }
    var newWin = window.frames["printdaily"];
    newWin.document.write(
      `
    <link rel="stylesheet" href="/css/bootstrap-5.2.3/dist/css/bootstrap.min.css">
    <link href="/css/stytle.css" rel="stylesheet">
  <body onload="window.print()">
<img src="${img}" alt=""  >
<p>Admin</p>
<h1>Monthly Report on ( ${date})</h1>
<div class="table-responsive">
<table class="table table-bordered">
              <thead >
              <th>No</th>
              <th>Date</th>
              <th>Item_no</th>
              <th>Documnet_No</th>
              <th>Item_Name</th>
              <th>Total Quantity</th>
              <th>Unit Price</th> 
             <th>Total DescountPrice</th>
              <th class="table-primary"> Total Price Before Discount</th>
              <th class="table-info">Total Price After Discount</th>
              </thead>
              <tbody>
              ${tr}
               <tr>
                  
           <th colspan="5" class="table-secondary">Grand Total</th>
           <th class="table-success qty">${qty}</th>
           <th class="table-info price">${totalunit}</th>
           <th class="table-primary desprice">${desp}</th>
             <th class="table-danger totald">${totalpricebefore}</th>
             <th class="table-danger totald">${totalpricebeafter}</th>
          
           
         </tr>
              
              </tbody>
              </table> 
              </div>   
        </body>
 
 `
    );

    newWin.document.close();
  }

  // Copy To Clip Board
  $("#copy-button").on("click", function () {
    function selectElementContents(el) {
      $("#tablemonth")
        .find("tr")
        .css({ " background-color": "lightgreen" });
      var body = document.body,
        range,
        sel;
      if (document.createRange && window.getSelection) {
        range = document.createRange();
        sel = window.getSelection();
        sel.removeAllRanges();
        try {
          range.selectNodeContents(el);
          sel.addRange(range);
        } catch (e) {
          range.selectNode(el);
          sel.addRange(range);
        }
      } else if (body.createTextRange) {
        range = body.createTextRange();
        range.moveToElementText(el);
        range.select();
      }
      document.execCommand("Copy");
    }
    selectElementContents(tablemonth);
  });

  SelectMonth();
  function SelectMonth() {
    $("#datefilter").on("change", function () {
      
      var DateValue = $(this).val();
      var tr = "";
          MonthDatatable.destroy()
          $("#monthreport").html(` <thead>
          <tr>
          <th>No</th>
          <th>Item_no</th>
          <th>UOM</th>
          <th>Item_Name</th>
          <th>Total Quantity</th>
          <th>Unit Price</th>
          <th>Total DescountPrice</th>
          <th class="table-primary"> Total Price Before Discount</th>
          <th class="table-info">Total Price After Discount</th>
          </tr>
        
        </thead>
        
        <tbody>
        
        </tbody>`)

       
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
                ajax: "monthdate/datafilter/" + DateValue,
                
                columns: [ {
                        data: 'created_at',
                        name: 'created_at',
                        render:function(data,type,row){
                            return (row.created_at).substring(10,0);
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
                    {search: 'none',
                        render: function(data, type, row) {
                                return Number((row.unit_price)*(row.total_count)).toFixed(2)
                            },
                    },
                    
                    {search: 'none',
                        render: function(data, type, row) {
                                return (Number((row.unit_price)*(row.total_count))-Number((row.discount_amount))).toFixed(2)
                            },
                    },
                    
                    
    
                ],
            });
    
        });
        
      });
    
  }

  $("#nav-contact-tab").on("click", function () { });
  var tr = `
<tr>
<th>Order Date</th>
<th>Customer Name</th>
<th>Customer Name 2</th>
<th>Total</th>
<th>Discount</th>
<th>Grand Total</th>
</tr>
`;
  $("#sale_returntable").append(tr);

  let avtion = 0;
  $(".view-more-btn").on("click", function (e) {
    if (avtion == 0) {
      avtion = 1;
      $(".full-list .list-select-input").slideDown().animate(
        {
          opacity: 1,
        },
        {
          queue: false,
          duration: "slow",
        }
      );
    } else {
      avtion = 0;
      $(".full-list .list-select-input").slideUp().animate(
        {
          opacity: 1,
        },
        {
          queue: false,
          duration: "fast",
        }
      );
    }

    e.preventDefault();
  });
  $(".salesubmit").on("click", function () {
    let fromdate = $(".fromdate").val();
    let todate = $(".todate").val();
    let customername = $(".customers-salereport").val();
    let sale_persioncode = $("#sale_persioncode").val();
     if (customername == "0") {
      $(".customers-salereport").focus();
    }
    else if(fromdate==''){

      $('.fromdate').focus()
    }
    else if(todate==''){
      $('.todate').focus();
    }
     else if (sale_persioncode == "0") {
      $("#sale_persioncode").focus();
    } else {
      datatable.destroy();
      $("#sale_returntable").html(` <thead>
  <tr>
      <th>Order Date</th>
      <th>Customer Name</th>
      <th>Customer Name 2</th>
      <th>Currency Code</th>
      <th>Sale_Persion_Code</th>
      <th>Payment Method</th>
  </tr>

</thead>

<tbody>

</tbody>`);

      $(function () {
        datatable = $("#sale_returntable").DataTable({
          responsive: true,
          destroy: true,
          autoWidth: false,
          dom: "Blfrtip",
          buttons: [
            {
              extend: "copy",
              exportOptions: {
                modifier: {
                  page: "all",
                  search: "none",
                },
              },
            },
            {
              extend: "excel",
              exportOptions: {
                modifier: {
                  page: "all",
                  search: "none",
                },
              },
            },
            {
              extend: "csv",
              exportOptions: {
                modifier: {
                  page: "all",
                  search: "none",
                },
              },
            },
            {
              extend: "pdf",
              exportOptions: {
                modifier: {
                  page: "all",
                  search: "none",
                },
              },
            },
            {
              extend: "print",
              exportOptions: {
                modifier: {
                  page: "all",
                  search: "none",
                },
              },
            },
          ],
          processing: true,
          serverSide: true,
          ajax: "salereport/filter_data_by_query/"+customername+'/'+sale_persioncode+'/'+fromdate+'/'+todate,

          columns: [
            {
              data: "order_date",
              name: "order_date",
            },
            {
              data: "customer_name",
              name: "customer_name",
            },
            {
              data: "customer_name_2",
              name: "customer_name_2",
            },
            {
              data: "currency_code",
              name: "currency_code",
              render: function (data, type, row) {
                if (row.currency_code == null) {
                  return "Dollar";
                } else {
                  return row.currency_code;
                }
              },
            },
            {
              data: "salesperson_code",
              name: "salesperson_code",
              render: function (data, type, row) {
                if (
                  row.salesperson_code == null ||
                  row.salesperson_code == ""
                ) {
                  return "Not Found";
                } else {
                  return row.salesperson_code;
                }
              },
            },
            {
              data: "payment_method_code",
              name: "payment_method_code",
            },
          ],
        });
      });
    }
  });

$('#nav-topproduct-tab').on('click',function(){















  
})
$('.return_filter').on('change',function(){
  var thisvalue=$('#change_date_return').val()
$.ajax({
  url: "return/retrun_allproduct/" + thisvalue,
  type:'GET',
  dataType:'json',
  success:function(data){
     $('.return_prices').text(Number(data.status[0].totalprice).toFixed(2)+'$')
     $('.return_item').text(Number(data.status[0].total_count).toFixed(2))
  }

})



  
  MonthDatatable.destroy()
  $('#return_table').html(`
  <thead class="thead-light">
  <tr>
      <th>No</th>
      <th>Item_no</th>
      <th>UOM</th>
      <th>Item_Name</th>
      <th>Total Quantity</th>
      <th>Unit Price</th>
      <th>Total DescountPrice</th>
      <th class="table-primary"> Total Price Before Discount</th>
      <th class="table-info">Total Price After Discount</th>
  </tr>

</thead>

<tbody>

</tbody>


  `
  )


 
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
          ajax: "return/retrun_report/" + thisvalue,

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


})


  // End jquery

});

// Print Excell For Daily Report
function ExportToExcel(type, id, name, fn, dl) {
  var date = new Date().toISOString().slice(0, 10);
  var elt = document.getElementById(id);
  var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
  return dl
    ? XLSX.write(wb, { bookType: type, bookSST: true, type: "base64" })
    : XLSX.writeFile(wb, fn || `${name}${date}.` + (type || "xlsx"));
}
