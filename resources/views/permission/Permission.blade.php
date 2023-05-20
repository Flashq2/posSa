<!DOCTYPE html>
<html lang="en">

<head>

    @extends('hader')
    @section('contain')
    @endsection
    <title>Permission </title>
    <link rel="icon" type="image/png"
        href="{{ asset('https://static.wixstatic.com/media/74d6b3_1939d8a45096498883a91d31a42f868f~mv2.png/v1/fill/w_469,h_229,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/BlueTech_Large_KH.png') }}"
        sizes="16x16">

</head>

<body>
    @extends('layouts.slide-left')
    @section('container')
    @endsection
    @extends('permission.permissionmodal')
    @section('modelpermission')
    @endsection
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

            <p>{{(__('permission.permission'))}}</p>
        </div>
        <button class="add" data-bs-toggle="modal" data-bs-target="#exampleModal" data-opt="1"
            style="margin-top:20px;">
            {{(__('permission.add'))}}
        </button>
        <table id="permission" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead class="thead-info">
                <tr>
                    <th scope="col">{{(__('permission.code'))}}</th>
                    <th scope="col">{{(__('permission.des1'))}}</th>
                    <th scope="col">{{(__('permission.des2'))}}</th>
                    <th scope="col">Active</th>
                    <th scope="col">{{(__('permission.adds'))}}</th>
                    <th scope="col">{{(__('permission.update'))}}</th>
                    <th scope="col">{{(__('permission.delete'))}}</th>
                    <th scope="col">{{(__('permission.dis'))}}</th>
                    <th scope="col">{{(__('permission.action'))}}</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <div class="modal fade" id="deletepermission" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you Want to delect This User?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary no-nodelete"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger delete-permisson">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>

</html>
@include('script')
<script></script>
<script>
    $(document).ready(function() {
        let checkadd = 0;
        let checkupdate = 0;
        let checkdelete = 0;
        let checkdis=0;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var datatable
        $(function() {



            datatable = $('#permission').DataTable({
                
                processing: true,
                serverSide: true,
                language: {
                    "processing": ""
                 },
                ajax: " {{ route('permission.list') }}",
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
                        data: 'add',
                        name: 'add',
                        render: function(data, type, row) {
                            if (row.add == 1) {
                                return '<input type="checkbox" class="addvalue" checked style="width: 30px;height:30px;" onclick="return false;">'
                            } else {
                                return '<input type="checkbox" class="addvalue"  style="width: 30px;height:30px;" onclick="return false;">'
                            }


                        },
                    },

                    {
                        data: 'update',
                        name: 'update',
                        render: function(data, type, row) {
                            if (row.update == 1) {
                                return '<input type="checkbox" class="editvalue" checked style="width: 30px;height:30px;" onclick="return false;">'
                            } else {
                                return '<input type="checkbox" class="editvalue"  style="width: 30px;height:30px;" onclick="return false;">'
                            }


                        },
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        render: function(data, type, row) {
                            if (row.delete == 1) {
                                return '<input type="checkbox" class="deletevalue" checked style="width: 30px;height:30px;" onclick="return false;">'
                            } else {
                                return '<input type="checkbox" class="deltevalue"  style="width: 30px;height:30px;" onclick="return false;">'
                            }


                        },
                    },
                    {
                        data: 'discount',
                        name: 'discount',
                        render: function(data, type, row) {
                            if (row.discount == 1) {
                                return '<input type="checkbox" class="discount" checked style="width: 30px;height:30px;" onclick="return false;">'
                            } else {
                                return '<input type="checkbox" class="discount"  style="width: 30px;height:30px;" onclick="return false;">'
                            }


                        },
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
       


        function Add_Permission() {
            $('body').on('click', '.addpermission', function() {


                checkadd = $('.adddpermission').prop('checked')
                checkupdate = $('.updatepermission').prop('checked')
                checkdelete = $('.deletepermission').prop('checked')
                checkdis = $('.discountpermission').prop('checked')
                if (checkadd == true) {
                    checkadd = 1;
                } else {
                    checkadd = 0;
                }

                if (checkupdate == true) {
                    checkupdate = 1;
                } else {
                    checkupdate = 0;
                }

                if (checkdelete == true) {
                    checkdelete = 1;
                } else {
                    checkdelete = 0;
                }
                if (checkdis == true) {
                    checkdis = 1;
                } else {
                   checkdis= 0;
                }


                var code = $('#code').val();
                var des = $('#des').val();
                var des2 = $('#des2').val()
                var active = $('#active option:selected').text();

                var data = {
                    'code': code,
                    'des': des,
                    'des2': des2,
                    'active': active,
                    'add': checkadd,
                    'update': checkupdate,
                    'delete': checkdelete,
                    'discount':checkdis
                }
                $.ajax({
                    url: 'addpermission',
                    type: 'POST',
                    datatype: 'json',
                    data: data,
                    success: function(data) {
                        console.log(checkdis);
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
                            $('#exampleModal').modal('hide');
                            datatable.ajax.reload(null, false);
                            checkadd = 0;
                            checkdelete = 0;
                            checkupdate = 0;
                            checkdis=0;
                        }


                    }
                });
            })
        }


        //Edit (Get value to Modal)

        function Show_Edit_Value() {
            $('body').on("click", '.edit', function() {
                //       Swal.fire({
                //   template: '#my-template'
                // })
                $('.editpermission').css({
                    'display': 'block'
                });
                $('.addpermission').css({
                    'display': 'none'
                });
                var eThis = $(this);
                var par = eThis.parents('tr');
                var id = par.find('td:eq(0)').text();
                var des = par.find('td:eq(1)').text();
                var des2 = par.find('td:eq(2)').text();
                var active = par.find('td:eq(3)').text();
                var add = par.find('td:eq(4) input').prop('checked');
                var update = par.find('td:eq(5) input').prop('checked');
                var deletecheck = par.find('td:eq(6) input').prop('checked');
                var discountchecck = par.find('td:eq(7) input').prop('checked');

                $('#exampleModal').modal('show');
                $('#code').val(id);
                $('#des').val(des);
                $('#des2').val(des2)
                $('#active').val(active);
                $('#id').val(id);
                if (add == true) {
                    $('.adddpermission').prop('checked', true)
                } else {
                    $('.adddpermission').prop('checked', false)
                }
                if (update == true) {
                    $('.updatepermission').prop('checked', true)
                } else {
                    $('.updatepermission').prop('checked', false)
                }
                if (deletecheck == true) {
                    $('.deletepermission').prop('checked', true)
                } else {
                    $('.deletepermission').prop('checked', false)
                }
                if (discountchecck == true) {
                    $('.discountpermission').prop('checked', true)
                } else {
                    $('.discountpermission').prop('checked', false)
                }



            })
        }


        $('body').on("click", '.add', function() {
            $('#form_Permission').trigger('reset');
            $('.editpermission').css({
                'display': 'none'
            });
            $('.addpermission').css({
                'display': 'block'
            });

        })
        $('body').on('click', '.editpermission', function() {


            checkadd = $('.adddpermission').prop('checked')
            checkupdate = $('.updatepermission').prop('checked')
            checkdelete = $('.deletepermission').prop('checked')
            checkdis = $('.discountpermission').prop('checked')
            if (checkadd == true) {
                checkadd = 1;
            } else {
                checkadd = 0;
            }

            if (checkupdate == true) {
                checkupdate = 1;
            } else {
                checkupdate = 0;
            }

            if (checkdelete == true) {
                checkdelete = 1;
            } else {
                checkdelete = 0;
            }
            if (checkdis == true) {
                checkdis = 1;
            } else {
                checkdis = 0;
            }

            var code = $('#code').val();
            var des = $('#des').val();
            var des2 = $('#des2').val();
            var id = $('#id').val();
            var active = $('#active option:selected').text();
            var data = {
                'code': code,
                'des': des,
                'des2': des2,
                'active': active,
                'add': checkadd,
                'update': checkupdate,
                'delete': checkdelete,
                'discount':checkdis
            }
            $.ajax({
                url: 'editpermission/' + id,
                type: 'POST',
                datatype: 'json',
                data: data,
                success: function(data) {
                    $('#exampleModal').modal('hide');
                    datatable.ajax.reload(null, false);
                }
            });
        })
        var id;

        function Delete_Permission() {
            $('body').on('click', '.delete', function() {
                $('#deletepermission').modal('show')
                var eThis = $(this);
                var par = eThis.parents('tr');
                id = par.find('td:eq(0)').text();

            })

            $('.delete-permisson').on('click', function() {
                $.ajax({
                    url: 'deletepermission/' + id,
                    type: 'GET',
                    // datatype:'json',
                    //  data:data,
                    success: function(data) {
                        $('#deletepermission').modal('hide')
                        datatable.ajax.reload(null, false);
                    }
                });
            })
        }
        Delete_Permission()
        Add_Permission()
        Show_Edit_Value()
    });
</script>
