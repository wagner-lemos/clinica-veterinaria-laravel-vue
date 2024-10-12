<template>
  <div class="flex flex-col w-full gap-4 align-baseline justify-center">
    <div class="flex flex-col pt-[17px] pb-4 border-b-2 border-quaternary">
      <div class="flex gap-[2px] px-[6px]">
        <h3 class="font-bold text-base text-secondary-text">
          {{ date }}
          <span v-if="hour !== '' && hour !== null && hour"> - </span>
          {{ hour }}
        </h3>
      </div>

      <div
        v-if="message !== '' && message !== null && message"
        class="flex gap-[5px] items-start px-[6px]"
      >
        <h2 class="font-medium text-base text-primary ">
          {{ message }}
        </h2>
      </div>
      <div v-else class="flex gap-[5px] items-start px-[6px]">
        <h2 class="font-medium text-base text-primary h-4">
          Mensagem não informada.
        </h2>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "NotificationItem",
  props: {
    date: {
      type: String,
    },
    hour: {
      type: String,
    },
    message: {
      type: String,
    },
  },
};
</script>

<style>

</style>
