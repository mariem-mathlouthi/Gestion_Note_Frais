<template>
  <div class="login-container">
    <div class="login-form">
      <form @submit.prevent="loginUser" class="form">
        <h2><i class="bi bi-box-arrow-in-right"></i> Login</h2>

        <div class="form-group">
          <label for="createUserEmail"><i class="bi bi-envelope-fill"></i> Email</label>
          <div class="input-group">
            <input
              type="text"
              class="form-control"
              id="createUserEmail"
              placeholder="Your email"
              v-model="email"
            />
          </div>
        </div>

        <div class="form-group">
          <label for="createPassword"><i class="bi bi-lock-fill"></i> Password</label>
          <div class="input-group">
            <input
              type="password"
              class="form-control"
              id="createPassword"
              placeholder="Your password"
              v-model="password"
            />
          </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Login</button>
        <div class="form-links">
          <router-link to="/singUp"><i class="bi bi-person-plus-fill"></i> Create new account</router-link>
          <router-link to="/forgot_password"><i class="bi bi-question-circle-fill"></i> Forgot Password?</router-link>
        </div>
      </form>

      <div class="pic"></div>
    </div>
  </div>
</template>

<script>
import { AuthStore } from "../store/index.js";
import UserService from "@/services/UsersService/UsersService.js";

export default {
  name: "LoginView",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  setup() {
    const store = AuthStore();
    return { store };
  },
  methods: {
    loginUser() {
      UserService.loginUser(this.email, this.password).then((res) => {
        const auth = AuthStore();
        if (auth.getisadmin == 1) {
          this.$router.push({ name: "DepenseView" });
        } else {
          this.$router.push({ name: "DashboardView" });
        }
        console.log(res);
      });
    },
  },
};
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: linear-gradient(to right, #536dfe, #7e57c2);
}

.login-form {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  max-width: 400px;
  width: 100%;
}

.form {
  padding: 2rem;
  text-align: center;
}

h2 {
  color: #4d68a1;
  margin-bottom: 1.5rem;
  font-size: 2rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.input-group {
  position: relative;
}

.input-group input {
  width: 100%;
  padding: 15px;
  font-size: 16px;
  border: none;
  border-bottom: 2px solid #ccc;
  border-radius: 0;
  outline: none;
  transition: border-bottom-color 0.3s ease;
}

.input-group input:focus {
  border-bottom-color: #4d68a1;
}

.form-links {
  margin-top: 10px;
  display: flex;
  justify-content: space-between;
}

.form-links router-link {
  color: #8e85da;
  text-decoration: none;
  cursor: pointer;
}

.form-links router-link:hover {
  text-decoration: underline;
}

.btn-primary {
  background-color: #4d68a1;
  color: white;
  width: 100%;
  padding: 15px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #364d79;
}
</style>
