<template>
  <svg 
    :width="size" 
    viewBox="0 0 16 13" 
    fill="none" 
    xmlns="http://www.w3.org/2000/svg">
    <path 
      d="M2 7.4L5.42857 11L14 2" 
      :stroke="color" 
      stroke-width="2.5" 
      stroke-linecap="round" 
      stroke-linejoin="round"/>
  </svg> 
</template>

<script>
export default {
  name: "IconCheckLaranja",
  props: {
    color: {
      type: String,
      default: "#F5821F",
    },
    size: {
      type: Number,
      default: 12,
    },
  },
};
</script>

<style></style>
