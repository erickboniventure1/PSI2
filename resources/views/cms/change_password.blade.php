@extends('cms.layouts.cms')

@section('more')
<script type="text/javascript">
  //Save a dummy item in the window
  window.item = null
  //Save dummy fields in the window
  window.fields = null
  //Save dummy baseUrl in the window
  window.baseUrl = ''
</script>
@endsection

@section('content')

<div class="card">
  <div class="card-header">Change Password: </div>
  <div class="card-body">
    
    @if(request()->session()->has('message'))
      <div id="alert-success" class="alert alert-success alert-dismissible fade show"
        role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{request()->session()->pull('message')}}
      </div>
    @endif
    
    @if($errors->any())
      <div id="alert-error" class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    
    <form name="reset_password_form" id="reset_password_form"
      method="post" action="{{route('password.request')}}">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="current_password">Current Password:</option>
        <input type="password" id="current_password"
          name="current_password" class="form-control"
          placeholder="current password"
          value="{{ old('current_password') }}" autofocus>
      </div>

      <div class="form-group">
        <label for="new_password">New Password:</option>
        <input type="password" id="new_password" name="password"
          class="form-control" placeholder="new password">
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirm Password:</option>
        <input type="password" id="password_confirmation" name="password_confirmation"
          class="form-control" placeholder="confirm password">
      </div>

      <div class="form-group text-success">
        <button class="btn btn-pill btn-success" type="submit">
          Submit
        </button>
      </div>

    </form>

  </div>
</div>
@endsection
