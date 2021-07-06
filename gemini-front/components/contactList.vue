<template>
  <v-data-table
    :headers="headers"
    :items="contacts"
    :options.sync="pagination"
    item-key="id"
  >
    <template #[`item.actions`]="{ item }" >
      <v-btn dark @click="edit(item)">
        <v-icon dark>mdi-pencil</v-icon>
      </v-btn>

      <v-btn dark @click="remove(item)">
        <v-icon dark>mdi-close</v-icon>
      </v-btn>
    </template>

    <template #[`item.contactTypeId`]="{ item }" >
      {{ getContactTypeNameById(item.contactTypeId)}}
    </template>
  </v-data-table>
</template>

<script>
export default {
  name: "ContactList",
  props: {
    contacts: {
      type: Array,
      required: true,
    },
    contactTypes: {
      type: Array,
      required: true,
    },
  },
  data: () => ({
    headers: [
      { text: 'id', value: 'id'},
      { text: 'First Name', value: 'firstName' },
      { text: 'Last Name', value: 'lastName' },
      { text: 'Date Of Birth', value: 'dateOfBirth'},
      { text: 'Email', value: 'email'},
      { text: 'Telephone', value: 'telephone'},
      { text: 'Contact Type', value: 'contactTypeId'},
      { text: 'Actions', value: 'actions'},
    ],
    pagination: {
      page: 1,
      itemsPerPage: 10,
      totalItems: 0,
      sortBy: [],
      sortDesc: [],
    },
  }),
  watch: {
    async pagination() {
      await this.$emit('paginate', this.pagination)
    },
  },
  methods: {
    edit(contact){
      this.$emit('edit', contact)
    },
    remove(contact){
      this.$emit('remove', contact)
    },
    getContactTypeNameById(id){
      return this.contactTypes.find(x => x.id === id).name
    },
  }
}
</script>

<style scoped>

</style>
