<template>

  <svg :width="size"  viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path
      d="M1.6136 8.97727L1.61137 8.97847C1.55705 9.00764 1.49385 9.00605 1.44393 8.98042C1.44159 8.97922 1.43945 8.97805 1.4375 8.97692V1.02504C1.44037 1.0232 1.44377 1.02121 1.44776 1.01914C1.49558 0.994326 1.55714 0.992201 1.61137 1.02132L1.61232 1.02183L9.05277 5.00684L1.6136 8.97727Z"
      :stroke="color" stroke-width="2" />
  </svg>

</template>

<script>
export default {
  name: "IconPlayLaranja",
  props: {
    color: {
      type: String,
      default: "#F5821F",
    },
    size: {
      type: Number,
      default: 10,
    },
  },
};
</script>

<style></style>
