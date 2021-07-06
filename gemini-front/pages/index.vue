<template>
  <div>
    <ContactList :contacts="contacts" :contact-types="contactTypes" @paginate="fetchContacts" @edit="openForm" @remove="removeContact"/>
    <v-btn block @click="openForm()">
      Add Contact
    </v-btn>
    <v-dialog
      v-model="showForm"
      width="500"
    >
      <ContactForm :contact="selectedContact" :contact-types="contactTypes" @save="saveSelectedContact"/>
    </v-dialog>

  </div>
</template>

<script>

import ContactList from "../components/contactList";
import ContactForm from "../components/contactForm";
export default {
  components: {ContactForm, ContactList  },
  async asyncData({ store }) {
    await store.dispatch('contacts/getAll', { start: 0, size: 10 });
    const contacts = store.state.contacts.contacts
    await store.dispatch('contactTypes/getAll');
    const contactTypes = store.state.contactTypes.contactTypes
    return {
      contacts,
      contactTypes
    };
  },
  data: () => ({
    contactTypes: [],
    selectedContact: {
      id: null,
      firstName: null,
      lastName: null,
      dateOfBirth: null,
      email: null,
      telephone: null,
      contactTypeId: null,
    },
    showForm: false,
  }),
  methods: {
    async fetchContacts(pagination){
      await this.$store.dispatch('contacts/getAll', { start: pagination.itemsPerPage * (pagination.page - 1), size: pagination.itemsPerPage })
    },
    openForm(contact){
      console.log('contact', contact)
      if(contact){
        this.selectedContact = contact
        this.showForm = true
        return
      }
      this.selectedContact =  {
        id: null,
        firstName: null,
        lastName: null,
        dateOfBirth: null,
        email: null,
        telephone: null,
      }
      this.showForm = true

    },
    async saveSelectedContact(selectedContact){
      try {
        if(selectedContact.id){
          await this.$store.dispatch('contacts/update', selectedContact)
        }
        if(!selectedContact.id){
          await this.$store.dispatch('contacts/create', selectedContact)
        }
      } catch (e) {
      } finally {
        this.contacts = this.$store.state.contacts.contacts
        this.showForm = false
      }

    },
    async removeContact(contact){
      try {
        await this.$store.dispatch('contacts/remove', contact)
      }catch (e) {
      } finally {
        this.contacts = this.$store.state.contacts.contacts
      }
    }
  }
}
</script>
