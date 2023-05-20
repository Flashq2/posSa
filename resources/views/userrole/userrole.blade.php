 <!DOCTYPE html>
 <html lang="en">
  <head>
    @extends('hader')
  @section('contain')
      
  @endsection
  <title>Permission </title>
  <link rel="icon" type="image/png" href="{{asset('https://static.wixstatic.com/media/74d6b3_1939d8a45096498883a91d31a42f868f~mv2.png/v1/fill/w_469,h_229,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/BlueTech_Large_KH.png')}}" sizes="16x16">
  
  </head>
 <body>
  
 
@extends('layouts.slide-left')
@section('container')
    
@endsection
<script src="https://kit.fontawesome.com/bca9825c0c.js" crossorigin="anonymous"></script>
 
 
   
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">  
     <div class="pan">
    
      <p>{{(__('userrole.userrole'))}}</p>
     </div>
 
<button  class="add" data-bs-toggle="modal" data-bs-target="#exampleModal" data-opt="1" style="margin-top:20px;" >
  {{(__('userrole.add'))}}   <i class="fa-regular fa-calendar-plus"></i>
</button>




<div class="modal fade" id="deleteuserrole" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you Want to delete user role?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary no-nodelete" data-bs-dismiss="modal">Cansel</button>
        <button type="button" class="btn btn-primary yes-delete_userrole">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
@extends('userrole.modalforuserrole')
@section('userrole')
@endsection
 
    

 
 
<div class="alert alert-primary" role="alert">
  User add Scuess
</div>
 
 

 
  
     
    <table id="userrole" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th scope="col">{{(__('userrole.code'))}} <i class="fa-solid fa-sort"></i></th>
            <th scope="col">{{(__('userrole.des1'))}}<i class="fa-solid fa-sort"></i></th>
            <th scope="col">{{(__('userrole.des2'))}}<i class="fa-solid fa-sort"></i></th>
            <th scope="col">Inactived<i class="fa-solid fa-sort"></i></th>
            <th scope="col">{{(__('userrole.action'))}}<i class="fa-solid fa-sort"></i></th>
            
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
    $(function () {
     
      
       datatable = $('#userrole').DataTable({
          processing: true,
          serverSide: true,
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
          ajax: "{{ route('userrole.list') }}",
          columns: [
          {data: 'code', name: 'code'},
          {data: 'description', name: 'description'},
          {data: 'description_2', name: 'description_2'},
          {data: 'inactived', name: 'inactived'},
          {
              data: 'action', 
              name: 'action', 
              orderable: true, 
              searchable: true
          },
         
         
      ]
      });
      
    });
     
  </script>
  <script>
  
  $(document).ready(function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }});
    var id_user=0; 
  $('body').on("click",'.delete',function(){
$('#deleteuserrole').modal('show');
    var eThis=$(this);
        var par=eThis.parents('tbody tr');
        indd=par.index();
         id_user=par.find('td:eq(0)').text();

  })
    $('.add').on('click',function(){
      $('#user_role').trigger('reset');
    })
    // add new user use Ajax
function Add(){
  $('.adduser').on("click",function(e){ 

      
    
        event.preventDefault()
       var code= $('#idd').val();
       var des=$('#des').val();
      var des2=$('#des2').val();
       var active =  $('#active').val();
  var table=$('.table')
 var data={
 'code':code,
 'des':des,
 'des2':des2,
 'active':active,
 }
    $.ajax({
  url:'adduserrole',
  type:'POST',
  data:data,
  cache:false,
  dataType:"json",
  beforeSend:function(){
            //work before success    
  },
  success:function(data){ 
    
    if(data.status){
      $('.error-info').css({'display':'block'})
       $('.error-info').text(data.status.code+"*")
        $('#idd').css({'border':'1px solid red'})    
        $('#idd').focus()
                      
                        setInterval(() => {
                        $(".error-info").fadeOut(2000);
                        }, 1000);
    }
    else{
       $('#exampleModal').modal('hide');
         datatable.ajax.reload(null,false)  
         $('#user_role').trigger('reset');
    }

   
  },
  error: function(xml, error,thrownError) {
    alert(thrownError);
    
  }         
      });
    });
}
 
function Show_Editinfo(){
   $('body').on("click",'.edit',function(){
     $('#exampleModal').modal('show');
     var eThis=$(this);
        var par=eThis.parents('tbody tr');
        indd=par.index();
        var id=par.find('td:eq(0)').text();
        var des=par.find('td:eq(1)').text();
        var des2=par.find('td:eq(2)').text();
        var active=par.find('td:eq(3)').text();
          $('#idd').val(id);
          $('#id').val(id);
          $('#des').val(des);
          $('#des2').val(des2);
          $('#active').val(active);
 
     $('.adduser').css({'display':'none'});
     $('.editebu').css({'display':'block'});
        
      })
      $('body').on('click','.add',function(){
        
        $('.adduser').css({'display':'block'});
        $('.editebu').css({'display':'none'});
      })
}
     
function Edit(){
        $('body').on('click','.editebu',function(){
        var idd=$('#idd').val();
        var id=$('#id').val();
        var des=$('#des').val();
        var des2=$('#des2').val();
        var active=$('#active').val();
      console.log(id);
     
  var table=$('.table')
  var data={
 'idd':idd,
 'des':des,
 'des2':des2,
 'active':active,
 }
     $.ajax({
  url:'edituserrole/'+id,
  type:'POST',
  data:data,
  //contentType:false,
  cache:false,
  //processData:false,
  dataType:"json",
  beforeSend:function(){
            //work before success    
  },
  success:function(data){  
    $('#exampleModal').modal('hide');
   datatable.ajax.reload()
   $('.alert').css({'display':'block'});
    setInterval(function(){
      $('.alert').css({'display':'none'});
    },2000);
   
   
            
  },

  error: function(xml, error,thrownError) {
    alert(thrownError);
    
  }         
        });
     });
}

function Delect_UserRole(){
  $('.yes-delete_userrole').on('click',function(){

  $.ajax({
  url:'deleteuserrole/'+id_user,
  cache:false,
  beforeSend:function(){
            //work before success    
  },
  success:function(data){  
    $('#deleteuserrole').modal('hide');
   datatable.ajax.reload(null,false)
   $('.alert').css({'display':'block'});
    setInterval(function(){
      $('.alert').css({'display':'none'});
    },2000);
   
   
            
  },
  error: function(xml, error,thrownError) {
    alert(thrownError);
    
  }         
  });
  })
}
Delect_UserRole()
Show_Editinfo();
Edit()
Add()

  });

 </script>