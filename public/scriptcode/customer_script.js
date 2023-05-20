$(document).ready(function() {

    let perdelete = '{{ $getpermissioncode[0]->delete }}'
    let perupdate = '{{ $getpermissioncode[0]->update }}'
    let peradd = '{{ $getpermissioncode[0]->add }}'
    Delete_Perview()
    Click_Delete()
    Edit();
    Edit_Preview()
    Add()

    if (perdelete == 0) {
        $('body').find('.edit').addClass('black');
    }



    $('.add').on('click', function() {
        $('#add_customer').trigger('reset');
    })

    // $('body').find('.edit').addClass('black');
    //   $(this).addClass('black')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function Add() {
        $('.adduser').on("click", function(e) {
            if (peradd == 1) {
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
            } else {
                Swal.fire({
                    template: '#my-template'
                })
                $('#exampleModal').modal('hide')
            }




            var indd
        });
    }

    function Edit_Preview() {
        $('body').on("click", ".edit", function() {
            if (perupdate == 1) {
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

            } else {
                Swal.fire({
                    template: '#my-template'
                })
            }


        });
    }

    // Click Edit Button
    function Edit() {
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

    function Delete_Perview() {
        $('body').on("click", ".delete", function() {
            if (perdelete == 1) {
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
            } else {
                Swal.fire({
                    template: '#my-template'
                })
            }
        });
    }
    // delete Button 

    function Click_Delete() {
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