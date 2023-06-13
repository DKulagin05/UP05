<template>
  <div class="container">
    <div class="wrapper">
      <div v-if="CategoryArray.length > 0">
        <h1>Личный кабинет</h1>
        <h2>Добро пожаловать, {{ user.client_name }}!</h2>
        <p class="status">Статус клиента: {{ CategoryArray[user.client_category_id - 1].category_name }}</p>

        <h3>Детали профиля:</h3>
        <div v-if="!editMode">
          <ul style="font-size: 18px; display:flex; flex-direction: column; gap: 5px">
            <li><strong>Имя:</strong> {{ user.client_name }}</li>
            <li><strong>Номер телефона:</strong> {{ user.client_phone }}</li>
            <li><strong>Дата рождения:</strong> {{ user.birthday ?? 'Неизвестно' }}</li>
            <li><strong>Всего потрачено:</strong> {{ totalSpent }} руб.</li>
          </ul>
          <button class="edit-button" @click="toggleEditMode">Редактировать</button>
        </div>
        <div v-else class="edit-container">
          <label for="name">Имя:</label>
          <input type="text" id="name" v-model="editedUser.client_name" required>
          <label for="phone">Номер телефона:</label>
          <input type="text" id="phone" v-model="editedUser.client_phone" required>
          <label for="birthday">Дата рождения:</label>
          <input type="date" id="birthday" v-model="editedUser.birthday" required>
          <div class="edit-btn">
            <button class="save-button" @click="saveChanges">Сохранить</button>
            <button class="cancel-button" @click="cancelEdit">Отмена</button>
          </div>
        </div>

        <h3 style="margin-top: 20px;">Ваши заказы:</h3>
        <ul style="display:flex; flex-direction: column; gap: 20px; font-size: 18px;" v-if="orders.length>0">
          <li v-for="order in orders" :key="order.id" style="">
            {{ order.id }} - {{ order.date }} - {{ order.title }} - {{ order.destination }} - {{ order.total_price }} руб. - {{ checkStatus(order.end_date) }}
          </li>
        </ul>
        <div class="" v-else>У вас нет заказов</div>
      </div>
      <p v-else>Загрузка</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserProfile',
  data() {
    return {
      user: '',
      editedUser: {},
      CategoryArray: [],
      orders: [],
      editMode: false,
    };
  },
  computed: {
    totalSpent() {
      return this.orders.reduce((total, order) => total + parseFloat(order.total_price), 0);
    },
  },
  methods: {
    checkStatus(date) {
      const objectDate = new Date(date);
      const currentDate = new Date();

      if (objectDate < currentDate) {
        return 'Завершен';
      } else {
        return 'В процессе';
      }
    },
    toggleEditMode() {
      this.editMode = !this.editMode;
      this.editedUser = { ...this.user };
    },
    saveChanges() {
      fetch('http://practic/src/api/EditUser.php', {
        method: 'POST',
        body: JSON.stringify({
          id_user: this.editedUser.client_id,
          name: this.editedUser.client_name,
          phone: this.editedUser.client_phone,
          birthday: this.editedUser.birthday
        })
      })
          .then(response => response.json())
          .then(data => {
            alert(data);
            fetch('http://practic/src/api/Login.php', {
              method: 'POST',
              body: JSON.stringify({
                phone: this.editedUser.client_phone,
                password: this.user.password,
              })
            })
                .then(response => response.json())
                .then(data => {
                  localStorage.clear();
                  localStorage.setItem('user', JSON.stringify(data));
                  location.reload();
                })
                .catch(error => console.error(error));
          })
          .catch(error => console.error(error));

      this.user = { ...this.editedUser };
      this.editMode = false;
    },
    cancelEdit() {
      this.editMode = false;
    },
  },
  mounted() {
    this.user = JSON.parse(localStorage.getItem('user'))[0];
    this.editedUser = { ...this.user };
    fetch('http://practic/src/api/GetAllCategories.php', {
      method: 'GET',
    })
        .then(response => response.json())
        .then(data => {
          this.CategoryArray = data;
        })
        .catch(error => console.error(error));

    fetch('http://practic/src/api/GetUserTours.php', {
      method: 'POST',
      body: JSON.stringify({
        id_user: this.user.client_id
      })
    })
        .then(response => response.json())
        .then(data => {
          this.orders = data;
        })
        .catch(error => console.error(error));
  }
};
</script>

<style scoped>
.container {
  background-color: #f0f5f9; /* Светло-голубой фон контейнера */
  padding: 20px;
}

/* Стили для страницы "Личный кабинет" */
.wrapper {
  margin: 0 auto;
  padding: 20px;
  background-color: #EAF5FF;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
  font-size: 24px;
  margin-bottom: 20px;
}

h2 {
  font-size: 20px;
  margin-bottom: 10px;
}

h3 {
  font-size: 18px;
  margin-bottom: 10px;
}

p {
  margin-bottom: 10px;
  font-size: 18px;
}

ul {
  margin-left: 20px;
}

.status {
  color: #0066CC;
  font-weight: bold;
}

.edit-button {
  margin-bottom: 10px;
}

.edit-button,
.save-button,
.cancel-button {
  background-color: #00bfff;
  color: #fff;
  border: none;
  border-radius: 4px;
  padding: 8px 16px;
  cursor: pointer;
  margin-top: 10px;
}

.edit-container {
  display: flex;
  flex-direction: column;
  gap: 10px;
  max-width: 250px;
  margin-left: 50px;
  font-weight: bold;
}

.edit-btn {
  display: flex;
  justify-content: space-between;
}

.save-button {
  background-color: #28a745;
  margin-right: 10px;
}

.cancel-button {
  background-color: #dc3545;
}

/* Адаптивный дизайн для ширины экрана до 600px */
@media screen and (max-width: 600px) {
  .container {
    padding: 10px;
  }

  .wrapper {
    padding: 10px;
  }

  h1 {
    font-size: 20px;
  }

  h2 {
    font-size: 20px;
  }

  h3 {
    font-size: 18px;
  }

  p {
    font-size: 18px;
  }

  ul {
    margin-left: 10px;
  }

  .edit-container {
    max-width: 200px;
    margin-left: 30px;
  }
}
</style>
