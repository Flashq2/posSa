<script src="https://kit.fontawesome.com/bca9825c0c.js" crossorigin="anonymous"></script>
<style>
  .control-img{
    width: 100px;
    height: 100px;
    margin: 0 auto;
  }
  .control-img img{
     width: 100%;
     height: 100%;
     object-fit: contain;
  }
</style>
<div class="container-fluid">
  
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="control-img">
          <img src='/tos/{{$get->Logo}}'alt=""> 
        </div>
      
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{url('dashboard')}}">
                <span data-feather="home"></span>
                <h4> {{$get->CompanyName}}</h4>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{url('dashboard')}}">
                <span data-feather="home"></span>
                My Company
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('user/user')}}">
                <span data-feather="file"></span>
                {{(__('sidepanel.user'))}}   <div class="ime"><i class="fa-solid fa-users"></i></div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('userrole/userrole')}}">
                <span data-feather="shopping-cart"></span>
                {{(__('sidepanel.userrole'))}} <div class="ime"><i class="fa-solid fa-person-circle-exclamation fa-lg" style="color: #3e77da;"></i></i></div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('permission/permission')}}">
                <span data-feather="users"></span>
                {{(__('sidepanel.permission'))}} <div class="ime"><i class="fa-solid fa-unlock-keyhole"></i></div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('customer.index')}}">
                <span data-feather="bar-chart-2"></span>
                {{(__('sidepanel.customer'))}} <div class="ime"><i class="fa-solid fa-users"></i></div>
              </a>
            </li>
           
          </ul>
         
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            
          </h6>
           
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home"></span>
                {{(__('sidepanel.item'))}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('itemgroup.index')}}">
                <span data-feather="file-text"></span>
                {{(__('sidepanel.item_Groups'))}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('itemcategory.index')}}">
                <span data-feather="file-text"></span>
                {{(__('sidepanel.item_Catagory'))}}
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="{{route('newitem.index')}}">
                <span data-feather="file-text"></span>
                {{(__('sidepanel.item'))}}
              </a>
            </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            
            </h6>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home"></span>
                {{(__('sidepanel.uom'))}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('itemuomI.index')}}">
                <span data-feather="file-text"></span>
                    {{(__('sidepanel.itemuom'))}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('uom/uommenu')}}">
                <span data-feather="file-text"></span>
                {{(__('sidepanel.uom'))}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('posname')}}">
                <span data-feather="file-text"></span>
                  POS
              </a>
            </li>
             
            <li class="nav-item">
              <a class="nav-link" href="{{route('setting.index')}}">
                <span data-feather="file-text"></span>
                {{(__('sidepanel.setting'))}}
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
@yield('container')
<script>
</script>