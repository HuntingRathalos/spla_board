<script setup lang="ts">
const form = ref({
  email: '',
});

const handleSendPasswordResetEmail = async () => {
  const { error } = await useApiFetch('/api/forgot-password', {
    method: 'POST',
    body: form.value,
  });
};
</script>
<template>
  <form @submit.prevent="handleSendPasswordResetEmail">
    <div class="">
      <label for="email"></label>
      <input v-model="form.email" type="email" name="email" id="email" />
    </div>
    <button type="submit">ログイン</button>
  </form>
</template>
