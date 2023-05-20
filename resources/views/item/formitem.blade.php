<form   method="POST" enctype="multipart/form-data" id="su">
    @csrf
    <div class="row">
      <div class="col-6">
          <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">{{(__('item.no'))}}</label>
          <input type="text" class="form-control dd" id="no" aria-describedby="emailHelp" name="no" required>
          <input type="hidden" class="form-control dd" id="id" aria-describedby="emailHelp" name="id">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">{{(__('item.no2'))}}</label>
          <input type="text" class="form-control" id="no2" aria-describedby="emailHelp" name="no2">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">	{{(__('item.des1'))}}</label>
            <input type="text" class="form-control" id="des" aria-describedby="emailHelp" name="des">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">	{{(__('item.des2'))}}</label>
            <input type="text" class="form-control" id="des2" aria-describedby="emailHelp" name="des2">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">{{(__('item.item_g'))}}</label>
           
<input class="form-control" list="datalistOptions" id='item-gcode' name="item-gcode" placeholder="Select Item Group" required>
<datalist id="datalistOptions">
  @foreach ($data2 as $item)
  <option value="{{$item->code}}" >{{$item->code}}</option>
@endforeach
 
</datalist>
          </div>

        
        
      </div>
      <div class="col-6">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">{{(__('item.item_c'))}}</label>
            {{-- <input type="text" class="form-control" id="itemCcode" aria-describedby="emailHelp" name="itemCcode"> --}}
            <select class="form-select" aria-label="Default select example" id='itemCcode' name="itemCcode">
              @foreach ($data as $item)
                   <option value="{{$item->code}}" >{{$item->code}}</option>
              @endforeach
             
              
              
            </select>
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">{{(__('item.unit_price'))}}</label>
          <input type="text" class="form-control" id="unitprice" aria-describedby="emailHelp" name="unitprice" required>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">{{(__('item.remark'))}}</label>
            <input type="text" class="form-control" id="remark" aria-describedby="emailHelp" name="remark">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">{{(__('item.pic'))}}</label>
            <input type="file" class="form-control" id="image" aria-describedby="emailHelp" name="image">
            {{-- <input type="file" name="image" id="image"> --}}
          </div> 
        
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Active</label>
          {{-- <input type="text" class="form-control" id="active" aria-describedby="emailHelp" name="active"> --}}
          <select class="form-select" aria-label="Default select example" id='active' name="active">
              
            <option value="1" selected>Yes</option>
            <option value="2">No</option>
            
          </select>
          
          
        </div>
      </div>
    </div>
    <button type="submit">{{(__('item.add'))}}</button>
  </form>
  


 