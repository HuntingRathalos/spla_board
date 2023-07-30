<script setup lang="ts">
import { useAuth } from '~/composables/auth';

definePageMeta({
  // middleware: ['logged-in-is-redirects'],
});
const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});
// const email = ref('');
// const password = ref('');

const handleRegister = async () => {
  const { error } = await useAuth().register(form.value);
  if (!error.value) {
    navigateTo('/');
  }
};
</script>
<template>
  <NuxtLink to="requireAuth">認証</NuxtLink>
  <!-- <div v-if="useAuthStore().user">{{ useAuthStore().user.name }}</div> -->
  <form @submit.prevent="handleRegister">
    <label>
      Name
      <input v-model="form.name" type="text" />
    </label>
    <label>
      Email
      <input v-model="form.email" type="email" />
    </label>
    <label>
      Password
      <input v-model="form.password" type="password" />
    </label>
    <label>
      Password confirmation
      <input v-model="form.password_confirmation" type="password" />
    </label>

    <button>Register</button>
  </form>
</template>
