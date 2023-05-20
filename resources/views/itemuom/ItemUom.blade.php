<!DOCTYPE html>
<html lang="en">
    <head>
        @extends('hader')
      @section('contain')
          
      @endsection
      <title>Item Unit of Measure</title>
      <link rel="icon" type="image/png" href="{{asset('https://static.wixstatic.com/media/74d6b3_1939d8a45096498883a91d31a42f868f~mv2.png/v1/fill/w_469,h_229,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/BlueTech_Large_KH.png')}}" sizes="16x16">
      
      </head>
<body>
   @extends('hader')
@section('contain')
@endsection



@if (auth()->user()->permission_code !=='Admin')
 @include('layouts.side-left-user')
@else
@include('layouts.slide-left')

@endif

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="pan">

        <p>Item Unit of Measure</p>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form method="POST" id="formitemuom">

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('itemuom.no'))}}</label>
                            <input type="text" class="form-control" id="code" aria-describedby="emailHelp"
                                name="code" readonly placeholder="Autoincresment">
                            <input type="hidden" class="form-control" id="idd" aria-describedby="emailHelp"
                                name="idd">

                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('itemuom.item_no'))}}</label>
                           
                            <input class="form-control" list="datalistOptions" id='item_no' name="item_no"
                                placeholder="Type to search Item_no">
                                <p class="error-info">
                                    
                                </p>
                            <datalist id="datalistOptions">
                                @foreach ($item_no as $item)
                                    <option value="{{ $item->no }}">{{ $item->no }}</option>
                                @endforeach

                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('itemuom.des1'))}}</label>
                            <input type="text" class="form-control" id="des" aria-describedby="emailHelp"
                                name="des">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('itemuom.des2'))}}</label>
                            <input type="text" class="form-control" id="des2" aria-describedby="emailHelp"
                                name="des2">
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('itemuom.uom'))}}</label>
                            <input type="text" class="form-control" id="iuom" aria-describedby="emailHelp"
                                name="iuom" list="datalistOption">
                            <datalist id="datalistOption">
                                @foreach ($uom as $test)
                                    <option value="{{ $test->code }}">{{ $test->code }}</option>
                                @endforeach

                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('itemuom.idcode'))}}</label>
                            <input type="text" class="form-control" id="idcode" aria-describedby="emailHelp"
                                name="idcode">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('itemuom.qtyperunit'))}}</label>
                            <input type="text" class="form-control" id="qty" aria-describedby="emailHelp"
                                name="qty">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('itemuom.price'))}}</label>
                            <input type="text" class="form-control" id="price" aria-describedby="emailHelp"
                                name="price">
                        </div>

                    </div>
                </div>



            </form>

            <button class="additemuom">{{(__('itemuom.add'))}}</button>
            <button class="editgroup">{{(__('itemuom.edit'))}}</button>


        </div>
        <div class="col-2"></div>
    </div>
    <div class="showbordere">

    </div>
    <div class="alert alert-primary hide" role="alert">
        Edit Successfully
    </div>
    <table id="item_uom" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead class="thead-primary">
            <tr>
                <th scope="col">{{(__('itemuom.no'))}}</th>
                <th scope="col">{{(__('itemuom.item_no'))}}</th>
                <th scope="col">{{(__('itemuom.uom'))}}</th>
                <th scope="col">{{(__('itemuom.idcode'))}}</th>
                <th scope="col">{{(__('itemuom.des1'))}}</th>
                <th scope="col">{{(__('itemuom.des2'))}}</th>
                <th scope="col">{{(__('itemuom.qtyperunit'))}}</th>
                <th scope="col">{{(__('itemuom.price'))}}</th>
                <th scope="col">{{(__('itemuom.action'))}}</th>
            </tr>
        </thead>

    </table>

    <template id="my-template">
        <swal-title>
          Permission Not Allow
        </swal-title>
        <swal-icon type="warning" color="red"></swal-icon>
       
         
        <swal-param name="allowEscapeKey" value="false" />
        <swal-param
          name="customClass"
          value='{ "popup": "my-popup" }' />
        <swal-function-param
          name="didOpen"
          value="popup => console.log(popup)" />
      </template>

</main> 
</body>
</html>










@include('script')

<script>
    $(document).ready(function() {
        let perdelete = '{{ $getpermissioncode[0]->delete }}'
        let perupdate = '{{ $getpermissioncode[0]->update }}'
        let peradd = '{{ $getpermissioncode[0]->add }}'

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Function Block

        Add_Uom();
        Edit()
        var datatable
        $(function() {


            datatable = $('#item_uom').DataTable({
                dom: "Blfrtip",
                buttons: [{
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
                    //     {
                    // extend: 'collection',
                    // text: 'Table control',
                    // buttons: [


                    //   ]
                    //     }


                ],
                processing: true,
                serverSide: true,
                ajax: " {{ route('showdatauom.list') }}",

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'item_no',
                        name: 'item_no'
                    },
                    {
                        data: 'unit_of_measure_code',
                        name: 'unit_of_measure_code'
                    },
                    {
                        data: 'identifier_code',
                        name: 'identifier_code'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'description_2',
                        name: 'description_2'
                    },
                    {
                        data: 'qty_per_unit',
                        name: 'qty_per_unit',
                    render: function (data, type, row) {
                      
                      return Number(row.qty_per_unit).toFixed(2);
                     
              },
                    },
                    {
                        data: 'price',
                        name: 'price',
                       render: function (data, type, row) {
                      
                      return Number(row.price).toFixed(2)+'$';
                     
              },
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
function Add_Uom(){
    $(document).on("click", '.additemuom', function() {
        if(peradd==1){
          var frmdataa = new FormData($('#formitemuom')[0]);
            $.ajax({
                url: 'showdatauom/addtitemuom',
                type: 'POST',
                datatype: 'json',
                data: frmdataa,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    if (data.status) {
                            $('.error-info').css({
                                'display': 'block'
                            })
                            $('.error-info').text(data.status.item_no + "*")
                            $('#item_no').css({
                                'border': '1px solid red'
                            })
                            $('#item_no').focus()

                            setInterval(() => {
                                $(".error-info").fadeOut(2000);
                            }, 1000);
                        }
                        else{
                                  $('.alert').css({
                        'display': 'block'
                    });
                    setInterval(function() {
                        $('.alert').css({
                            'display': 'none'
                        });
                    }, 2000);
                    $('#formitemuom').trigger("reset");
                    datatable.ajax.reload(null, false);
                        }

              
                }
            })  
        }
        else{
            Swal.fire({
            template: '#my-template'
            })
        }
            
        })
}
        
function Edit(){
     $('body').on("click", '.edit', function() {
        if(perupdate==1){
            var eThis = $(this);
            var par = eThis.parents('tr');
            var id = par.find('td:eq(0)').text();
            $('.editgroup').css({
                'display': 'block'
            });
            $('.additemuom').css({
                'display': 'none'
            });
            $.ajax({
                url: 'showinfouom/' + id,
                datatype: 'json',
                type: 'GET',
                success: function(data) {
                    $('body').find('#code').val(data.data.id);
                    $('body').find('#idd').val(data.data.id);
                    $('body').find('#item_no').val(data.data.item_no);
                    $('body').find('#des').val(data.data.description);
                    $('body').find('#des2').val(data.data.description_2);
                    $('body').find('#iuom').val(data.data.unit_of_measure_code);
                    $('body').find('#idcode').val(data.data.identifier_code);
                    $('body').find('#qty').val(data.data.qty_per_unit);
                    $('body').find('#price').val(data.data.price);
                }
            })
        }
        else{
            Swal.fire({
            template: '#my-template'
                })
        }
            
        })
}
       
        // Save Edit
        $('.editgroup').on('click', function() {
            var frmdataa = new FormData($('#formitemuom')[0]);
            var id = $('#idd').val()
            $('.editgroup').css({
                'display': 'none'
            });
            $('.additemuom').css({
                'display': 'block'
            });

            $.ajax({
                url: 'itemuom/edit/' + id,
                type: 'POST',
                datatype: 'json',
                contentType: false,
                cache: false,
                processData: false,
                data: frmdataa,
                success: function(data) {
                    $('.alert').css({
                        'display': 'block'
                    });
                    setInterval(function() {
                        $('.alert').css({
                            'display': 'none'
                        });
                    }, 2000);
                    datatable.ajax.reload(null, false);
                    $('#formitemuom').trigger("reset");
                }
            })
        });
        // delete 

        $('body').on('click', '.delete', function() {
            if(perdelete==1){
                var eThis = $(this);
            var par = eThis.parents('tr');
            var id = par.find('td:eq(0)').text();
            $.ajax({
                url: 'deletuom/' + id,
                type: 'POST',
                datatype: 'json',
                contentType: false,
                cache: false,
                processData: false,
                // data:frmdataa,
                success: function(data) {

                    datatable.ajax.reload(null, false);

                }
            })
            }
            else{
                Swal.fire({
                template: '#my-template'
                 })
            }
        })



    });
</script>
