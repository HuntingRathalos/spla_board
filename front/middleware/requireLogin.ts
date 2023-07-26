import { useAuthStore } from '~/stores/auth';

export default defineNuxtRouteMiddleware(async (to, from) => {
  // このコードがあると、ssr時にこのmiddlewareが作用せずに、auth/requireAuth(要認証ぺーじ)に遷移してしまうので、ハイドレーションエラーを起こした
  // if (process.server) return;

  if (!useAuthStore().isAuthenticated) {
    // 現状errorは吐いていないが,ssrでstoreにアクセスできるのかどうかが曖昧
    return navigateTo('/auth/login');
  }
});
