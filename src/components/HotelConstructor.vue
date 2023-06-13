<template>
  <div>
    <h2>Конструктор отелей</h2>
    <form @submit.prevent="createHotel">
      <label for="hotelName">Название отеля:</label>
      <input type="text" id="hotelName" v-model="hotel.name" required>

      <label for="hotelName">Описание отеля:</label>
      <input type="text" id="hotelName" v-model="hotel.description" required>

      <label for="hotelImg">Изображение отеля:</label>
      <input type="file" id="hotelImg" @change="EditImgSelected1" required>

      <label for="hotelLocation">Местоположение:</label>
      <select id="hotelLocation" v-model="hotel.location" required>
        <option v-for="location in locations" :key="location.id" :value="location.id">{{ location.position }}</option>
      </select>

      <label for="hotelLocation">Рейтинг:</label>
      <select id="hotelLocation" v-model="hotel.rating" required>
        <option v-for="star in rating" :key="star.id" :value="star.id">{{ star.value }}</option>
      </select>

      <button type="submit" :disabled="!isFormValid">Сохранить</button>
    </form>

    <div v-if="isFormSubmitted && isFormValid">
      <p>Отель успешно создан!</p>
      <p>Название: {{ hotel.name }}</p>
      <p>Описание: {{ hotel.description }}</p>
      <p>Местоположение: {{ getLocationNameById(hotel.location) }}</p>
      <p>Рейтинг: {{ getRatingNameById(hotel.rating) }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      hotel: {
        name: '',
        description: '',
        img: null,
        location: null,
        rating: null,
      },
      locations: [],
      rating: [
        { id: 1, value: 1},
        { id: 2, value: 2},
        { id: 3, value: 3},
        { id: 4, value: 4},
        { id: 5, value: 5}
      ],
      isFormSubmitted: false,
    };
  },
  computed: {
    isFormValid() {
      return this.hotel.name !== '' && this.hotel.description !== '' && this.hotel.location !== null && this.hotel.rating !== null;
    },
  },
  methods: {
    EditImgSelected1(event) {
      this.hotel.img = event.target.files[0];
    },
    createHotel() {
      if (!this.isFormValid) {
        alert('Пожалуйста, заполните все обязательные поля!');
        return;
      }

      if (confirm('Вы уверены, что хотите сохранить отель?')) {
        const formDataCreate = new FormData();
        formDataCreate.append('name', this.hotel.name)
        formDataCreate.append('description', this.hotel.description)
        formDataCreate.append('img', this.hotel.img)
        formDataCreate.append('location', this.hotel.location)
        formDataCreate.append('rating', this.hotel.rating)
        fetch('http://practic/src/api/CreateHotel.php', {
          method: 'POST',
          body: formDataCreate
        })
            .then(response => response.json())
            .then(data => {
              this.isFormSubmitted = true;
            })
            .catch(error => console.error(error));
      }

      // Отправка данных формы на сервер или обработка локально
    },
    getLocationNameById(id) {
      const location = this.locations.find((loc) => loc.id === id);
      return location ? location.position : '';
    },
    getRatingNameById(id) {
      const rating = this.rating.find((rat) => rat.id === id);
      return rating ? rating.value : '';
    },
  },
  mounted() {
    fetch('http://practic/src/api/GetAllLocations.php', {
      method: 'GET',
    })
        .then(response => response.json())
        .then(data => {
          this.locations = data;
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
form input[type="file"] {
  padding: 10px;
  border: 1px solid #2c82c9;
  border-radius: 5px;
  margin: 5px;
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