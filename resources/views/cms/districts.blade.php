@extends('cms.layouts.cms')

@section('more')
<script type="text/javascript">
  //Save a dummy district in the window
  window.item = null
  //Save dummy district fields in the window
  window.fields = null
  //Save the baseUrl in the window
  window.baseUrl = '/api/districts'
</script>
@endsection

@section('content')

@include('cms.modals.confirmation-modal')  
  
<div class="container" id="container">
  
  <div class="row">
    
    <div class="col-12">
      
      <a role="button" 
        class="btn btn-pill btn-success mb-3 float-right"
        href="{{ route('districts.create') }}">
        <span class="btn-text">
          Create District</span>
      </a>
      
      <div class="table-responsive">
        
        <table class="table table-hover position-relative" id="she-table">
          
          @include('cms.loaders.loader')
          
          <thead>
            <tr>
              <th class="d-none"></th>
              <th>District Name</th>
              <th>Region</th>
              <th>Actions</th>
            </tr>
          </thead>
          
          <tbody>
            
            @foreach($districts as $district)
              <tr @click="onConfirm({{$district->id}}, $event)">
                <td class="d-none">{{ $district->id }}</td>
                <td>{{ $district->name }}</td>
                <td>{{ $district->region->name }}</td>
                <td>
                  <div class="btn-group">
                    <a role="button" class="btn btn-pill btn-warning" 
                      title="view and edit details" 
                      data-toggle="tooltip" 
                      href="{{ route('districts.edit', ['district' => $district->id]) }}">
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