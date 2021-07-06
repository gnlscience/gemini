export const state = () => ({
  contactTypes: [],
})

export const mutations = {
  setContactTypes(state, contactTypes) {
    state.contactTypes = contactTypes
  },
}

export const actions = {
  async getAll({ commit, state, dispatch }, query) {
    const url = '/api/contactType/getAll'
    const { data } = await this.$axios.get(url)
    commit('setContactTypes', data)
  },
}
