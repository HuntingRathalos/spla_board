import { defineStore } from 'pinia';
import { useAuth } from '~/composables/auth';

export const useUserStore = defineStore({
  id: 'user',
  state: () => {
    return {};
  },
});
