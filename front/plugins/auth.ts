import { useAuthStore } from '~/stores/auth';

export default defineNuxtPlugin(async (nuxtApp) => {
  console.log('init');
  if (process.server) {
    console.log('ssr');
    // ssrで取得しようとすると、ssrログでfetchエラーを吐いたので、csrで取得している（本当はssrの方が良い？）
  }

  if (process.client) {
    console.log('csr');
  }
  if (useCookie('auth').value) {
    // ssrでもstoreにアクセスできるっぽい
    await useAuthStore().updateUser();
  }
});
// logoutのタイミングでcookie,authを削除しないと常にユーザー取得Apiが叩かれちゃう
// 2回ログアウトしないと、cookieが消えない！！
