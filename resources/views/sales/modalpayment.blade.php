<!-- Button trigger modal -->
 
  
  <!-- Modal -->
  <div class="modal fade" id="payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{(__('pos.payment'))}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-body-color">
          
            <section>
              
              <form action="" id="form_payment">
                <div class="d-flex justify-content-between align-items-center mb-5  ">
                  <div class="d-flex flex-row align-items-center">
                    <h4 class="text-uppercase mt-1">Blue Technology</h4>
                    <span class="ms-2 me-3">Pay</span>
                  </div>
                  {{-- <a href="#!">Cancel and return to the website</a> --}}
                  {{-- <img src="{{asset('img/blue1.webp')}}" alt=""> --}}
                </div>
              
                <div class="row">
                  <div class="col-md-7 col-lg-7 col-xl-6 mb-4 mb-md-0">
                    <div class="row">
                <div class="col-6">
                    <div class="p-2 d-flex justify-content-between align-items-center" style="background-color: #eee;">
                        <span>{{(__('pos.paytotalprice'))}}</span>
                        <span class="payprice">0</span>
                      </div>
                </div>
                  <div class="col-6"><div class="p-2 d-flex justify-content-between align-items-center" style="background-color: #eee;">
                    <span>{{(__('pos.groos'))}}</span>
                    <span class="paydes" id="paydes">0</span>
                  </div></div>
                  <div class="col-6">
                     <div class="p-2 d-flex justify-content-between align-items-center" style="background-color: #eee;">
                        <span>{{(__('pos.totalitem'))}}</span>
                        <span class="payitem">0</span>
                      </div> 
                  </div>
                  <div class="col-6">
                    <div class="p-2 d-flex justify-content-between align-items-center" style="background-color: #eee;">
                        <span>Date</span>
                        <span >{{date('Y M D')}}</span>
                      </div> 
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{(__('pos.currencycode'))}}</label>
                        <select name="currency-code" id="currency-code" class="form-control">
                          <option value="dollar" selected>Dollar</option>
                          <option value="reil">រៀល</option>
                        </select>
                      </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                      <label  class="form-label">{{(__('pos.invoiceno'))}}</label>
                      <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">#</span>
                        <input type="text" class="form-control" id="invoice_code" aria-describedby="addon-wrapping"   readonly value="000{{$lastesd->id + 1}}">
                      </div>
                      </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{(__('pos.amount'))}}</label>
                        <input type="text" class="form-control" id="amount" aria-describedby="emailHelp" name="amount" autocomplete="off" required>
                      </div>
                  </div>
                  <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Sale Person Code</label>
                        <input type="text" class="form-control" id="sale" aria-describedby="emailHelp" name="des" autocomplete="off">
                      </div>
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1" class="form-label">{{(__('pos.payby'))}}</label>
                    <select name="payby" id="payby" class="form-control">
                            <option value="Cash">{{(__('pos.cash'))}}</option>
                            <option value="Check">{{(__('pos.check'))}}</option>
                            <option value="Credit Card">{{(__('pos.credit'))}}</option>
                    </select>
                  </div>
                  <div class="col-6">
                    <label for="exampleInputEmail1" class="form-label">Document Type</label>
                    <select name="doc" id="doc" class="form-control">
                            <option value="Invoice">Invoice</option>
                            <option value="Cr">Cr</option>
                             
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="textAreaExample">{{(__('pos.remark'))}}</label>
                        <textarea class="form-control" id="textAreaExample1" rows="4"></textarea>
                  </div>
                    </div>
                  
                  </div>
                  <div class="col-md-5 col-lg-4 col-xl-4 offset-lg-1 offset-xl-2">
                    <div class="p-3" style="background-color: #eee;">
                      <span class="fw-bold">{{(__('pos.detail'))}}</span>
                      <div class="d-flex justify-content-between mt-2">
                        <span>{{(__('pos.paytotalprice'))}}</span> <span class="payprice" id="payprice">0</span>
                      </div>
                      <div class="d-flex justify-content-between mt-2">
                        <span>{{(__('pos.groos'))}}</span> <span class="paydes">$0.0</span>
                      </div>
                      
                      <div class="d-flex justify-content-between mt-2">
                        <span>{{(__('pos.discount'))}}</span> <span class="desprice">0</span>
                         
                      </div>
                      <hr />
                      <div class="d-flex justify-content-between mt-2">
                        <span class="lh-sm"> {{(__('pos.net'))}}
                           
                        </span >
                        <span class="paydes">0</span>
                      </div>
                      <div class="d-flex justify-content-between mt-2">
                        <span class="lh-sm">{{(__('pos.paying'))}}</span>
                        <span class="paying">0</span>
                      </div>
                       <div class="d-flex justify-content-between mt-2">
                        <span>{{(__('pos.balance'))}} </span> <span class="balance"></span>
                      </div>
                      <hr />
                      <div class="d-flex justify-content-between mt-2">
                        <span>Dollar Price </span> <span class="dollar">Cash</span>
                      </div>
                      <div class="d-flex justify-content-between mt-2">
                        <span>Paying By </span> <span class="paytype">Cash</span>
                      </div>
                      <hr />
  
                    </div>
                  </div>
                </div>
              </form>
              </section>
              
        </div>
        <div class="modal-footer"> 
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{(__('pos.close'))}}</button>
          <button type="button" class="btn btn-primary masteradd"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>{{(__('pos.payment'))}}
            </button> 
         
        </div>
      </div>
    </div>
  </div>