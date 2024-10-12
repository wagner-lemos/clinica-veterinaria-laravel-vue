<template>
  <div 
    @click="closeModalOutside"
    class="__modal w-full h-screen z-50 absolute flex justify-center items-center"
  >
    <div class="w-[310px] flex flex-col">
      <div class="w-full h-[90px] flex align-center justify-center py-[10px] bg-secondary rounded-t-15">
        <img 
        class="h-full object-contain"
        :src="icon" :alt="alt_img" />
      </div>

      <div class="w-full flex flex-col justify-center items-center py-5 bg-tertiary rounded-b-15 gap-3">
        <div class="w-[75px] h-[75px]">
          <img class="w-full h-full object-cover rounded-15" :src="img" :alt="alt_img" />
        </div>

        <p class="font-medium text-base text-tertiary-text">{{ nome }}</p>
        <p class="font-bold text-sm text-primary-text">{{ maestria_certificado }}</p>
        <p class="font-medium text-sm text-primary">{{ conquista  }}</p>
        <p class="font-bold text-sm text-tertiary-text">Conquistado em {{ data }}</p>
      </div>

      <div class="w-full flex justify-center items-center gap-10 pt-5">
        <div 
          class="w-[50px] h-[50px] flex justify-center items-center bg-secondary rounded-15 cursor-pointer"
        >
          <iconCompartilhar />
        </div>
        <div 
          @click="closeModal"
          class="w-[50px] h-[50px] flex justify-center items-center bg-secondary rounded-15 cursor-pointer"
        >
          <iconFecharBranco />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import iconCompartilhar from "~/components/icons/iconCompartilhar.vue";
import iconFecharBranco from "~/components/icons/iconFecharBranco.vue";

// Props
defineProps({
  icon: String,
  img: String,
  alt_img: String,
  nome: String,
  maestria_certificado: String,
  conquista: String,
  data: String,
});

// Data
const emit = defineEmits(['close'])

// Methods
const closeModal = () => {
  emit('close');
};

const closeModalOutside = (event) => {
  if (event.target.classList.contains("__modal")) {
    closeModal();
  }
};
</script>

<style scoped>
.__modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); 
}
</style>
