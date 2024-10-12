<template>
    <svg xmlns="http://www.w3.org/2000/svg" :width="size" :height="Math.round(size * 0.71)" viewBox="0 0 21 15" fill="none">
        <path
            d="M21 4.70203C21 2.10369 18.938 0 16.3911 0H4.6089C2.06203 0 0 2.10369 0 4.70203V10.298C0 12.8963 2.06203 15 4.6089 15H16.3911C18.938 15 21 12.8963 21 10.298V4.70203ZM14.072 7.92014L8.78554 10.59C8.58109 10.7032 7.87427 10.5542 7.87427 10.3099V4.83313C7.87427 4.5888 8.58109 4.43981 8.79138 4.559L13.8501 7.36591C14.0604 7.4851 14.2882 7.80095 14.072 7.92014Z"
            :fill="color" />
    </svg>
</template>

<script>
export default {
    name: 'IconYoutube',
    props: {
        color: {
            type: String,
            default: '#00395A',
        },
        size: {
            type: Number,
            default: 20
        }
    },
}
</script>

<style></style>