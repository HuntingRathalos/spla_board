<script setup lang="ts">
const form = ref({
  genre_id: 1,
  body: '',
  start_at: '',
  finished_at: '',
});
const handleCreateParty = async () => {
  await useParty().createParty(form.value);
};
</script>
<template>
  <div class="">
    <NuxtLink to="/party/">partyIndex画面</NuxtLink>>
    <form @submit.prevent="handleCreateParty">
      <div class="">
        <!-- genre_idをセレクトボックスで取得する -->
        <label for=""></label>
        <input v-model="form.genre_id" type="number" name="" id="" />
      </div>
      <div class="">
        <label for="body"></label>
        <input v-model="form.body" type="text" name="body" id="body" />
      </div>
      <div class="">
        <label for="start_at"></label>
        <input v-model="form.start_at" type="datetime-local" name="start_at" id="start_at" />
      </div>
      <div class="">
        <label for="finished_at"></label>
        <input v-model="form.finished_at" type="datetime-local" name="finished_at" id="finished_at" />
      </div>
      <button type="submit">募集作成</button>
    </form>
  </div>
</template>
