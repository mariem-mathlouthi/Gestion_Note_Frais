<template>
  <div class="forgot-password-container">
    <h1><i class="bi bi-shield-check"></i> Mot de passe oublié</h1>
    <form @submit.prevent="submitForm" class="forgot-password-form">
      <label for="email"><i class="bi bi-envelope-fill"></i> Email:</label>
      <div class="input-wrapper">
        <input type="email" id="email" v-model="email" required>
      </div>
      <button type="submit"><i class="bi bi-arrow-right-circle-fill"></i> Submit</button>
    </form>
  </div>
</template>

<script>
import ResetPasswordService from '@/services/ResetPassword/reset_password';

export default {
  data() {
    return {
      email: '',
    };
  },
  methods: {
    submitForm() {
      ResetPasswordService.ForgotPassword({ email: this.email }).then((res) => {
        this.$router.push({ name: "LoginUser" });
      });
    },
  },
};
</script>

<style scoped>
.forgot-password-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f0f0f0;
}

.forgot-password-form {
  max-width: 300px;
  width: 100%;
  margin-top: 20px;
  background-color: #fff;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

h1 {
  color: #333;
  font-size: 28px;
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 8px;
  color: #555;
}

.input-wrapper {
  position: relative;
}

input {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  box-sizing: border-box;
  border: 1px solid #ddd;
  border-radius: 8px;
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
  background-color: #4cae4c;
}
</style>
