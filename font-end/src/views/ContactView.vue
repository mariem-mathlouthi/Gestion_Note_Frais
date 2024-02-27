<template>
    <div>
      <article class="contact py-5" data-aos="fade-up">
        <div class="container">
          <div class="text-center py-4">
            <h2 class="text-uppercase">Contact Us</h2>
          </div>
          <form @submit.prevent="Onsubmit" class="shadow p-4 m-3 rounded bg-light">
            <h4 class="fw-bolder text-primary mb-4">Get In Touch</h4>
            <p class="text-muted">
              We are here for you! How can we help?
            </p>
            <div v-if="afficher_error" class="alert alert-danger">
              {{ error }}
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <input
                    type="text"
                    @keyup="validate('name')"
                    @click="validate('name')"
                    v-model="name"
                    :class="{ 'form-control': true, 'is-invalid': name_error !== '' }"
                    placeholder="Enter your name"
                  />
                  <small v-if="name_error !== ''" class="text-danger">
                    {{ name_error }}
                  </small>
                </div>
                <div class="mb-3">
                  <input
                    type="email"
                    v-model="email"
                    @keyup="validate('email')"
                    @click="validate('email')"
                    placeholder="Enter your email address"
                    :class="{ 'form-control': true, 'is-invalid': email_error !== '' }"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                  />
                  <small v-if="email_error !== ''" class="text-danger">
                    {{ email_error }}
                  </small>
                </div>
                <div class="mb-3">
                  <textarea
                    placeholder="Go ahead, we are listening"
                    :class="{ 'form-control': true, 'is-invalid': messages_error !== '' }"
                    @keyup="validate('messages')"
                    @click="validate('messages')"
                    style="outline: none; border: none; padding: 10px; resize: vertical;"
                    v-model="messages"
                    cols="20"
                    rows="5"
                  ></textarea>
                  <small v-if="messages_error !== ''" class="text-danger">
                    {{ messages_error }}
                  </small>
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block">
                  Send
                </button>
              </div>
              <div class="col-sm-6 text-center">
                <div class="mb-3">
                  <Vue3Lottie
                    data-aos="zoom-out"
                    data-aos-delay="50"
                    
                    style="width: 100%; height: 100%"
                  />
                </div>
                <div class="text-left">
                  <address>
                   <!-- <div class="mb-3">
                      <strong>Bizerte</strong> <span class="text-danger">❤</span>
                    </div>-->
                    <div class="mb-3">
                      <strong>Phone:</strong> +21651007576
                    </div>
                    <div>
                      <strong>Email:</strong> costsavvy@gmail.com
                    </div>
                  </address>
                </div>
              </div>
            </div>
          </form>
        </div>
      </article>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        messages: "",
        name: "",
        email: "",
        name_error: "",
        email_error: "",
        messages_error: "",
        afficher_error: 0,
        error: "",
      };
    },
    created() {
      this.loadDataFromLocalStorage();
    },
    methods: {
      loadDataFromLocalStorage() {
        this.messages = localStorage.getItem('contact_messages') || "";
        this.name = localStorage.getItem('contact_name') || "";
        this.email = localStorage.getItem('contact_email') || "";
      },
      show_hide() {
        this.afficher_error = 1;
        setTimeout(() => (this.afficher_error = 0), 4000);
      },
      Onsubmit() {
        let valid = this.validate('name') && this.validate('email') && this.validate('messages');
        if (valid) {
          localStorage.setItem('contact_messages', this.messages);
          localStorage.setItem('contact_name', this.name);
          localStorage.setItem('contact_email', this.email);
          console.log("Form submitted successfully!");
        }
      },
      validate(input) {
        if (input === "name") {
          if (this.name === "") {
            this.name_error = "Name required";
          } else if (this.name.length < 5) {
            this.name_error = "Name must be greater than 5 characters";
          } else {
            this.name_error = "";
            return true;
          }
        } else if (input === "email") {
          if (this.email === "") {
            this.email_error = "Email required";
          } else if (
            !String(this.email)
              .toLowerCase()
              .match(
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
              )
          ) {
            this.email_error = "Please enter a valid email";
          } else {
            this.email_error = "";
            return true;
          }
        } else if (input === "messages") {
          if (this.messages === "") {
            this.messages_error = "Message required";
          } else if (this.messages.length < 5) {
            this.messages_error = "Message must be at least 5 chars long";
          } else {
            this.messages_error = "";
            return true;
          }
        }
        return false;
      },
    },
  };
  </script>
  
  
  <style scoped>
  .move_input {
    animation: animate 0.5s;
  }
  
  @keyframes animate {
    0% {
      transform: translateX(10px);
    }
    50% {
      transform: translateX(-10px);
    }
    100% {
      transform: translateX(0);
    }
  }
  h4{
    text-align: center;
  }
  
  </style>