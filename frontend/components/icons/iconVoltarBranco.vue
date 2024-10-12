<template>
  <svg
    :width="size"
    viewBox="0 0 9 14"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      d="M7.71516 1.28425C7.33538 0.906058 6.71864 0.904442 6.33724 1.28425L1.28484 6.31714C0.905055 6.69533 0.905055 7.30949 1.28484 7.68769L6.33886 12.7206C6.72189 13.0971 7.33863 13.0923 7.71679 12.7109C8.09008 12.3343 8.09008 11.7282 7.71679 11.35L3.34929 7.00241L7.71516 2.6548C8.09495 2.27661 8.09495 1.66245 7.71516 1.28425Z"
      fill="white"
      :stroke="color"
    />
  </svg>
</template>

<script>
export default {
  name: "IconVoltarBranco",
  props: {
    color: {
      type: String,
      default: "#ffffff",
    },
    size: {
      type: Number,
      default: 7,
    },
  },
};
</script>

<style></style>
