<div id="success-alert" class="alert alert-success alert-dismissible fade show"
  role="alert" style="display:none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  Operation Successful
</div>

<div id="error-alert" class="alert alert-danger alert-dismissible fade show"
  role="alert" v-show="showError">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    @{{ errorMessage }}
</div>


