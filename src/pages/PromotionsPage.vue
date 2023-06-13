<template>
  <div class="container">
    <div class="wrapper">
      <h1 class="title">Список акций</h1>
      <table class="table" v-if="CategoryArray.length > 0 && discounts.length > 0">
        <thead>
        <tr>
          <th>Название</th>
          <th>Размер скидки</th>
          <th>От категории</th>
          <th>Дата окончания</th>
          <th class="adaptive-hide">Действия</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="discount in discounts" :key="discount.id">
          <td>{{ discount.discount_title }}</td>
          <td>{{ getDiscountLabel(discount) }}</td>
          <td>{{ CategoryArray[discount.client_category - 1].category_name }}</td>
          <td>{{ discount.end_date ?? 'Бессрочно' }}</td>
          <td class="adaptive-hide">
            <button @click="viewDiscount(discount)" class="btn-view">Просмотр информации</button>
            <button @click="deleteDiscount(discount.discount_id)" class="btn-delete" v-if="user.admin === '1'">Удалить</button>
          </td>
        </tr>
        </tbody>
      </table>
      <div class="" v-else style="text-align: center; font-size: 32px; font-weight: bold;">Загрузка...</div>
      <div class="view-window" v-if="view">
        <p>Название: {{ currentDiscount.discount_title }}</p>
        <p>Описание: {{ currentDiscount.discount_description }}</p>
        <p>Действует на направление: {{ currentDiscount.direction ? '' : 'Любое' }}</p>
        <p>Размер скидки: {{ getDiscountLabel(currentDiscount) }}</p>
        <p>Для клиентов от статуса: {{ CategoryArray[currentDiscount.client_category - 1].category_name }}</p>
        <p>Дата окончания: {{ currentDiscount.end_date ?? 'Бессрочно' }}</p>
        <button @click="closeView" class="btn-close">Закрыть</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      discounts: [],
      view: false,
      currentDiscount: null,
      CategoryArray: [],
      user: [],
    };
  },
  methods: {
    // Функция получения метки скидки в зависимости от типа
    getDiscountLabel(discount) {
      if (discount.discount_type === 'fixed') {
        return `${discount.discount_value} руб.`;
      } else if (discount.discount_type === 'percentage') {
        return `${discount.discount_value} %`;
      }
      return '';
    },
    // Функция открытия формы просмотра акции
    viewDiscount(discount) {
      this.currentDiscount = discount;
      this.view = true;
    },
    closeView() {
      this.view = false;
      this.currentDiscount = null;
    },

    deleteDiscount(id) {
      if (confirm('Уверены, что хотите удалить акцию с id ' + id)) {
        fetch('http://practic/src/api/RemovePromotion.php', {
          method: 'POST',
          body: JSON.stringify({
            id: id,
          })
        })
            .then(response => response.json())
            .then(data => {
              console.log(data)
              location.reload();
            })
            .catch(error => console.error(error));
      }
    }
  },
  mounted() {
    if (localStorage.getItem('user')) {
      this.user = JSON.parse(localStorage.getItem('user'))[0];
    }

    fetch('http://practic/src/api/GetAllPromotions.php', {
      method: 'POST',
    })
        .then(response => response.json())
        .then(data => {
          this.discounts = data;
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
.container {
  background-color: #f0f5f9; /* Светло-голубой фон контейнера */
  padding: 20px;
}

.title {
  color: #00BFFF; /* Светло-голубой цвет заголовка */
}

.table {
  border-collapse: collapse;
  width: 100%;
}

th,
td {
  padding: 8px;
  text-align: left;
}

th {
  background-color: #E6F4FF; /* Светло-голубой фон заголовков столбцов */
}

tr:nth-child(even) {
  background-color: #F0F8FF; /* Светло-голубой фон четных строк */
}

.btn-view,
.btn-delete,
.btn-close {
  background-color: #00BFFF; /* Светло-голубой фон кнопок */
  color: white;
  border: none;
  padding: 8px 16px;
  margin-right: 8px;
  cursor: pointer;
}
.btn-delete {
  background-color: #f85970;
}
.btn-view:hover,
.btn-close:hover {
  background-color: #87CEFA; /* Более светлый голубой фон кнопок при наведении */
}

.view-window {
  background-color: #E6F4FF; /* Светло-голубой фон окна просмотра */
  padding: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.view-window p {
  margin-bottom: 10px
}

/* Адаптивный дизайн до 600px */
@media (max-width: 600px) {
  .container {
    padding: 10px;
  }

  .title {
    font-size: 24px;
  }

  th,
  td {
    padding: 6px;
  }

  .btn-view,
  .btn-delete,
  .btn-close {
    padding: 6px 12px;
  }

  .view-window {
    padding: 10px;
  }

  .view-window p {
    margin-bottom: 6px;
  }
  .adaptive-hide {
    display: none;
  }
}
</style>
