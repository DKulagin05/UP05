<template>
  <div>
    <h2>Конструктор туров</h2>
    <form @submit.prevent="createHotel">
      <label for="tourTitle">Название тура:</label>
      <input type="text" id="tourTitle" v-model="tour.title" required>

      <label for="tourDesc">Описание тура:</label>
      <input type="text" id="tourDesc" v-model="tour.description" required>

      <label for="tourDesc">Изображение тура:</label>
      <input type="file" id="tourDesc" @change="EditImgSelected" required>

      <label for="tourDepart">Из:</label>
      <select id="tourDepart" v-model="tour.departure" required>
        <option v-for="location in locations" :key="location.id" :value="location.position">{{ location.position }}</option>
      </select>

      <label for="tourDest">В:</label>
      <select id="tourDest" v-model="tour.destination" required>
        <option v-for="location in locations" :key="location.id" :value="location.position">{{ location.position }}</option>
      </select>

      <label for="tourDate">Начинается:</label>
      <input type="date" id="tourDate" v-model="tour.date" required>

      <label for="tourDuration">Продолжительность (в днях):</label>
      <input type="number" id="tourDuration" v-model="tour.duration" required>

      <label for="tourPrice">Стоимость:</label>
      <input type="number" id="tourPrice" v-model="tour.price" required>

      <label for="tourDepart">Отель прибывания:</label>
      <select id="tourDepart" v-model="tour.hotel_id" required>
        <option v-for="hotel in hotels" :key="hotel.id" :value="hotel.id">{{ hotel.name }}</option>
      </select>
      <!-- Добавьте другие поля для параметров отеля, такие как категория, удобства и т.д. -->

      <button type="submit" :disabled="!isFormValid">Сохранить</button>
    </form>

    <div v-if="isFormSubmitted && isFormValid">
      <p>Тур успешно создан!</p>
      <p>Название: {{ tour.name }}</p>
      <p>Описание: {{ tour.description }}</p>
      <p>Из: {{ tour.departure }}</p>
      <p>В: {{ tour.destination }}</p>
      <p>Начинается: {{ tour.date }}</p>
      <p>Стоимость: {{ tour.price }}</p>
      <p>Местоположение: {{ getHotelNameById(tour.hotel_id) }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tour: {
        title: '',
        description: '',
        img: null,
        departure: null,
        destination: null,
        date: null,
        duration: null,
        price: 0,
        hotel_id: null,
      },
      locations: [],
      hotels: [],
      isFormSubmitted: false,
    };
  },
  computed: {
    isFormValid() {
      return this.tour.title !== '' && this.tour.description !== '' && this.tour.departure !== null && this.tour.hotel_id !== null
          && this.tour.destination !== null && this.tour.date !== null && this.tour.duration !== null && this.tour.price !== 0;
    },
  },
  methods: {
    EditImgSelected(event) {
      this.tour.img = event.target.files[0]
    },
    createHotel() {
      if (!this.isFormValid) {
        alert('Пожалуйста, заполните все обязательные поля!');
        return;
      }

      if (confirm('Вы уверены, что хотите сохранить тур?')) {
        const formDataCreate = new FormData();
        formDataCreate.append('title', this.tour.title)
        formDataCreate.append('description', this.tour.description)
        formDataCreate.append('img', this.tour.img)
        formDataCreate.append('departure', this.tour.departure)
        formDataCreate.append('destination', this.tour.destination)
        formDataCreate.append('date', this.tour.date)
        formDataCreate.append('duration', this.tour.duration)
        formDataCreate.append('price', this.tour.price)
        formDataCreate.append('hotel_id', this.tour.hotel_id)
        fetch('http://practic/src/api/CreateTour.php', {
          method: 'POST',
          body: formDataCreate
        })
            .then(response => response.json())
            .then(data => {
              this.isFormSubmitted = true;
            })
            .catch(error => console.error(error));
      }

    },
    getLocationNameById(id) {
      const location = this.locations.find((loc) => loc.id === id);
      return location ? location.position : '';
    },
    getHotelNameById(id) {
      const hotel = this.hotels.find((hotel) => hotel.id === id);
      return hotel ? hotel.name : '';
    },
  },
  mounted() {
    fetch('http://practic/src/api/GetAllHotels.php', {
      method: 'POST',
    })
        .then((response) => response.json())
        .then((data) => {
          this.hotels = data;
        })
        .catch((error) => console.error(error));

    fetch('http://practic/src/api/GetAllLocations.php', {
      method: 'POST',
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

form input[type="file"] {
  padding: 10px;
  border: 1px solid #2c82c9;
  border-radius: 5px;
  margin: 5px;
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