<template>
  <div class="wrapper" style="margin-bottom: 50px;">
    <div class="selects">
      <div class="input_label_box">
        <input type="radio" name="selectConstructor" id="promo" value="promo" v-model="selectedOption">
        <label for="promo">Создать акцию</label>
      </div>

      <div class="input_label_box">
        <input type="radio" name="selectConstructor" id="hotel" value="hotel" v-model="selectedOption">
        <label for="hotel">Создать отель</label>
      </div>

      <div class="input_label_box">
        <input type="radio" name="selectConstructor" id="location" value="location" v-model="selectedOption">
        <label for="location">Создать адрес</label>
      </div>

      <div class="input_label_box">
        <input type="radio" name="selectConstructor" id="user" value="user" v-model="selectedOption">
        <label for="user">Создать пользователя</label>
      </div>

      <div class="input_label_box">
        <input type="radio" name="selectConstructor" id="tour" value="tour" v-model="selectedOption">
        <label for="tour">Создать тур</label>
      </div>

      <div class="input_label_box">
        <input type="radio" name="selectConstructor" id="userR" value="userR" v-model="selectedOption">
        <label for="userR">Редактировать статус пользователя</label>
      </div>

      <div class="input_label_box">
        <input type="radio" name="selectConstructor" id="service" value="service" v-model="selectedOption">
        <label for="service">Создать услугу</label>
      </div>


    </div>
    <div style="text-align: center; font-size: 32px" v-if="selectedOption === null">Выберите функцию</div>
    <div style="padding: 0 15px">
    <PromotionConstructor v-if="selectedOption === 'promo'"/>
    <HotelConstructor v-if="selectedOption === 'hotel'"/>
    <LocationConstructor v-if="selectedOption === 'location'"/>
    <UserConstructor v-if="selectedOption === 'user'"/>
    <TourConstructor v-if="selectedOption === 'tour'"/>
    <UserRedactor v-if="selectedOption === 'userR'"/>
    <ServiceConstructor v-if="selectedOption === 'service'"/>
    </div>
  </div>
</template>

<script>
import PromotionConstructor from '@/components/PromotionConstructor.vue';
import HotelConstructor from "@/components/HotelConstructor.vue";
import UserConstructor from "@/components/UserConstructor.vue";
import LocationConstructor from "@/components/LocationConstructor.vue";
import TourConstructor from "@/components/TourConstructor.vue";
import UserRedactor from "@/components/UserRedactor.vue";
import ServiceConstructor from "@/components/ServiceConstructor.vue";

export default {
  name: "AdminPage",
  components: {
    PromotionConstructor,
    HotelConstructor,
    UserConstructor,
    LocationConstructor,
    TourConstructor,
    UserRedactor,
    ServiceConstructor,
  },
  data() {
    return {
      selectedOption: null,
      user: null
    }
  },
  watch: {

  },
  methods: {
  },
  mounted() {
    // if (localStorage.getItem('user')) {
    //   this.user = localStorage.getItem('user')
    // } else {
    //   this.user = {
    //     admin: 0
    //   }
    // }
    // if (this.user.admin === '1') {
    // } else {
    //   this.$router.push('/auth')
    // }
  }
}
</script>

<style scoped>
.selects {
  display: flex;
  gap: 20px;
  padding: 20px;
  flex-wrap: wrap;
}

input[type="radio"] {
  display: none;
}

label {
  border: 1px solid #00BFFF;
  padding: 15px;
}

/* Стили для активного состояния input radio */
input[type="radio"]:checked + label {
  background-color: #00BFFF;
}

label:hover {
  cursor: pointer;
}
</style>