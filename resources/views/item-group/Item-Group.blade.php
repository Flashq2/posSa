<!DOCTYPE html>
<html lang="en">
    <head>
        @extends('hader')
      @section('contain')
          
      @endsection
      <title>Item Group</title>
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

        <p>{{(__('item_group.item_group'))}}</p>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form method="POST" id="itemgroup">

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('item_group.codes'))}}</label>
                            <input type="text" class="form-control" id="code" aria-describedby="emailHelp"
                                name="code" required>
                            <input type="hidden" class="form-control" id="id" aria-describedby="emailHelp"
                                name="id">
                            <p class="error-info"></p>

                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('item_group.des1'))}}</label>
                            <input type="text" class="form-control" id="mdes" aria-describedby="emailHelp"
                                name="mdes">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('item_group.des2'))}}</label>
                            <input type="text" class="form-control" id="mdes2" aria-describedby="emailHelp"
                                name="mdes2">
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('item_group.item_brad'))}}</label>
                            <input type="text" class="form-control" id="brandcode" aria-describedby="emailHelp"
                                name="brandcode">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('item_group.item_c'))}}</label>
                            <select class="form-select" aria-label="Default select example" id='category'
                                name="category">
                                @foreach ($datanew as $data)
                                    <option value="{{ $data->code }}" selected>{{ $data->code }}</option>
                                @endforeach



                            </select>
                            {{-- <input type="text" class="form-control" id="category" aria-describedby="emailHelp" name="category"> --}}
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

            <button class="addgroup">{{(__('item_group.add'))}}</button>
            <button class="editgroup">{{(__('item_group.edit'))}}</button>

        </div>
        <div class="col-2"></div>
    </div>
    <div class="alert alert-primary hide" role="alert">
        Add Successfully
    </div>
    <table id="item_group" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead class="color-900">
            <tr>
                <th scope="col">{{(__('item_group.codes'))}}</th>

                <th scope="col">{{(__('item_group.des1'))}}</th>
                <th scope="col">{{(__('item_group.des2'))}}</th>
                <th scope="col">{{(__('item_group.item_brad'))}}</th>
                <th scope="col">{{(__('item_group.item_c'))}}</th>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        let perdelete = '{{ $getpermissioncode[0]->delete }}'
        let perupdate = '{{ $getpermissioncode[0]->update }}'
        let peradd = '{{ $getpermissioncode[0]->add }}'
        

        //---------Function--------------
        Add();
        Delete();
        Edit();
        Save_Edit();


        var datatable
        $(function() {


            datatable = $('#item_group').DataTable({

                processing: true,
                serverSide: true,
                ajax: " {{ route('itemgrouplist.list') }}",
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
                        data: 'item_brand_code',
                        name: 'item_brand_code'
                    },
                    {
                        data: 'item_category_code',
                        name: 'item_category_code'
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

        //   })

function Add(){
  $(document).on("click", '.addgroup', function() {


            if (peradd == 1) {
                var frmdataa = new FormData($('#itemgroup')[0]);
                $.ajax({
                    url: 'additemgroup',
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
                            $('#itemgroup').trigger("reset");
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
                $('.editgroup').css({
                    'display': 'block'
                });
                $('.addgroup').css({
                    'display': 'none'
                });
                $.ajax({
                    url: 'showinfo/' + id,
                    datatype: 'json',
                    type: 'GET',
                    success: function(data) {
                        $('body').find('#code').val(data.data.code);
                        $('body').find('#id').val(data.data.code);
                        $('body').find('#mdes').val(data.data.description);
                        $('body').find('#mdes2').val(data.data.description_2);
                        $('body').find('#brandcode').val(data.data.item_brand_code);
                        $('body').find('#category').val(data.data.item_category_code);
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
   $('.editgroup').on('click', function() {
            var frmdataa = new FormData($('#itemgroup')[0]);
            var id = $('#id').val()
            $('.editgroup').css({
                'display': 'none'
            });
            $('.addgroup').css({
                'display': 'block'
            });

            $.ajax({
                url: 'editpostgroup/' + id,
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
                    $('#itemgroup').trigger("reset");
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
                    url: 'deletgroup/' + id,
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
