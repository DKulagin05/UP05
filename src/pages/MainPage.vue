<template>
  <div class="home-container">
    <div class="wrapper">
      <h1 class="title">Добро пожаловать в наше туристическое агентство!</h1>
      <p style="margin-bottom: 15px;">Выберите один из наших уникальных туров:</p>
      <div class="tour-sort-container">
        <div class="control-panel">
          <div class="filter">
            <label for="priceFrom">Цена от:</label>
            <input type="number" id="priceFrom" v-model.number="filters.priceFrom" min="0" step="1000">
          </div>
          <div class="filter">
            <label for="priceTo">Цена до:</label>
            <input type="number" id="priceTo" v-model.number="filters.priceTo" min="0" step="1000">
          </div>
          <div class="filter">
            <label for="tourDep">Из:</label>
            <select id="tourDep" v-model="filters.departure" required>
              <option value="">Все</option>
              <option v-for="location in locations" :key="location.id" :value="location.position">{{ location.position }}</option>
            </select>
          </div>
          <div class="filter">
            <label for="tourDest">В:</label>
            <select id="tourDest" v-model="filters.destination" required>
              <option value="">Все</option>
              <option v-for="location in locations" :key="location.id" :value="location.position">{{ location.position }}</option>
            </select>
          </div>
          <div class="filter">
            <button class="subscribe-button" @click="resetFilters">Сбросить фильтры</button>
          </div>
        </div>
      </div>

      <div class="tour-list" v-if="filteredTours.length > 0">
        <div v-for="tour in paginatedTours" :key="tour.id" class="tour-item">
          <div class="tour-image">
            <img :src="'src/assets/img/tours/' + tour.img" alt="Tour Image" />
          </div>
          <div class="tour-details">
            <div class="tour-header">
              <h3>{{ tour.title }}</h3>
              <span v-if="user.admin === '1'" style="opacity: 0.2">{{ tour.id }}</span>
            </div>
            <p>{{ tour.description }}</p>
            <p class="price">Цена:
              <span v-if="tour.discountedPrice" class="discounted-price">{{ tour.discountedPrice }} руб. <del style="color: #000; margin-left: 10px;">{{ tour.price }} руб.</del></span>
              <span v-else>{{ tour.price }} руб.</span>
            </p>
            <p>Дата проведения: {{ tour.date }}</p>
            <p style="margin-bottom: 10px;">Количество дней: {{ tour.duration }}</p>
            <div class="places">
              <p>Место отправления:<br /><strong>{{ tour.departure }}</strong></p>
              <p>Место прибытия:<br /><strong>{{ tour.destination }}</strong></p>
            </div>
            <p>Отель пребывания: <router-link to="/hotels">{{ getHotelNameById(tour.hotel_id) }}</router-link></p>
          </div>
          <div class="tour-btn">
            <button class="subscribe-button" @click="subscribe(tour.id)">Записаться</button>
            <button class="subscribe-button delete-button" v-if="user.admin === '1'" @click="removeTour(tour.id)">Удалить</button>
          </div>
        </div>
      </div>
      <div class="loading" style="" v-else>Туров с такими фильтрами на данный момент нет, возвращайтесь позже</div>

      <div class="pagination" v-if="totalPages > 1">
        <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1">Назад</button>
        <button v-for="page in totalPages" :key="page" @click="changePage(page)" :class="{ active: page === currentPage }">{{ page }}</button>
        <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages">Вперед</button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      tours: [],
      hotels: [],
      user: [],
      locations: [],
      filters: {
        priceFrom: null,
        priceTo: null,
        departure: '',
        destination: ''
      },
      currentPage: 1,
      perPage: 6,
    };
  },
  computed: {
    filteredTours() {
      let filtered = this.tours;

      if (this.filters.priceFrom !== null) {
        filtered = filtered.filter(tour => tour.price >= this.filters.priceFrom);
      }

      if (this.filters.priceTo !== null) {
        filtered = filtered.filter(tour => tour.price <= this.filters.priceTo);
      }

      if (this.filters.departure !== '') {
        filtered = filtered.filter(tour => tour.departure.toLowerCase().includes(this.filters.departure.toLowerCase()));
      }

      if (this.filters.destination !== '') {
        filtered = filtered.filter(tour => tour.destination.toLowerCase().includes(this.filters.destination.toLowerCase()));
      }

      return filtered;
    },
    totalPages() {
      return Math.ceil(this.filteredTours.length / this.perPage);
    },
    paginatedTours() {
      const startIndex = (this.currentPage - 1) * this.perPage;
      const endIndex = startIndex + this.perPage;
      return this.filteredTours.slice(startIndex, endIndex);
    },
  },
  methods: {
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
      }
    },
    getHotelNameById(id) {
      const hotel = this.hotels.find((hotel) => hotel.id === id);
      return hotel ? hotel.name : '';
    },
    subscribe(id) {
      const user = JSON.parse(localStorage.getItem('user')) ?? false;
      if (user) {
        if (confirm('Вы уверены что хотите записаться на этот тур?')) {
          fetch('http://practic/src/api/JoinTour.php', {
            method: 'POST',
            body: JSON.stringify({
              id_user: this.user.client_id,
              id_tour: id,
            }),
          })
              .then((response) => response.json())
              .then((data) => {
                alert(data + '. Вскоре мы позвоним вам для уточнения деталей');
                this.$router.push('/profile');
              })
              .catch((error) => console.error(error));
        }
      } else {
        alert('Зарегистрируйтесь или войдите в аккаунт');
      }
    },
    removeTour(id) {
      if (confirm('Вы уверены что хотите удалить этот тур?' + id)) {
        fetch('http://practic/src/api/RemoveTour.php', {
          method: 'POST',
          body: JSON.stringify({
            id_tour: id,
          }),
        })
            .then((response) => response.json())
            .then((data) => {
              alert('Вы успешно удалили тур');
              location.reload();
            })
            .catch((error) => console.error(error));
      }
    },
    resetFilters() {
      // Reset filters to their initial values
      this.filters.priceFrom = null;
      this.filters.priceTo = null;
      this.filters.departure = '';
      this.filters.destination = '';

      // Fetch all tours
      fetch('http://practic/src/api/GetAllTours.php', {
        method: 'POST',
      })
          .then((response) => response.json())
          .then((data) => {
            this.tours = data.map((tour) => {
              if (this.user.client_category_id === '2') {
                return {
                  ...tour,
                  discountedPrice: tour.price * 0.9,
                };
              } else if (this.user.client_category_id === '3') {
                return {
                  ...tour,
                  discountedPrice: tour.price * 0.8,
                };
              } else if (this.user.client_category_id === '4') {
                return {
                  ...tour,
                  discountedPrice: tour.price * 0.7,
                };
              } else {
                return tour;
              }
            });
          })
          .catch((error) => console.error(error));
    },
  },
  mounted() {
    if (localStorage.getItem('user')) {
      this.user = JSON.parse(localStorage.getItem('user'))[0];
    }

    fetch('http://practic/src/api/GetAllLocations.php', {
      method: 'POST',
    })
        .then(response => response.json())
        .then(data => {
          this.locations = data;
        })
        .catch(error => console.error(error));

    fetch('http://practic/src/api/GetAllHotels.php', {
      method: 'POST',
    })
        .then((response) => response.json())
        .then((data) => {
          this.hotels = data;
        })
        .catch((error) => console.error(error));

    fetch('http://practic/src/api/GetAllTours.php', {
      method: 'POST',
    })
        .then((response) => response.json())
        .then((data) => {
          this.tours = data.map((tour) => {
            if (this.user.client_category_id === '2') {
              return {
                ...tour,
                discountedPrice: tour.price * 0.9, // 10% discount for category 2
              };
            } else if (this.user.client_category_id === '3') {
              return {
                ...tour,
                discountedPrice: tour.price * 0.8, // 20% discount for category 3
              };
            } else if (this.user.client_category_id === '4') {
              return {
                ...tour,
                discountedPrice: tour.price * 0.7, // 30% discount for category 4
              };
            } else {
              return tour;
            }
          });
        })
        .catch((error) => console.error(error));
  },
};
</script>
<style scoped>
.tour-sort-container {
  margin-bottom: 16px;
}
.pagination {
  display: flex;
  gap: 10px;
  justify-content: center;
  margin: 20px 0 50px 0;
  font-size: 18px;
}
.pagination button {
  padding: 10px;
  background-color: #4299e1;
  border-radius: 5px;
  color: white;
}
.pagination button:disabled {
  padding: 10px;
  background-color: #666666;
  opacity: 0.4;
  border-radius: 5px;
  color: white;
}
.control-panel {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  align-items: center;
}

.filter {
  display: flex;
  align-items: center;
  gap: 4px;
}

.filter label {
  font-size: 14px;
  color: #4a5568;
}

.filter input[type="number"],
.filter select {
  padding: 8px 12px;
  font-size: 14px;
  width: 150px;
  border-radius: 4px;
  border: 1px solid #cbd5e0;
  color: #2d3748;
}

.filter select {
  appearance: none;
  background-color: #fff;
  background-repeat: no-repeat;
  background-position: right 8px center;
  background-size: 16px;
  padding-right: 32px;
}

.filter button {
  background-color: #4299e1;
  color: #fff;
  padding: 8px 16px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  font-size: 14px;
}

.filter button + button {
  margin-left: 8px;
}

.home-container {
  background-color: #f0f5f9;
  padding: 16px;
}

.wrapper {
  max-width: 1200px;
  margin: 0 auto;
}

.title {
  font-size: 24px;
  color: #2b6cb0;
  margin-bottom: 16px;
}

.tour-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 16px;
}

.tour-item {
  background-color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 500px;
  padding: 16px;
  border-radius: 8px;
  max-width: 400px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.tour-btn {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
}
.tour-image {
  text-align: center;
  margin-bottom: 16px;
}

.tour-image img {
  width: 100%;
  height: 200px;
  border-radius: 4px;
}

.tour-details {
  font-size: 16px;
}

.tour-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 8px;
}

.price {
  margin-bottom: 8px;
}

.discounted-price {
  color: #e53e3e;
}

.places {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
}

.subscribe-button {
  background-color: #4299e1;
  color: #fff;
  padding: 8px 16px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  font-size: 14px;
}

.delete-button {
  background-color: #e53e3e;
  margin-left: 8px;
}

.loading {
  text-align: center;
  font-size: 32px;
  font-weight: bold;
  color: #4a5568;
  padding: 16px;
}
</style>