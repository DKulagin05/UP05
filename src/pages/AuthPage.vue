<template>
  <div>
    <h1 style="text-align: center">Страница авторизации</h1>
    <div class="selects">
      <div class="input_label_box">
        <input style="display: none" type="radio" name="selectConstructor" id="login" value="login" v-model="selectedOption">
        <label for="login" class="radio-label">Авторизация</label>
      </div>
      <div class="input_label_box">
        <input style="display: none" type="radio" name="selectConstructor" id="registration" value="registration" v-model="selectedOption">
        <label for="registration" class="radio-label">Регистрация</label>
      </div>
    </div>

    <Login v-if="selectedOption === 'login'" />
    <Registration v-if="selectedOption === 'registration'" />
  </div>
</template>

<script>
import Registration from '@/components/Registration.vue';
import Login from "@/components/Login.vue";

export default {
  components: {
    Registration,
    Login,
  },
  data() {
    return {
      selectedOption: 'login',
    }
  }
};
</script>

<style>
.selects {
  display: flex;
  justify-content: center;
}

.input_label_box {
  display: inline-block;
  margin: 10px;
}

.radio-label {
  display: inline-block;
  padding: 10px 20px;
  background-color: #2B6CB0;
  color: #FFF;
  border-radius: 4px;
  cursor: pointer;
}
.radio-label:hover {
  background-color: #007BFF;
}

/* Стили для активного состояния input radio */
input[type="radio"]:checked + label {
  background-color: #007BFF;
}



</style>