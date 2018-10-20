@extends('cms.layouts.cms')

@section('more')
<script type="text/javascript">
  //Save a dummy ipcLeader in the window
  window.item = null
  //Save dummy ipcLeader fields in the window
  window.fields = null
  //Save the baseUrl in the window
  window.baseUrl = '/api/ipcLeaders'
</script>
@endsection

@section('content')

@include('cms.modals.confirmation-modal')  
  
<div class="container" id="container">
  
  <div class="row">
    
    <div class="col-12">
      
      <a role="button" 
        class="btn btn-pill btn-success mb-3 float-right"
        href="{{ route('ipcLeaders.create') }}">
        <span class="btn-text">
          Create IpcLeader</span>
      </a>
      
      <div class="table-responsive">
        
        <table class="table table-hover position-relative" id="she-table">
          
          @include('cms.loaders.loader')
          
          <thead>
            <tr>
              <th class="d-none"></th>
              <th>IPC Leader Name</th>
              <th>Phone Number</th>
              <th>Device SN</th>
              <th>Device IMEI</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          
          <tbody>
            
            @foreach($ipcLeaders as $ipcLeader)
              <tr @click="onConfirm({{$ipcLeader->id}}, $event)">
                <td class="d-none">{{ $ipcLeader->id }}</td>
                <td>{{ fullName($ipcLeader->first_name, $ipcLeader->last_name) }}</td>
                <td>{{ $ipcLeader->phone_number }}</td>
                <td>{{ $ipcLeader->device_sn  }}</td>
                <td>{{ $ipcLeader->device_imei  }}</td>
                <td>{{ ($ipcLeader->status) ? 'Active' : 'InActive' }}</td>
                <td>
                  <div class="btn-group">
                    <a role="button" class="btn btn-pill btn-warning" 
                      title="view and edit details" 
                      data-toggle="tooltip" 
                      href="{{ route('ipcLeaders.edit', ['ipcLeader' => $ipcLeader->id]) }}">
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