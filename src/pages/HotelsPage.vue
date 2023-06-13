<template>
  <div class="container">
    <div class="wrapper">
      <h2>Отели</h2>
      <div class="hotel-list">
        <div v-for="hotel in hotels" :key="hotel.id" class="hotel-card">
          <img :src="'src/assets/img/hotels/' + hotel.img" alt="Отель.png" style="margin-bottom: 10px; min-width: 100%; max-height: 200px">
          <h3>{{ hotel.name }}</h3>
          <p class="hotel-location">{{ hotel.location }}</p>
          <p class="hotel-description">{{ hotel.description }}</p>
          <p class="hotel-rating">Рейтинг: {{ hotel.rating }}/5</p>
          <div class="hotel-buttons">
            <button class="view-button" @click="FakeRedirection">Подробнее</button>
            <button class="remove-button" @click="RemoveHotel(hotel.id)" v-if="user.admin === '1'">Удалить</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HotelCatalog',
  data() {
    return {
      hotels: [],
      user: [],
    };
  },
  methods: {
    FakeRedirection() {
      alert('Перенаправление на сайт данного отеля');
      location.reload();
    },
    RemoveHotel(id) {
      if (confirm('Вы уверены, что хотите удалить данный отель?')) {
        fetch('http://practic/src/api/RemoveHotel.php', {
          method: 'POST',
          body: JSON.stringify({
            id_hotel: id
          })
        })
            .then(response => response.json())
            .then(data => {
              alert('Отель успешно удален');
            })
            .catch(error => console.error(error));
      }
    },
  },
  mounted() {
    if (localStorage.getItem('user')) {
      this.user = JSON.parse(localStorage.getItem('user'))[0];
    }

    fetch('http://practic/src/api/GetAllHotels.php', {
      method: 'GET',
    })
        .then(response => response.json())
        .then(data => {
          this.hotels = data;
        })
        .catch(error => console.error(error));
  }
};
</script>

<style scoped>
template {

}
.container {
  background-color: #f0f5f9;
  padding: 20px;
}

.hotel-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
}

.hotel-card {
  width: 300px;
  padding: 20px;
  margin: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

h3 {
  font-size: 20px;
  margin-bottom: 10px;
}

.hotel-location {
  color: #333;
  margin-top: 10px;
}

.hotel-description {
  color: #555;
}

.hotel-rating {
  color: #666;
  margin-top: 10px;
}

.hotel-buttons {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.view-button {
  background-color: #00bfff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.view-button:hover {
  background-color: #0099e6;
}

.remove-button {
  background-color: #f61435;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  opacity: 0.7;
  transition: background-color 0.3s ease;
}

.remove-button:hover {
  background-color: #e60b2d;
}

button:focus {
  outline: none;
}

button:active {
  transform: translateY(1px);
}
</style>
