<template>
  <div>
    <h2>Конструктор местоположений</h2>
    <form @submit.prevent="createLocation">
      <label for="serviceName">Название:</label>
      <input type="text" id="serviceName" v-model="location" required>

      <label for="serviceDescription">Описание:</label>
      <input type="text" id="serviceDescription" v-model="description" required>

      <label for="servicePrice">Цена:</label>
      <input type="text" id="servicePrice" v-model="price" required>

      <button type="submit" :disabled="!isFormValid">Сохранить</button>
    </form>

    <div v-if="isFormSubmitted && isFormValid">
      <p>Услуга успешно создана!</p>
      <p>Название: {{ location }}</p>
      <p>Описание: {{ description }}</p>
      <p>Цена: {{ price }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      location: '',
      description: '',
      price: '',
      isFormSubmitted: false,
    };
  },
  computed: {
    isFormValid() {
      return this.location !== '' && this.description !== '' && this.price !== '';
    },
  },
  methods: {
    createLocation() {
      if (!this.isFormValid) {
        alert('Пожалуйста, заполните все обязательные поля!');
        return;
      }

      if (confirm('Вы уверены, что хотите сохранить услугу?')) {
        fetch('http://practic/src/api/CreateService.php', {
          method: 'POST',
          body: JSON.stringify({
            name: this.location,
            description: this.description,
            price: this.price
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