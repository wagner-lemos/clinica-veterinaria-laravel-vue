<template>
  <button
    class="w-full min-w-28 min-h-10 bg-secondary flex items-center justify-center rounded-6 hover:opacity-85 transition-opacity text-primary-text text-base font-bold"
    @click="handleClick"
  >
    {{ text }}
  </button>
</template>

<script setup>
const emit = defineEmits(["clicked"]);
const props = defineProps({
  text: String,
});

const handleClick = () => {
  emit("clicked");
};
</script>

<style></style>
