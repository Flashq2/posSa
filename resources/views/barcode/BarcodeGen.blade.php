<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Generate-Barcode</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/stytle.css') }}">
    {{-- <script src="{{asset('js/jbarcode/jquery/jquery-barcode.js')}}"></script>
    <script src="{{asset('js/jbarcode/jquery/jquery-barcode.min.js')}}"></script> --}}
<style>
    svg#barcode{
      display: inline-block
    }
    table {
    border: 1px solid black;
    border-collapse: collapse;
    }
    .table>:not(caption)>*>* {
    padding: 0.5rem 0.5rem;
    background-color: white;
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}
</style>

</head>

<body>
    <div class="modal fade" id="show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Format</label>
                            <select name="format" id="format" class="form-control">
                                <option value="code128">Code-128</option>
                                <option value="code39">Code-39</option>
                                <option value="ean13">EAN-13</option>
                                <option value="ean8">EAN-8</option>
                                <option value="ean5">EAN-5</option>
                                <option value="ean2">EAN-2</option>
                                <option value="1tf14">ITF-14</option>
                                <option value="msi">MSI</option>
                                <option value="pharmacode">Pharmacode</option>
                            </select>
                            <div class="mb-3">
                                <label class="form-label">Width</label>
                                <input type="number" name="width" id="width" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Height</label>
                                <input type="number" name="height" id="height" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Display Value</label>
                                <select name="display" id="display" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Back Groud Color</label>
                                    <input type="color" name="color" id="color" class="form-control">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary gen">Generate-Barcode</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showitemno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Format</label>
                            <select name="format" id="format" class="form-control">
                                <option value="code128">Code-128</option>
                                <option value="code39">Code-39</option>
                                <option value="ean13">EAN-13</option>
                                <option value="ean8">EAN-8</option>
                                <option value="ean5">EAN-5</option>
                                <option value="ean2">EAN-2</option>
                                <option value="1tf14">ITF-14</option>
                                <option value="msi">MSI</option>
                                <option value="pharmacode">Pharmacode</option>
                            </select>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Item_no</label>
                                <input class="form-control" list="datalistOptions" id='item_no' name="item_no"
                                    placeholder="Type to search Item_no">
                                    <p class="error-info">
                                        
                                    </p>
                                <datalist id="datalistOptions">
                                    @foreach ($item_no as $item)
                                        <option value="{{ $item->item_no }}">{{ $item->item_no }}</option>
                                    @endforeach
    
                                </datalist>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">UOM</label>
                                <select name="uom" id="uom" class="form-control">
                                    <option value="1">Select UOm</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Display Value</label>
                                <select name="display" id="displayh" class="form-control">
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Back Groud Color</label>
                                    <input type="color" name="color" id="colorh" class="form-control">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Width</label>
                            <input type="number" name="width" id="widthh" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Height</label>
                            <input type="number" name="height" id="heighth" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Barcode Quantity</label>
                            <input type="number" name="qty" id="qty" class="form-control" value="1">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary generate_itemno">Generate-Barcode</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="row">
                <div class="col-12">
                    <button><a href="{{ url()->previous() }}">Back</a></button>&nbsp;<button class="option">Custome
                        Barcode</button>
                    <button class="gernerate_by_name">Generate By Item No</button>
                    <button class="print">Print</button>

                </div>
            </div>
            <div class="row addmorebarcode">
            </div>
            <table class="table table-bordered"> 
                
            </table>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
<script>

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.option').on("click", function() {
        $('#show').modal("show")
       

        })
        $('.gernerate_by_name').on("click", function() {
        $('#showitemno').modal("show")
       

        })


$('.gen').on('click',function(){

     var width=$('#width').val();
        var height=$('#height').val();
        var display=$('#display').val();
        var color=$('#color').val()
        var fm=$('#format').val();
        if(height==null || height=='' || width==null || width=='' || width<=0 || height<=0){
            height=40;
            width=1;
        }
      
$.ajax({
  url:'{{url("barcode/show/showbarcode")}}',
 dataType:'json',
  beforeSend:function(){
            //work before success    
  },
  success:function(data){  
   console.log(data)
    $('#show').modal('hide')        
    // $('.table').html("");
    var tr=""
     var td='';
    for(var i=0;i<data.datatest.length;i++){
      for(var j=0;j<2;j++){
       td= `
        <td>
        <svg class="${data.datatest[i].identifier_code}"></svg>
             </td>
                 `
      }
       tr+=td
       console.log(tr)
         $('.table').append(`<tbody><tr> ${td}${td}<tr></tbody>`);
        JsBarcode("."+data.datatest[i].identifier_code+"",''+data.datatest[i].identifier_code+'', {
                format:fm,
                lineColor: color,
                width: width,
                height: height,
                displayValue: display,
                textPosition:'bottom'
            });
      
       
           
        
    }

    
   
  }        
});
        
});
$('#item_no').on('change',function(){
var ethis=$(this).val()
    $.ajax({
        url:'{{url("barcode/show/uom")}}',
        type:'GET',
        data:{
            'ethis':ethis
        },
        dataType:'json',
        success:function(data){
            var option = ''
                        data.status.forEach(element => {
                            option +=
                                `<option value="${element.unit_of_measure_code}">${element.unit_of_measure_code}</option>`
                        });
                        $('#uom')
                            .find('option')
                            .remove()
                            .end()
                            .append(option)
        }

    })

})
$('.generate_itemno').on('click',function(){
    var width=$('#widthh').val();
        var height=$('#heighth').val();
        var display=$('#displayh').val();
        var color=$('#colorh').val()
        var fm=$('#formath').val();
        var qty=$('#qty').val()
        if(height==null || height=='' || width==null || width=='' || width<=0 || height<=0){
            height=40;
            width=1;
        }
    var item_no=$('#item_no').val();

    var uom=$('#uom').val()
    console.log(uom)
    $.ajax({
        url:'{{url("barcode/show/barcode_code")}}',
        data:{
            'item':item_no,
            'uom':uom
        },
        dataType:'json',
        success:function(data){


            var tr=""
     var td='';
    data.select.forEach(element => {
          td= `
        <td>
        <svg class="${element.identifier_code}"></svg>
             </td>`
var qtys=0
var count=qty;
if(qty>=4){
    for(var i=0;i<qty;i++){
    tr+=td
    qtys++;
   
    if(qtys>=4){
 $('.table').append(`<tbody><tr>
             ${tr}

             <tr></tbody>`);
                
                tr=''
                qtys=0;
                count=count-4
    }
    
   

}
}
else if(qty<4){
    tr+=td
    qtys++;
   
     
 $('.table').append(`<tbody><tr>
             ${tr}

             <tr></tbody>`);
                
                tr=''
                qtys=0;
                count=count-4
    
}
console.log(count)

          
        JsBarcode("."+element.identifier_code+"",''+element.identifier_code+'', {
                format:fm,
                lineColor: color,
                width: width,
                height: height,
                displayValue: display,
                textPosition:'top'
            });   
    });
      
        
            
        
        }
    })
})

$('.print').on('click',function(){
    window.print();
})
    });
</script>

</html>
