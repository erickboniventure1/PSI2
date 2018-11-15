@extends('cms.layouts.cms')

@section('more')
<script type="text/javascript">
  //Save a dummy st in the window
  window.item = null
  //Save dummy st fields in the window
  window.fields = null
  //Save the baseUrl in the window
  window.baseUrl = '/api/staff'
</script>
@endsection

@section('content')

@include('cms.modals.confirmation-modal')  
  
<div class="container" id="container">
  
  <div class="row">
    
    <div class="col-12">
      
      <a role="button" 
        class="btn btn-pill btn-success mb-3 float-right"
        href="{{ route('staff.create') }}">
        <span class="btn-text">
          Create Staff</span>
      </a>
      
      <div class="table-responsive">
        
        <table class="table table-hover position-relative" id="she-table">
          
          @include('cms.loaders.loader')
          
          <thead>
            <tr>
              <th class="d-none"></th>
              <th>Name</th>
              <th>Facility Name</th>
              <th>Region</th>
              <th>District</th>
              <th>Phone Number</th>
              <th>Device SN</th>
              <th>Device IMEI</th>
              <th>Type</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          
          <tbody>
            
            @foreach($staff as $st)
              <tr @click="onConfirm({{$st->id}}, $event)">
                <td class="d-none">{{ $st->id }}</td>
                <td>{{ fullName($st->first_name, $st->last_name) }}</td>
                <td>{{ $st->facility->name}}</td>
                <td>{{ $st->facility->district->region->name}}</td>
                <td>{{ $st->facility->district->name}}</td>
                <td>{{ $st->phone_number }}</td>
                <td>{{ $st->device_sn  }}</td>
                <td>{{ $st->device_imei  }}</td>
                <td>{{ $st->type }}</td>
                <td>{{ ($st->status) ? 'Active' : 'InActive' }}</td>
                <td>
                  <div class="btn-group">
                    <a role="button" class="btn btn-pill btn-warning" 
                      title="view and edit details" 
                      data-toggle="tooltip" 
                      href="{{ route('staff.edit', ['st' => $st->id]) }}">
                      <i class="fa fa-eye"></i>
                    </a>
                    <button type="button" class="btn btn-pill btn-danger" 
                      title="delete" data-toggle="tooltip" value="delete">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
            
          </tbody>
          
        </table>
        
      </div>
      
    </div>

    
    
  </div>
  
</div>
  
@endsection