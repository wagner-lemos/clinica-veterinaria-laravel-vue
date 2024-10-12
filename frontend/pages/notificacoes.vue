<template>
  <div class="w-full flex flex-col justify-center items-center py-[10px]">
    <BannerPage slug="suas-notificacoes" />

    <div
      v-if="loadingNotifications"
      v-loading="loadingNotifications"
      element-loading-background="transparent"
      class="w-full h-56"
    ></div>
    <div v-else class="max-w-[860px] w-full px-3">
      <notification-item
        v-for="(notificacao, index) in notificacoesData.notificacoes"
        :key="index"
        :date="notificacao.date"
        :hour="notificacao.hour"
        :message="notificacao.message"
      />
    </div>

  </div>

  
</template>

<script setup>
import { ref, onMounted } from "vue";
import NotificationItem from "~/components/NotificationItem.vue";
import notificacoesData from "~/mocks/notificacoes.json";

const loadingNotifications = ref(false);

onMounted(() => {
  fetchNotificacoes();
});

const fetchNotificacoes = () => {
  try {
    loadingNotifications.value = true;
    data.value = notificacoesData;
  } catch (error) {
    console.log("error", error);
  } finally {
    loadingNotifications.value = false;
  }
};

</script>
