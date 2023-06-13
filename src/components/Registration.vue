<template>
  <div class="registration-container">
    <h2 class="registration-title">Регистрация</h2>
    <form @submit.prevent="register" class="registration-form">
      <label class="form-label">
        Имя пользователя:<br>
        <input
            style="min-width: 320px"
            type="text"
            v-model="username"
            required
            class="form-input"
            :class="{ 'input-error': usernameError }"
        ><br>
        <span v-if="usernameError" class="error">{{ usernameError }}</span>
      </label>
      <label class="form-label">
        Пароль: <br>
        <input
            style="min-width: 320px"
            type="password"
            v-model="password"
            required
            class="form-input"
            :class="{ 'input-error': passwordError }"
        > <br>
        <span v-if="passwordError" class="error">{{ passwordError }}</span>
      </label>
      <label class="form-label">
        Номер телефона: <br>
        <input
            style="min-width: 320px"
            type="text"
            v-model="phone"
            required
            class="form-input"
            :class="{ 'input-error': phoneError }"
        > <br>
        <span v-if="phoneError" class="error">{{ phoneError }}</span>
      </label>
      <label class="form-label">
        Дата рождения:<br>
        <input
            style="min-width: 320px"
            type="date"
            v-model="birthdate"
            required
            class="form-input"
            :class="{ 'input-error': birthdateError }"
        ><br>
      </label>
      <button type="submit" class="registration-button">Зарегистрироваться</button>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      username: '',
      password: '',
      birthdate: '',
      phone: '',
      usernameError: '',
      phoneError: '',
      passwordError: '',
      birthdateError: ''
    };
  },
  methods: {
    validatePhoneNumber(phone) {
      const regex = /^[+7|8]\d{10}$/;
      return regex.test(phone);
    },
    register() {
      // Сброс сообщений об ошибках
      this.usernameError = '';
      this.passwordError = '';
      this.phoneError = '';
      this.birthdateError = '';

      // Валидация полей
      if (this.username.length < 3) {
        this.usernameError = 'Имя должно содержать не менее 3 символов';
      }
      if (this.phone.length !== 11 || !this.validatePhoneNumber(this.phone)) {
        this.phoneError = 'Введите корректный номер телефона';
      }
      if (this.password.length < 8) {
        this.passwordError = 'Пароль должен содержать не менее 8 символов';
      }

      // Валидация даты рождения
      if (!this.birthdate) {
        this.birthdateError = 'Введите дату рождения';
      } else {
        const birthYear = new Date(this.birthdate).getFullYear();
        const currentYear = new Date().getFullYear();
        if (birthYear < 1900 || birthYear > currentYear) {
          this.birthdateError = 'Дата рождения должна быть между 1900 и текущим годом';
        }
      }

      // Если есть ошибки, останавливаем отправку формы
      if (this.usernameError || this.phoneError || this.passwordError || this.birthdateError) {
        return;
      }

      // Остальная логика регистрации
      fetch('http://practic/src/api/Registration.php', {
        method: 'POST',
        body: JSON.stringify({
          username: this.username,
          password: this.password,
          birthdate: this.birthdate,
          phone: this.phone
        })
      })
          .then(response => response.json())
          .then(data => {
            alert(data);
          })
          .catch(error => console.error(error));
    }
  }
};
</script>
<style>
.registration-container {
  background-color: #F0F7FA;
  padding: 20px;
  border-radius: 8px;
  text-align: center;
  max-width: 400px;
  margin: 0 auto;
}

.registration-title {
  color: #2B6CB0;
}

.registration-form {
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

.input-error {
  border-color: red;
}

.registration-button {
  background-color: #2B6CB0;
  color: #FFF;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 20px;
}

.error {
  color: red;
}
</style>