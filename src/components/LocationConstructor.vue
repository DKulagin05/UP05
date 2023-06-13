<template>
  <div>
    <h2>Конструктор местоположений</h2>
    <form @submit.prevent="createLocation">
      <label for="hotelName">Адрес:</label>
      <input type="text" id="hotelName" v-model="location" required>

      <!-- Добавьте другие поля для параметров отеля, такие как категория, удобства и т.д. -->

      <button type="submit" :disabled="!isFormValid">Сохранить</button>
    </form>

    <div v-if="isFormSubmitted && isFormValid">
      <p>Адрес успешно создан!</p>
      <p>Название: {{ location }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      location: '',
      isFormSubmitted: false,
    };
  },
  computed: {
    isFormValid() {
      return this.location !== '';
    },
  },
  methods: {
    createLocation() {
      if (!this.isFormValid) {
        alert('Пожалуйста, заполните все обязательные поля!');
        return;
      }

      if (confirm('Вы уверены, что хотите сохранить местоположение?')) {
        fetch('http://practic/src/api/CreateLocation.php', {
          method: 'POST',
          body: JSON.stringify({
            name: this.location,
          })
        })
            .then(response => response.json())
            .then(data => {
              this.isFormSubmitted = true;
              console.log(data)
            })
            .catch(error => console.error(error));
      }

      // Отправка данных формы на сервер или обработка локально
    }
  },
  mounted() {

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