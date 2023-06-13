<template>
  <div>
    <h2>Создание пользователя</h2>
    <form @submit.prevent="createUser">

      <label for="clientName">Имя клиента:</label>
      <input type="text" id="clientName" v-model="user.clientName" required>

      <label for="clientPhone">Номер клиента:</label>
      <input type="text" id="clientPhone" v-model="user.clientPhone" required>

      <label for="clientCategoryId">Категория клиента:</label>
      <select id="clientCategoryId" v-model="user.clientCategory" required>
        <option v-for="category in CategoryArray" :value="category.category_id">{{ category.category_name }}</option>
      </select>

      <label for="password">Пароль:</label>
      <input type="text" id="password" v-model="user.password" required>

      <label for="birthday">Дата рождения:</label>
      <input type="date" id="birthday" v-model="user.birthday" required>

      <div class="label_box">
        <label for="admin">Администратор:</label>
        <input type="checkbox" id="admin" v-model="user.admin">
      </div>

      <button type="submit" :disabled="!isFormValid">Сохранить</button>
    </form>

    <div v-if="isFormSubmitted && isFormValid">
      <p>Пользователь успешно создан!</p>
      <p>Имя клиента: {{ user.clientName }}</p>
      <p>Номер телефона: {{ user.clientPhone }}</p>
      <p>Категория клиента: {{ CategoryArray[user.clientCategory-1].category_name }}</p>
      <p>Пароль: {{ user.password }}</p>
      <p>Дата рождения: {{ user.birthday }}</p>
      <p>Администратор: {{ user.admin ? 'Да' : 'Нет' }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        clientName: '',
        clientPhone: '',
        birthday: '',
        admin: false,
        clientCategory: null,
        password: ''
      },
      CategoryArray: [],
      isFormSubmitted: false,
    };
  },
  computed: {
    isFormValid() {
      return (
          this.user.clientName !== '' &&
          this.user.clientPhone !== '' &&
          this.user.clientCategory !== null &&
          this.user.birthday !== '' &&
          this.user.password !== ''
      );
    },
  },
  methods: {
    createUser() {
      if (!this.isFormValid) {
        alert('Пожалуйста, заполните все обязательные поля!');
        return;
      }

      if (confirm('Вы уверены, что хотите создать пользователя?')) {
        fetch('http://practic/src/api/CreateUser.php', {
          method: 'POST',
          body: JSON.stringify({
            name: this.user.clientName,
            phone: this.user.clientPhone,
            category: this.user.clientCategory,
            password: this.user.password,
            birthday: this.user.birthday,
            admin: this.user.admin ? 1 : 0,
          })
        })
            .then(response => response.json())
            .then(data => {
              this.isFormSubmitted = true;
            })
            .catch(error => console.error(error));
      }

      // Отправка данных формы на сервер или обработка локально
    },
  },
  mounted() {
    fetch('http://practic/src/api/GetAllCategories.php', {
      method: 'POST',
    })
        .then(response => response.json())
        .then(data => {
          this.CategoryArray = data;
        })
        .catch(error => console.error(error));
    }
};
</script>

<style scoped>
.promotion-constructor {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f0f5f9;
  border-radius: 5px;
}

.title {
  color: #2c82c9;
  font-size: 24px;
  margin-bottom: 20px;
}

form label {
  display: block;
  margin-bottom: 8px;
  color: #333;
}

form input[type="text"],
form input[type="number"],
form select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

form input[type="checkbox"] {
  margin-right: 5px;
}

form button[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  margin-top: 20px;
  background-color: #2c82c9;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

form button[type="submit"]:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

.result {
  margin-top: 20px;
  padding: 10px;
  background-color: #d4edda;
  border-radius: 3px;
}

.result p {
  margin: 0;
  color: #155724;
}

.error-message {
  color: #dc3545;
  margin-top: 10px;
}
</style>