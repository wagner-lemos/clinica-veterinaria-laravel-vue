<template>
  <div
    class="flex flex-wrap gap-2 justify-center mx-auto w-full max-w-[714px] px-3 py-9"
  >
    <template v-for="(filterButton, index) in filterButtons" :key="index">
      <div class="flex-1 basis-24">
        <ButtonFilter
          :active="filterSelected === filterButton.value ? true : false"
          :text="filterButton.label"
          @clicked="handleFilterClick(filterButton.value)"
        />
      </div>
    </template>
    <div class="flex-1 basis-24">
      <SelectCategoriasFilter
        :categorias="categorias"
        @selected="handleSelectCategoria"
        :loading="loading"
      />
    </div>
  </div>
</template>

<script setup>
import ButtonFilter from "./ButtonFilter.vue";
import SelectCategoriasFilter from "./SelectCategoriasFilter.vue";

const emit = defineEmits(["filterClick", "selectCategoria"]);
const filterSelected = ref("todos");

const props = defineProps({
  categorias: Array,
  loading: Boolean,
  filterButtons: {
    type: Array,
    default: [
      {
        label: "Todos",
        value: "todos",
      },
      {
        label: "Mais recentes",
        value: "recentes",
      },
    ],
  },
});

const handleSelectCategoria = (categoria) => {
  emit("selectCategoria", categoria);
};

const handleFilterClick = (filter) => {
  console.log('filter', filter)
  filterSelected.value = filter;
  emit("filterClick", filter);
};
</script>
