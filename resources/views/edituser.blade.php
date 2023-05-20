@extends('hader')
@section('contain')
    
@endsection
<div class="container">


<form method="POST" action="{{url('uploadedit')}}"  enctype="multipart/form-data" >
    @csrf
    <div class="row">

    
   <div class="col-6">
       
      <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Id</label>
          <input type="text" class="form-control dd" id="id" aria-describedby="emailHelp" name="id" value="{{$edit->id}}">
          <input type="text" class="form-control dd" id="idd" aria-describedby="emailHelp" name="idd" value="{{$edit->id}}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="{{$edit->email}}">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Salesperson_code</label>
          <input type="text" class="form-control" id="salse" aria-describedby="emailHelp" name="salse" value="{{$edit->salesperson_code}}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" value="{{$edit->name}}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Gender</label>
          <input type="text" class="form-control" id="gender" aria-describedby="emailHelp" name="gender" value="{{$edit->gender}}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Date of Birth</label>
          <input type="text" class="form-control dd" id="dob" aria-describedby="emailHelp" name="dob" value="{{$edit->date_of_birth}}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">id_card_no</label>
          <input type="text" class="form-control dd" id="idcard" aria-describedby="emailHelp" name="idcard" value="{{$edit->id_card_no}}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Phone_no</label>
          <input type="text" class="form-control dd" id="phone" aria-describedby="emailHelp" name="phone" value="{{$edit->phone}}">
          
        </div>
        
   </div>
   <div class="col-6">
       <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">User_role_code</label>
          <select class="form-select" aria-label="Default select example" id='userrole' value="{{$edit->user_role_code}}" >
              <option selected>Choose Option</option>
              <option value="1">Yes</option>
              <option value="2">No</option>
              
            </select>
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Address</label>
          <input type="text" class="form-control" id="address" aria-describedby="emailHelp" name="address" value="{{$edit->address}}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Addresss2</label>
          <input type="text" class="form-control" id="address2" aria-describedby="emailHelp" name="address2" value="{{$edit->address_2}}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Country_code</label>
          <input type="text" class="form-control" id="contry" aria-describedby="emailHelp" name="contry" value="{{$edit->country}}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">City</label>
          <input type="text" class="form-control" id="city" aria-describedby="emailHelp" name="city" value="{{$edit->city}}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Status</label>
          <input type="text" class="form-control" id="status" aria-describedby="emailHelp" name="status" value="{{$edit->status}}">
          
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password</label>
            <input type="text" class="form-control" id="status" aria-describedby="emailHelp" name="status" value="{{$edit->password}}">
            
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Permission_Code</label>
          <select class="form-select" aria-label="Default select example" id='permission' value="{{$edit->permission_code}}">
              <option selected>Choose Option</option>
              <option value="1">Yes</option>
              <option value="2">No</option>
              
            </select>
          
        </div>
        
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Inactived</label>
         
          <select class="form-select" aria-label="Default select example" id='active' value="{{$edit->inactived}}  ">
              <option selected>Choose Option</option>
              <option value="1">Yes</option>
              <option value="2">No</option>
              
            </select>
         
          
        </div>
   </div>
  </div>  
 <button type="submit">Edit</button>
         
      </form>
    </div>