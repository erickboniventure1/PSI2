@extends('cms.layouts.cms')

@section('more')
<script type="text/javascript">
  //Save the region in the window
  @isset($district)
  window.item = {!! json_encode($district) !!}
  @endisset
  //Save the parent models in the window
  window.parents = {!! json_encode($regions) !!}
  //Save the region fields in the window
  window.fields = {
    name:'', region_id: '',
  }
  //Save the baseUrl in the window
  window.baseUrl = '/api/districts'
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
            District Form
          </div>
          
          <div class="card-body d-flex justify-content-between flex-wrap">
            
            <div class="col-12">
              
              <div class="form-group">
                <label for="name">Region Name:</label>
                <select name="region_id" class="form-control"
                  v-model="form.region_id" required>
                  <option 
                    v-for="parent in parents" :key="parent.id"
                    :value="parent.id">@{{parent.name}}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="name">District Name:</label>
                <input type="text" name="name" class="form-control"
                  v-model="form.name" required>
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