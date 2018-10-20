@extends('cms.layouts.cms')

@section('more')
<script type="text/javascript">
  //Save a dummy region in the window
  window.item = null
  //Save dummy region fields in the window
  window.fields = null
  //Save the baseUrl in the window
  window.baseUrl = '/api/regions'
</script>
@endsection

@section('content')

@include('cms.modals.confirmation-modal')  
  
<div class="container" id="container">
  
  <div class="row">
    
    <div class="col-12">
      
      <a role="button" 
        class="btn btn-pill btn-success mb-3 float-right"
        href="{{ route('regions.create') }}">
        <span class="btn-text">
          Create Region</span>
      </a>
      
      <div class="table-responsive">
        
        <table class="table table-hover position-relative" id="she-table">
          
          @include('cms.loaders.loader')
          
          <thead>
            <tr>
              <th class="d-none"></th>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          
          <tbody>
            
            @foreach($regions as $region)
              <tr @click="onConfirm({{$region->id}}, $event)">
                <td class="d-none">{{ $region->id }}</td>
                <td>{{ $region->name }}</td>
                <td>
                  <div class="btn-group">
                    <a role="button" class="btn btn-pill btn-warning" 
                      title="view and edit details" 
                      data-toggle="tooltip" 
                      href="{{ route('regions.edit', ['region' => $region->id]) }}">
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