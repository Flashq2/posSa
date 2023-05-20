@extends('hader')
@section('contain')
    
@endsection
 
<div class="container">



<form method="POST" action="{{url('submitedit')}}"  enctype="multipart/form-data" >
    @csrf
          <input type="hidden" class="form-control" id="id" aria-describedby="emailHelp" name="id" value="{{$edit->id}}" readonly>
        
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">No</label>
            <input type="text" class="form-control" id="idd" aria-describedby="emailHelp" name="idd" value="{{$edit->id}}" >
            
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nanme</label>
          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" value="{{$edit->name }}">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name_2</label>
          <input type="text" class="form-control" id="name2" aria-describedby="emailHelp" name="name2" value="{{$edit->name_2}} ">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Address</label>
          <input type="text" class="form-control" id="address" aria-describedby="emailHelp" name="address" v\value="{{$edit->address}} ">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Address 2</label>
          <input type="text" class="form-control" id="address2" aria-describedby="emailHelp" name="address2" value="{{$edit->address_2}} ">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">phone_no</label>
          <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" name="phone" value="{{$edit->phone_no}}  ">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">phone_no2</label>
          <input type="text" class="form-control" id="phone2" aria-describedby="emailHelp" name="phone2" value="{{$edit->phone_no_2}}" >
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Salepersion_Code</label>
          <input type="text" class="form-control" id="salse" aria-describedby="emailHelp" name="salse" value="{{$edit->salsepersion_code}}">
          
        </div>
        
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Inactived</label>
          <input type="text" class="form-control" id="active" aria-describedby="emailHelp" name="active" value="{{$edit->inactived}} ">
          
        </div>
        
        <button type="submit" class="btn btn-primary ">Add new</button>
        {{-- <a href="{{route('link.index')}}"><button type="button" class="btn btn-primary ml-3">Back</button></a> --}}
      </form>
    </div>