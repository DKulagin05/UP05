<template>
  <div>
    <h2>Конструктор акций</h2>
    <form @submit.prevent="createPromotion">
      <label for="promotionName">Название акции:</label>
      <input type="text" id="promotionName" v-model="promotion.name" required>

      <label for="promotionDescription">Описание акции:</label>
      <input type="text" id="promotionDescription" v-model="promotion.description" required>

      <label for="promotionDiscountType">Тип скидки:</label>
      <select id="promotionDiscountType" v-model="promotion.discountType">
        <option value="fixed">Фиксированная скидка</option>
        <option value="percentage">Процентная скидка</option>
      </select>

      <label for="promotionDiscountAmount">Размер скидки:</label>
      <input type="number" id="promotionDiscountAmount" v-model="promotion.discountAmount" required>

      <label for="promotionDirections">Направление:</label>
      <select id="promotionDirections" v-model="promotion.direction">
        <option v-for="direction in directions" :key="direction.id" :value="direction.id">{{ direction.position }}</option>
      </select>

      <label for="clientCategoryId">Категория клиента:</label>
      <select id="clientCategoryId" v-model="promotion.clientCategory" required>
        <option v-for="category in CategoryArray" :value="category.category_id">{{ category.category_name }}</option>
      </select>

      <div class="label_box">
        <label for="promotionDate">Дата действия:</label>
        <input type="checkbox" id="promotionDate" v-model="promotion.hasDate">
      </div>
      <div class="label_box">
        <label for="promotionDate">Установить дату</label>
        <input type="date" id="promotionDate" v-model="promotion.date" :disabled="!promotion.hasDate">
      </div>
      <button type="submit" :disabled="!isFormValid">Сохранить</button>
    </form>

    <div v-if="isFormSubmitted && isFormValid">
      <p>Акция успешно создана!</p>
      <p>Название: {{ promotion.name }}</p>
      <p>Тип скидки: {{ promotion.discountType }}</p>
      <p>Размер скидки: {{ promotion.discountAmount }}</p>
      <p>Направления: {{ promotion.direction }}</p>
      <p v-if="promotion.hasDate">Дата действия: {{ promotion.date }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      promotion: {
        name: '',
        description: '',
        discountType: 'fixed',
        discountAmount: 0,
        hasDate: false,
        direction: '',
        clientCategory: 1,
        date: '',
      },
      directions: [],
      CategoryArray: [],
      isFormSubmitted: false,
    };
  },
  computed: {
    isFormValid() {
      return (
          this.promotion.name !== '' &&
          this.promotion.discountAmount > 0
      );
    },
  },
  methods: {
    getLocationNameById(id) {
      const directions = this.directions.find((loc) => loc.id === id);
      return directions ? directions.position : '';
    },
    createPromotion() {
      if (!this.isFormValid) {
        // Показать сообщение об ошибке заполнения формы
        alert('Пожалуйста, заполните все обязательные поля!');
        return;
      }

      // Подтверждение сохранения акции через диалоговое окно
      if (confirm('Вы уверены, что хотите сохранить акцию?')) {
        fetch('http://practic/src/api/CreatePromotion.php', {
          method: 'POST',
          body: JSON.stringify({
            name: this.promotion.name,
            description: this.promotion.description,
            discountType: this.promotion.discountType,
            discountAmount: this.promotion.discountAmount,
            direction: this.getLocationNameById(this.promotion.direction),
            clientCategory: this.promotion.clientCategory,
            date: this.promotion.date,
          })
        })
            .then(response => response.json())
            .then(data => {
              this.isFormSubmitted = true;
            })
            .catch(error => console.error(error));
      }

      // Отправка данных формы на сервер или обработка локально
      // В данном примере просто устанавливаем флаг успешной отправки формы
      this.isFormSubmitted = true;
    },
  },
  mounted() {
    fetch('http://practic/src/api/GetAllLocations.php', {
      method: 'POST',
    })
        .then(response => response.json())
        .then(data => {
          this.directions = data;
        })
        .catch(error => console.error(error));

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
.label_box {
  display: flex;
  align-items: center;
  gap: 10px;
}
.label_box label {
  margin: 5px;
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