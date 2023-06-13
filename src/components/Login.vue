<template>
  <div class="authorization-container">
    <h2 class="authorization-title">Авторизация</h2>
    <form @submit.prevent="login" class="authorization-form">
      <label class="form-label">
        Номер пользователя:<br>
        <input style="min-width: 320px" type="text" v-model="phone" required class="form-input">
      </label>
      <label class="form-label">
        Пароль:<br>
        <input style="min-width: 320px" type="password" v-model="password" required class="form-input">
      </label>
      <button type="submit" class="authorization-button">Войти</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      phone: '',
      password: ''
    };
  },
  methods: {
    login() {
      // Отправка данных авторизации на сервер

      fetch('http://practic/src/api/Login.php', {
        method: 'POST',
        body: JSON.stringify({
          phone: this.phone,
          password: this.password,
        })
      })
          .then(response => response.json())
          .then(data => {
            if (typeof data === 'string') {
              alert(data);
            } else if (Array.isArray(data)) {
              localStorage.setItem('user', JSON.stringify(data));
              this.$router.push('/profile');
            }
          })
          .catch(error => console.error(error));

    }
  }
};
</script>

<style>
.authorization-container {
  background-color: #F0F7FA;
  padding: 20px;
  border-radius: 8px;
  text-align: center;
  max-width: 400px;
  margin: 0 auto;
}

.authorization-title {
  color: #2B6CB0;
}

.authorization-form {
  margin-top: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.form-label {
  display: block;
  margin-bottom: 10px;
  color: #2B6CB0;
  font-weight: bold;
}

.form-input {
  padding: 8px;
  border: 1px solid #2B6CB0;
  border-radius: 4px;
}

.authorization-button {
  background-color: #2B6CB0;
  color: #FFF;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 20px;
}
</style>