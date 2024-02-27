<template>
  <div class="changer-password-container">
    <h1><i class="bi bi-shield-lock"></i> Changer Password</h1>
    <form @submit.prevent="submitForm" class="changer-password-form">
      <label for="email"><i class="bi bi-envelope-fill"></i> Email:</label>
      <input type="email" id="email" v-model="email" required>

      <label for="password"><i class="bi bi-shield-lock-fill"></i> New Password:</label>
      <input type="password" id="password" v-model="password" required>

      <label for="confirmPassword"><i class="bi bi-shield-lock-fill"></i> Confirm Password:</label>
      <input type="password" id="confirmPassword" v-model="confirmPassword" required>

      <label for="code"><i class="bi bi-shield-code"></i> Code:</label>
      <input type="text" id="code" v-model="code" required>

      <button type="submit"><i class="bi bi-arrow-repeat"></i> Reset</button>
    </form>
  </div>
</template>

<script>
import ResetPasswordService from '@/services/ResetPassword/reset_password';

export default {
  data() {
    return {
      email: '',
      password: '',
      confirmPassword: '',
      code: ''
    };
  },
  methods: {
    submitForm() {
      ResetPasswordService.ChangerPassword({
        email: this.email,
        password: this.password,
        code: this.code
      }).then((res) => {
        this.$router.push({ name: "LoginUser" });
      });
    },
  },
};
</script>

<style scoped>
.changer-password-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f9f9f9;
}

.changer-password-form {
  max-width: 300px;
  width: 100%;
  margin-top: 20px;
  background-color: #fff;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease-in-out;
}

.changer-password-form:hover {
  transform: scale(1.02);
}

h1 {
  color: #333;
  font-size: 28px; /* Increased font size for emphasis */
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 8px;
  color: #555;
}

input {
  width: 100%;
  padding: 12px; /* Increased padding for better visual appeal */
  margin-bottom: 15px;
  box-sizing: border-box;
  border: 1px solid #ddd;
  border-radius: 8px;
  transition: border-color 0.3s ease;
}

input:focus {
  border-color: #5cb85c;
}

button {
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

button:hover {
  background-color: #45a049;
}
</style>
