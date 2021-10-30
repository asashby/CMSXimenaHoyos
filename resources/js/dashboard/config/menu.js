import Vue from 'vue'

export default [{
  label: 'sidebar.dashboard',
  icon: 'fas fa-tachometer-alt',
  uri: { name: 'dashboard.home' }
}, {
  label: 'sidebar.modules.content',
  children: [{
    label: 'Articulos',
    permission: 'LIST_ARTICLE',
    icon: 'fas fa-book',
    uri: { name: 'dashboard.article' }
  },{
    label: 'Secciones',
    permission: 'LIST_SECTION',
    icon: 'fas fa-list-alt',
    uri: { name: 'dashboard.sections' }
  },{
    label: 'Cursos',
    permission: 'LIST_COURSE',
    icon: 'fas fa-list-alt',
    uri: { name: 'dashboard.course' }
  },{
    label: 'Unidades',
    permission: 'LIST_UNIT',
    icon: 'fas fa-list-alt',
    uri: { name: 'dashboard.unit'  }
  },{
    label: 'Preguntas',
    permission: 'LIST_QUESTION',
    icon: 'fas fa-list-alt',
    uri: { name: 'dashboard.question'  }
  }]
}, {
  label: 'sidebar.modules.base',
  children: [{
    label: 'sidebar.user',
    permission: 'LIST_USER',
    icon: 'fas fa-users',
    uri: { name: 'dashboard.user' }
  }, {
    label: 'sidebar.file',
    permission: 'LIST_FILE',
    icon: 'fas fa-folder',
    uri: { name: 'dashboard.file' }
  }],
}, {
  label: 'sidebar.modules.system',
  children: [{
    label: 'sidebar.visitor',
    permission: 'LIST_VISITOR',
    icon: 'fas fa-eye',
    uri: { name: 'dashboard.visitor' }
  }, {
    label: 'sidebar.role',
    permission: 'LIST_ROLE',
    icon: 'fas fa-exclamation-triangle',
    uri: { name: 'dashboard.role' }
  }, {
    label: 'sidebar.system',
    permission: 'LIST_SYSTEM_INFO',
    icon: 'fas fa-cogs',
    uri: { name: 'dashboard.system' }
  }]
}]
