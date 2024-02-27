<template>
  <div class="signUp-container">
    <div class="signUp-form">
      <form @submit.prevent="addUser" class="form" enctype="multipart/form-data">
        <h2 class="form-title"><i class="bi bi-person-plus-fill"></i> Sign Up</h2>

        <div class="form-group">
          <label for="createName"><i class="bi bi-person-fill"></i> Name</label>
          <input
            type="text"
            class="form-control"
            id="createName"
            placeholder="Foulen Ben Foulen"
            v-model="name"
          />
        </div>

        <div class="form-group">
          <label for="createUserEmail"><i class="bi bi-envelope-fill"></i> Email</label>
          <input
            type="text"
            class="form-control"
            id="createUserEmail"
            placeholder="Email"
            v-model="email"
          />
        </div>

        <div class="form-group">
          <label for="createPassword"><i class="bi bi-lock-fill"></i> Password</label>
          <input
            type="password"
            class="form-control"
            id="createPassword"
            placeholder="Password"
            v-model="password"
          />
        </div>

        <div class="form-group">
          <label for="photo" class="input-label"><i class="bi bi-file-image-fill"></i> Upload User Photo:</label>
          <div class="input-group">
            <input type="file" ref="photo" @change="uploadFile" id="photo" class="form-control file-input" />
            <div class="input-group-append">
              <label for="photo" class="btn btn-outline-secondary file-label"><i class="bi bi-folder-plus"></i></label>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i> Sign Up</button>
      </form>

      <div class="pic"></div>
    </div>
  </div>
</template>

<script>
import UserService from "@/services/UsersService/UsersService.js";

export default {
  name: "SignUpView",
  data() {
    return {
      name: "",
      email: "",
      password: null,
      image: null,
    };
  },
  methods: {
    uploadFile() {
      this.image = this.$refs.photo.files[0];
    },
    addUser() {
      UserService.signUp({
        name: this.name,
        email: this.email,
        password: this.password,
        photo: this.image,
      }).then((res) => {
         this.$router.push({name:"LoginUser"});
      }).catch((error)=>{
        console.log(error);
      });
    },
  },
};
</script>

<style scoped>
.signUp-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: linear-gradient(to right, #536dfe, #7e57c2);
}

.signUp-form {
  background-color: #fff;
  border-radius: 16px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  max-width: 400px;
  width: 100%;
}

.form {
  padding: 2rem;
  text-align: center;
}

.form-title {
  color: #536dfe;
  font-size: 24px;
  margin-bottom: 2rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-control {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  outline: none;
}

.file-input {
  display: none;
}

.file-label {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}

.input-group-append {
  cursor: pointer;
}

.btn-primary {
  background-color: #536dfe;
  color: white;
  width: 100%;
  padding: 15px;
  font-size: 18px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #3f51b5;
}

.pic {
  background-size: cover;
  background-position: center;
  height: 100px;
  margin-top: 1rem;
  border-radius: 16px;
  background-image: linear-gradient(to right, #3f51b5, #536dfe);
}
</style>
