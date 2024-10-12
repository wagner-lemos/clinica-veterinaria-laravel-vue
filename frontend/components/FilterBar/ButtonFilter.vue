<template>
  <button
    @click="$emit('clicked')"
    class="text-base font-bold w-full p-1 min-h-12 rounded-15 border-[3px] border-primary text-primary-text hover:bg-primary hover:text-secondary transition-colors"
    :class="active ? 'bg-primary text-secondary' : ''"
  >
    {{ text }}
  </button>
</template>
<script setup>
const props = defineProps({
  text: {
    type: String,
    default: "Button",
  },
  active: Boolean,
});
</script>
