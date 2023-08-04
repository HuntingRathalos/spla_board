<script setup lang="ts">
import { useAuthStore } from '~/stores/auth';

const store = useAuthStore();

const form = ref({
  name: store.user?.name,
  email: store.user?.email,
});

const handleModifyProfile = async () => {
  const { error } = await useApiFetch('/api/user/profile-information', {
    method: 'PUT',
    body: form.value,
  });
  if (!error) {
    store.updateUser();
  }
};
</script>
<template>
  <form @submit.prevent="handleModifyProfile">
    <div>
      <label>
        Name
        <input v-model="form.name" type="text" />
      </label>
    </div>
    <div class="">
      <label for="email"></label>
      <input v-model="form.email" type="email" name="email" id="email" />
    </div>
    <button type="submit">ログイン</button>
  </form>
</template>
