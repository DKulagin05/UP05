<template>
  <div class="promotion-search">
    <h2 class="title">Поиск акционных маршрутов</h2>

    <div class="client-select">
      <label for="clientSelect">Выберите клиента:</label>
      <select id="clientSelect" v-model="selectedClient">
        <option v-for="client in clients" :key="client.id" :value="client.id">{{ client.name }}</option>
      </select>
      <p v-if="selectedClient">Статус клиента: {{ getClientStatus(selectedClient) }}</p>
    </div>

    <table class="routes-table">
      <thead>
      <tr>
        <th>Маршрут</th>
        <th>Дата тура</th>
        <th>Полная сумма путевки</th>
        <th>Сумма путевки с учетом скидки</th>
        <th>Применяемые акции</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="route in filteredRoutes" :key="route.id">
        <td>{{ route.route }}</td>
        <td>{{ route.date }}</td>
        <td>{{ route.fullPrice }}</td>
        <td>{{ getDiscountedPrice(route) }}</td>
        <td>{{ getPromotionsForRoute(route.id) }}</td>
      </tr>
      </tbody>
    </table>

    <p class="result-count">Всего найдено маршрутов: {{ filteredRoutes.length }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectedClient: null,
      clients: [
        { id: 1, name: 'Клиент 1', status: 'Platinum' },
        { id: 2, name: 'Клиент 2', status: 'Gold' },
        { id: 3, name: 'Клиент 3', status: 'Silver' },
        // ...
      ],
      routes: [
        { id: 1, route: 'Маршрут 1', date: '2023-06-01', fullPrice: 1000 },
        { id: 2, route: 'Маршрут 2', date: '2023-06-02', fullPrice: 1500 },
        { id: 3, route: 'Маршрут 3', date: '2023-06-03', fullPrice: 2000 },
        { id: 4, route: 'Маршрут 4', date: '2023-06-04', fullPrice: 2500 },
        // ...
      ],
      promotions: [
        { routeId: 1, promotionId: 1, discount: 100, client: 'all'},
        { routeId: 2, promotionId: 2, discount: 200, client: 'gold' },
        { routeId: 2, promotionId: 3, discount: 150, client: 'Silver' },
        { routeId: 4, promotionId: 4, discount: 500, client: 'Platinum' },
        // ...
      ],
    };
  },
  computed: {
    filteredRoutes() {
      return this.routes.map(route => {
        const promotion = this.getPromotionForRoute(route.id);
        if (promotion) {
          return {
            ...route,
            route: this.getPromotionName(promotion.promotionId),
            discount: promotion.discount,
          };
        } else {
          return route;
        }
      }).sort((a, b) => {
        return this.getDiscountedPrice(a) - this.getDiscountedPrice(b);
      });
    },
  },
  methods: {
    getPromotionForRoute(routeId) {
      const test = this.promotions.find(promotion => promotion.routeId === routeId);
      return test.find(promotion => promotion.client === "gold")
    },
    getPromotionName(promotionId) {
      // Здесь может быть логика получения названия акции по её идентификатору
      // Например, запрос к серверу или использование словаря акций
      return `Акция ${promotionId}`;
    },
    getDiscountedPrice(route) {
      const promotion = this.getPromotionForRoute(route.id);
      if (promotion) {
        return route.fullPrice - promotion.discount;
      } else {
        return route.fullPrice;
      }
    },
    getClientStatus(clientId) {
      const client = this.clients.find(client => client.id === clientId);
      return client ? client.status : 'None';
    },
    getPromotionsForRoute(routeId) {
      const promotions = this.promotions.filter(promotion => promotion.routeId === routeId);
      return promotions.map(promotion => `${promotion.promotionId}: ${promotion.discount}`).join(', ');
    },
  },
};
</script>