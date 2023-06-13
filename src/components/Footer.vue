<template>
  <footer class="footer">
    <div class="footer-content">
<!--      <div class="mailing">-->
<!--        <form>-->
<!--          <input type="text" placeholder="">-->
<!--          <button>Подписаться</button>-->
<!--        </form>-->
<!--        <div class="mailing_additional">-->
<!--          Так же вы можете написат-->
<!--        </div>-->
<!--      </div>-->
      <div class="footer-column">
        <h3 class="footer-heading">О нас</h3>
        <p>Наше туристическое агентство предлагает комфортное размещение и превосходное обслуживание для всех гостей. Мы с радостью встретим вас и обеспечим приятное пребывание.</p>
      </div>
      <div class="footer-column">
        <h3 class="footer-heading">Контакты</h3>
        <p><i class="fas fa-map-marker-alt"></i> Адрес: 123 ул. Гостеприимная, Город</p>
        <p><i class="fas fa-phone"></i> Телефон: +1 234 567 890</p>
        <p><i class="fas fa-envelope"></i> Email: info@example.com</p>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2023 Туристическое агентство. Все права защищены.</p>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer',
};
</script>

<style scoped>
.footer {
  background-color: #333;
  color: #fff;
  padding: 40px 0 20px 0;
}

.footer-content {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  max-width: 1200px;
  margin: 0 auto;
}

.footer-column {
  flex: 1 1 300px;
  max-width: 400px;
  margin-bottom: 20px;
}

.footer-heading {
  font-size: 20px;
  margin-bottom: 10px;
}

.footer-links {
  list-style: none;
  padding: 0;
}

.footer-links li {
  margin-bottom: 8px;
}

.footer-links a {
  color: #fff;
  text-decoration: none;
}

.footer-links a:hover {
  text-decoration: underline;
}

.footer-bottom {
  text-align: center;
  margin-top: 20px;
}

.footer-bottom p {
  font-size: 14px;
}

/* Адаптивный дизайн для ширины экрана до 600px */
@media screen and (max-width: 600px) {
  .footer-content {
    flex-direction: column;
    align-items: center;
  }

  .footer-column {
    margin-bottom: 30px;
    max-height: 150px;
    text-align: center;
  }

  .footer-column:last-child {
    margin-bottom: 0;
  }

  .footer-heading {
    font-size: 18px;
  }

  .footer-bottom p {
    font-size: 12px;
  }
}
</style>
