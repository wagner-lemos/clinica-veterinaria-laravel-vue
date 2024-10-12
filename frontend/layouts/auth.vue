<template>
  <ElConfigProvider :locale="ptBr">
    <div class="w-full">
      <div class="absolute w-full h-full z-10">
        <slot />
      </div>
    </div>
  </ElConfigProvider>
</template>

<script setup>
import ptBr from "element-plus/dist/locale/pt-br.min.mjs";
</script>

<style scoped></style>
