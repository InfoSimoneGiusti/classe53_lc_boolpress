<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1>Per contattarci usa i nostri recapiti:</h1>

          <div v-if="success" class="alert alert-success">
            Grazie, il tuo messaggio è stato inviato con successo, ti
            contatteremo quanto prima!
          </div>

          <form @submit.prevent="sendForm">
            <div class="form-group">
              <label for="name">Come ti chiami?</label>
              <input
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.name }"
                id="name"
                name="name"
                v-model="name"
              />

              <p
                v-for="(error, index) in errors.name"
                :key="'name-error-' + { index }"
                class="invalid-feedback"
              >
                {{ error }}
              </p>
            </div>

            <div class="form-group">
              <label for="email">La tua email?</label>
              <input
                type="email"
                class="form-control"
                :class="{ 'is-invalid': errors.email }"
                id="email"
                name="email"
                v-model="email"
              />
              <p
                v-for="(error, index) in errors.email"
                :key="'name-error-' + { index }"
                class="invalid-feedback"
              >
                {{ error }}
              </p>
            </div>

            <div class="form-group">
              <label for="message">Come possiamo aiutarti?</label>
              <textarea
                class="form-control"
                :class="{ 'is-invalid': errors.message }"
                id="message"
                rows="10"
                name="message"
                v-model="message"
              ></textarea>

              <p
                v-for="(error, index) in errors.message"
                :key="'name-error-' + { index }"
                class="invalid-feedback"
              >
                {{ error }}
              </p>
            </div>

            <button type="submit" class="btn btn-primary">
              {{ loading ? "Invio in corso" : "Invia" }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Contact",

  data() {
    return {
      name: "",
      email: "",
      message: "",
      success: false,
      errors: {},
      loading: false,
    };
  },

  methods: {
    sendForm() {
      this.loading = true;
      this.success = false;
      axios
        .post("/api/contacts", {
          name: this.name,
          email: this.email,
          message: this.message,
        })
        .then((response) => {
          if (response.data.success) {
            //se l'email è stata inviata
            this.success = true;
            this.name = "";
            this.email = "";
            this.message = "";
            this.errors = {};
            this.loading = false;
          } else {
            //se l'invio è fallito
            this.success = false;
            this.errors = response.data.errors;
            this.loading = false;
          }
        });
    },
  },
};
</script>

<style>
</style>
