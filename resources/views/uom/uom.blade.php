<!DOCTYPE html>
<html lang="en">
    <head>
        @extends('hader')
      @section('contain')
          
      @endsection
      <title>Unit of Measure</title>
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

        <p>Unit of Measure</p>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form method="POST" id="uom">

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{(__('itemuom.codes'))}}</label>
                            <input type="text" class="form-control" id="code" aria-describedby="emailHelp"
                                name="code">
                            <input type="hidden" class="form-control" id="idd" aria-describedby="emailHelp"
                                name="idd">
                            <p class="error-info"></p>

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
                            <label for="exampleInputEmail1" class="form-label">Factor</label>
                            <input type="number" class="form-control" id="factor" aria-describedby="emailHelp"
                                name="factor">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Inactived</label>
                            <select name="active" id="active" class="form-control">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                    </div>


                </div>
        </div>



        </form>
    </div>
    <button class="adduom">{{(__('itemuom.adduom'))}}</button>
    <button class="edituom">{{(__('itemuom.edit'))}}</button>
    <div class="col-2"></div>
    </div>
    <div class="showbordere">

    </div>
    <div class="alert alert-primary hide" role="alert">
        Edit Successfully
    </div>
    <table id="uom" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead >
            <tr>
                <th scope="col">{{(__('itemuom.codes'))}}</th>
                <th scope="col">{{(__('itemuom.des1'))}}</th>
                <th scope="col">{{(__('itemuom.des2'))}}</th>
                <th scope="col">Factor</th>
                <th scope="col">Active</th>
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
        var datatable
        $(function() {


            datatable = $('.table').DataTable({
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



                ],
                processing: true,
                serverSide: true,
                ajax: " {{ route('showuom.list') }}",

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
                        data: 'factor',
                        name: 'factor',
                        render: function(data, type, row) {
                            return Number(row.factor).toFixed(2);

                        },
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


        /// Add UOM
        $(document).on("click", '.adduom', function() {
        if(peradd==1){
            var frmdataa = new FormData($('#uom')[0]);
            $.ajax({
                url: 'showdatauom/adduom',
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
                        $('#uom').trigger("reset");
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



        // Show information
        $('body').on("click", '.edit', function() {
        if(perupdate==1){
            var eThis = $(this);
            var par = eThis.parents('tr');
            var id = par.find('td:eq(0)').text();

            $('.edituom').css({
                'display': 'block'
            });
            $('.adduom').css({
                'display': 'none'
            });
            $.ajax({
                url: 'showinfouomlist/' + id,
                datatype: 'json',
                type: 'GET',
                success: function(data) {
                    $('body').find('#code').val(data.data.code);
                    $('body').find('#idd').val(data.data.code);

                    $('body').find('#des').val(data.data.description);
                    $('body').find('#des2').val(data.data.description_2);

                    $('body').find('#factor').val(data.data.factor);
                    $('body').find('#active').val(data.data.inactived);
                    // alert(data.data.code);
                }
            })
        }
        else{
            Swal.fire({
                template: '#my-template'
                    })
        }
            
        })



        // Save Edit
        $('.edituom').on('click', function() {
            var frmdataa = new FormData($('#uom')[0]);
            var id = $('#idd').val()
            $('.edituom').css({
                'display': 'none'
            });
            $('.adduom').css({
                'display': 'block'
            });

            $.ajax({
                url: 'uom/edit/' + id,
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
                    $('#uom').trigger("reset");
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
                url: 'deletuoms/' + id,
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
