<template>
  <header class="site-header">
    <nav>
      <button class="nav-toggle" @click="toggleNav" v-if="isMobile">
        <span class="toggle-icon" :class="{ 'open': isNavOpen }"></span>
        <span class="toggle-icon" :class="{ 'open': isNavOpen }"></span>
        <span class="toggle-icon" :class="{ 'open': isNavOpen }"></span>
      </button>
      <ul class="nav-list" :class="{ 'nav-list-open': isNavOpen }">
        <li><router-link to="/">Главная</router-link></li>
        <li><router-link to="/sale">Акции</router-link></li>
        <li><router-link to="/about">О нас</router-link></li>
        <li><router-link to="/hotels">Отели</router-link></li>
        <li><router-link to="/services">Услуги</router-link></li>
        <li><router-link to="/reviews">Отзывы</router-link></li>
        <li v-if="!user"><router-link to="/auth">Авторизация/регистрация</router-link></li>
        <li v-if="user.admin === '1'"><router-link to="/admin">Админ панель</router-link></li>
        <li v-if="user"><router-link to="/profile">Профиль</router-link></li>
        <li v-if="user"><router-link to="/logout">Выйти</router-link></li>
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  data() {
    return {
      user: false,
      isNavOpen: false,
      isMobile: false
    };
  },
  mounted() {
    if (localStorage.getItem('user')) {
      this.user = JSON.parse(localStorage.getItem('user'))[0];
    }
    this.checkMobile();
    window.addEventListener('resize', this.checkMobile);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.checkMobile);
  },
  methods: {
    toggleNav() {
      this.isNavOpen = !this.isNavOpen;
    },
    checkMobile() {
      this.isMobile = window.innerWidth <= 600;
    }
  }
};
</script>

<style scoped>
.site-header {
  background-color: #f2f2f2;
  padding: 20px;
  display: flex;
  justify-content: center;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.site-header nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
  gap: 30px;
}

.site-header nav ul li {
  margin-right: 20px;
}

.site-header nav ul a {
  text-decoration: none;
  color: #333;
  font-size: 18px;
  font-weight: bold;
  transition: color 0.3s ease;
}

.site-header nav ul a:hover {
  color: #00bfff;
}

/* Styles for mobile menu */
@media (max-width: 600px) {
  .site-header nav ul {
    display: none;
    flex-direction: column;
    gap: 10px;
    padding-top: 10px;
  }

  .site-header nav ul.nav-list-open {
    display: flex;
  }

  .site-header nav ul li {
    margin-right: 0;
  }

  .site-header nav ul a {
    display: block;
    text-align: center;
  }

  .site-header nav ul li:first-child {
    margin: 10px 0;
  }

  .site-header nav .nav-toggle {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 5px;

  }

  .site-header nav .toggle-icon {
    display: flex;
    width: 25px;
    height: 3px;
    background-color: #333;
    flex-direction: row;
    gap: 5px;
    transition: transform 0.3s ease;
  }

  .site-header nav .toggle-icon.open {
    /*transform: rotate(90deg);*/
  }
}
</style>
