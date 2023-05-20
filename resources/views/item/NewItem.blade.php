<form   method="POST" enctype="multipart/form-data" id="su">
    @csrf
    <div class="row">
      <div class="col-6">
          <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">no</label>
          <input type="text" class="form-control dd" id="no" aria-describedby="emailHelp" name="no">
          <input type="hidden" class="form-control dd" id="id" aria-describedby="emailHelp" name="id">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">no_2</label>
          <input type="text" class="form-control" id="no2" aria-describedby="emailHelp" name="no2">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">	description</label>
            <input type="text" class="form-control" id="des" aria-describedby="emailHelp" name="des">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">	description_2</label>
            <input type="text" class="form-control" id="des2" aria-describedby="emailHelp" name="des2">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">item_group_code</label>
            <input type="text" class="form-control" id="item-group" aria-describedby="emailHelp" name="item-group">
          </div>

        
        
      </div>
      <div class="col-6">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">item_category_code</label>
            <input type="text" class="form-control" id="item-gcode" aria-describedby="emailHelp" name="item-gcode">
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">unit_price</label>
          <input type="text" class="form-control" id="unitprice" aria-describedby="emailHelp" name="unitprice">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">remark</label>
            <input type="text" class="form-control" id="remark" aria-describedby="emailHelp" name="remark">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Picture</label>
            {{-- <input type="file" class="form-control" id="image" aria-describedby="emailHelp" name="image"> --}}
            <input type="file" name="image" id="image">
          </div> 
        
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Active</label>
          {{-- <input type="text" class="form-control" id="active" aria-describedby="emailHelp" name="active"> --}}
          <select class="form-select" aria-label="Default select example" id='active'>
              
            <option value="1" selected>Yes</option>
            <option value="2">No</option>
            
          </select>
          <div class="preimg">
            <img id="preview-image" width="300px">
          </div>
          
        </div>
      </div>
    </div>
    {{-- <button type="submit">Submit</button> --}}
    <input type="submit" value="Edit">

  </form>