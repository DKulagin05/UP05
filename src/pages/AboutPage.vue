<template>
  <div class="container">
    <div class="about-page">
      <div class="about-banner">
        <h1>Добро пожаловать в наше туристическое агентство!</h1>
      </div>

      <div class="about-content">
        <div class="about-section">
          <h2>Кто мы</h2>
          <p>Мы команда профессионалов, специализирующихся на организации путешествий по всему миру.</p>
        </div>

        <div class="about-section">
          <h2>Наши услуги</h2>
          <p>Мы предоставляем широкий спектр услуг, включая:</p>
          <ul>
            <li>Бронирование авиабилетов</li>
            <li>Бронирование отелей и курортов</li>
            <li>Транспортные услуги</li>
            <li>Организацию экскурсий и мероприятий</li>
            <li>Индивидуальное планирование маршрутов</li>
          </ul>
        </div>

        <div class="about-section">
          <h2>Наши преимущества</h2>
          <ul>
            <li>Опытные специалисты с глубокими знаниями в сфере туризма</li>
            <li>Надежные партнеры по всему миру</li>
            <li>Индивидуальный подход к каждому клиенту</li>
            <li>Гарантированное качество услуг</li>
            <li>24/7 поддержка клиентов</li>
          </ul>
        </div>

        <div class="about-section">
          <h2>Свяжитесь с нами</h2>
          <p>Начните планировать ваше следующее незабываемое путешествие уже сегодня! Свяжитесь с нами для получения подробной информации и консультации:</p>
          <p>Телефон: +7 123 456-7890</p>
          <p>Email: info@example.com</p>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  name: 'AboutPage',
};
</script>

<style scoped>
.container {
  background-color: #f0f5f9; /* Светло-голубой фон контейнера */
  padding: 20px;
}
/* Стили для страницы "О нас" */
.about-page {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.about-banner {
  text-align: center;
  margin-bottom: 30px;
}

.about-content {
  background-color: #f7f7f7;
  padding: 20px;
  border-radius: 5px;
}

.about-section {
  margin-bottom: 30px;
}

h1 {
  font-size: 32px;
  margin-bottom: 20px;
}

h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

p {
  margin-bottom: 10px;
}

ul {
  margin-bottom: 10px;
  padding-left: 20px;
}

li {
  margin-bottom: 5px;
}

.contact-info {
  font-weight: bold;
}
</style>
