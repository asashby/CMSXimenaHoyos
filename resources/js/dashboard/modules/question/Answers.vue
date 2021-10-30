<template>
  <div class="row">
    <vue-table :title="$t('page.answers')" :fields="fields" :api-url="url_answers" :item-actions="itemActions"
               @table-action="tableActions" show-paginate>
      <template slot="buttons">
        <button type="button" class="btn btn-success btn-sm" @click="show"
                v-if="checkPermission('CREATE_ANSWER')">{{$t('form.new')}}
        </button>
        <router-link :to="{ name: 'dashboard.question' }" class="btn btn-sm btn-secondary ml-2" exact>{{
            $t('form.back')
          }}
        </router-link>
      </template>
    </vue-table>

    <modal :show="showFolder" @confirm="confirm" @cancel="cancel" :large="true" show-footer>
      <template slot="title">{{ $t('form.new_answer') }}</template>
      <form>
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">{{ $t('form.title') }}</label>
          <div class="col-sm-10">
            <input type="text" id="title" name="title" v-model="title" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="message" class="col-form-label col-sm-2">{{ $t('form.message') }}</label>
          <div class="col-sm-10">
            <input type="text" id="message" name="message" class="form-control" v-model="message">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-2 col-form-label">
            {{ $t('form.status_answer') }}
          </div>
          <div class="col-sm-2">
            <div class="togglebutton" style="margin-top: 6px">
              <label>
                <input type="checkbox" name="status" v-model="status">
                <span class="toggle"></span>
              </label>
            </div>
          </div>
          <div class="col-sm-2 col-form-label">
            {{ $t('form.is_correct') }}
          </div>
          <div class="col-sm-2">
            <div class="togglebutton" style="margin-top: 6px">
              <label>
                <input type="checkbox" name="is_correct" v-model="is_correct">
                <span class="toggle"></span>
              </label>
            </div>
          </div>
        </div>
      </form>
    </modal>
  </div>
</template>

<script>
import Modal from 'dashboard/components/Modal'
import Multiselect from 'vue-multiselect'

export default {
  components: {
    Modal,
    Multiselect
  },
  data() {
    return {
      url_answers: 'answers/' + this.$route.params.id,
      showFolder: false,
      id: null,
      question_id: '',
      title: '',
      message: '',
      is_correct: false,
      status: false,
      anwser_obj: {
        question_id: '',
        title: '',
        message: '',
        is_activated: false,
        status: false,
      },
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
        name: 'message',
        trans: 'table.message',
        sortField: 'message',
      }, {
        name: '__component',
        trans: 'table.status_answer',
        titleClass: 'text-center',
        dataClass: 'text-center'
      }, {
        name: '__activated',
        trans: 'table.is_correct',
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
        {name: 'edit-item', permission: 'UPDATE_ANSWER', icon: 'fas fa-pencil-alt', class: 'btn btn-info'},
        {name: 'delete-item', permission: 'DESTROY_ANSWER', icon: 'fas fa-trash-alt', class: 'btn btn-danger'}
      ]
    }
  },
  methods: {
    show() {
      this.showFolder = true
      this.question_id = this.$route.params.id
    },
    confirm() {
      this.anwser_obj.question_id = this.question_id
      this.anwser_obj.title = this.title
      this.anwser_obj.message = this.message
      this.anwser_obj.is_activated = this.is_correct ? 1 : 0
      this.anwser_obj.status = this.status ? 1 : 0
      let url = this.id ? 'answers/' + this.question_id + '/' + this.id : 'answers/' + this.question_id
      let method = this.id ? 'patch' : 'post'

      this.$http[method](url, this.anwser_obj)
        .then((response) => {
          toastr.success('¡Opción modificada  con exíto!')
          this.cancel()
          this.$emit('reload')
        }).catch(({response}) => {
        if (response.data.error) {
          toastr.error(response.data.error.message)
        } else {
          toastr.error(response.status + ' : Resource ' + response.statusText)
        }
      })
    },
    cancel() {
      this.id = null
      this.question_id = ''
      this.title = ''
      this.message = ''
      this.status = false
      this.is_correct = false
      this.showFolder = false
    },
    loadData(data) {
      this.showFolder = true
      this.question_id = data.question_id
      this.title = data.title
      this.message = data.message
      this.status = data.status
      this.is_correct = data.is_activated
    },
    tableActions(action, data) {
      if (action == 'edit-item') {
        this.id = data.id
        this.loadData(data)
      } else if (action == 'delete-item') {
        this.$http.delete('answers/' + this.$route.params.id + '/' + data.id)
          .then((response) => {
            toastr.success('Unidad eliminada satistactoriamente')

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
  }
}
</script>
