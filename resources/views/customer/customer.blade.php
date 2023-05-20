<!DOCTYPE html>
<html lang="en">
    <head>
        @extends('hader')
      @section('contain')
          
      @endsection
      <title>User Role</title>
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
    <div class="pan">

        <p>{{(__('customer.customer'))}}</p>
    </div>
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
     
 
    <!-- Button trigger modal -->
    <div class="alert alert-primary" role="alert">
        Customer add Scuess
    </div>
    <button class="add" data-bs-toggle="modal" data-bs-target="#exampleModal" data-opt="1">
        {{(__('customer.newcustomer'))}}
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{(__('customer.user'))}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="add_customer">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.id'))}}</label>
                                    <input type="text" class="form-control dd" id="no"
                                        aria-describedby="emailHelp" name="no">
                                    <p class="error-info"></p>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.name'))}}</label>
                                    <input type="text" class="form-control" id="name"
                                        aria-describedby="emailHelp" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.name2'))}}</label>
                                    <input type="text" class="form-control" id="name2"
                                        aria-describedby="emailHelp" name="name2">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.address'))}}</label>
                                    <input type="text" class="form-control" id="address"
                                        aria-describedby="emailHelp" name="address">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.address2'))}}</label>
                                    <input type="text" class="form-control" id="address2"
                                        aria-describedby="emailHelp" name="address2">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.phone_number'))}}</label>
                                    <input type="text" class="form-control" id="phone"
                                        aria-describedby="emailHelp" name="phone">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.phone_number2'))}}</label>
                                    <input type="text" class="form-control" id="phone2"
                                        aria-describedby="emailHelp" name="phone2">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Salepersion_Code</label>
                                    <input type="text" class="form-control" id="salse"
                                        aria-describedby="emailHelp" name="salse">

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Inactived</label>
                                    {{-- <input type="text" class="form-control" id="active" aria-describedby="emailHelp" name="active"> --}}
                                    <select name="active" id="active" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">NO</option>
                                    </select>

                                </div>
                            </div>
                        </div>



                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{(__('customer.close'))}}</button>
                    <button type="button" class="btn btn-primary adduser">{{(__('customer.save_change'))}}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Edite Customer --}}
    <div class="modal fade" id="editmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">User</h1> --}}
                    <img src="{{ asset('img/blue1.webp') }}" alt="">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.id'))}}</label>
                                    <input type="hidden" class="form-control dd" id="no"
                                        aria-describedby="emailHelp" name="no">
                                    <input type="text" class="form-control id" id="id"
                                        aria-describedby="emailHelp" name="id">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.name'))}}</label>
                                    <input type="text" class="form-control name" id="name"
                                        aria-describedby="emailHelp" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.name2'))}}</label>
                                    <input type="text" class="form-control name2" id="name2"
                                        aria-describedby="emailHelp" name="name2">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.address'))}}</label>
                                    <input type="text" class="form-control address" id="address"
                                        aria-describedby="emailHelp" name="address">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.address2'))}}</label>
                                    <input type="text" class="form-control address2" id="address2"
                                        aria-describedby="emailHelp" name="address2">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.phone_number'))}}</label>
                                    <input type="text" class="form-control phone" id="phone"
                                        aria-describedby="emailHelp" name="phone">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.phone_number2'))}}</label>
                                    <input type="text" class="form-control phone2" id="phone2"
                                        aria-describedby="emailHelp" name="phone2">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Salepersion_Code</label>
                                    <input type="text" class="form-control salse" id="salse"
                                        aria-describedby="emailHelp" name="salse">

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Inactived</label>
                                    <select name="active" id="active2" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">NO</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{(__('customer.close'))}}</button>
                    <button type="button" class="btn btn-primary edituser">{{(__('customer.clickedit'))}}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete Customer --}}
    <div class="modal fade" id="deletemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">User</h1> --}}
                    <img src="{{ asset('img/blue1.webp') }}" alt="">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                {{-- <th scope="col">{{(__('customer.id'))}}</th>
                                <th scope="col">{{(__('customer.name'))}}</th>
                                <th scope="col">{{(__('customer.name2'))}}</th>
                                <th scope="col">{{(__('customer.address'))}}</th>
                                <th scope="col">{{(__('customer.address2'))}}</th>
                                <th scope="col">{{(__('customer.phone_number'))}}</th>
                                <th scope="col">{{(__('customer.phone_number2'))}}</th>
                                <th scope="col">salesperson_code</th>
                                <th scope="col">inactived</th>
                                <th scope="col">{{(__('customer.edit'))}}</th> --}}
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.id'))}}</label>
                                    <input type="hidden" class="form-control dd" id="no"
                                        aria-describedby="emailHelp" name="no">
                                    <input type="text" class="form-control id" id="id"
                                        aria-describedby="emailHelp" name="id">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.name'))}}</label>
                                    <input type="text" class="form-control name" id="name"
                                        aria-describedby="emailHelp" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.name2'))}}</label>
                                    <input type="text" class="form-control name2" id="name2"
                                        aria-describedby="emailHelp" name="name2">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.address'))}}</label>
                                    <input type="text" class="form-control address" id="address"
                                        aria-describedby="emailHelp" name="address">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.address2'))}}</label>
                                    <input type="text" class="form-control address2" id="address2"
                                        aria-describedby="emailHelp" name="address2">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.phone_number'))}}</label>
                                    <input type="text" class="form-control phone" id="phone"
                                        aria-describedby="emailHelp" name="phone">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">{{(__('customer.phone_number2'))}}</label>
                                    <input type="text" class="form-control phone2" id="phone2"
                                        aria-describedby="emailHelp" name="phone2">

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Salepersion_Code</label>
                                    <input type="text" class="form-control salse" id="salse"
                                        aria-describedby="emailHelp" name="salse">

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Inactived</label>
                                    <select name="active" id="active" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">NO</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{(__('customer.close'))}}</button>
                    <button type="button" class="btn btn-primary deleteuser">{{(__('customer.delete'))}}</button>
                </div>
            </div>
        </div>
    </div>

   

        <div class="table-responsive">
            <table id="customer" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">{{(__('customer.id'))}}</th>
                        <th scope="col">{{(__('customer.name'))}}</th>
                        <th scope="col">{{(__('customer.name2'))}}</th>
                        <th scope="col">{{(__('customer.address'))}}</th>
                        <th scope="col">{{(__('customer.address2'))}}</th>
                        <th scope="col">{{(__('customer.phone_number'))}}</th>
                        <th scope="col">{{(__('customer.phone_number2'))}}</th>
                        <th scope="col">salesperson_code</th>
                        <th scope="col">inactived</th>
                        <th scope="col">{{(__('customer.edit'))}}</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>


            </table>

        </div>
</main>    
</body>
</html>



 
@include('script')

<script type="text/javascript"></script>

<script>
    $(document).ready(function() {

        let perdelete = '{{ $getpermissioncode[0]->delete }}'
        let perupdate = '{{ $getpermissioncode[0]->update }}'
        let peradd = '{{ $getpermissioncode[0]->add }}'
            Delete_Perview() 
            Click_Delete()   
            Edit();
            Edit_Preview()
            Add()

    if(perdelete==0){
        $('body').find('.edit').addClass('black');
    }
  


  $('.add').on('click',function(){
  $('#add_customer').trigger('reset');
  })

        var datatable
        $(function() {


            datatable = $('#customer').DataTable({
                processing: true,
                serverSide: true,
                ajax: " {{ route('customer.list') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'name_2',
                        name: 'name_2'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'address_2',
                        name: 'address_2'
                    },
                    {
                        data: 'phone_no',
                        name: 'phone_no'
                    },
                    {
                        data: 'phone_no_2',
                        name: 'phone_no_2'
                    },
                    {
                        data: 'salesperson_code',
                        name: 'salesperson_code'
                    },
                    {
                        data: 'inactived',
                        name: 'inactived'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,
                        
                    },


                ],
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




        // $('body').find('.edit').addClass('black');
        //   $(this).addClass('black')
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
function Add(){
  $('.adduser').on("click", function(e) {
    if(peradd==1){
      event.preventDefault()
            var no = $('#no').val();
            var name = $('#name').val();
            var name2 = $('#name2').val();
            var address = $('#address').val();
            var address2 = $('#address2').val();
            var phone = $('#phone').val();
            var phone2 = $('#phone2').val();
            var sales = $('#salse').val();
            var active = $('#active').val();
            var table = $('.table')
            var data = {
                'id': no,
                'name': name,
                'name2': name2,
                'address': address,
                'address2': address2,
                'phone': phone,
                'phone': phone2,
                'sales': sales,
                'active': active
            }
            $.ajax({
                url: 'addcustomer',
                type: 'POST',
                data: data,
                //contentType:false,
                cache: false,
                //processData:false,
                dataType: "json",
                beforeSend: function() {
                    //work before success    
                },
                success: function(data) {
                    if (data.status) {
                        $('.error-info').css({
                            'display': 'block'
                        })
                        $('.error-info').text(data.status.id + "*")
                        $('#no').css({
                            'border': '1px solid red'
                        })
                        $('#no').focus()

                        setInterval(() => {
                            $(".error-info").fadeOut(2000);
                        }, 1000);
                    } else {
                        $('#exampleModal').modal('hide')
                        datatable.ajax.reload(null, false);
                        $('.alert').css({
                            'display': 'block'
                        });
                        setInterval(function() {
                            $('.alert').css({
                                'display': 'none'
                            });
                        }, 2000);
                    }




                },
                error: function(xml, error, thrownError) {
                    console.log(thrownError);

                }
            });
    }
    else{
      Swal.fire({
  template: '#my-template'
})
$('#exampleModal').modal('hide')
    }
            



            var indd
        });
}
        
 function Edit_Preview(){
   $('body').on("click", ".edit", function() {
    if(perupdate==1){
        var eThis = $(this);
            var par = eThis.parents('tbody tr');
            indd = par.index();
            var id = par.find('td:eq(0)').text();
            $('#editmodel').modal('show');
            $.ajax({
                url: 'editcustomer/' + id,
                type: 'Get',
                // data:data,
                //contentType:false,
                cache: false,
                //processData:false,
                // dataType:"json",
                beforeSend: function() {
                    //work before success    
                },
                success: function(data) {
                    $('body').find('.dd').val(data.edit.id)
                    $('body').find('.id').val(data.edit.id)
                    $('body').find('.name').val(data.edit.name)
                    $('body').find('.name2').val(data.edit.name_2)
                    $('body').find('.address').val(data.edit.address)
                    $('body').find('.address2').val(data.edit.address_2)
                    $('body').find('.phone').val(data.edit.phone_no)
                    $('body').find('.phone2').val(data.edit.phone_no_2)
                    $('body').find('.salse').val(data.edit.salesperson_code)
                    $('body').find('#active2').val(data.edit.inactived)


                },
                error: function(xml, error, thrownError) {
                    console.log(thrownError);

                }
               
            });

    }
    else{
                    Swal.fire({
                            template: '#my-template'
                            })
                }


        });
 }
       
        // Click Edit Button
function Edit(){
   $('.edituser').on("click", function() {
            var table = $('.table');
            var no = $('.dd').val();
            var id = $('.id').val();
            var name = $('.name').val();
            var name2 = $('.name2').val();
            var address = $('.address').val();
            var address2 = $('.address2').val();
            var phone = $('.phone').val();
            var phone2 = $('.phone2').val();
            var sales = $('.salse').val();
            var active = $('#active2').val();

            var data = {
                'id': id,
                'name': name,
                'name2': name2,
                'address': address,
                'address2': address2,
                'phone': phone,
                'phone2': phone2,
                'sales': sales,
                'active': active
            }
            $.ajax({

                url: 'submitedit/' + no,
                type: 'POST',
                data: data,
                //contentType:false,
                cache: false,
                //processData:false,
                dataType: "json",
                beforeSend: function() {
                    //work before success    
                },
                success: function(data) {
                    $('#editmodel').modal('hide');
                    // par.find('td:eq(1)').val();
                    table.find("tr:eq(" + (indd + 1) + ") td:eq(0)").text(id);
                    table.find("tr:eq(" + (indd + 1) + ") td:eq(1)").text(name);
                    table.find("tr:eq(" + (indd + 1) + ") td:eq(2)").text(name2);
                    table.find("tr:eq(" + (indd + 1) + ") td:eq(3)").text(address);
                    table.find("tr:eq(" + (indd + 1) + ") td:eq(4)").text(address2);
                    table.find("tr:eq(" + (indd + 1) + ") td:eq(5)").text(phone);
                    table.find("tr:eq(" + (indd + 1) + ") td:eq(6)").text(phone2);
                    table.find("tr:eq(" + (indd + 1) + ") td:eq(7)").text(sales);
                    table.find("tr:eq(" + (indd + 1) + ") td:eq(8)").text(active);



                },
                error: function(xml, error, thrownError) {
                    console.log(thrownError);

                }
            });

        })
}
       
function Delete_Perview(){
    $('body').on("click", ".delete", function() {
        if(perdelete==1){
           var eThis = $(this);
            var par = eThis.parents('tbody tr');
            indd = par.index();
            var id = par.find('td:eq(0)').text();
            $('#deletemodel').modal('show');
            $.ajax({
                // we use the same route with edit because it just get data from databases and  show it in model
                url: 'editcustomer/' + id,
                type: 'Get',
                // data:data,
                //contentType:false,
                cache: false,
                //processData:false,
                // dataType:"json",
                beforeSend: function() {
                    //work before success    
                },
                success: function(data) {
                    // alert(data.edit.id);
                    // $('#no').val(data.edit.id);
                    $('body').find('.dd').val(data.edit.id)
                    $('body').find('.id').val(data.edit.id)
                    $('body').find('.name').val(data.edit.name)
                    $('body').find('.name2').val(data.edit.name_2)

                    $('body').find('.address').val(data.edit.address)
                    $('body').find('.address2').val(data.edit.address_2)
                    $('body').find('.phone').val(data.edit.phone_no)
                    $('body').find('.phone2').val(data.edit.phone_no_2)
                    $('body').find('.salse').val(data.edit.salesperson_code)
                    $('body').find('.active').val(data.edit.inactived)


                },
                error: function(xml, error, thrownError) {
                    console.log(thrownError);

                }
            });  
        }else{
            Swal.fire({
  template: '#my-template'
})
        }});
}
        // delete Button 
      
function Click_Delete(){
   $('.deleteuser').on("click", function() {
            var id = $('.dd').val();
            var table = $('.table')
            $.ajax({

                url: 'delete/' + id,
                type: 'GET',
                // data:data,
                //contentType:false,
                //cache:false,
                //processData:false,
                //dataType:"json",
                beforeSend: function() {
                    //work before success    
                },
                success: function(data) {
                    $('#deletemodel').modal('hide');

                    datatable.ajax.reload(null, false);

                },
                error: function(xml, error, thrownError) {
                    console.log(thrownError);

                }
            });
        })
}
  

    });
</script>
 
