@extends('cms.layouts.cms')

@section('content')

<div class="container">
  
  <div class="row">
            
        <div class="card col-md-4">
          <div class="card-body">
            <h5 class="card-title">Staff</h5>
            <p class="card-text">
              {{ sprintf('%s', number_format($count['staff'])) }}
            </p>
          </div>
        </div>
        
        <div class="card col-md-4 mt-2 mt-md-0">
          <div class="card-body">
            <h5 class="card-title">Regions</h5>
            <p class="card-text">
              {{ sprintf('%s', number_format($count['regions'])) }}
            </p>
          </div>
        </div>
        
        <div class="card col-md-4 mt-2 mt-md-0">
          <div class="card-body">
            <h5 class="card-title">Districts</h5>
            <p class="card-text">
              {{ sprintf('%s', number_format($count['districts'])) }}
            </p>
          </div>
        </div>
                  
  </div>

  <div class="row mt-0 mt-md-2">
        
      <div class="card col-md-4 mt-2 mt-md-0">
        <div class="card-body">
          <h5 class="card-title">Ipc Leaders</h5>
          {{--<h5 class="card-title">Users</h5>--}}

          <p class="card-text">
            {{ sprintf('%s', number_format($count['ipcLeaders'])) }}
          </p>
        </div>
      </div>
      
      <div class="card col-md-4 mt-2 mt-md-0">
        <div class="card-body">
          <h5 class="card-title">Facilities</h5>
          <p class="card-text">
            {{ sprintf('%s', number_format($count['facilities'])) }}
          </p>
        </div>
      </div>
        <div class="card col-md-4 mt-2 mt-md-0">
        <div class="card-body">
          
          <p class="card-text">
            <h5 class="card-title">Search..</h5>
          </p>
        </div>
      </div>

</div>

      
  </div>




@endsection