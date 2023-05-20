@extends('hader')
@section('contain')
@endsection
@extends('layouts.slide-left')
@section('container')
@endsection
 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab"
                aria-controls="nav-home" aria-selected="true">Daily Sales</a>
            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab"
                aria-controls="nav-profile" aria-selected="false">Monthly Sales</a>
            <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab"
                aria-controls="nav-contact" aria-selected="false">Sale Report</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            {{-- Daily  Report  --}}
            <div class="row">
                <div class="col-2">
                    <label for="" class="form-label">Select Date:</label>
                    <input type="date" class="form-control " id="changedate">
                </div>
                <div class="col-2">
                  <label for="" class="form-label">Sales By</label>
                  <select name="username" id="username" class="form-control">
                    @foreach ($user as $selectuser)
                        <option value="{{$selectuser->name}}">{{$selectuser->name}}</option>
                    @endforeach
                   
                    
                  </select>
              </div>


            </div>
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="cardreport">
                          <div class="showvalue item">
                                <h3>450</h3>
                          </div>
                            <div class="headingimg">Total Item Sales
                                <div class="author"> By <span class="name">Blue
                                        Technology</span><br>{{ date('Y-m-d H:i:s') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="cardreport">
                          <div class="showvalue sale">
                            <h3>450</h3>
                      </div>
                            <div class="headingimg">Sales Value 
                                <div class="author"> By <span class="name">Blue Technology
                                    </span><br>{{ date('Y-m-d H:i:s') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="cardreport">
                          <div class="showvalue">
                            <h3>450</h3>
                      </div>
                            <div class="headingimg">Total Item
                                <div class="author"> By <span class="name">Blue
                                        Technology</span><br>{{ date('Y-m-d H:i:s') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="cardreport">
                          <div class="showvalue">
                            <h3>450</h3>
                      </div>
                            <div class="headingimg">Unit of Measure
                                <div class="author"> By <span class="name">Blue
                                        Technology</span><br>{{ date('Y-m-d H:i:s') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="mar">
          {{ date('d-M-Y ') }}
        </div>
        <div class="container">
          <div class="row">
            <table class="table table-bordered">
              <thead class="table-light">
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Sale By</th>
                  <th scope="col">Items_Code</th>
                  <th scope="col">Items_Name</th>
                  <th scope="col">Catagory</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Unit Price</th>
                  <th scope="col">Descount Price</th>
                  <th scope="col">Descount Percentage</th>
                  <th scope="col">Total Price</th>
                </tr> 
              </thead>
              <tbody>
                @foreach ($saleline as $item)
                <tr>
                  <th scope="row"> {{ date('d-M-Y ') }}</th>
                  <td>No Name</td>
                  <td>{{$item->item_no}}</td>
                  <td>{{$item->item_description}}</td>
                  <td>{{$item->item_category_code}}</td>
                  <td>{{Str::substr($item->quantity,0,4)}}</td>
                  <td>{{Str::substr($item->unit_price,0,5)}}$</td>
                      
                  @if ($item->discount_amount==0)
                  <td>0$</td>
                  @else
                  <td>{{Str::substr($item->discount_amount,0,7)}}$</td>  
                  @endif
                  
                  
                  @if ($item->discount_percentage==0)
                  <td>0%</td>
                  @else
                       <td>{{Str::substr($item->discount_percentage,0,3)}}%</td>
                  @endif

                 
                  <td>{{Str::substr($item->amount,0,4)}}$</td>
                </tr>
                @endforeach
                
                <tr>
                  
                  <th colspan="5" class="table-secondary">Grand Total</th>
                  <th class="table-success qty">00</th>
                  <th class="table-info price">00</th>
                  <th class="table-primary desprice">00</th>
                  <th class="table-warning desper">00</th>
                    <th class="table-danger totald">00</th>
                 
                  
                </tr>
              </tbody>
            </table>
          </div>
        
        </div>
             
             
          



        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <p>clicked profile</p>
            <p>clicked profile</p>
            <p>clicked profile</p>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <p>clicked contact</p>
            <p>clicked contact</p>
            <p>clicked contact</p>
        </div>
    </div>


    <!--Bootstrap Js-->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> --}}

</main>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{asset('/js/jbarcode/scriptsalereport.js')}}"></script>
 
 
