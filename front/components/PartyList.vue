<script setup lang="ts">
import { Party } from '~/types/party';
defineProps<{ parties: Party[] }>();

// propsでリストの情報を受けて表示、クリックで詳細へ遷移
const keyword = ref('');
const sort = ref(1);
const sortArray = ['1', '2'];

const handleFetchParties = async () => {
  // useParty().getParties(keyword, sort);
  // const { data } = await useApiFetch(`/api/parties?keyword=${keyword.value}`, { method: 'GET' });
  // const { data } = await useApiFetch('/api/parties?keyword=こんにちは', { method: 'GET' });
  // const { data } = await useApiFetch('/api/parties?keyword=""', { method: 'GET' });
  const { data } = await useApiFetch('/api/parties?keyword=こんにちは&sort=2', { method: 'GET' });
  console.log(data);
};
</script>

<template>
  <div class="">
    <ul>
      <li v-for="party in parties">
        <NuxtLink :to="`/party/${party.id}`">{{ party.id }}</NuxtLink>
      </li>
    </ul>
    <form @submit.prevent="handleFetchParties" method="get">
      <div class="">
        <label for="keyword">キーワード</label>
        <input v-model="keyword" type="text" name="keyword" id="keyword" />
      </div>
      <button type="submit">検索する</button>
    </form>
    <form @submit.prevent="handleFetchParties" method="get">
      <div class="">
        <label for="sort">検索順</label>
        <select v-model="sort">
          <option v-for="num in sortArray" :key="num" value="num">{{ num }}</option>
        </select>
      </div>
      <button type="submit">検索する</button>
    </form>
  </div>
</template>
