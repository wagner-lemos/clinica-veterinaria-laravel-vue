<template>
    <svg xmlns="http://www.w3.org/2000/svg" :width="size" :height="Math.round(size / 0.81)" viewBox="0 0 12 20" fill="none">
        <path
            d="M10.2802 11.2493L10.8491 7.63143H7.28496V5.27982C7.28496 4.29056 7.78417 3.32391 9.38047 3.32391H11V0.243075C11 0.243075 9.52559 0 8.12084 0C5.18364 0 3.26227 1.73544 3.26227 4.87281V7.63143H0V11.2493H3.26227V20H7.27916V11.2493H10.2802Z"
            :fill="color" />
    </svg>
</template>

<script>
export default {
    name: 'IconFacebook',
    props: {
        color: {
            type: String,
            default: '#00395A',
        },
        size: {
            type: Number,
            default: 12
        }
    }
}
</script>

<style></style>