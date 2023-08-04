<script setup lang="ts">
// ここにpartyDetailを置く
// リストをクリックすると、ここに遷移する
// id番めのパーティをApi叩いて取得
// 自分の募集だけは更新できる
const form = ref({
  id: 0,
  genre_id: 1,
  body: '',
  start_at: new Date(),
  finished_at: new Date(),
});
const route = useRoute();
const id = Number(route.params.id);
const sortArray = [1, 2];
const friend_code = ref(1);

onMounted(() => {
  setParty();
});

const setParty = async () => {
  const party = await useParty().getParty(id);
  // form = Object.assign(form, party);
  form.value.id = party.id;
  form.value.genre_id = party.genre_id;
  form.value.body = party.body;
  form.value.start_at = party.start_at;
  form.value.finished_at = party.finished_at;
};

const handleUpdateParty = async () => {
  const party = await useParty().updateParty(form.value);
  console.log(party);
};
const handleDeleteParty = async () => {
  const party = await useParty().deleteParty(id);
};
const hondleJoin = async () => {
  await useUser().join(id, friend_code.value);
};
</script>
<template>
  <div class="">
    <NuxtLink to="/party/">partyIndex画面</NuxtLink>>
    <form @submit.prevent="handleUpdateParty">
      <select v-model="form.genre_id">
        <option v-for="num in sortArray" :key="num" :value="num" :selected="num === form.genre_id">{{ num }}</option>
      </select>
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
      <button type="submit">募集更新</button>
    </form>
    <div class="">
      <button @click="handleDeleteParty" type="button">募集削除</button>
    </div>
    <div class="">
      <label for="friend_code">フレンドコード</label>
      <input v-model="friend_code" type="number" name="friend_code" id="friend_code" />
      <button @click="hondleJoin" type="button">参加</button>
    </div>
  </div>
</template>
