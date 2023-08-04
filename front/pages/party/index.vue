<script setup lang="ts">
import { useApiFetch } from '~/composables/useApiFetch';
import { usePartyStore } from '~/stores/party';

const store = usePartyStore();
const parties = store.parties;
// console.log(parties);

let tabNumber = ref(1);

const toggleTabs = (num: number) => {
  tabNumber.value = num;
};
// onMounted(() => {
//   console.log('aaa');
// });
const handleFetch = async () => {
  // const { data } = await useApiFetch('/api/parties', { method: 'GET' });
  useParty().getParties();
  // usePartyStore().setParties(data.value);
};
// handleFetch();
</script>

<template>
  <div class="flex flex-wrap">
    <div class="w-full">
      <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
          <a
            class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal"
            v-on:click="toggleTabs(1)"
            v-bind:class="{ 'text-pink-600 bg-white': tabNumber !== 1, 'text-white bg-pink-600': tabNumber === 1 }"
          >
            Profile
          </a>
        </li>
        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
          <a
            class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal"
            v-on:click="toggleTabs(2)"
            v-bind:class="{ 'text-pink-600 bg-white': tabNumber !== 2, 'text-white bg-pink-600': tabNumber === 2 }"
          >
            Settings
          </a>
        </li>
        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
          <a
            class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal"
            v-on:click="toggleTabs(3)"
            v-bind:class="{ 'text-pink-600 bg-white': tabNumber !== 3, 'text-white bg-pink-600': tabNumber === 3 }"
          >
            Options
          </a>
        </li>
      </ul>
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
        <div class="px-4 py-5 flex-auto">
          <div class="tab-content tab-space">
            <button @click="handleFetch">fetch</button>
            <NuxtLink to="/party/create">party作成画面</NuxtLink>>

            <PartyList :parties="parties" />
            <div v-bind:class="{ hidden: tabNumber !== 1, block: tabNumber === 1 }">
              <p>
                Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C
                users after installed base benefits.
                <br />
                <br />
                Dramatically visualize customer directed convergence without revolutionary ROI.
              </p>
            </div>
            <div v-bind:class="{ hidden: tabNumber !== 2, block: tabNumber === 2 }">
              <p>
                Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate
                one-to-one customer service with robust ideas.
                <br />
                <br />
                Dynamically innovate resource-leveling customer service for state of the art customer service.
              </p>
            </div>
            <div v-bind:class="{ hidden: tabNumber !== 3, block: tabNumber === 3 }">
              <p>
                Efficiently unleash cross-media information without cross-media value. Quickly maximize timely
                deliverables for real-time schemas.
                <br />
                <br />
                Dramatically maintain clicks-and-mortar solutions without functional solutions.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
