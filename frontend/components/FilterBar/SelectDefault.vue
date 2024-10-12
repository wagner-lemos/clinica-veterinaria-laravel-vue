<template>
  <div class="__categoria-select __categoria-select--filter w-full h-full">
    <el-select
      v-model="optionSelected"
      popper-class="__categoria-dropdown"
      no-match-text="Não encontrado"
      no-data-text="Sem dados"
      loading-text="carregando..."
      :placeholder="placeholder"
      :loading="loading"
      clearable
      @clear="handleClear"
    >
      <el-option
        v-for="option in optionsWithTodos"
        :key="option.id"
        :label="option.nome"
        :value="option.id"
        @click="handleSelect"
      >
      <div>
        <div class="categoria-option-content-wrapper">
          <span class="option-icon"></span>
          <span class="option-text">{{ option.nome }}</span>
        </div>
      </div>
      </el-option>
    </el-select>
  </div>
</template>

<script setup>

const props = defineProps({
  loading: Boolean,
  options: {
    type: Array,
    default: [],
  },
  placeholder: {
    type: String,
    default: 'Selecione'
  },
  clearSelected: Boolean
});

onMounted(() => {
  console.log('options', props.options)
})

watch(() => props.clearSelected, (newVal) => {
  if (newVal) {
    optionSelected.value = ""
  }
});

const emit = defineEmits(["selected"]);
const optionSelected = ref(null);
const optionsWithTodos = computed(() => {
  let optionsCopy = [...props.options];

  optionsCopy.unshift({
    nome: "Todos",
    id: "",
  });

  return optionsCopy;
});

function handleSelect() {
  emit("selected", optionSelected.value);
}

const handleClear = () => {
  optionSelected.value = ""
  emit("selected", optionSelected.value);
}
</script>

<style></style>
