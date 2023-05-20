<!DOCTYPE html>
<html lang="en">
    <head>
        @extends('hader')
      @section('contain')
          
      @endsection
      <title>Item</title>
      <link rel="icon" type="image/png" href="{{asset('https://static.wixstatic.com/media/74d6b3_1939d8a45096498883a91d31a42f868f~mv2.png/v1/fill/w_469,h_229,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/BlueTech_Large_KH.png')}}" sizes="16x16">
      
      </head>
<body>
    
@extends('hader')
@section('contain')
@endsection



@if (auth()->user()->permission_code !== 'Admin')
    @include('layouts.side-left-user')
@else
    @include('layouts.slide-left')
@endif

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="alert alert-danger" role="alert">
        This Item No is Already Exists
    </div>
    <div class="pan">

        <p>{{(__('item.item'))}}</p>
    </div>
    <!-- Modal  Edit Item-->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">   </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="edititem">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('item_group.no'))}}</label>
                                    <input type="text" class="form-control dd" id="mno"
                                        aria-describedby="emailHelp" name="mno" required>
                                    <input type="hidden" class="form-control dd" id="mid"
                                        aria-describedby="emailHelp" name="mid">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('item.no2'))}}</label>
                                    <input type="text" class="form-control" id="mno2"
                                        aria-describedby="emailHelp" name="mno2">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('item.des1'))}}</label>
                                    <input type="text" class="form-control" id="mdes"
                                        aria-describedby="emailHelp" name="mdes">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('item.des2'))}}</label>
                                    <input type="text" class="form-control" id="mdes2"
                                        aria-describedby="emailHelp" name="mdes2">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('item.item_g'))}}</label>
                                    <input type="text" class="form-control" id="mitem-gcode"
                                        aria-describedby="emailHelp" name="mitem-gcode">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('item.item_c'))}}</label>
                                    <input type="text" class="form-control" id="mitemCcode"
                                        aria-describedby="emailHelp" name="mitemCcode">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('item.unit_price'))}}</label>
                                    <input type="text" class="form-control" id="munitprice"
                                        aria-describedby="emailHelp" name="munitprice">
                                        <p class="error-info">
                                            
                                        </p>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('item.remark'))}}</label>
                                    <input type="text" class="form-control" id="mremark"
                                        aria-describedby="emailHelp" name="mremark">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('item.pic'))}}</label>
                                    {{-- <input type="file" class="form-control" id="image" aria-describedby="emailHelp" name="image"> --}}
                                    <input type="file" name="mimage" id="mimage" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Active</label>
                                    {{-- <input type="text" class="form-control" id="active" aria-describedby="emailHelp" name="active"> --}}
                                    <select class="form-select" aria-label="Default select example" id='mactive'
                                        name="mactive">

                                        <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>

                                    </select>
                                    <div class="mpreimg">
                                        {{-- <img id="mpreview-image" > --}}
                                        <img src="{{ asset('img/blue1.webp') }}" alt="" id="pre">
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- <button type="submit">Submit</button> --}}
                        {{-- <input type="submit" value="Edit"> --}}


                    </form>
                </div>
                <div class="modal-footer">
                    <button class="editi">{{(__('item.edit'))}}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{(__('item.close'))}}</button>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-8">
            @include('item.formitem')

        </div>
        <div class="col-4">
            <div class="preimg">
                <img id="preview-image" >
              
              </div>
              <h3 style="text-align: center">{{(__('item.preview'))}}</h3>
        </div>

    </div>

    <table id="item" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th scope="col">{{(__('item.no'))}}</th>
                <th scope="col">{{(__('item.no2'))}}</th>
                <th scope="col">{{(__('item.des1'))}}</th>
                <th scope="col">{{(__('item.des2'))}}</th>
                <th scope="col">{{(__('item.item_g'))}}</th>
                <th scope="col">{{(__('item.unit_price'))}}</th>
                <th scope="col">{{(__('item.item_c'))}}</th>
                <th scope="col">{{(__('item.remark'))}}</th>
                <th scope="col">{{(__('item.pic'))}}</th>
                <th scope="col">Active</th>
                <th scope="col">{{(__('item.action'))}}</th>
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
Image_Change()
Add_Item();
Edit()
Delete()

        var datatable
        $(function() {


            datatable = $('#item').DataTable({
                processing: true,
                serverSide: true,
                rowReorder: true,
                ajax: " {{ route('itemlist.list') }}",
                columns: [{
                        data: 'no',
                        name: 'no'
                    },
                    {
                        data: 'no_2',
                        name: 'no_2'
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
                        data: 'item_group_code',
                        name: 'item_group_code'
                    },
                    {
                        data: 'unit_price',
                        name: 'unit_price',
                        render: function(data, type, row) {

                            return Number(row.unit_price).toFixed(2) + '$';

                        },
                    },
                    {
                        data: 'item_category_code',
                        name: 'item_category_code'
                    },
                    {
                        data: 'remark',
                        name: 'remark'
                    },
                    // {data: 'picture', name: 'picture'},
                    {
                        data: 'product_brand_logo',
                        name: 'product_brand_logo',
                        orderable: true,
                        searchable: true
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
                columnDefs: [{
                    className: "my_class",
                    "targets": [8]
                }],
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
            });

        });

function Image_Change(){
     $('#image').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);


            }


            reader.readAsDataURL(this.files[0]);

        });
}
function Add_Item(){
    $('#su').on('submit', function(e) {
           
            e.preventDefault();

            if(peradd==1){
                let frmdata = new FormData(this);
            var item_no = $('#mno').val()
            $.ajax({
                url: 'additem',
                type: 'POST',
                datatype: 'json',
                data: frmdata,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {


                    if (data.status) {
                        $('.alert-danger').css({
                            'display': 'block'
                        })
                        $('.alert-danger').text(data.status.no)
                        $('#su').trigger("reset");

                        setInterval(() => {
                            $(".alert-danger").fadeOut(2000);
                        }, 1000);
                    } else {
                        $('#preview-image').attr('src','');
                        $('#su').trigger("reset");
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
       
        
        var image = "";
function Edit(){
     $('body').on("click", '.edit', function() {

            if(perupdate==1){
                 var eThis = $(this);
            var par = eThis.parents('tr');
            var indd = par.find('td:eq(0)').text();
            $('#edit').modal("show");
            $.ajax({
                url: 'edititem/' + indd,
                type: 'GET',
                datatype: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    $('body').find('#mno').val(data.data.no);
                    $('body').find('#mno2').val(data.data.no_2);
                    $('body').find('#mdes').val(data.data.description);
                    $('body').find('#mdes2').val(data.data.description_2);
                    $('body').find('#mremark').val(data.data.remark);
                    // $('body').find('#mactive').val(data.data.active);
                    $('body').find('#munitprice').val(data.data.unit_price);
                    $('body').find('#mitem-gcode').val(data.data.item_group_code);
                    $('body').find('#mitemCcode').val(data.data.item_category_code);
                    var img = data.data.picture
                    // $('.mpreimg').css({"background-image":"{{ asset('img/blue.gif') }}"}) ;
                    if (img == null) {
                        img = 'blue1.webp';

                    }
                    $('body').find('.mpreimg img').attr('src', `{{ asset('tos/${img}') }} `)

                }
            })
            }
            else{
                Swal.fire({
                template: '#my-template'
                })
            }
           

        });
}
       
        $('#mimage').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                //  $('#pre').attr('src', e.target.result); 
                $('body').find('.mpreimg img').attr('src', e.target.result);

            }


            reader.readAsDataURL(this.files[0]);
        })
        $(document).on('click', '.editi', function() {
            // e.preventDefault();
            // var eThis=$(this);
            // var par=eThis.parents('tr');
            // var indd=par.find('td:eq(0)').text();
            var id = $('#mno').val();
            let frmdata = new FormData($('#edititem')[0]);

            $.ajax({
                url: 'edititempost/' + id,
                type: 'POST',
                datatype: 'json',
                data: frmdata,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#edit').modal("hide");
                    datatable.ajax.reload(null, false);
                }
            })
        });
function Delete(){
     $('body').on("click", ".delete", function() {
            if(perdelete==1){
                var eThis = $(this);
            var par = eThis.parents('tr');
            var indd = par.find('td:eq(0)').text();
            $.ajax({
                url: 'deleteidtem/' + indd,
                type: 'POST',
                // datatype:'json',
                // data:frmdata,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // $('#edit').modal("hide");
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
}
       
        $('body').on('mouseover', 'td.my_class', function() {
            var eThis = $(this);
            var par = eThis.parents('tr');
            var indd = par.find('td:eq(8) img').attr('src');

            var des = par.find('td:eq(2)').text();
            if ($('body').find('.tdshowimg').length <= 0) {
                eThis.find('img').before(`
                  <div class="tdshowimg">
                <p>${des}</p>
                <img src="${indd}" alt="">
            </div>
            `)
            }
            console.log($('body').find('.tdshowimg').length)

        })
        $('body').on('mouseleave', '.my_class', function() {
            // $('table tr td .tdshowimg').remove("tdshowimg") 
            $('.tdshowimg').remove()

        })


    });
</script>
