process.env.DEBUG = 'nuxt:*'


export const state = () => ({
  contacts: [],
})

export const mutations = {
  setContacts(state, contacts) {
    state.contacts = contacts
  },
  addNewContact(state, contact){
    state.contacts.unshift(contact)
  },
  updateContacts(state, contact){
    state.contacts = state.contacts.map(c => {
      if (c.id === contact.id) {
        return {
          ...c,
          ...contact,
        }
      }
      return c
    })
  },
  removeContact(state, contact){
    state.contacts = state.contacts.filter(c => c.id !== contact.id)
  }
}

export const actions = {
  async getAll({ commit, state, dispatch }, pagination) {
    const url = `/api/contact/getAll/${pagination.start}/${pagination.size}`
    const { data } = await this.$axios.get(url)
    commit('setContacts', data)
  },

  async create({ commit, state, dispatch }, contact) {
    const url = '/api/contact/create'
    const { data } = await this.$axios.post(url, contact)
    commit('addNewContact', data)
  },

  async update({ commit, state, dispatch }, contact) {
    const url = `/api/contact/update/${contact.id}`
    const { data } = await this.$axios.post(url, contact)
    commit('updateContacts', data)
  },

  async remove({ commit, state, dispatch }, contact) {
    const url = `/api/contact/delete/${contact.id}`
    await this.$axios.post(url)
    commit('removeContact', contact)
  },
}
