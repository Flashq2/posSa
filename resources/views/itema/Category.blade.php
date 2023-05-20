<!DOCTYPE html>
<html lang="en">
    <head>
        @extends('hader')
      @section('contain')
          
      @endsection
      <title>Item Categoty</title>
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


    <template id="my-template">
        <swal-title>
            Permission Not Allow
        </swal-title>
        <swal-icon type="warning" color="red"></swal-icon>


        <swal-param name="allowEscapeKey" value="false" />
        <swal-param name="customClass" value='{ "popup": "my-popup" }' />
        <swal-function-param name="didOpen" value="popup => console.log(popup)" />
    </template>
    <div class="pan">

        <p>{{(__('item_group.item_cate'))}}</p>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form method="POST" id="itemcate">

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('item_group.codes'))}}</label>
                            <input type="text" class="form-control" id="code" aria-describedby="emailHelp"
                                name="code" required>
                            <input type="hidden" class="form-control" id="id" aria-describedby="emailHelp"
                                name="id">
                            <p class="error-info">

                            </p>

                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('item_group.des1'))}}</label>
                            <input type="text" class="form-control" id="mdes" aria-describedby="emailHelp"
                                name="mdes">
                        </div>


                    </div>
                    <div class="col-6">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('item_group.des2'))}}</label>
                            <input type="text" class="form-control" id="mdes2" aria-describedby="emailHelp"
                                name="mdes2">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Active</label>

                            <select class="form-select" aria-label="Default select example" id='active'
                                name="active">

                                <option value="Yes" selected>Yes</option>
                                <option value="No">No</option>

                            </select>


                        </div>
                    </div>
                </div>



            </form>

            <button class="addcate">{{(__('item_group.add_item_cate'))}}</button>
            <button class="editcate">{{(__('item_group.edit'))}}</button>

        </div>
        <div class="col-2"></div>
    </div>
    <div class="alert alert-primary hide" role="alert">
        Add Successfully
    </div>
    <table id="category" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead >
            <tr>
                <th scope="col">{{(__('item_group.codes'))}}</th>
                <th scope="col">{{(__('item_group.des1'))}}</th>
                <th scope="col">{{(__('item_group.des2'))}}</th>
                <th scope="col">inactived</th>
                <th scope="col">{{(__('item_group.action'))}}</th>
            </tr>
        </thead>

    </table>


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

      //function //   
        Add()
        Edit()
        Save_Edit()
        Delete()



      //function//
        var datatable
        $(function() {


            datatable = $('#category').DataTable({

                processing: true,
                serverSide: true,
                ajax: " {{ route('itemcatelist.list') }}",
                columns: [{
                        data: 'code',
                        name: 'code'
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

        $.extend( $.fn.dataTable.defaults, {
    language: {
        "processing": "Loading. Please wait..."
    },
 
});

function Add(){
  $(document).on("click", '.addcate', function() {


            if (peradd == 1) {
                var frmdataa = new FormData($('#itemcate')[0]);
                $.ajax({
                    url: 'addicate',
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
                            $('.error-info').text(data.status.code + "*")
                            $('#code').css({
                                'border': '1px solid red'
                            })
                            $('#code').focus()

                            setInterval(() => {
                                $(".error-info").fadeOut(2000);
                            }, 1000);
                        } else {

                            $('.alert').css({
                                'display': 'block'
                            });
                            setInterval(function() {
                                $('.alert').css({
                                    'display': 'none'
                                });
                            }, 2000);
                            $('#itemcate').trigger("reset");
                            datatable.ajax.reload(null, false);
                        }

                    }
                })
            } else {
                Swal.fire({
                    template: '#my-template'
                })
            }

        })
}        
        
function Edit(){
   $('body').on("click", '.edit', function() {
            if (perupdate == 1) {
                var eThis = $(this);
                var par = eThis.parents('tr');
                var id = par.find('td:eq(0)').text();
                $('.editcate').css({
                    'display': 'block'
                });
                $('.addcate').css({
                    'display': 'none'
                });
                $.ajax({
                    url: 'showinfocate/' + id,
                    datatype: 'json',
                    type: 'GET',
                    success: function(data) {
                        $('body').find('#code').val(data.data.code);
                        $('body').find('#id').val(data.data.code);
                        $('body').find('#mdes').val(data.data.description);
                        $('body').find('#mdes2').val(data.data.description_2);
                        $('body').find('#active').val(data.data.inactived);
                    }
                })
            } else {
                Swal.fire({
                    template: '#my-template'
                })
            }

        })
}
 

function Save_Edit(){
 $('.editcate').on('click', function() {
            var frmdataa = new FormData($('#itemcate')[0]);
            var id = $('#id').val()
            $('.editcate').css({
                'display': 'none'
            });
            $('.addcate').css({
                'display': 'block'
            });

            $.ajax({
                url: 'editpostcate/' + id,
                type: 'POST',
                datatype: 'json',
                contentType: false,
                cache: false,
                processData: false,
                data: frmdataa,
                success: function(data) {
                    $('#itemcate').trigger("reset");
                    $('.alert').css({
                        'display': 'block'
                    });
                    setInterval(function() {
                        $('.alert').css({
                            'display': 'none'
                        });
                    }, 2000);
                    datatable.ajax.reload(null, false);

                }
            })
        }); 
}
        
function Delete(){
   $('body').on('click', '.delete', function() {
            if (perdelete == 1) {
                var eThis = $(this);
                var par = eThis.parents('tr');
                var id = par.find('td:eq(0)').text();
                $.ajax({
                    url: 'deletcate/' + id,
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
            } else {
                Swal.fire({
                    template: '#my-template'
                })
            }

        })
}
    });
</script>
