{{-- @extends('hader')
@section('contain')
@section('title_name', 'User Info')
    
 
    
@endsection --}}
<!DOCTYPE html>
<html lang="en">

<head>
    @extends('hader')
    @section('contain')
    @endsection
    <title>User</title>
    <link rel="icon" type="image/png"
        href="{{ asset('https://static.wixstatic.com/media/74d6b3_1939d8a45096498883a91d31a42f868f~mv2.png/v1/fill/w_469,h_229,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/BlueTech_Large_KH.png') }}"
        sizes="16x16">

</head>

<body>
    @extends('layouts.slide-left')
    @section('container')
    @endsection
    <script src="https://kit.fontawesome.com/bca9825c0c.js" crossorigin="anonymous"></script>

<?php
$header=\App\Models\Getcustomer::all();
 ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="pan">

            <p>{{ __('user.user') }}</p>
        </div>

        <!-- Button trigger modal -->
        <button class="add" data-bs-toggle="modal" data-bs-target="#exampleModal" data-opt="1"
            style="margin-top:20px;">
            {{ __('user.add') }}
        </button>
        <!-- Modal -->
        @extends('layouts.Modaluser')
        @section('modaladduser')
        @endsection

        <!-- Button trigger modal -->


        <!-- Modal -->



        <div class="modal fade" id="deleteuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you Want to delect This User?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary no-nodelete"
                            data-bs-dismiss="modal">{{ __('user.close') }}</button>
                        <button type="button"
                            class="btn btn-primary yes-delete">{{ __('user.submitdelete') }}</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="alert alert-primary" role="alert">
            User add Scuess
        </div>

        <table id="user" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">{{ __('user.id') }}</i></th>
                    <th scope="col">{{ __('user.email') }}</i></th>
                    <th scope="col">{{ __('user.sales') }}</i></th>
                    <th scope="col">{{ __('user.name') }}</i></th>
                    <th scope="col">{{ __('user.gender') }}</i></th>
                    <th scope="col">{{ __('user.dao') }}</th>
                    {{-- <th scope="col">IDCard</th>
            <th scope="col">Phone</th> --}}
                    {{-- <th scope="col">password</th> --}}
                    <th scope="col">User Role</th>
                    <th scope="col">Permission</th>
                    <th scope="col">{{ __('user.address') }}</th>
                    <th scope="col">{{ __('user.address2') }}</th>
                    {{-- <th scope="col">country_code</th> --}}
                    <th scope="col">{{ __('user.city') }}</th>
                    <th scope="col">{{ __('user.status') }}</th>
                    <th scope="col">inactived</th>
                    <th scope="col">{{ __('user.action') }}</th>
                </tr>
            </thead>
            <tbody>


            </tbody>
        </table>




    </main>
</body>

</html>



@include('script')

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
</script>
<script src="{{asset('scriptcode/user_script.js')}}"></script>

