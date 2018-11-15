<nav class="sidebar-nav">
  
  <ul class="nav">
    
    <li class="nav-item">
      <a class="nav-link {{ isActiveRoute('home') }}" href="{{url('/admin')}}">
        <i class="nav-icon cui-speedometer"></i> Dashboard
      </a>
    </li>
    
    <li class="nav-title">Featured</li>

     @can('crud-region')
      <li class="nav-item">
        <a class="nav-link {{ areActiveRoutes(['regions.index', 'regions.create', 'regions.edit']) }}" 
          href="{{ route('regions.index') }}">
          <i class="nav-icon cui-layers"></i> Regions
        </a>
      </li>
    @endcan

    @can('crud-district')
      <li class="nav-item">
        <a class="nav-link {{ areActiveRoutes(['districts.index', 'districts.create', 'districts.edit']) }}" 
           href="{{ route('districts.index') }}">
        <i class="nav-icon cui-note"></i>Districts</a>
      </li>
    @endcan
    
    @can('crud-facility')
      <li class="nav-item">
        <a class="nav-link {{ areActiveRoutes(['facilities.index', 'facilities.create', 'facilities.edit']) }}" 
           href="{{ route('facilities.index') }}">
        <i class="nav-icon cui-calendar"></i>Facilities</a>
      </li>
    @endcan  
    
      <li class="nav-title">Members</li>
      
      @can('crud-staff')
        <li class="nav-item">
          <a class="nav-link {{ areActiveRoutes(['staff.index', 'staff.create', 'staff.edit']) }}" 
             href="{{ route('staff.index') }}">
          <i class="nav-icon cui-briefcase"></i>IPC & PROV</a>
        </li>
      @endcan
      
      @can('crud-ipcLeader')
        <li class="nav-item">
          <a class="nav-link {{ areActiveRoutes(['ipcLeaders.index', 'ipcLeaders.create', 'ipcLeaders.edit']) }}" 
            href="{{ route('ipcLeaders.index') }}">
            <i class="nav-icon cui-comment-square"></i>IpcLeaders
          </a>
        </li>
      @endcan
    
    {{-- Learn Nav With DropDown Menu --}}
    <li class="nav-item nav-dropdown d-lg-none">
      
      <a class="nav-link nav-dropdown-toggle" href="#">
        Account
      </a>
    
      <ul class="nav-dropdown-items">
        
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="cui-account-logout"></i> Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}"
            method="POST" style="display: none;">{{ csrf_field() }}</form>
        </li>
        
        <li class="nav-item ">
          <a class="nav-link" href="{{ route('change_password') }}">
            <i class="cui-lock-unlocked"></i> Change password
          </a>
        </li>
        
      </ul>
      
    </li>
    
  </ul>
  
</nav>
