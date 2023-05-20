<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Permission</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST"   enctype="multipart/form-data" id="form_Permission">
            @csrf
            <div class="row">
              <div class="col-6">
                  <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('permission.code'))}}</label>
                  <input type="text" class="form-control dd" id="code" aria-describedby="emailHelp" name="code">
                  <p class="error-info"></p>
                  <input type="hidden" class="form-control dd" id="id" aria-describedby="emailHelp" name="id">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('permission.des1'))}}</label>
                  <input type="text" class="form-control" id="des" aria-describedby="emailHelp" name="des">
                </div>
                
                {{(__('permission.adds'))}}  <input type="checkbox" class="adddpermission"    style="width: 30px;height:30px;">
                {{(__('permission.update'))}} <input type="checkbox" class="updatepermission"   style="width: 30px;height:30px;">
              </div>
              <div class="col-6">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('permission.des2'))}}</label>
                  <input type="text" class="form-control" id="des2" aria-describedby="emailHelp" name="des2">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">ACTIVE</label>
                  {{-- <input type="text" class="form-control" id="active" aria-describedby="emailHelp" name="active"> --}}
                  <select class="form-select" aria-label="Default select example" id='active'>
                      
                    <option value="Yes" selected>Yes</option>
                    <option value="Yes">No</option>
                    
                  </select>
                </div>
          
                {{(__('permission.delete'))}}  <input type="checkbox" class="deletepermission"  style="width: 30px;height:30px;">
                {{(__('permission.dis'))}}  <input type="checkbox" class="discountpermission"  style="width: 30px;height:30px;">
                   
               
              </div>
            </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary addpermission" >{{(__('permission.add'))}}</button>
          <button type="button" class="btn btn-success editpermission" >{{(__('permission.edit'))}}</button>
        </div>
      </div>
    </div>
  </div>
  @yield('modelpermission')