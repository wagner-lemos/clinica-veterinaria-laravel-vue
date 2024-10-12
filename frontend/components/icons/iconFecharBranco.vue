<template>
  <svg
    :width="size"
    viewBox="0 0 22 22"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      d="M2 20L20 2M2 2L20 20"
      :stroke="color"
      stroke-width="2.5"
      stroke-linecap="round"
      stroke-linejoin="round"
    />
  </svg>
</template>

<script>
export default {
  name: "IconFecharBranco",
  props: {
    color: {
      type: String,
      default: "#ffffff",
    },
    size: {
      type: Number,
      default: 18,
    },
  },
};
</script>

<style></style>
