// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,

  app: {
    head: {
      link: [
        {
          rel: "stylesheet",
          href: "https://vjs.zencdn.net/8.10.0/video-js.css",
        },
      ],
    },
  },

  devtools: { enabled: true },

  modules: [
    "@nuxtjs/tailwindcss",
    "@pinia/nuxt",
    "@vueuse/motion/nuxt",
    "@element-plus/nuxt",
    "vue3-carousel-nuxt",
    [
      "@nuxtjs/google-fonts",
      {
        families: {
          Montserrat: true,
        },
      },
    ],
    "vue3-carousel-nuxt",
  ],

  swiper: {},

  pinia: {
    storesDirs: ["./stores/**", "./custom-folder/stores/**"],
  },

  css: ["~/assets/css/main.css"],

  tailwindcss: {
    cssPath: ["~/assets/css/tailwind.css", { injectPosition: "last" }],
    configPath: "tailwind.config",
    exposeConfig: {
      level: 2,
    },
    config: {},
    viewer: true,
  },

  runtimeConfig: {
    public: {
      baseApiUrl: 'http://localhost:8000/api',
    },
  },

  compatibilityDate: "2024-10-12",
});