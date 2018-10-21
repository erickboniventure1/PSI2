@extends('cms.layouts.cms')

@section('more')
<script type="text/javascript">
  //Save the ipcLeader in the window
  @isset($ipcLeader)
  window.item = {!! json_encode($ipcLeader) !!}
  @endisset
  //Save the ipcLeader fields in the window
  window.fields = {
    first_name:'', last_name: '',email: '' ,phone_number: '', description: '', status: '',
    device_sn: '', device_imei: '', picture: '',
  }
  //Save the baseUrl in the window
  window.baseUrl = '/api/ipcLeaders'
</script>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ $breadcrumb_past_url }}">{{$breadcrumb_past}}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
      {{$breadcrumb_active}}</li>
  </ol>
</nav>
@endsection

@section('content')  
<div class="row">
        
    <div class="col-12">   
                  
      <form class="position-relative" 
        method="post" @submit.prevent="onSubmit">
                
        @include('cms.loaders.loader')

        <div class="card">
        
          <div class="card-header">
           <!--  Users Form -->
            IpcLeader Form

          </div>
          
          <div class="card-body d-flex justify-content-between flex-wrap">
            
            <div class="col-md-8">
              
              <div class="form-group">
                <label for="name">First Name:</label>
                <input type="text" name="name" class="form-control"
                  v-model="form.first_name" required>
              </div>
              <div class="form-group">
                <label for="name">Last Name:</label>
                <input type="text" name="last_name" class="form-control"
                  v-model="form.last_name" required>
              </div>
                <div class="form-group">
                <label for="name">Email:</label>
                <input type="text" name="email" class="form-control"
                  v-model="form.email" required>
              </div>
              <div class="form-group">
                <label for="name">Phone Number:</label>
                <input type="text" name="phone_number" class="form-control"
                  v-model="form.phone_number" required>
              </div>
              <div class="form-group">
                <label for="name">Device SN:</label>
                <input type="text" name="device_sn" class="form-control"
                  v-model="form.device_sn" required>
              </div>
              <div class="form-group">
                <label for="name">Device IMEI:</label>
                <input type="text" name="device_imei" class="form-control"
                  v-model="form.device_imei" required>
              </div>
              <div class="form-group">
                <label for="name">Description:</label>
                <textarea name="description" rows="5" 
                  class="form-control" v-model="form.description"
                  ></textarea>
              </div>
              <div class="form-group">
                <label for="name">Status:</label>
                <select name="status" class="form-control"
                  v-model="form.status" required>
                  <option value="1">Active</option>
                  <option value="0">InActive</option>
                </select>
              </div>
                          
            </div>
            
            <div class="col-md-4">
              
              <div class="form-group text-center">
                 <label for="video_link">User Picture:</label>
                <label for="video_link">Ipc Leader Picture:</label>
                <div class="picture-container">
                  <img 
                    v-show="showPicture"
                    :src="form.picture" alt="IpcLeader Picture"
                    class="picture img-thumbnail">
                  <i v-show="showIcon" class="fa fa-5x fa-file-photo-o"></i>
                  <div class="picture-placeholder d-flex align-items-center justify-content-center"
                    v-if="showPlaceHolder">@{{file.name}}</div>
                </div>
                <button type="button" 
                  class="btn btn-pill btn-outline-success mt-2"
                  @click="onUpload()">
                  <i class="fa fa-upload"></i>
                  <span v-show="!showPicture">Upload</span>
                  <span v-show="showPicture">Change</span>
                </button>
                <input type="file" name="picture" id="file-input" 
                  class="d-none" @change="onFileUploaded">
              </div>
              
            </div>
            
          </div>
                    
          <div class="card-footer">
            <button type="submit" 
              class="btn btn-pill btn-success btn-lg float-right">
              Submit
            </button>
          </div>
          
        </div>
        
      </form>
                      
  </div>
    
</div>

@endsection