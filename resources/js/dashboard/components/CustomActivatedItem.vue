<template>
  <span :style="{color: color}" @click="setStatus(rowData)"><i class="fas fa-circle"></i></span>
</template>

<script>
export default{
  props: {
    rowData: {
      type: Object,
      required: true
    },
    apiUrl: {
      type: String,
      required: true
    }
  },
  computed: {
    color() {
      return this.rowData.is_activated ? '#4fcf5d' : '#bf5329'
    }
  },
  methods: {
    setStatus(rowData) {
      let index = this
      swal({
        title: "Cambiar el estado del registro",
        text: "La acción puede afectar algunos datos, piénselo dos veces!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, cambiar!",
      }).then(function (result) {
        result.value && index.postData(rowData)
      })
    },
    postData(rowData) {
      this.$http.post(this.apiUrl + '/' + rowData.id + '/status', {is_activated: !rowData.is_activated})
          .then((response) => {
            this.rowData.is_activated = !this.rowData.is_activated
            if (this.rowData.is_activated) {
              toastr.success('¡Registro activado satisfactoriamente!')
            } else {
              toastr.warning('¡Haz desactivado un registro exisitosamente!')
            }
          }).catch((response) => {
            if (response.data.error) {
              toastr.error(response.data.error.message)
            } else {
              toastr.error(response.status + ' : Resource ' + response.statusText)
            }
          })
    }
  }
}
</script>

<style lang="scss" scoped>
span {
  cursor:pointer;
}
</style>
