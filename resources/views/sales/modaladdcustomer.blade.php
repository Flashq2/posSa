<div class="modal fade" id="adminaddcustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{(__('pos.customer'))}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST"   enctype="multipart/form-data" id="formcustomer">
            @csrf
            <div class="row">
              <div class="col-6">
                  <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('pos.id'))}}</label>
                  <input type="text" class="form-control dd" id="no" aria-describedby="emailHelp" name="no">
                 <p class="error-info"></p> 
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('pos.name'))}}</label>
                  <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                <p class="error-info-name">
                  
                </p>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('pos.name2'))}}</label>
                  <input type="text" class="form-control" id="name2" aria-describedby="emailHelp" name="name2">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('pos.address'))}}</label>
                  <input type="text" class="form-control" id="address" aria-describedby="emailHelp" name="address">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('pos.address2'))}}</label>
                  <input type="text" class="form-control" id="address2" aria-describedby="emailHelp" name="address2">
                  
                </div>
              </div>
              <div class="col-6">
                   <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('pos.phone_number'))}}</label>
                  <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" name="phone">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('pos.phone_number2'))}}</label>
                  <input type="text" class="form-control" id="phone2" aria-describedby="emailHelp" name="phone2">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Salepersion_Code</label>
                  <input type="text" class="form-control" id="salse" aria-describedby="emailHelp" name="salse">
                  
                </div>
                
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Inactived</label>
                  {{-- <input type="text" class="form-control" id="active" aria-describedby="emailHelp" name="active"> --}}
                  <select name="active" id="active" class="form-control">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                  
                </div>
              </div>
            </div>
              
             
                 
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{(__('pos.close'))}}</button>
          <button type="button" class="btn btn-primary addnewuser" >{{(__('pos.newcustomer'))}}</button>
        </div>
      </div>
    </div>
  </div>