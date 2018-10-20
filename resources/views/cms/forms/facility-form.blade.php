@extends('cms.layouts.cms')

@section('more')
<script type="text/javascript">
  //Save the facility in the window
  @isset($facility)
  window.item = {!! json_encode($facility) !!}
  @endisset
  //Save the parent models in the window
  window.parents = {!! json_encode($ipcLeaders) !!}
  window.parents2 = {!! json_encode($regions) !!}
  //Save the facility fields in the window
  window.fields = {
      name:'',
        description: '',
        region_id: '',
        user_id: '',
        district_id: '',
        status: '',
  }
  //Save the baseUrl in the window
  window.baseUrl = '/api/facilities'
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
            Facility Form
          </div>
          
          <div class="card-body d-flex justify-content-between flex-wrap">
            
            <div class="col-12">
              
              <div class="form-group">
                <label for="name">Ipc Leader Name:</label>
                <select name="user_id" class="form-control"
                  v-model="form.user_id" required>
                  <option 
                    v-for="parent in parents" :key="parent.id" 
                    :value="parent.id">@{{parent.first_name + " " + parent.last_name}}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="name">Region:</label>
                <select name="region_id" class="form-control"
                  v-model="form.region_id" required @change="fetchChildren">
                  <option 
                    v-for="parent in parents2" :key="parent.id" 
                    :value="parent.id">@{{parent.name}}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="name">District:</label>
                <select name="district_id" class="form-control"
                  v-model="form.district_id" required>
                  <option 
                    v-for="parent in parents3" :key="parent.id" 
                    :value="parent.id">@{{parent.name}}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="name">Facility Name:</label>
                <input type="text" name="name" class="form-control"
                  v-model="form.name" required>
              </div>
              <div class="form-group">
                <label for="name">Facility Description:</label>
                <textarea name="description" rows="5" 
                  class="form-control" v-model="form.description"
                  required></textarea>
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