<template>

</template>

<script>

export default {
  name: "Logout",
  mounted() {
    localStorage.clear();
    this.$router.push('/auth')
  }
}
</script>

<style scoped>

</style>