<script setup lang="ts">
const route = useRoute();

const form = ref({
  email: '',
  password: '',
  password_confirmation: '',
  token: route.query.token,
});

const handlePasswordReset = async () => {
  const { error } = await useApiFetch('/api/reset-password', {
    method: 'POST',
    body: form.value,
  });
};
</script>
<template>
  <form @submit.prevent="handlePasswordReset">
    <div class="">
      <label for="email"></label>
      <input v-model="form.email" type="email" name="email" id="email" />
    </div>
    <div class="">
      <label for="password"></label>
      <input v-model="form.password" type="password" name="password" id="password" />
    </div>
    <div class="">
      <label for="password_confirmation"></label>
      <input
        v-model="form.password_confirmation"
        type="password"
        name="password_confirmation"
        id="password_confirmation"
      />
    </div>
    <button type="submit">パスワードを設定する</button>
  </form>
</template>
