<template>
  <div class="__input-default-wrapper w-full">
    <el-input
      v-model="textoBuscado"
      placeholder="Buscar..."
      type="text"
      clearable
      @keyup.enter="handleEnterPress"
      @input="handleInputChange"
    >
    </el-input>
  </div>
</template>

<script>
import { ref } from "vue";

export default {
  name: "InputDefault",
  setup(props, { emit }) {
    const textoBuscado = ref("");

    const handleEnterPress = () => {
      emit("enterPress", textoBuscado.value);
    };

    const handleInputChange = () => {
      emit("inputChange", textoBuscado.value);
    };

    return {
      textoBuscado,
      handleInputChange,
      handleEnterPress,
    };
  },
};
</script>

<style>
.__input-default-wrapper .el-input__wrapper {
  background: transparent !important;
  border-radius: 6px;
  height: 50px;
  border: 3px solid #fff;
  box-shadow: none;
  color: #fff !important;
}

.__input-default-wrapper .el-input__inner {
  color: #fff !important;
  font-weight: 700;
}

.__input-default-wrapper .el-input__inner::placeholder {
  color: #fff;
  font-size: 13px;
  font-weight: 700;
}

.__input-default-wrapper .el-input__clear {
  color: #fff !important;
}
</style>
