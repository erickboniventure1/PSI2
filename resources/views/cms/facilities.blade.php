@extends('cms.layouts.cms')

@section('more')
<script type="text/javascript">
  //Save a dummy facility in the window
  window.item = null
  //Save dummy facility fields in the window
  window.fields = null
  //Save the baseUrl in the window
  window.baseUrl = '/api/facilities'
</script>
@endsection

@section('content')

@include('cms.modals.confirmation-modal')  
  
<div class="container" id="container">
  
  <div class="row">
    
    <div class="col-12">
      
      <a role="button" 
        class="btn btn-pill btn-success mb-3 float-right"
        href="{{ route('facilities.create') }}">
        <span class="btn-text">
          Create Facility</span>
      </a>
      
      <div class="table-responsive">
        
        <table class="table table-hover position-relative" id="she-table">
          
          @include('cms.loaders.loader')
          
          <thead>
            <tr>
              <th class="d-none"></th>
              <th>Facility Name</th>
              <th>Ipc Leader</th>
              <th>District</th>
              <th>Region</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          
          <tbody>
            
            @foreach($facilities as $facility)
              <tr @click="onConfirm({{$facility->id}}, $event)">
                <td class="d-none">{{ $facility->id }}</td>
                <td>{{ $facility->name }}</td>
                <td>{{ fullName($facility->user->first_name, $facility->user->last_name) }}</td>
                <td>{{ $facility->district->name }}</td>
                <td>{{ $facility->region->name }}</td>
                <td>{{ ($facility->status) ? 'Active'  : 'InActive' }}</td>
                <td>
                  <div class="btn-group">
                    <a role="button" class="btn btn-pill btn-warning" 
                      title="view and edit details" 
                      data-toggle="tooltip" 
                      href="{{ route('facilities.edit', ['facility' => $facility->id]) }}">
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