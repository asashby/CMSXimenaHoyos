<template>
  <div class="row">
    <vue-table :title="$t('page.units')" :fields="fields" :api-url="api_url" :item-actions="itemActions"
               @table-action="tableActions" show-paginate>
      <template slot="buttons">
        <router-link :to="{ name: 'dashboard.unit.create' }" class="btn btn-sm btn-success ml-2 mr-2"
                     v-if="checkPermission('CREATE_UNIT')">{{ $t('page.create') }}
        </router-link>
        <router-link :to="{ name: 'dashboard.course' }" class="btn btn-sm btn-secondary" exact>{{
            $t('form.back')
          }}
        </router-link>
      </template>
    </vue-table>

  </div>
</template>

<script>
export default {
  data() {
    return {
      api_url: 'courses/units/' + this.$route.params.id,
      fields: [{
        name: 'id',
        trans: 'table.id',
        titleClass: 'width-5-percent text-center',
        dataClass: 'text-center'
      }, {
        name: 'title',
        trans: 'table.title',
        sortField: 'title',
      }, {
        name: 'content',
        trans: 'table.content',
        sortField: 'content',
      }, {
        name: 'course_name',
        trans: 'table.course',
        titleClass: 'width-50-percent',
        sortField: 'course_name'
      }, {
        name: 'order',
        trans: 'table.order',
        titleClass: 'width-7-percent',
        sortField: 'order'
      },{
        name: '__activated',
        trans: 'table.status',
        titleClass: 'text-center',
        dataClass: 'text-center'
      }, {
        name: '__actions',
        trans: 'table.action',
        titleClass: 'text-center',
        dataClass: 'text-center',
      }
      ],
      itemActions: [
        {name: 'edit-item', permission: 'UPDATE_UNIT', icon: 'fas fa-pencil-alt', class: 'btn btn-info'},
        {name: 'delete-item', permission: 'DESTROY_UNIT', icon: 'fas fa-trash-alt', class: 'btn btn-danger'}
      ]
    }
  },

  methods: {
    tableActions(action, data) {
      if (action == 'edit-item') {
        this.$router.push({name: 'dashboard.unit.edit', params: {id: data.id}})
      } else if (action == 'delete-item') {
        this.$http.delete('units/' + data.id)
          .then((response) => {
            toastr.success('Eliminado satisfactoriamente')

            this.$emit('reload')
          }).catch(({response}) => {
          if ((typeof response.data.error !== 'string') && response.data.error) {
            toastr.error(response.data.error.message)
          } else {
            toastr.error(response.status + ' : Resource ' + response.statusText)
          }
        })
      }
    }
  },

}
</script>
