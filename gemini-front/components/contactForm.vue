<template>
    <v-card>
      <v-card-title class="text-h5">
        {{ editContact ? "Edit" : "New" }} Contact
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="editContact.firstName"
                label="First Name"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="editContact.lastName"
                label="Last Name"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-menu
                v-model="fromDateMenu"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                full-width
                max-width="290px"
                min-width="290px"
              >
                <template #activator="{ on }">
                  <v-text-field
                    label="Date of Birth"
                    :value="editContact.dateOfBirth"
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker
                  v-model="editContact.dateOfBirth"
                  no-title
                  @input="fromDateMenu = false"
                ></v-date-picker>
              </v-menu>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="editContact.email"
                label="Email"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-text-field
                v-model="editContact.telephone"
                label="Telephone"
              ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
              <v-select
                v-model="editContact.contactTypeId"
                :items="contactTypes"
                item-text="name"
                item-value="id"
                label="Contact Type"
              ></v-select>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
      <v-divider></v-divider>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="primary"
          text
          @click="save"
        >
          Add
        </v-btn>
      </v-card-actions>
    </v-card>
</template>

<script>

export default {
  name: "ContactForm",
  props: {
    contact: {
      type: Object,
      required: true,
    },
    contactTypes: {
      type: Array,
      required: true,
    },
  },
  data: () => ({
    fromDateMenu: null,
  }),
  computed: {
    editContact(){
      return {...this.contact}
    },
  },
  methods:{
    save(){
      this.$v.editContact.$touch()
      this.$emit('save', this.editContact)
    },
  },
}
</script>

<style scoped>

</style>
