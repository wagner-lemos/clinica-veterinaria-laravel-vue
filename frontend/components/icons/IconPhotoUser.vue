<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    :width="sizeW"
    :height="sizeH"
    viewBox="0 0 84 106"
    fill="none"
  >
    <path
      d="M59.0561 47.7C68.4756 38.1934 68.4756 22.7802 59.0561 13.2736C49.6365 3.76703 34.3644 3.76703 24.9449 13.2736C15.5253 22.7802 15.5253 38.1934 24.9449 47.7C34.3644 57.2066 49.6365 57.2066 59.0561 47.7Z"
      :fill="color"
    />
    <path
      d="M60.1624 63.6106H23.8402C10.6536 63.6106 0 74.3626 0 87.6711V106H84V87.6711C84 74.4102 73.3019 63.6106 60.1624 63.6106Z"
      :fill="color"
    />
    <path
      d="M72.6077 53.7812H63.4499V60.9298H79.6883V44.5414H72.6077V53.7812Z"
      :fill="color"
    />
    <path
      d="M72.6077 16.3937H79.6883V0.00528731H63.4499V7.15391H72.6077V16.3937Z"
      :fill="color"
    />
    <path
      d="M11.3425 7.14862H20.4977V0H4.26195V16.3884H11.3425V7.14862Z"
      :fill="color"
    />
    <path
      d="M20.4977 60.9246V53.7759H11.3425V44.5361H4.26195V60.9246H20.4977Z"
      :fill="color"
    />
  </svg>
</template>

<script>
export default {
  name: "IconPhotoUser",
  props: {
    color: {
      type: String,
      default: "white",
    },
    sizeH: {
      type: Number,
      default: 161,
    },
    sizeW: {
      type: Number,
      default: 128,
    },
  },
};
</script>

<style></style>
