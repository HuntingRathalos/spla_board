import { useAuthStore } from '~/stores/auth';

export default defineNuxtRouteMiddleware(async (to, from) => {
  // if (process.server) return;

  if (useAuthStore().isAuthenticated) {
    return navigateTo('/');
  }
});
