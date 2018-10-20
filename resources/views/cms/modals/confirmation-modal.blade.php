@verbatim
<div class="modal" tabindex="-1" role="dialog" id="confirmation-modal"
    :class="{ 'has-loader loading': isLoading }">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You are about to delete this item.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pill btn-success"
          @click="onDelete">
          Okay</button>
        <button type="button" class="btn btn-pill btn-outline-danger" 
          data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
@endverbatim