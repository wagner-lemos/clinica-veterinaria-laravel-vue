<template>
  <div class="w-full max-w-container mx-auto flex gap-x-2 items-center">
    <div>
      <SelectCategorias
        :categorias="categorias"
        @selected="handleSelectCategoria"
        :loading="loading"
      />
    </div>

    <InputDefault @enterPress="search" @inputChange="handleInputChange" />

    <button
      @click="search"
      class="__icon-lupa-wrapper h-[50px] w-[50px] min-w-[50px] border-[3px] border-primary flex items-center justify-center rounded-15 cursor-pointer"
    >
      <IconLupa />
    </button>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import SelectCategorias from "./SelectCategorias.vue";
import InputDefault from "../../../components/InputDefault.vue";
import IconLupa from "../../../components/Icons/IconLupa.vue";

export default {
  name: "SearchBar",
  components: {
    InputDefault,
    IconLupa,
    SelectCategorias,
  },
  async setup() {
    const categorias = ref([])
    const categoriaSelected = ref({});
    const textoBuscado = ref("");
    const loading = ref(false)

    const userStore = useUserStore()
    const completeToken = "Bearer " + userStore.token;

    const runTimeConfig = useRuntimeConfig();
    const { baseApiUrl } = runTimeConfig.public;

    onMounted(() => {
      fetchCategorias()
    })

    const fetchCategorias = async () => {
      try {
        loading.value = true;

        const apiUrl = `${baseApiUrl}/categorias`;

        const response = await $fetch(apiUrl, {
          method: "GET",
          headers: {
            Authorization: completeToken,
          },
        });

        categorias.value = response[0];
      } catch (error) {
        console.log("fetch categorias error", error);
      } finally {
        loading.value = false;
      }
    };

    const handleSelectCategoria = (categoria) => {
      categoriaSelected.value = categoria;
      console.log("categoriaSelected.value", categoriaSelected.value);
    };

    const handleInputChange = (value) => {
      textoBuscado.value = value;
      console.log("textoBuscado.value", textoBuscado.value);
    };

    const search = () => {
      console.log("search");
    };

    return {
      categorias,
      categoriaSelected,
      handleInputChange,
      handleSelectCategoria,
      search,
      loading
    };
  },
};
</script>

<style scoped>
.__icon-lupa-wrapper svg {
  transition: 200ms ease-in-out;
}

.__icon-lupa-wrapper:hover svg {
  scale: 1.1;
}
</style>
