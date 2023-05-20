 
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // add new user use Ajax

        $('.add').on('click', function() {
            $('#user-form')[0].reset();
        })
        $('.adduser').on("click", function(e) {


            var email = $('#email').val();
            var id = $('#no').val();
            var salesperson_code = $('#salse').val();
            var name = $('#name').val();
            var gender = $('#gender').val();
            var date = $('#dob').val();
            var idcard = $('#idcard').val();

            var phone = $('#phone').val();
            var userrole = $('#userrole option:selected').text();
            var address = $('#address').val();
            var address2 = $('#address2').val();
            var status = $('#status').val();
            var contry = $('#contry').val();
            var permission = $('#permission').val();
            var active = $('#active').val();
            var password = $('#pass').val();
            var city = $('#city').val();
            var table = $('.table')
            var data = {
                'email': email,
                'salesperson_code': salesperson_code,
                'name': name,
                'gender': gender,
                'date': date,
                'idcare': idcard,
                'phone': phone,
                'userrole': userrole,
                'address': address,
                'address2': address2,
                'status': status,
                'contry': contry,
                'permission': permission,
                'active': active,
                'city': city,
                'password': password,
            }
            $.ajax({
                url: 'adduser',
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
                    if (data.status.email) {


                        $('.error-info-email').css({
                            'display': 'block'
                        })
                        $('.error-info-email').text(data.status.email + "*")
                        $('#email').css({
                            'border': '1px solid red'
                        })
                        $('#email').focus()

                        setInterval(() => {
                            $(".error-info-email").fadeOut(2000);
                        }, 1000);

                    } else if (data.status.salesperson_code) {
                        $('.error-info').css({
                            'display': 'block'
                        })
                        $('.error-info').text(data.status.salesperson_code + "*")
                        $('#salse').css({
                            'border': '1px solid red'
                        })
                        $('#salse').focus()

                        setInterval(() => {
                            $(".error-info").fadeOut(2000);
                        }, 1000);
                    } else if (data.status.name) {
                        $('.error-info-name').css({
                            'display': 'block'
                        })
                        $('.error-info-name').text(data.status.name + "*")
                        $('#name').css({
                            'border': '1px solid red'
                        })
                        $('#name').focus()

                        setInterval(() => {
                            $(".error-info-name").fadeOut(2000);
                        }, 1000);
                    } else if (data.status.password) {
                        $('.error-info-pass').css({
                            'display': 'block'
                        })
                        $('.error-info-pass').text(data.status.password + "*")
                        $('#pass').css({
                            'border': '1px solid red'
                        })
                        $('#pass').focus()

                        setInterval(() => {
                            $(".error-info-pass").fadeOut(2000);
                        }, 1000);
                    }


                    if (data.status == 'true') {
                        $('#exampleModal').modal('hide');
                        $('#exampleModal').find('form').trigger('reset')
                        datatable.ajax.reload(null, false)
                    }



                },
                error: function(xml, error, thrownError) {
                    alert(thrownError);

                }
            });
        });
        //Edit user use ajax
        $('body').on("click", '.edit', function() {

            var eThis = $(this);
            var par = eThis.parents('tbody tr');
            indd = par.index();
            var id = par.find('td:eq(0)').text();
            $('#exampleModal').modal('show');


            $.ajax({
                url: 'showdatauser/edit/' + id,
                // type:'POST',

                //contentType:false,
                cache: false,
                //processData:false,
                dataType: "json",
                beforeSend: function() {
                    //work before success    
                },
                success: function(data) {

                    $('#email').val(data.showedit.email);
                    $('#no').val(data.showedit.id);
                    $('#salse').val(data.showedit.salesperson_code);
                    $('#name').val(data.showedit.name);
                    $('#gender').val(data.showedit.gender);
                    $('#dob').val(data.showedit.date_of_birth);
                    $('#idcard').val(data.showedit.id_card_no);
                    $('#phone').val(data.showedit.phone_no);
                    $('#userrole').val(data.showedit.user_role_code);
                    $('#address').val(data.showedit.address);
                    $('#address2').val(data.showedit.address_2);
                    $('#status').val(data.showedit.status);
                    $('#contry').val(data.showedit.country_code);
                    $('#permission').val(data.showedit.permission_code);
                    $('#active').val(data.showedit.inactived);
                    $('#city').val(data.showedit.city);

                },
                error: function(xml, error, thrownError) {
                    alert(thrownError);

                }

            });

            $('.adduser').css({
                'display': 'none'
            });
            $('.editebu').css({
                'display': 'block'
            });

        })



        $('body').on('click', '.add', function() {

            $('.adduser').css({
                'display': 'block'
            });
            $('.editebu').css({
                'display': 'none'
            });
        })


        $('body').on('click', '.editebu', function() {
            var email = $('#email').val();
            var password = $('#password').val()
            var id = $('#no').val();
            var salesperson_code = $('#salse').val();
            var name = $('#name').val();
            var gender = $('#gender').val();
            var date = $('#dob').val();
            var idcard = $('#idcard').val();
            var phone = $('#phone').val();
            var userrole = $('#userrole option:selected').text();
            var address = $('#address').val();
            var address2 = $('#address2').val();
            var status = $('#status').val();
            var contry = $('#contry').val();
            var permission = $('#permission').val();
            var active = $('#active').val();
            var city = $('#city').val();
            var table = $('.table')
            var data = {
                'email': email,
                'salesperson_code': salesperson_code,
                'name': name,
                'gender': gender,
                'date': date,
                'idcare': idcard,
                'phone': phone,
                'userrole': userrole,
                'address': address,
                'address2': address2,
                'status': status,
                'contry': contry,
                'permission': permission,
                'active': active,
                'city': city,
                'password': password,
            }
            $.ajax({
                url: 'edit/' + id,
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
                    $('#exampleModal').modal('hide');
                    $('#exampleModal').find('form').trigger('reset')
                    datatable.ajax.reload(null, false)
                    $('.alert').text('User has been Edit')
                    $('.alert').css({
                        'display': 'block'
                    });
                    setInterval(function() {
                        $('.alert').css({
                            'display': 'none'
                        });
                    }, 2000);



                },
                error: function(xml, error, thrownError) {
                    alert(thrownError);

                }
            });

        })



        var delectID = ""
        $('body').on("click", '.delete', function() {
            var eThis = $(this);
            var par = eThis.parents('tbody tr');
            indd = par.index();
            delectID = par.find('td:eq(0)').text();
            $('#deleteuser').modal('show')
        })


        $('body').on('click', '.yes-delete', function() {
            $.ajax({
                url: 'deleteuser/' + delectID,
                type: 'GET',
                // data:data,
                //contentType:false,
                cache: false,
                //processData:false,
                // dataType:"json",
                beforeSend: function() {
                    //work before success    
                },
                success: function(data) {


                    datatable.ajax.reload(null, false)
                    $('.alert').text('User has been delete')
                    $('.alert').css({
                        'display': 'block'
                    });
                    setInterval(function() {
                        $('.alert').css({
                            'display': 'none'
                        });
                    }, 2000);
                    $('#deleteuser').modal('hide')




                },
                error: function(xml, error, thrownError) {
                    alert(thrownError);

                }
            });
        })
    });
 