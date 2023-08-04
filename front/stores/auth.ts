import { defineStore } from 'pinia';
import { useAuth } from '~/composables/auth';
import { User, Credentials, RegistrationInfo } from '~/types/auth';

export const useAuthStore = defineStore({
  id: 'auth',
  state: () => {
    return {
      user: null as null | User,
    };
  },
  getters: {
    isAuthenticated(state) {
      return state.user !== null;
    },
  },
  actions: {
    async updateUser() {
      try {
        const user = await useAuth().user();
        console.log(user);
        this.user = user;
        // console.log(this.user);
      } catch (error) {
        console.error(error);
        this.resetUser();
      }
    },
    resetUser() {
      this.user = null;
    },
  },
  persist: true,
  // cookieははログアウト時にバックエンド側で削除するように実装
  // persist: {
  //   storage: persistedState.cookiesWithOptions({
  //     maxAge: 2,
  //   }),
  // },
});
