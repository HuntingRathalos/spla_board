import { FetchContext } from 'ofetch';
import { UseFetchOptions } from 'nuxt/app';
import { useRequestHeaders } from 'nuxt/app';

export function useApiFetch<T>(path: string, options: UseFetchOptions<T> = {}) {
  const config = useRuntimeConfig();

  let headers: any = {
    Accept: 'application/json',
  };
  let baseURL = config.public.baseURL;

  const token = useCookie('XSRF-TOKEN');

  if (token.value) {
    headers['X-XSRF-TOKEN'] = token.value as string;
  }

  if (process.server) {
    baseURL = config.public.baseContainerURL as string;
    headers = {
      ...headers,
      ...useRequestHeaders(['cookie']),
      referer: config.public.referer,
    };
  }

  const onRequest = ({ request, options }: FetchContext) => {
    //   // Log request
    // console.info('[fetch request]', request, options);
  };
  const onResponse = ({ request, response }: FetchContext) => {
    //   // Log request
    // type ReturnFetchType<T extends string> = ReturnType<typeof useFetch<void, unknown, T>>['data'];
    // type Data = ReturnFetchType<"api/user">
    console.info('[fetch request]', request, options);
    // console.log(response?._data as User);
    // console.log(typeof response?._data);
  };

  const onResponseError = ({ request, response }: FetchContext) => {
    // Log error
    console.error('[fetch response error]', request, response?.status);
    if (response?.status) {
      showError({ statusCode: response.status, message: response._data.message });
      console.log('error');
      console.log(response);
      // responsemマクロが機能するようにしたい（api/userが機能してない？）
      // throw createError({ statusCode: response.status, statusMessage: 'Page Not Found', fatal: true });
    }
    // Handle response error...
  };

  return useFetch(baseURL + path, {
    credentials: 'include',
    watch: false,
    ...options,
    headers: {
      ...headers,
      ...options?.headers,
    },
    onRequest,
    onResponse,
    onResponseError,
  });
}

// // ログイン画面
// 会員登録機能、型定義
