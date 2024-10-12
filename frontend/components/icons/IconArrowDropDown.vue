<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    :width="size"
    viewBox="0 0 14 8"
    fill="none"
  >
    <path
      d="M12.7157 7.21516C13.0939 6.83538 13.0956 6.21864 12.7157 5.83724L7.68286 0.784837C7.30467 0.405055 6.69051 0.405055 6.31231 0.784837L1.27943 5.83886C0.902851 6.22189 0.9077 6.83863 1.28913 7.21679C1.6657 7.59008 2.27178 7.59008 2.64998 7.21679L6.99759 2.84929L11.3452 7.21516C11.7234 7.59495 12.3376 7.59495 12.7157 7.21516Z"
      :fill="color"
      :stroke="color"
    />
  </svg>
</template>

<script>
export default {
  name: "IconArrowDropDown",
  props: {
    color: {
      type: String,
      default: "#ffffff",
    },
    size: {
      type: Number,
      default: 14,
    },
  },
};
</script>

<style></style>
