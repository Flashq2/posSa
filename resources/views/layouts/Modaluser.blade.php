<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{(__('user.user'))}}</h1>
          <button type="button" class="btn-close add" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" id="user-form">
            @csrf
            <div class="row">
  
            
           <div class="col-6">
               
              <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('user.id'))}}</label>
                  <input type="text" class="form-control dd" id="no" aria-describedby="emailHelp" name="no" readonly value="{{$lastesd->id +1}}">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('user.email'))}}</label>
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                  <p class="error-info-email"></p>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Salesperson_code</label>
                  <input type="text" class="form-control" id="salse" aria-describedby="emailHelp" name="salse">
                  <p class="error-info"></p>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('user.name'))}}</label>
                  <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                  <p class="error-info-name"></p>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('user.gender'))}}</label>
                  <select name="gender" id="gender" class="form-control">
                    <option value="Male">{{(__('user.male'))}}</option>
                    <option value="Fimale">{{(__('user.fimale'))}}</option>
                  </select>
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('user.dao'))}}</label>
                  <input type="text" class="form-control dd" id="dob" aria-describedby="emailHelp" name="dob" placeholder="2023-03-14">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Id_Card_No</label>
                  <input type="text" class="form-control dd" id="idcard" aria-describedby="emailHelp" name="idcard">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('user.phone_number'))}}</label>
                  <input type="text" class="form-control dd" id="phone" aria-describedby="emailHelp" name="phone">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Password</label>
                  <input type="text" class="form-control dd" id="pass" aria-describedby="emailHelp" name="pass">
                  <p class="error-info-pass"></p>
                </div>
           </div>
           <div class="col-6">
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">User_role_code</label>
                  <select class="form-select" aria-label="Default select example" id='userrole'>
                       @foreach ($userrole as $item)
                            <option value="{{$item->code}}" selected>{{$item->code}}</option>
                       @endforeach
                    </select>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('user.address'))}}</label>
                  <input type="text" class="form-control" id="address" aria-describedby="emailHelp" name="address">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('user.address2'))}}</label>
                  <input type="text" class="form-control" id="address2" aria-describedby="emailHelp" name="address2">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Country_code</label>
                  <input type="text" class="form-control" id="contry" aria-describedby="emailHelp" name="contry">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('user.city'))}}</label>
                  <input type="text" class="form-control" id="city" aria-describedby="emailHelp" name="city">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">{{(__('user.status'))}}</label>
                  <input type="text" class="form-control" id="status" aria-describedby="emailHelp" name="status">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Permission_Code</label>
                  <select class="form-select" aria-label="Default select example" id='permission'>
                    @foreach ($permiss as $permission)
                        <option value="{{$permission->code}}">{{$permission->code}}</option>
                    @endforeach
{{--                       
                      <option value="1" selected>Yes</option>
                      <option value="2">No</option>
                       --}}
                    </select>
                  
                </div>
                
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Inactived</label>
                 
                  <select class="form-select" aria-label="Default select example" id='active'>
                      
                      <option value="1" selected>Yes</option>
                      <option value="2">No</option>
                      
                    </select>
                  {{-- <input type="text" class="form-control" id="active" aria-describedby="emailHelp" name="active"> --}}
                  
                </div>
           </div>
          </div>  
                 
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary adduser" >{{(__('user.save_change'))}}</button>
          <button type="button" class="btn btn-success editebu" >{{(__('user.clickedit'))}}</button>
        </div>
      </div>
    </div>
  </div>
  @yield('modaladduser')