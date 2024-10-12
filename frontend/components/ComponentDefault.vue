<template>
  <h1>{{ nome }}</h1>
</template>

<script>
import { reactive } from 'vue';
import IconFacebook from '/components/icons/IconFacebook.vue';
import IconLinkedin from '/components/Icons/IconLinkedin.vue';
import IconYoutube from '/components/Icons/IconYoutube.vue';

import CookieComplianceModal from '../CookiesModal/CookieComplianceModal.vue';

export default {
  name: 'ComponentDefault',
  components: {
      IconFacebook,
      IconLinkedin,
      IconYoutube,
      CookieComplianceModal
  },
  props: {
    prop1: String,
  },
  setup() {
      const nome =ref('');
      nome.value = "Fulano";

      const state = reactive({
          socialLinksData: [
              {
                  name: 'Facebook',
                  link: 'https://www.facebook.com/amcorlimited/',
                  iconName: 'icon-facebook',
                  size: 16
              },
              {
                  name: 'Linkedin',
                  link: 'https://www.linkedin.com/company/amcor',
                  iconName: 'icon-linkedin',
                  size: 20
              },
              {
                  name: 'Youtube',
                  link: 'https://www.youtube.com/user/AmcorPackaging',
                  iconName: 'icon-youtube',
                  size: 20
              },
          ]
      })

      return {
          state,
          nome
      }
  }
}
</script>

<style scoped>
.__footer-container::after {
  content: '';
  display: block;
  position: absolute;
  bottom: calc(100% - 1px);
  width: 360px;
  height: 67px;
  right: 0;
}
</style>

