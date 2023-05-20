 
    $(document).ready(function() {

        let discountcheck = '{{ $getpermissioncode[0]->discount }}'
        console.log(discountcheck)



        setInterval(() => {
            var checktable = $('.table').find('tr').length
            if (checktable >= 2) {
                $('.contain').css({
                    'background-image': 'none'
                })
                $('.contain h2').css({
                    'display': 'none'
                })
            } else {
                $('.contain').css({
                    'background-image': 'url("/tos/cart.png")'
                })
                $('.contain h2').css({
                    'display': 'block'
                })
            }
        }, 100);


        // SET LIMIT FOR BUTTON LIMIT
        var frmopt = 10;
        $('.gro').on('click', 'ul.dataopt li', function() {
            var ethis = $(this)
            // console.log(data('opt'));
            frmopt = ethis.data("opt");
            console.log(frmopt)
        })


        // GLOBAL VARIABAL
        let list = ['1'];
        var descount = 0
        let pricecode = [];
        var price;
        var code
        let getcode = "";
        let gettable
        var vb = 0;
        var toprice = []
        var pricedescount = 0;

        // --------------------------------------------------------------
        //Special Charactor in Javascript
        //var format = /^[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/;
        //--------------------------------------------------------------

        // AJAX SET UP
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //SET DESCOUNT (num% or num)
        $('#descount').on('keyup', function() {
            descount = $(this).val()
            //if descount includes %
            if (descount == null || descount == "") {
                var tola = $('.totalprice').find('p').text();
                $('.totalprice').find('span').text(tola)
                $('.totalprice').find('h6').text(0)

            } else {
                if (descount.includes("%")) {
                    descount = descount.substring(Number(descount.length) - 1, -1)

                }
                var totalwithdescount = $('.totalprice').find('p').text();
                $('.totalprice').find('span').text(Number((totalwithdescount) - Number(
                    totalwithdescount) * Number(descount) / 100).toFixed(4))
                $('.totalprice').find('h6').text((Number(totalwithdescount) * Number(descount) / 100)
                    .toFixed(4))
            }



        })

        // SEARCH ITEM BY  ITEM_NO
        let fade = ""
        $('#searchitem').on('keyup', function() {
            console.log($(this).val());
            var search = $('#searchitem').val();
            var data = {
                'search': search,
            }
            $.ajax({
                url: 'search',
                type: 'GET',
                datatype: 'json',

                data: data,
                beforeSend: function() {
                    $('body').find('.spinners').css('display', 'block');
                },
                success: function(data) {
                    $('.item').html(data);
                    $('body').find('.spinners').css('display', 'none');
                    var record = $('.card1').length;
                    $('.readmore span').text(record);


                }
            })
        })






        // READMORE BUTTON
        var dd = 60;
        $('.getmore').on("click", function() {
            // document.body.scrollTop = -900;
            var category = $('#category').val()
            var record = $('.card1').length;
            var limit = frmopt;
            var ofs = record
            //   console.log(frmopt);
            //    dd=dd+30;
            var data = {
                'limit': frmopt,
                'ofs': ofs,
                'category': category,
            }
            $.ajax({
                url: 'setlimit',
                type: 'GET',
                datatype: 'json',
                data: data,
                success: function(data) {
                    $('.item').append(data).fadeIn();
                    var record = $('.card1').length;
                    $('.readmore span').text(record);
                }
            })
        })

        window.onscroll = function(ev) {

            if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {

                setTimeout(function() {
                    ShowmoreRecord()
                }, 1);

                function ShowmoreRecord() {
                    var category = $('#category').val()
                    var record = $('.card1').length;
                    var limit = frmopt;
                    //   console.log(frmopt);
                    //    dd=dd+30;
                    var data = {
                        'limit': 50,
                        'ofs': record,
                        'category': category
                    }
                    $.ajax({
                        url: 'setlimit',
                        type: 'GET',
                        datatype: 'json',
                        data: data,
                        beforeSend: function() {
                            $('body').find('.spinners').css('display', 'block');
                        },

                        success: function(data) {
                            $('.spinners').css({
                                'display': 'block'
                            })
                            $('.item').append(data);
                            $('body').find('.spinners').css('display', 'none');
                            var record = $('.card1').length;
                            $('.readmore span').text(record);

                        }
                    })
                }

            }

        }
        // CLICK TO ADD ITEM

        function Add_Item_to_Preview_Table() {
            $('.item').on("click", '.list', function() {
                var table = $('.table');
                var eThis = $(this);
                var par = eThis.parent();
                var part = $(this);
                var body = eThis.parents('body');
                var indd = par.index();
                price = par.find('.list h6.price').text();
                code = par.find('.list h6.code').text();
                var id = par.find('.list h6.id').text();
                var des = par.find('.list h6.des').text();
                var des1 = par.find('.list h6.des1').text();
                var uom = par.find('.list h6.uom').text();
                var qtyuom = par.find('.list h6.qtyuom').text();
                var itemgcode = par.find('.list h6.itemgcode').text();
                var itemccode = par.find('.list h6.itemccode').text();
                getcode = code;
                var getlet = 0;
                for (var i = 0; i < list.length; i++) {
                    if (list[i] == id) {
                        getlet = 1;
                        break;
                    }

                }
                var dd
                var pp
                var desprice
                var item_desprice
                if (getlet == 1) {
                    dd = $('body').find(`#${id}`).val()
                    item_desprice = $('body').find(`#${id}p`).val()
                    pp = $('body').find("." + id + "d").text()

                    var sho = parseInt(dd) + 1
                    $('body').find(`#${id}`).val(sho);
                    $('body').find("." + id + "s").text((parseFloat(pp) * parseInt(sho) -
                        parseFloat(pp) * parseInt(sho) * Number(item_desprice) / 100).toFixed(
                        4));

                    var tola = $('.totalprice').find('span').text();
                    var tolawithp = $('.totalprice').find('p').text();
                    var totalthisprice = Number(tolawithp) + (Number(pp) * ((Number(sho)) - Number(dd)))
                    var pt = Number(tolawithp) + (Number(pp) * ((Number(sho)) - Number(dd)));
                    var getertotal = $('.table').find('tr').length
                    var td = 0;
                    var testprice = 0
                    for (var i = 1; i < getertotal; i++) {
                        testprice = $('.table').find(`tr:eq(${Number(i)}) td:eq(3)`).text();
                        td += Number(testprice)

                        $('body').find('.totalprice span').text((Number(td)).toFixed(4));
                        // $('body').find('.totalprice p').text();

                    }
                    $('body').find('.totalprice p').text((totalthisprice).toFixed(4));
                    $('body').find('.totalprice h6').text((Number($('body').find('.totalprice p')
                        .text()) - Number(td)).toFixed(4));
                } else {

                    list.push(id);
                    var tr = `
                         <tr >
                       <td>${code.substring(0)}</td>
                       <td>${price.substring(6,0)}</td>
                       <td><input type="number" name="${id}" id="${id}" value="1" class="hello" ></td>
                       <th><input type="number" id="${id}p" value="0" class="thdiscount" ></th>
                       <th><span class="click">${uom}</span></th>
                       <td class="${id}s"> ${price.substring(6,0)}</td>
                       <td class="${id}d" id="none" class="none">${price.substring(6,0)}</td>
                       <td><i class="fa-solid fa-xmark"></i></td>
                       <td class="none">${des}</td> 
                       <td class="none">${des1}</td>
                       <td class="none">${uom}</td>
                       <td class="none">${qtyuom}</td>
                       <td class="none">${itemgcode}</td>
                       <td class="none">${itemccode}</td>
                       <th class="none">${id}</th>
                   </tr> `

                    table.find('tr:eq(0)').after(tr);
                    if (discountcheck == 0) {

                        $('body').find("input.thdiscount").prop('disabled', true);
                        $('body').find("input.thdiscount").css({
                            'border': '1px solid black'
                        });
                    }
                    var td = $('.table').find(`tr:eq(1) td:eq(3)`).text()
                    gettable = $('.table').find('tr').length
                    var tola = $('.totalprice').find('span').text();

                    var maintotal = $('.totalprice').find('p').text();

                    var pt = Number(maintotal) + Number(td)

                    // $('body').find('.totalprice span').text((Number(pt) - Number(pt) * Number(descount) / 100).toFixed(4));
                    // $('body').find('.totalprice p').text((Number(pt)).toFixed(4));
                    $('body').find('.total span').text(gettable - 1);

                    var getertotal = $('.table').find('tr').length
                    var td = 0;
                    var testprice = 0
                    for (var i = 1; i < getertotal; i++) {
                        testprice = $('.table').find(`tr:eq(${Number(i)}) td:eq(3)`).text();
                        td += Number(testprice)
                        $('body').find('.totalprice span').text((Number(td)).toFixed(4));


                    }
                    $('body').find('.totalprice p').text((pt).toFixed(4));
                    $('body').find('.totalprice h6').text((Number($('body').find('.totalprice p')
                        .text()) - Number(td)).toFixed(4));


                }




            })
        }


        let indexforuom = 0;
        let item_code = 0;

        function Change_Uom() {
            $('body').on('click', '.click', function() {
                $('#change_uom').modal('show')
                let ethis = $(this);
                var par = ethis.parents('tr');
                item_code = par.find('td:eq(0)').text();
                indexforuom = par.index();
                $('#stockuom').val('');
                $.ajax({
                    url: 'ShowUomByitemNo',
                    dataType: 'json',
                    data: {
                        'itemcode': item_code,
                    },
                    beforeSend: function() {

                    },
                    success: function(data) {
                        var option = ''
                        data.status.forEach(element => {
                            option +=
                                `<option value="${element.unit_of_measure_code}">${element.unit_of_measure_code}</option>`
                        });
                        $('#stockuom')
                            .find('option')
                            .remove()
                            .end()
                            .append(option)

                    }

                })

            });

        }

        function Set_Uom() {
            $('.setuom').on('click', function() {
                var stockuom = $('#stockuom').val()

                $('#change_uom').modal('hide');
                var qty = $('body').find(`tr:eq(${indexforuom}) td:eq(2) input`).val();
                var id = $('body').find(`tr:eq(${indexforuom}) th:eq(2)`).text();
                var discount = $('body').find(`tr:eq(${indexforuom}) th:eq(0) input`).val();
                $('body').find(`tr:eq(${indexforuom}) th:eq(1) span`).text(stockuom);
                var data = {
                    'itemcode': item_code,
                    'index': stockuom,
                }
                $.ajax({
                    url: 'changeuom',
                    dataType: 'json',
                    data: data,
                    beforeSend: function() {

                    },
                    success: function(data) {
                        console.log(qty)
                        var price = data.status[0].price;

                        const index = list.indexOf(id);
                        const x = list.splice(index, 1);



                        $('body').find(`td`).removeClass(`${id}s`);
                        $('body').find(`td:eq(3)`).addClass(`${data.status[0].id}s`);
                        $('body').find(`td`).removeClass(`${id}d`);
                        $('body').find(`td:eq(4)`).addClass(`${data.status[0].id}d`);
                        $('body').find(`tr:eq(${indexforuom}) td:eq(1) `).text(Number(price)
                            .toFixed(4));
                        $('body').find(`tr:eq(${indexforuom}) td:eq(3) `).text(Number(((
                            price) * qty) - (price) * qty * discount / 100).toFixed(
                            4));
                        $('body').find(`${data.status[0].id}d`).text(Number((price)))
                        $('body').find(`tr:eq(${indexforuom}) td:eq(6) `).text(data.status[
                            0].description);
                        $('body').find(`tr:eq(${indexforuom}) td:eq(7) `).text(data.status[
                            0].description_2);
                        $('body').find(`tr:eq(${indexforuom}) td:eq(8) `).text(data.status[
                            0].unit_of_measure_code);
                        $('body').find(`tr:eq(${indexforuom}) td:eq(9) `).text(data.status[
                            0].qty_per_unit);
                        list.push(data.status[0].id);
                        var getertotal = $('.table').find('tr').length
                        var td = 0;
                        var tp = 0 //tp=total Price
                        var tpdes = 0; //tpdes= total discount Price
                        var testprice = 0
                        var total_Pice;
                        var total_desPrice;
                        var sum_des;


                        for (var i = 1; i < getertotal; i++) {
                            sum_des = Number($('.table').find(
                                `tr:eq(${Number(i)}) td:eq(1)`).text()) * Number(
                                $('.table').find(`tr:eq(${Number(i)}) td:eq(2) input`)
                                .val())
                            testprice = $('.table').find(`tr:eq(${Number(i)}) td:eq(3)`)
                                .text();
                            total_Pice = sum_des
                            total_desPrice = (sum_des * Number($('.table').find(
                                `tr:eq(${Number(i)}) th:eq(0) input`).val())) / 100
                            td += Number(testprice)
                            tp += Number(total_Pice);
                            tpdes += Number(total_desPrice)

                            $('body').find('.totalprice span').text((Number(td)).toFixed(
                                4));
                            $('body').find('.totalprice p').text((tp).toFixed(4));
                            $('body').find('.totalprice h6').text((Number(tpdes)).toFixed(
                                4));
                        }

                    }

                })

            })
        }

        // REMOVE ITEM FROM TABLE
        function Remove_Item() {
            $('body').on('click', '.fa-xmark', function() {

                var eThis = $(this);

                var parent = eThis.parents('tr');
                var element = parent.find('th:eq(2)').text();

                var price = parent.find('td:eq(3)').text();
                var tola = $('.totalprice').find('p').text();
                $(this).closest("tr").remove();

                console.log('------------------------------')

                var total_item = $('body').find('.total span').text();
                $('body').find('.total span').text(total_item - 1)
                var getertotal = $('.table').find('tr').length
                var td = 0;
                var tp = 0 //tp=total Price
                var tpdes = 0; //tpdes= total discount Price
                var testprice = 0
                var total_Pice;
                var total_desPrice;
                var sum_des;


                for (var i = 1; i < getertotal; i++) {

                    sum_des = Number($('.table').find(`tr:eq(${Number(i)}) td:eq(1)`).text()) * Number(
                        $('.table').find(`tr:eq(${Number(i)}) td:eq(2) input`).val())
                    testprice = $('.table').find(`tr:eq(${Number(i)}) td:eq(3)`).text();
                    total_Pice = sum_des
                    total_desPrice = (sum_des * Number($('.table').find(
                        `tr:eq(${Number(i)}) th:eq(0) input`).val())) / 100
                    td += Number(testprice)
                    tp += Number(total_Pice);
                    tpdes += Number(total_desPrice)

                    $('body').find('.totalprice span').text((Number(td)).toFixed(4));
                    $('body').find('.totalprice p').text((tp).toFixed(4));
                    $('body').find('.totalprice h6').text((Number(tpdes)).toFixed(4));
                }
                if (getertotal <= 1) {
                    $('body').find('.totalprice span').text(000);
                    $('body').find('.totalprice p').text(000);
                    $('body').find('.totalprice h6').text(000);
                }




                const index = list.indexOf(element);
                const x = list.splice(index, 1);
                list.forEach(elemd => {
                    console.log(elemd)
                });



            })
        }




        function Discount_ItemPrice() {
            $('body').on('change', '.thdiscount', function() {
                var eThis = $(this);

                var parent = eThis.parents('tr');
                var discout_value = parent.find('th:eq(0) input').val()
                var qty = parent.find('td:eq(2) input').val();
                var price = parent.find('td:eq(1)').text();
                var newprice = parent.find('td:eq(3)').text();
                var total = Number(qty) * Number(price) - (Number(qty) * Number(price)) *
                    discout_value / 100;
                parent.find('td:eq(3)').text(total.toFixed(2));
                var getto = []
                var ghe
                var getertotal = $('.table').find('tr').length
                var td = 0;
                var testprice = 0
                for (var i = 1; i < getertotal; i++) {
                    testprice = $('.table').find(`tr:eq(${Number(i)}) td:eq(3)`).text();
                    td += Number(testprice)
                    $('body').find('.totalprice span').text((Number(td)).toFixed(4));
                    $('body').find('.totalprice p').text();

                }
                $('body').find('.totalprice h6').text((Number($('body').find('.totalprice p').text()) -
                    Number(td)).toFixed(4));
            })
        }


        function Update_Quantity() {
            $('body').on('change', `.hello`, function() {
                var eThis = $(this);
                var parent = eThis.parents('tr');
                var qty = parent.find('td:eq(2) input').val();
                var price = parent.find('td:eq(1)').text();
                var newprice = parent.find('td:eq(3)').text();
                var total = Number(qty) * Number(price);
                var discout_value = parent.find('th:eq(0) input').val()
                parent.find('td:eq(3)').text(total.toFixed(2));

                var getertotal = $('.table').find('tr').length

                // if (getertotal <= 2) {

                //     $('body').find('.totalprice span').text((Number(total) - Number(total) * Number(
                //         descoundiscout_valuet) / 100).toFixed(4));
                //     $('body').find('.totalprice p').text(total.toFixed(4));
                // }
                var testprice = 0
                var td = 0;
                for (var i = 1; i < getertotal; i++) {


                    testprice = $('.table').find(`tr:eq(${Number(i)}) td:eq(3)`).text();
                    td += Number(testprice)
                    $('body').find('.totalprice span').text((Number(td) - Number(td) * Number(
                            discout_value) /
                        100).toFixed(4));
                    $('body').find('.totalprice p').text(td.toFixed(4));
                    $('body').find('.totalprice h6').text((Number(td) * Number(discout_value) / 100)
                        .toFixed(
                            4));
                }


            });
        }
        /// UPDATE QTY PRODUCT 



        // PRINT PAYMENT
        function PrintPayment() {
            var customername = $('#customer').find('option:selected').text()
            var printtable = $('.table').find('tr').length
            var id = $('.table').find(`tr:eq(${Number(i)}) td:eq(3)`).text();
            var thead = `
                                <table class="tablee">
                                <thead  class="thead-dark">
                                <tr class="color">
                                <th>Item_no</th>
                                <th>Price</th>
                                 <th>Qty</th>
                                 <th>Discount</th>
                                 <th>Uom</th>
                                 <th>Subtotal</th>
                                 <th>Clear</th>
                            </tr>
                         </thead>
                          </table>
     `
            var tgb = $('.tablee');
            var gb = "";
            for (var i = 1; i < printtable; i++) {

                gb += `
         <tr >
                       
                       <td>${$('.table').find(`tr:eq(${Number(i)}) td:eq(0)`).text()}</td>
                       <td>${$('.table').find(`tr:eq(${Number(i)}) td:eq(1)`).text()}</td>
                       <td> ${$('.table').find(`tr:eq(${Number(i)}) td:eq(2) input`).val()}</td>
                       <td> ${$('.table').find(`tr:eq(${Number(i)}) th:eq(0) input`).val()}</td>
                       <td> ${$('.table').find(`tr:eq(${Number(i)}) th:eq(1) span`).text()}</td>
                       <td>${$('.table').find(`tr:eq(${Number(i)}) td:eq(3)`).text()}</td>
                        
        </tr> 
        `

            }
            var totalitem = $('.total').find('span').text();
            var totalprice = $('.totalprice').find('span').text();
            var newWin = window.frames["printf"];
                                newWin.document.write(`
                        <link rel="stylesheet" href="{{ asset('css/bootstrap-5.2.3/dist/css/bootstrap.min.css') }}">
                        <link href="{{ asset('css/stytle.css') }}" rel="stylesheet">
                        <div class="printimg"><img src="{{ asset('img/blue1.webp') }}" alt=""></div>
                        
                        <div class='print-title'> <h1>Invoice</h1></div>
                        <hr>
                        <div class='print-info'>
                            No. 73BG, Street 360, Sangkat Boeung Keng Kang III
                    Phnom Penh, Cambodia 12304. 
                    Google Map
                    info@blue.com.kh
                    Tel: +855 23 215 889
                    Fax: +855 23 222 942
                            </div>
                        <body onload="window.print()">
                            <table class="table" >
                                            <thead class="thead-dark">
                             <tr>
                               
                                <th>Item_no </th>
                                 <th>Price </th>
                                 <th>Qty</th>
                                 <th>Discount</th>
                                 <th>Uom</th>
                                 <th>Subtotal</th>
                                  
                            </tr>
                         </thead> 
                         <tbody>
                    ${gb}
                    </tbody>
                         </table>
                <h5>------------------------------------------------------------------------ </h5>
                <h5>Customer Name :${customername}<h5>
                <p>------------------------------------------------------------------------ </p> 
                <h5>Total Price:${totalprice}  <b>$</b></h5>
                <h5>Total Items:${totalitem}  </h5>  

                    
        </body>
 
    `)
            newWin.document.close();


        }


        // ADD NEW CUSTOMER 

        function Add_new_Customer() {
            $('.adminaduder').on('click', function() {
                $('#adminaddcustomer').modal("show")
                var foralert = $('#customer').find(':selected p .id').text()

            })
            $('.addnewuser').on('click', function() {

                event.preventDefault()

                var id = $('#no').val();
                var name = $('#name').val();
                var name2 = $('#name2').val();
                var address = $('#address').val();
                var address2 = $('#address2').val();
                var phone = $('#phone').val();
                var phone2 = $('#phone2').val();
                var sales = $('#sales').val();
                var active = $('#active').val();
                var data = {
                    'id': id,
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
                    url: 'adminaddcustomer',
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



                        if (data.status.id) {
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
                        } else {
                            $('#adminaddcustomer').modal('hide')
                            var op = `
                         <option value="${id}">${name}</option>
                       `
                            $('#customer').find('option:eq(0)').before(op)
                            $('#customer').val(id)
                            $('#formcustomer').trigger("reset");
                        }

                    },
                    error: function(xml, error, thrownError) {
                        console.log(thrownError);

                    }
                });

            })
        }
        // Button Paymen

        var today
        var cure
        var invoc
        setInterval(() => {
            today = new Date();
            h = today.getHours(),
                m = today.getMinutes(),
                s = today.getSeconds();

            cure = new Date().toJSON().slice(0, 10).replace('/', '');

            invoc = `${s}${m}${h}${cure}`

        }, 1000);

        function Buttom_Payment() {

            $('.payment').on("click", function() {



                $('#form_payment')[0].reset();
                $('body').find('span.payprice').text('')
                $('body').find('span.dollar').text('')
                $('body').find('span.paydes').text('')
                $('body').find('span.payitem').text('')
                $('body').find('span.descount').text('')
                $('body').find('span.desprice').text('')
                $('#invoice').val('')
                $('#payment').modal('show');
                var price = $('.totalprice').find('p').text();
                var priceafterdes = $('.totalprice').find('span').text();
                var desprice = $('.totalprice').find('h6').text();
                var item = $('.total').find('span').text();
                var descount = $('#descount').val();
                var amount
                var balance
                $('body').find('span.payprice').text(Number(price).toFixed(2) + "$")
                $('body').find('span.dollar').text(Number(price).toFixed(2) + "$")
                $('body').find('span.paydes').text(Number(priceafterdes).toFixed(2) + "$")
                $('body').find('span.payitem').text(item)
                $('body').find('span.descount').text(descount + '%')
                $('body').find('span.desprice').text(Number(desprice).toFixed(2) + "$")

                $('#invoice').val(invoc.replace('-', ''))
                $('body').find('.balance').text(0 + "$")
                $('body').find('.paying').text('')

                var letable = $('.table').find('tr').length


            })
        }

        // Create Shortcut Key 
        $(document).on('keydown', function(e) {

            if (e.key == 'm' && e.altKey) {
                PaymentButton()
            } else if (e.key === 'f' && e.altKey) {
                openFullscreen()
                // $('.contain').css({'height':'850px'})
            } else if (e.key === 'p' && e.altKey) {
                var letable = $('.table').find('tr').length
                if (letable >= 2) {
                    PrintPayment()
                } else {
                    alert("Order First")
                }

            } else if (e.key === 'c' && e.altKey) {
                $('#adminaddcustomer').modal("show")
            } else if (e.key === 'h' && e.altKey) {
                $('body').find('#hold').modal('show');
            }

        })

        function PaymentButton() {

            $('#form_payment')[0].reset();
            $('body').find('span.payprice').text('')
            $('body').find('span.dollar').text('')
            $('body').find('span.paydes').text('')
            $('body').find('span.payitem').text('')
            $('body').find('span.descount').text('')
            $('body').find('span.desprice').text('')
            $('#payment').modal('show');
            var price = $('.totalprice').find('p').text();
            var priceafterdes = $('.totalprice').find('span').text();
            var desprice = $('.totalprice').find('h6').text();
            var item = $('.total').find('span').text();
            var descount = $('#descount').val();
            var amount
            var balance
            $('body').find('span.payprice').text(Number(price).toFixed(2) + "$")
            $('body').find('span.dollar').text(Number(price).toFixed(2) + "$")
            $('body').find('span.paydes').text(Number(priceafterdes).toFixed(2) + "$")
            $('body').find('span.payitem').text(item)
            $('body').find('span.descount').text(descount + '%')
            $('body').find('span.desprice').text(Number(desprice).toFixed(2) + "$")

            $('body').find('.balance').text(0 + "$")
            $('body').find('.paying').text('')

            var letable = $('.table').find('tr').length
        }

        // Change info on Payment modal

        function Change_Info_Payment_Modal() {
            $('body').on('keyup', '#amount', function() {
                var price = $('.totalprice').find('p').text();
                var amount = $(this).val()
                price = Number(price).toFixed(4)

                let paydisc = $('.totalprice').find('span').text()
                paydisc = paydisc.substring(paydisc.length, -1)

                let currency = $('#currency-code').val()
                let exchanges = $('#exchanges').val()
                let findBalacen = Number(amount) - Number(paydisc)
                if (currency == 'dollar') {
                    amount = Number(amount).toFixed(4)
                    if (Number(findBalacen) >= 0) {
                        $('body').find('.balance').css({
                            'color': 'black'
                        })
                        $('body').find('.paying').css({
                            'color': 'black'
                        })
                        $('body').find('.balance').text((amount - paydisc).toFixed(4) + "$")
                        $('body').find('.paying').text((amount))
                    } else {
                        $('body').find('.balance').css({
                            'color': 'red'
                        })
                        $('body').find('.paying').css({
                            'color': 'red'
                        })
                        $('body').find('.balance').text('Invaliad Input')
                        $('body').find('.paying').text('Invaliad Input')

                    }
                } else {
                    amount = Number(amount).toFixed(4)
                    if (Number(amount) >= paydisc * exchanges) {
                        console.log(paydisc * exchanges)
                        console.log(amount * exchanges)
                        $('body').find('.balance').css({
                            'color': 'black'
                        })
                        $('body').find('.paying').css({
                            'color': 'black'
                        })
                        $('body').find('.balance').text(((amount - (paydisc * exchanges))).toFixed(4))
                        $('body').find('.paying').text((amount))
                    } else {
                        $('body').find('.balance').css({
                            'color': 'red'
                        })
                        $('body').find('.paying').css({
                            'color': 'red'
                        })
                        $('body').find('.balance').text('Invaliad Input')
                        $('body').find('.paying').text('Invaliad Input')

                    }
                }





            })
        }

        function Change_Currency_Code() {
            $('body').on('change', '#currency-code', function() {


                let exchanges = $('#exchanges').val()

                let amount = $('#amount').val()

                let priceafter = $('#paydes').text()
                let payprice = $('#payprice').text()
                let price_input = $('.paying').text()
                let balance = $('.balance').text()
                if (amount == null || amount == 0) {

                    if (payprice.includes("$")) {

                        priceafter = priceafter.replace(/.$/, '')
                        payprice = payprice.replace(/.$/, '')
                        price_input = price_input.replace(/.$/, '')
                        balance = balance.replace(/.$/, '')

                    } else if (payprice.includes("រៀល")) {

                        priceafter = priceafter.replace('រៀល', '')
                        payprice = payprice.replace('រៀល', '')
                        price_input = price_input.replace('រៀល', '')
                        balance = balance.replace('រៀល', '')

                    } else {
                        amount = amount
                        priceafter = priceafter
                        payprice = payprice
                        price_input = price_input
                        balance = balance


                    }
                    var exchangesamount = 0;

                    if ($(this).val() == 'dollar') {
                        exchangesamount = (Number(amount) / exchanges)
                        $('#amount').val(exchangesamount)
                        $('.payprice').text((payprice / exchanges) + '$')
                        $('.paydes').text((priceafter / exchanges) + '$')

                    } else {
                        exchangesamount = (Number(amount) * exchanges)
                        $('#amount').val(exchangesamount)
                        $('.payprice').text((payprice * exchanges) + 'រៀល')
                        $('.paydes').text((priceafter * exchanges) + 'រៀល')



                    }
                } else {
                    if (payprice.includes("$")) {

                        priceafter = priceafter.replace(/.$/, '')
                        payprice = payprice.replace(/.$/, '')
                        price_input = price_input.replace(/.$/, '')
                        balance = balance.replace(/.$/, '')

                    } else if (payprice.includes("រៀល")) {

                        priceafter = priceafter.replace('រៀល', '')
                        payprice = payprice.replace('រៀល', '')
                        price_input = price_input.replace('រៀល', '')
                        balance = balance.replace('រៀល', '')

                    } else {
                        amount = amount
                        priceafter = priceafter
                        payprice = payprice
                        price_input = price_input
                        balance = balance


                    }
                    var exchangesamount = 0;

                    if ($(this).val() == 'dollar') {
                        exchangesamount = (Number(amount) / exchanges)
                        $('#amount').val(exchangesamount)
                        $('.payprice').text((payprice / exchanges) + '$')
                        $('.paydes').text((priceafter / exchanges) + '$')
                        $('.paying').text((price_input / 4000) + '$')
                        $('.balance').text((price_input - priceafter) / exchanges + '$')
                    } else {
                        exchangesamount = (Number(amount) * exchanges)
                        $('#amount').val(exchangesamount)
                        $('.payprice').text((payprice * exchanges) + 'រៀល')
                        $('.paydes').text((priceafter * exchanges) + 'រៀល')
                        $('.paying').text((price_input * exchanges) + 'រៀល')
                        $('.balance').text(((price_input - priceafter) * exchanges).toFixed(0) + 'រៀល')

                    }
                }



            })
        }
        // Change Payment Type

        $('#payby').on('change', function() {
            var pay_type = $(this).val();
            $('.paytype').text(pay_type)

        })

        $('body').on("click", '.print', function() {
            var letable = $('.table').find('tr').length
            if (letable >= 2) {
                PrintPayment()
            } else {
                Swal.fire({
                    template: '#my-template'
                })
            }

        })
        $('#amount').on('change', function() {
            var payprice = $('body').find('.paying').text();
            console.log(payprice)
            if (payprice === 'Invaliad Input') {

                $('.masteradd').css({
                    'pointer-events': 'none'
                })
                $('.masteradd').css({
                    'background-color': 'red'
                })
            } else {
                $('.masteradd').css({
                    'pointer-events': 'block'
                })
                $('.masteradd').css({
                    'background-color': 'blue'
                })
            }
        })

        function AddItem_To_Sale_Line_and_Sale_Header() {
            $('body').on("click", '.masteradd', function() {
                var price_register = $('.totalprice').find('p').text()
                var letable = $('.table').find('tr').length
                var id = $('#customer').val()
                var desamount = $('.totalprice').find('h6').text();
                var desper = $('#descount').val();
                var payment = $('body').find('#payby').val();
                var salepersion = $('body').find('#sale').val();
                var documentno = $('body').find('#doc').val();
                var invoiceno = $('#invoice').val()
                var payby = $('#amount').val()

                console.log(payby)
                if (letable >= 2) {
                    if (payby == "") {
                        alert("Pleas Enter Amount")
                        $('#amount').focus()
                    } else {



                        $.ajax({
                            url: 'update_register',
                            type: 'POST',
                            data: {
                                'totalprice': price_register,

                            },
                            dataType: 'json',
                            beforeSend: function() {

                            },
                            success: function(data) {
                                console.log("d")
                            }

                        })


                        var newdata = {
                            'desamount': desamount,
                            'desper': desper,
                            'payment': payment,
                            'salepersion': salepersion,
                            'docno': documentno
                        }
                        $.ajax({
                            url: 'addtosaleheader/' + id,
                            type: 'POST',
                            cache: false,
                            data: newdata,
                            dataType: "json",
                            beforeSend: function() {
                                //work before success    
                            },
                            success: function(data) {


                            },
                            error: function(xml, error, thrownError) {
                                console.log(thrownError);

                            }
                        });
                        //$('.masteradd span').css({'display':'block'})
                        var letable = $('.table').find('tr').length
                        var docno = $('body').find('#doc').val()
                        var desper = $('#descount').val();
                        var table = $('.table');
                        var exchange_rate = $('#exchanges').val()
                        for (var i = 1; i < letable; i++) {
                            var itemno = $('.table').find(`tr:eq(${i}) td:eq(0)`)
                                .text() // Select from table right side
                            var itemdes = $('.table').find(`tr:eq(${i}) td:eq(6)`).text()
                            var itemdes2 = $('.table').find(`tr:eq(${i}) td:eq(7)`).text()
                            var uom = $('.table').find(`tr:eq(${i}) td:eq(8)`).text()
                            var qtyuom = $('table').find(`tr:eq(${i}) td:eq(9)`).text()
                            var qty = $('.table').find(`tr:eq(${i}) td:eq(2) input`).val()
                            var unitprice = $('.table').find(`tr:eq(${i}) td:eq(1)`).text()
                            var amount = $('.table').find(`tr:eq(${i}) td:eq(3)`).text()
                            var desper = $('.table').find(`tr:eq(${i}) th:eq(0) input`).val()
                            var itemgcode = $('.table').find(`tr:eq(${i}) td:eq(10)`).text()
                            var itemccode = $('.table').find(`tr:eq(${i}) td:eq(11)`).text()
                            var pricelcy = Number(unitprice) * exchange_rate
                            var amountlcy = Number(amount) * exchange_rate
                            var desamount = Number(amount) * Number(desper) / 100
                            var data = {
                                'docno': invoiceno,
                                'itemno': itemno,
                                'itemdes': itemdes,
                                'itemdes2': itemdes2,
                                'uom': uom,
                                'qtyuom': qtyuom,
                                'qty': qty,
                                'unitprice': unitprice,
                                'pricelcy': pricelcy,
                                'desper': desper,
                                'desamount': desamount,
                                'amount': amount,
                                'amountlcy': amountlcy,
                                'itemgcode': itemgcode,
                                'itemccode': itemccode,
                                'created': salepersion,
                            }
                            $.ajax({
                                url: 'additemtosaleline',
                                type: 'POST',

                                //contentType:false,
                                cache: false,
                                data: data,
                                //processData:false,
                                dataType: "json",
                                beforeSend: function() {
                                    $('.masteradd span').css({
                                        'display': 'block'
                                    })

                                    PrintPayment()

                                },
                                success: function(data) {
                                    $('.payment-confirm').css({
                                        'display': 'block'
                                    })
                                    $('body').find('#payment').modal("hide");


                                },



                                error: function(xml, error, thrownError) {
                                    console.log(thrownError);

                                }
                            });
                        }
                    }
                } else {
                    Swal.fire({
                        template: '#my-template'
                    })
                }

            })
        }

        // SHOW HOLD MODAL
        $('.hold').on("click", function() {
            $('body').find('#hold').modal('show');
        })
        // ADD ITEM TO HOLD
        function HoldItem() {

            var letable = $('.table').find('tr').length
            var docno = $('body').find('#doc').val()
            var desper = $('#descount').val();
            var table = $('.table');
            var refer = $('#refer').val();
            var exchange_rate = $('#exchanges').val()
            if (refer == null || refer == 0) {
                alert("Pleas Enter Reference Code")
            } else {


                if (desper == null) {
                    desper = 0;
                }

                for (var i = 1; i < letable; i++) {


                    var itemno = $('.table').find(`tr:eq(${i}) td:eq(0)`)
                        .text() // Select from table right side
                    var itemdes = $('.table').find(`tr:eq(${i}) td:eq(6)`).text()
                    var itemdes2 = $('.table').find(`tr:eq(${i}) td:eq(7)`).text()
                    var uom = $('.table').find(`tr:eq(${i}) td:eq(8)`).text()
                    var qtyuom = $('.table').find(`tr:eq(${i}) td:eq(9)`).text()
                    var qty = $('.table').find(`tr:eq(${i}) td:eq(2) input`).val()
                    var unitprice = $('.table').find(`tr:eq(${i}) td:eq(1)`).text()
                    var amount = $('.table').find(`tr:eq(${i}) td:eq(3)`).text()
                    var itemgcode = $('.table').find(`tr:eq(${i}) td:eq(10)`).text()
                    var itemccode = $('.table').find(`tr:eq(${i}) td:eq(11)`).text()
                    var pricelcy = Number(unitprice) * exchange_rate
                    var amountlcy = Number(amount) * exchange_rate
                    var desamount = Number(amount) * Number(desper) / 100

                    var data = {
                        'docno': docno,
                        'itemno': itemno,
                        'itemdes': itemdes,
                        'itemdes2': itemdes2,
                        'uom': uom,
                        'qtyuom': qtyuom,
                        'qty': qty,
                        'unitprice': unitprice,
                        'pricelcy': pricelcy,
                        'desper': desper,
                        'desamount': desamount,
                        'amount': amount,
                        'amountlcy': amountlcy,
                        'itemgcode': itemgcode,
                        'itemccode': itemccode,
                        'refer': refer,
                    }
                    $.ajax({
                        url: 'additemtohold',
                        type: 'POST',

                        //contentType:false,
                        cache: false,
                        data: data,
                        //processData:false,
                        dataType: "json",
                        beforeSend: function() {
                            $('.masteradd span').css({
                                'display': 'block'
                            })
                            //work before success    
                        },
                        success: function(data) {


                            $('#hold').modal('hide');

                            const index = list.indexOf(itemno);
                            const x = list.splice(index, 1);
                            $('.totalprice').find('span').text(0)
                            $('.totalprice').find('p').text(0)
                            $('.totalprice').find('h6').text(0)
                            $('.total').find('span').text(0)
                            toprice
                            $('.masteradd span').css({
                                'display': 'none'
                            })
                            $('body').find('#payment').modal("hide");
                            table.html(`<thead>
                             <tr  >
                               
                                <th>Item_no </th>
                                 <th>Price </th>
                                 <th>Qty   </th>
                                 <th>Discount  </th>
                                 <th>Uom</th>
                                 <th>Subtotal  </th>
                                 <th>Clear</th>
                                  
                            </tr>
                         </thead>
                         <tbody></tbody>
                         `)

                            // $("tbody").children().remove();
                            // $('table > tr > td').remove();
                        },
                        error: function(xml, error, thrownError) {
                            console.log(thrownError);

                        }
                    });
                }
            }
        }
        $('body').on('click', '.addhold', function() {
            HoldItem();
        })

        function ScanItemBarcode() {
            $('#scan').on('keydown', function(e) {
                if (e.code == 'Enter') {

                    var scan = $('#scan').val();
                    var data = {
                        'scan': scan,
                    }
                    $.ajax({
                        url: 'scanbarcode',
                        // type: 'GET',
                        datatype: 'json',
                        data: data,
                        success: function(data) {

                            var table = $('.table');



                            price = data.pos[0].price;
                            code = data.pos[0].item_no;
                            id = data.pos[0].id;
                            var des = data.pos[0].description;
                            var des1 = data.pos[0].description_2;
                            var uom = data.pos[0].unit_of_measure_code;
                            var qtyuom = data.pos[0].qty_per_unit;
                            var itemgcode = data.pos[0].item_group_code;
                            var itemccode = data.pos[0].item_category_code;
                            getcode = id;
                            var getlet = 0;
                            for (var i = 0; i < list.length; i++) {
                                if (list[i] == id) {
                                    getlet = 1;
                                    break;
                                }

                            }
                            var dd
                            var pp
                            var desprice
                            var item_desprice
                            if (getlet == 1) {
                                dd = $('body').find(`#${id}`).val()
                                item_desprice = $('body').find(`#${id}p`).val()
                                pp = $('body').find("." + id + "d").text()

                                var sho = parseInt(dd) + 1
                                $('body').find(`#${id}`).val(sho);
                                $('body').find("." + id + "s").text((parseFloat(pp) *
                                    parseInt(sho) - parseFloat(pp) * parseInt(sho) *
                                    Number(item_desprice) / 100).toFixed(4));
                                var tola = $('.totalprice').find('span').text();
                                var tolawithp = $('.totalprice').find('p').text();
                                var totalthisprice = Number(tolawithp) + (Number(pp) * ((
                                    Number(sho)) - Number(dd)))
                                var pt = Number(tolawithp) + (Number(pp) * ((Number(sho)) -
                                    Number(dd)));
                                var getertotal = $('.table').find('tr').length
                                var td = 0;
                                var testprice = 0
                                for (var i = 1; i < getertotal; i++) {
                                    testprice = $('.table').find(
                                        `tr:eq(${Number(i)}) td:eq(3)`).text();
                                    td += Number(testprice)
                                    $('body').find('.totalprice span').text((Number(td))
                                        .toFixed(4));
                                }
                                $('body').find('.totalprice p').text((totalthisprice)
                                    .toFixed(4));
                                $('body').find('.totalprice h6').text((Number($('body')
                                        .find('.totalprice p').text()) - Number(td))
                                    .toFixed(4));





                            } else {
                                list.push(id);
                                var tr = `
                         <tr >
                       <td>${code.substring(0)}</td>
                       <td>${price.substring(6,0)}</td>
                       <td><input type="number" name="${id}" id="${id}" value="1" class="hello" ></td>
                       <th><input type="number" id="${id}p" value="0" class="thdiscount" ></th>
                       <th><span class="click">${uom}</span></th>
                        <td class="${id}s"> ${price.substring(6,0)}</td>
                        <td class="${id}d" id="none" class="none">${price.substring(6,0)}</td>
                       <td><i class="fa-solid fa-xmark"></i></td>
                       <td class="none">${des}</td> 
                       <td class="none">${des1}</td>
                       <td class="none">${uom}</td>
                       <td class="none">${qtyuom}</td>
                       <td class="none">${itemgcode}</td>
                       <td class="none">${itemccode}</td>
                       <th class="none">${id}</th>
                       
                   </tr> `

                                table.find('tr:eq(0)').after(tr);
                                var td = $('.table').find(`tr:eq(1) td:eq(3)`).text()
                                gettable = $('.table').find('tr').length
                                var tola = $('.totalprice').find('span').text();

                                var maintotal = $('.totalprice').find('p').text();

                                var pt = Number(maintotal) + Number(td)

                                // $('body').find('.totalprice span').text((Number(pt) - Number(pt) * Number(descount) / 100).toFixed(4));
                                // $('body').find('.totalprice p').text((Number(pt)).toFixed(4));
                                $('body').find('.total span').text(gettable - 1);


                                var getertotal = $('.table').find('tr').length
                                var td = 0;
                                var testprice = 0
                                for (var i = 1; i < getertotal; i++) {
                                    testprice = $('.table').find(
                                        `tr:eq(${Number(i)}) td:eq(3)`).text();
                                    td += Number(testprice)
                                    $('body').find('.totalprice span').text((Number(td))
                                        .toFixed(4));


                                }
                                $('body').find('.totalprice p').text((pt).toFixed(4));
                                $('body').find('.totalprice h6').text((Number($('body')
                                        .find('.totalprice p').text()) - Number(td))
                                    .toFixed(4));


                            }
                            $('#scan').val('')

                        }

                    })

                }

            })
        }

        var elem = document.documentElement;

        function openFullscreen() {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {


                elem.msRequestFullscreen();
            }
        }


        // function Clear_Table() {
        //     $('.clear').on('click', function() {

        //         const index = list.indexOf(element);
        //         const x = list.splice(index, 1);

        //     })
        // }

        let table_action = 0;
        $('.table-payment').on('click', function() {
            if (table_action == 0) {
                $('.contain').css({
                    'width': '80%'
                });
                $('.contain').css({
                    'background-color': 'skyblue'
                });
                table_action = 1;
            } else {
                $('.contain').css({
                    'width': '27%'
                });
                $('.contain').css({
                    'background-color': 'skyblue'
                });
                table_action = 0;
            }
        })





        $('.short').on('click', function() {
            $('.showshortcut').css({
                'margin-right': '0'
            })
        })

        $('.flo').on('click', function() {
            $('.showshortcut').css({
                'margin-right': '-480px'
            })
        })

        var showtable = 0;

        $(window).resize(function() {
            if (window.innerWidth <= 575.98) {
                $('.contain').css({
                    'margin-right': '-1200px'
                });
                $('.total').css({
                    'margin-right': '-1200px'
                });
                $('.totalprice').css({
                    'margin-right': '-1200px'
                });

            } else if (window.innerWidth >= 576 && window.innerWidth <= 1199.8) {
                $('.contain').css({
                    'margin-right': '-1200px'
                });
                $('.contain').css({
                    'width': '29%'
                });
                $('.total').css({
                    'margin-right': '-1200px'
                });
                $('.totalprice').css({
                    'margin-right': '-1200px'
                });
                $('.contain').css({
                    'height': '700px'
                });
                $('.total').css({
                    'width': '29%'
                });
                $('.totalprice').css({
                    'width': '29%'
                });
            } else if (window.innerWidth >= 1200) {
                $('.contain').css({
                    'margin-right': '0'
                });
                $('.contain').css({
                    'width': '29%'
                });
                $('.total').css({
                    'margin-right': '0'
                });
                $('.totalprice').css({
                    'margin-right': '0'
                });
                $('.contain').css({
                    'height': '700px'
                });
                $('.total').css({
                    'width': '29%'
                });
                $('.totalprice').css({
                    'width': '29%'
                });
            }
        });

        $('.showpaymentoption').on('click', function() {
            if (showtable == 0) {

                $('.contain').css({
                    'width': '95%'
                });
                $('.contain').css({
                    'height': '700px'
                });
                $('.total').css({
                    'width': '95%'
                });
                $('.totalprice').css({
                    'width': '95%'
                });
                $('.contain').css({
                    'margin-right': '0'
                });
                $('.total').css({
                    'margin-right': '0'
                });
                $('.totalprice').css({
                    'margin-right': '0'
                });
                $('.contain').css({
                    'background-color': 'skyblue'
                });
                showtable = 1;
            } else {

                $('.total').css({
                    'margin-right': '-1200px'
                });
                $('.totalprice').css({
                    'margin-right': '-1200px'
                });
                $('.contain').css({
                    'margin-right': '-1200px'
                });
                $('.contain').css({
                    'background-color': 'skyblue'
                });
                showtable = 0;
            }
        })




        $('#category').on('change', function() {
            var category = $(this).val()

            var data = {
                'category': category,
            }

            $.ajax({
                url: 'filtercatagory',
                type: 'GET',
                datatype: 'json',
                data: data,
                beforeSend: function() {
                    $('body').find('.spinners').css('display', 'block');
                },
                success: function(data) {
                    $('.item').html(data);
                    $('body').find('.spinners').css('display', 'none');
                    var record = $('.card1').length;
                    $('.readmore span').text(record);



                }

            })
        })

        function Filter_data_By_Catagory() {

        }
        $('.clear').on('click', function() {
            var table = $('.table');
            table.html(`<thead  class="thead-light">
                             <tr  >
                               
                                <th>Item_no </th>
                                 <th>Price </th>
                                 <th>Qty   </th>
                                 <th>Discount</th>
                                 <th>Subtotal  </th>
                                 <th>Clear</th>
                            </tr>
                         </thead>
                         <tbody>
                            </tbody>
                         `)
            list = ['1'];
            $('.totalprice').find('span').text(0)
            $('.totalprice').find('p').text(0)
            $('.totalprice').find('h6').text(0)
            $('.total').find('span').text(0)
        })

        $('.closes').on('click', function() {
            $.ajax({
                url: 'close_register',
                type: 'POST',
                beforeSend: function() {

                },
                success: function(data) {




                }

            })
        })
        Add_Item_to_Preview_Table()
        Remove_Item()
        Update_Quantity()
        Set_Uom();
        Change_Uom()
        Buttom_Payment()
        AddItem_To_Sale_Line_and_Sale_Header();
        Change_Info_Payment_Modal()
        ScanItemBarcode();
        Change_Currency_Code()
        //  HoldItem();Fta
        Discount_ItemPrice()
        Add_new_Customer()
    });
 