<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.84.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title_name')</title>
        <link rel="icon" type="image/png" href="{{asset('https://static.wixstatic.com/media/74d6b3_1939d8a45096498883a91d31a42f868f~mv2.png/v1/fill/w_469,h_229,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/BlueTech_Large_KH.png')}}" sizes="16x16">
        
        <script src="https://kit.fontawesome.com/bca9825c0c.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
        <style>
          .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
          }
    
          @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
          }
          form.form-margin{
            margin-top: 40px
          }
        </style>
    
        <link href="{{asset('css/stytle.css')}}" rel="stylesheet">
      
      </head>
<body>
    @include('layouts.slide-left')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container">
            <form class="form-margin" method="POST" enctype="multipart/form-data" action="{{url('setting/submit')}}">
                @csrf
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                       <select  id="lang" class="form-control" name="lang"   >
                        <option value="en">English</option>
                        <option value="kh">Khmer</option>
                       </select>
                      <label class="form-label" for="form6Example1">Language</label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                      <input type="text" id="form6Example2" class="form-control" name="company" id="company" value="{{$get->CompanyName}}" />
                      <label class="form-label" for="form6Example2">Company Name</label>
                    </div>
                  </div>
                </div>
              
                <!-- Text input -->
                <div class="form-outline mb-4">
                  <input type="file" id="form6Example3" class="form-control" name='image' id="image" value="{{$get->Logo}}" />
                  <label class="form-label" for="form6Example3">Company Logo</label>
                </div>
              
                <!-- Text input -->
              
                
              
                <!-- Message input -->
                <div class="form-outline mb-4">
                  <textarea class="form-control" id="form6Example7" rows="4"></textarea>
                  <label class="form-label" for="form6Example7">Additional information</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">Save Change</button>
             
              </form>
        </div>
    </main>
</body>
@include('script')
<script>
$(document).ready(function () {
});
</script>
</html>