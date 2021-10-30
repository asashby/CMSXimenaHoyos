<template>
  <div class="row">
    <vue-table :title="$t('page.categories')" :fields="fields" api-url="section" show-paginate @table-action="tableActions">
      <template slot="buttons">
        <router-link :to="{ name: 'dashboard.section.create' }" class="btn btn-sm btn-success" v-if="checkPermission('CREATE_SECTION')">{{ $t('page.create') }}</router-link>
      </template>
    </vue-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: [],
      fields: [{
          name: 'id',
          trans: 'table.id',
          titleClass: 'width-5-percent text-center',
          dataClass: 'text-center'
        }, {
          name: 'name',
          trans: 'table.name'
        },{
          name: 'created_at',
          trans: 'table.created_at'
        }, {
          name: '__actions',
          trans: 'table.action',
          titleClass: 'text-center',
          dataClass: 'text-center'
        }
      ]
    }
  },
  methods: {
    tableActions(action, data) {
      if (action == 'edit-item') {
        this.$router.push({ name: 'dashboard.section.edit', params: { id: data.id } })
      } else if (action == 'delete-item') {
        this.$http.delete('sections/' + data.id)
          .then((response) => {
            toastr.success('You delete the category success!')

            this.$emit('reload')
          }).catch(({ response }) => {
            toastr.error(response.status + ' : Resource ' + response.statusText)
          })
      }
    }
  }
}
</script>
