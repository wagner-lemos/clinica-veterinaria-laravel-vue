<template>
  <svg
    :width="size"
    viewBox="0 0 34 33"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      d="M10.75 19.0785C10.75 19.0785 12.9375 21.9249 16.5833 21.9249C20.2292 21.9249 22.4167 19.0785 22.4167 19.0785M12.2083 11.9624H12.2233M20.9583 11.9624H20.9733M31.1667 16.232C31.1667 24.0922 24.6375 30.4641 16.5833 30.4641C8.52918 30.4641 2 24.0922 2 16.232C2 8.37191 8.52918 2 16.5833 2C24.6375 2 31.1667 8.37191 31.1667 16.232Z"
      :stroke="color"
      stroke-width="4"
      stroke-linecap="round"
      stroke-linejoin="round"
    />
  </svg>
</template>

<script>
export default {
  name: "IconCheckBranco",
  props: {
    color: {
      type: String,
      default: "#ffffff",
    },
    size: {
      type: Number,
      default: 19,
    },
  },
};
</script>

<style></style>
