var table = null

$(function () {
      
  table = $("#she-table").DataTable({
    iDisplayLength: 6,
    bLengthChange: false,
    order: [[0, 'desc']],
  })
  
  $(":password").keydown(function() {
    $("#alert-error").fadeOut(0)
  })
  
  setTimeout(function () {
    $("#alert-success").slideUp("slow")
  }, 2000)
  
  // $('[data-toggle="datepicker"]').datepicker({
  //     format: 'yyyy-mm-dd',
  //     autoHide: true
  // })
  // 
  // $("#year-picker").datepicker({
  //     format: 'yyyy',
  //     autoHide: true
  // })
  
})

function showModal(id) {
  $('#' + id).modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  })
}

function closeModal(id) {
  $("#" + id).modal('hide')
  $('body').removeClass("modal-open")
  $('body').removeAttr('style')
  $(".modal-backdrop").remove()
}

function showHideAlert(id) {
  $("#" + id).fadeTo(2000, 500).slideUp(500, function(){
    $("#" + id).slideUp(500)
  })
}

/**
 * Our root vue instance where much of the magic happens.
 * Such magic includes, automatically updating datatable
 * when delete, edit and create opeations are performed
 */
var vm = new Vue({
  el:'#vue-container',
  data: {
    form: {},
    parents: [],
    parents2: [],
    parents3: [],
    file: null,
    deleteId: '', 
    index: '',
    action: '',
    errorMessage: '',
    showError: false,
    isLoading: false,
  },
  created() {    
    //Retrieve item from the window
    if(window.item !== undefined) {
      this.action = 'update'
      this.form = item
    } else if(window.fields !== undefined){
      // Retrieve fields from the window
      this.action = 'create'
      this.copyFields(fields, this.form)
    }
    if (window.parents !== undefined) {
      this.parents = parents
    }
    if (window.parents2 !== undefined) {
      this.parents2 = parents2
    }
  },
  mounted() {
    //Set up data-binding on date-pickers
    // $(".date-picker").on("hide.datepicker", () => {
    //   var _this = this
    //   setTimeout(function() {
    //     let date = $(".date-picker").val()
    //     if(_this.form.date !== undefined) {
    //       _this.form.date = date
    //     } else {
    //       _this.form.year_finished = date
    //     }
    //   }, 10)
    // })
  },
  computed: {
    showPlaceHolder() {
      return (this.action == 'create') && (this.file != null)
    },
    showPicture() {
      return this.action == 'update' 
    },
    showIcon() {
      return !this.showPicture && !this.showPlaceHolder
    },
  },
  methods: {
    copyFields(src, dest) {
      for(let field in src) {
        Vue.set(dest, field, src[field])
      }
    },
    resetFields(obj) {
      for(let field in obj) {
        Vue.set(obj, field, "")
      }
    },
    onSubmit() {
      if(this.action === 'create') {
        this.onCreate()
      } else {
        this.onSave()
      }
      $('html,body').animate({ scrollTop: 0 }, 'slow');
    },
    onCreate() {
      this.isLoading = true
      let payload = this.getPayload()
      if(this.file) {
        payload.append('picture', this.file)
      }
      axios.post(baseUrl, payload)
           .then(({data}) => {
             this.isLoading = false
             this.resetFields(this.form)
             this.file = null
             showHideAlert('success-alert')
           })
           .catch(error => {
             console.error(error)
             this.isLoading = false
             this.errorMessage = error.response.data.message
             this.showError = true
           }) 
    },
    onSave() {
      this.isLoading = true
      let payload = this.getPayload()
      payload.append('_method', 'PATCH')
      axios.post(baseUrl + "/" + this.form.id, payload, {
              headers: {'Content-Type': 'multipart/form-data'}})
           .then(({data}) => {
             this.form = data
             this.isLoading = false
             showHideAlert('success-alert')
           })
           .catch(error => {
             console.error(error)
             this.isLoading = false
             this.errorMessage = error.response.data.message
             this.showError = true
           })
    },
    getPayload() {
      let formData = new FormData()
      for(let field in this.form) {
        if(field == 'picture' || field == 'id') continue
        formData.append(field, this.form[field])
      }
      return formData
    },
    onConfirm(deleteId, ev) {
      target = ev.target
      if(target.value == 'delete' || target.className == 'fa fa-trash') {
        this.deleteId = deleteId
        this.index = table.row( ev.currentTarget ).index()
        showModal('confirmation-modal')
      }
    },
    onDelete() {
      closeModal('confirmation-modal')
      this.isLoading = true
      axios.delete(baseUrl + "/" + this.deleteId)
           .then(({data}) => {
             this.isLoading = false
             closeModal('confirmation-modal')
             table.row(this.index).remove().draw()
             showHideAlert('success-alert')
           })
           .catch(error => {
             console.error(error)
             this.isLoading = false
           }) 
    },
    onUpload() {
      $("#file-input").click()
    },
    onFileUploaded(event) {
      let file = event.target.files[0];
      let formData = new FormData();
      if(file) {
        formData.append('picture', file);
        formData.append('_method', 'PATCH');
      }
      if(this.action == 'update') {
        this.onReplace(formData)
      } else {
        this.onAttach(file)
      }
    },
    onAttach(file) {
      this.file = file
    },
    onReplace(file) {
      this.isLoading = true
      axios.post(baseUrl + "/" + this.form.id + "/picture",
                  file, {headers: {'Content-Type': 'multipart/form-data'}})
           .then(({data}) => {
             this.form.picture = data
             this.isLoading = false
             showHideAlert('success-alert')
           })
           .catch(error => {
             console.error(error)
             this.isLoading = false
             this.errorMessage = error.response.data.message
             this.showError = true
           })
    },
    fetchChildren() {
      let selectedParentId = this.form.region_id
      axios.get(baseUrl + "/regions/" + selectedParentId + "/districts")
           .then(response => this.parents3 = response.data)
    },
  }
})