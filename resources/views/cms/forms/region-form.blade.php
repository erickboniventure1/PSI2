@extends('cms.layouts.cms')

@section('more')
<script type="text/javascript">
  //Save the region in the window
  @isset($region)
  window.item = {!! json_encode($region) !!}
  @endisset
  //Save the region fields in the window
  window.fields = {
    name:'',
  }
  //Save the baseUrl in the window
  window.baseUrl = '/api/regions'
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
            Region Form
          </div>
          
          <div class="card-body d-flex justify-content-between flex-wrap">
            
            <div class="col-12">
              
              <div class="form-group">
                <label for="name">Name:</label>
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
        </div>
       </form>

    <div class="card-footer">
    <input type="file" name="import_file" />
    <button type="submit" 
              class="btn btn-pill btn-success btn-lg float-right">
              Import File
            </button>
          </div>
        </div>

@endsection