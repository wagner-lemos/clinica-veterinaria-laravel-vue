<template>
  <div class="w-full h-screen flex items-center justify-center bg-gray-200">
    <div class="w-full max-w-[330px]">
      <div
        class="flex flex-col gap-4 bg-primary rounded-6 p-6 text-center shadow-lg border-gray-100 border"
      >
        <el-form
          v-loading="loading"
          ref="formDataRef"
          :model="formData"
          :rules="rules"
          class="__form-login"
        >
          <div class="flex flex-col gap-4">
            <div class="__input_auth">
              <el-form-item prop="email">
                <el-input
                  placeholder="Email"
                  type="email"
                  v-model="formData.email"
                  clearable
                >
                  <template #prefix>
                    <div class="transition-all bg-secondary rounded-6 rounded-l-6"></div>
                  </template>
                </el-input>
              </el-form-item>
            </div>

            <div class="__input_auth">
              <el-form-item prop="password">
                <el-input
                  placeholder="Senha"
                  type="password"
                  show-password
                  v-model="formData.password"
                  @keypress.enter="handleLogin(formDataRef)"
                >
                  <template #prefix>
                    <div
                      class="transition-all bg-secondary rounded-6 rounded-l-6"
                    >
                    </div>
                  </template>
                </el-input>
              </el-form-item>
            </div>
          </div>
        </el-form>

        <div class="flex items-center justify-between">
          <ButtonAuth text="Entrar" @clicked="handleLogin(formDataRef)" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useUserStore } from "~/stores/UserStore";
import ButtonAuth from "~/components/auth/ButtonAuth.vue";

definePageMeta({
  layout: "auth",
});

const router = useRouter();
const userStore = useUserStore();
const loading = ref(false);
const formData = ref({
  email: "",
  password: "",
});
const formDataRef = ref();
const config = useRuntimeConfig();
const { baseApiUrl, apiToken } = config.public;

const rules = ref({
  email: [
    {
      required: true,
      message: "Campo obrigatório",
      trigger: "blur",
    },
    {
      pattern: /^[a-z0-9.]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i,
      message: "Insira um e-mail válido",
      trigger: "blur",
    },
  ],
  password: [
    {
      required: true,
      message: "Campo obrigatório",
      trigger: "blur",
    },
    {
      min: 3,
      message: "Esse campo deve ter ao menos 6 caracteres",
      trigger: "blur",
    },
  ],
});

const handleLogin = async (form) => {
  await form.validate(async (valid) => {
    if (valid) {
      try {
        loading.value = true;

        const response = await $fetch(baseApiUrl + "/auth/login", {
          method: "POST",
          body: formData.value,
        });

        console.log('response login',response)

        if (response.data.token) {
          ElMessage({
            showClose: true,
            message: "Login realizado com sucesso!",
            type: "success",
            duration: 1800,
          });
          goHome();
        }

        setGlobalUserData(response);
      } catch (error) {
        console.log("error", error);
        ElMessage({
          showClose: true,
          message: "Erro de validação. Verifique os campos do formulário.",
          type: "error",
        });
      } finally {
        loading.value = false;
      }
    } else {
      ElMessage({
        showClose: true,
        message: "Verifique os campos do formulário",
        type: "error",
      });
    }
  });
};

const setGlobalUserData = (response) => {
  userStore.setToken(response.data.token);
  userStore.setIsLogged(true);
};

const goHome = () => {
  router.push({ path: "/" });
};
</script>

<style scoped></style>
