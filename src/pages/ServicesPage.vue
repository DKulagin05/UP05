<template>
  <div class="container">
    <div class="wrapper">
      <h2>Дополнительные услуги</h2>
      <div class="service-list">
        <div v-for="service in services" :key="service.id" class="service-row">
          <div class="service-info">
            <h3>{{ service.title }}</h3>
            <p>{{ service.description }}</p>
            <p>Цена: {{ service.price }} рублей</p>
          </div>
          <div class="service-action">
<!--            <button @click="bookService(service.id)">Забронировать</button>-->
            <button @click="removeService(service.id)" class="btn-delete" v-if="user.admin === '1'">Удалить</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ServiceSection',
  data() {
    return {
      user: [],
      services: [],
    };
  },
  methods: {
    // bookService(serviceId) {
    //   // Логика для бронирования услуги
    // },
    removeService(serviceId) {
      fetch('http://practic/src/api/RemoveService.php', {
        method: 'POST',
        body: JSON.stringify({
          id_service: serviceId
        })
      })
          .then(response => response.json())
          .then(data => {
            alert(data)
            location.reload();
          })
          .catch(error => console.error(error));
    }
  },
  mounted() {
    fetch('http://practic/src/api/GetAllServices.php', {
      method: 'GET',
    })
        .then(response => response.json())
        .then(data => {
          this.services = data;
        })
        .catch(error => console.error(error));

    if (localStorage.getItem('user')) {
      this.user = JSON.parse(localStorage.getItem('user'))[0];
    }
  }
};
</script>

<style scoped>
.container {
  background-color: #f0f5f9; /* Светло-голубой фон контейнера */
  padding: 20px;
}

.btn-delete {
  background-color: #f85970;
}

.service-list {
  display: flex;
  flex-wrap: wrap;
}

.service-row {
  display: flex;
  align-items: center;
  width: 100%;
  padding: 20px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.service-info {
  flex: 1;
}

.service-action {
  margin-left: 10px;
  display: flex;
  gap: 10px;
}

button {
  background-color: #00bfff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* Адаптивный дизайн до 600px */
@media (max-width: 600px) {
  .container {
    padding: 10px;
  }

  .service-row {
    flex-direction: column;
    align-items: flex-start;
  }

  .service-info {
    margin-bottom: 10px;
  }

  .service-action {
    margin-left: 0;
    justify-content: flex-start;
  }
}
</style>
