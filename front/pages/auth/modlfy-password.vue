<script setup lang="ts">
// 422エラー（必要カラムがわかっていない）を吐くので一旦スキップ
const form = ref({
  current_password: '',
  password: '',
  // password_confirm: '',
});

const handleModefyPassword = async () => {
  const { error } = await useApiFetch('/api/user/password', {
    method: 'PUT',
    body: form.value,
  });
};
</script>
<template>
  <form @submit.prevent="handleModefyPassword">
    <div class="">
      <label for="current_password">現在のパスワード</label>
      <input v-model="form.current_password" type="password" name="current_password" id="current_password" />
    </div>
    <div class="">
      <label for="password">パスワード</label>
      <input v-model="form.password" type="password" name="password" id="password" />
    </div>
    <!-- <div class="">
      <label for="password_confirm">パスワード確認用</label>
      <input v-model="form.password_confirm" type="password" name="password_confirm" id="password_confirm" />
    </div> -->
    <button type="submit">ログイン</button>
  </form>
</template>
