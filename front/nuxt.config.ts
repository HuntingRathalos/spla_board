// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  // ssr: true,
  // ssr: false,
  // build: {
  //   extend(config, ctx) {
  //     if (ctx.isDev) {
  //       config.devtool = ctx.isClient ? 'source-map' : 'inline-source-map'
  //     }
  //   },
  // },
  modules: ['@pinia/nuxt', '@pinia-plugin-persistedstate/nuxt'],
  css: ['@/assets/css/main.css'],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  runtimeConfig: {
    public: {
      baseURL: 'http://localhost:80',
      baseContainerURL: 'http://nginx:80',
      referer: 'http://localhost:3000',
      // dockerのコンテナ名で指定する必要あり？
      // baseURL: 'http://api:80',
      // browserBaseURL: "http://localhost:80"
      auth: {
        endpoint: {
          csrf: '/sanctum/csrf-cookie',
          login: '/api/login',
          logout: '/api/logout',
          user: '/api/user',
          // register: '/api/register',
        },
      },
    },
    watchers: {
      webpack: {
        poll: true,
      },
    },
    sourcemap: {
      // server: true,
      client: true,
    },
  },
});
