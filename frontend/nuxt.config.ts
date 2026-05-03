// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  ssr: true,
  app: {
    head: {
      title: 'Masons Au Pair | Premium Au Pair Matching Platform',
      meta: [
        { name: 'description', content: 'Connecting high-quality au pairs with host families globally.' }
      ]
    }
  },
  css: ['~/assets/css/main.css']
})
