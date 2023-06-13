<template>
  <div class="wrapper">
    <label for="clientPhone">Номер клиента:</label>
    <input type="text" id="clientPhone" v-model="search_id" required>
    <button @click="SearchUser()" class="button">Найти</button>
    <div class="redact" v-if="user !== null">
      <label for="clientName">Имя клиента:</label>
      <input type="text" id="clientName" :value="user.client_name" disabled>
      <label for="clientCategoryId">Категория клиента:</label>
      <select id="clientCategoryId" v-model="user.client_category_id" required>
        <option v-for="category in CategoryArray" :value="category.category_id">{{ category.category_name }}</option>
      </select>

      <button @click="SaveChanges" class="button">Сохранить изменения</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "UserRedactor",
  data() {
    return {
      CategoryArray: [],
      user: null,
      newCategory: 1,
      search_id: null,
    };
  },
  methods: {
    SearchUser() {
      fetch("http://practic/src/api/GetUser.php", {
        method: "POST",
        body: JSON.stringify({
          user_phone: this.search_id,
        }),
      })
          .then((response) => response.json())
          .then((data) => {
            this.user = null
            if (data !== "Error") {
              this.user = data[0];
            } else {
              alert('Пользователя с таким номером не существует');
            }
          })
          .catch((error) => console.error(error));
    },
    SaveChanges() {
      fetch("http://practic/src/api/EditUserCategory.php", {
        method: "POST",
        body: JSON.stringify({
          id_user: this.user.client_id,
          id_category: this.user.client_category_id,
        }),
      })
          .then((response) => response.json())
          .then((data) => {
            alert(data);
            location.reload();
          })
          .catch((error) => console.error(error));
    },
  },
  mounted() {
    fetch("http://practic/src/api/GetAllCategories.php", {
      method: "POST",
    })
        .then((response) => response.json())
        .then((data) => {
          this.CategoryArray = data;
        })
        .catch((error) => console.error(error));
  },
};
</script>

<style scoped>
.wrapper {
  background-color: #f0f6fc;
  padding: 20px;
  border-radius: 10px;
}

label {
  color: #0066cc;
  font-weight: bold;
  margin-bottom: 10px;
  display: block;
}

input[type="text"],
select {
  padding: 8px;
  border: 1px solid #c2d6e3;
  border-radius: 4px;
  margin-bottom: 15px;
  width: 100%;
}

button {
  background-color: #0066cc;
  color: #ffffff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.redact {
  margin-top: 20px;
}
</style>
