<template>
  <div class="w-full">
    
    <section class="flex justify-end w-full p-4">
      <el-button type="success" @click="handleAddClick"> Adicionar </el-button>
    
      <el-button type="primary" @click="logout"> Sair </el-button>
    </section>

    <section class="w-full" v-loading="loadingTable">
      <el-table
        :data="filterTableData"
        style="width: 100%; height: 100%;"
      >
        <el-table-column
          label="Data"
          prop="date"
          align="center"
          fixed
        >
          <template #default="scope">
            {{ formatDate(scope.row.date) }}
          </template>
        </el-table-column>
        <el-table-column
          label="Nome do dono"
          prop="name"
          align="center"
        />
        <el-table-column
          label="Nome do Animal"
          prop="animal_name"
          align="center"
        />
        <el-table-column
          label="Período"
          prop="period"
          align="center"
        />
        <el-table-column align="center">
          <template #header>
            <el-input v-model="search" size="small" placeholder="Busca" />
          </template>
          <template #default="scope">
            <div class="">
              <el-button
                title="Detalhes"
                @click="handleShowDetails(scope.$index, scope.row)"
                :icon="View"
                size="small"
              />
              <el-button
                title="Editar"
                @click="handleEditClick(scope.$index, scope.row)"
                :icon="Edit"
                size="small"
              />
              <el-button
                title="Deletar"
                @click="handleDeleteClick(scope.$index, scope.row)"
                size="small"
                :icon="Delete"
                type="danger"
              />
            </div>
          </template>
        </el-table-column>
      </el-table>
    </section>

    <el-dialog
      v-model="dialogFormVisible"
      :title="
        dialogFormType === 'add' ? 'Adicionar registro' : 'Editar registro'
      "
      width="90%"
      style="max-width: 500px"
    >
      <el-form :model="form">
        <el-form-item label="Dr." :label-width="formLabelWidth">
          <el-select v-model="form.doctorId" placeholder="Selecione o Dr.">
            <el-option
              v-for="doctor in doctorList"
              :key="doctor.id"
              :label="doctor.name"
              :value="doctor.id"
            />
          </el-select>
        </el-form-item>

        <el-form-item label="Nome" :label-width="formLabelWidth">
          <el-input v-model="form.name" autocomplete />
        </el-form-item>

        <el-form-item label="Email" :label-width="formLabelWidth" type="email">
          <el-input v-model="form.email" autocomplete />
        </el-form-item>

        <el-form-item label="Nome do animal" :label-width="formLabelWidth">
          <el-input v-model="form.animalName" autocomplete />
        </el-form-item>

        <el-form-item label="Tipo do animal" :label-width="formLabelWidth">
          <el-input v-model="form.animalType" autocomplete />
        </el-form-item>

        <el-form-item label="Idade do animal" :label-width="formLabelWidth">
          <el-input v-model="form.animalAge" autocomplete type="number" />
        </el-form-item>

        <el-form-item label="Data" :label-width="formLabelWidth">
          <el-date-picker
            format="DD/MM/YYYY"
            value-format="YYYY-MM-DD"
            v-model="form.date"
            type="date"
            placeholder="Selecione a data"
          />
        </el-form-item>

        <el-form-item label="Período" :label-width="formLabelWidth">
          <el-select v-model="form.period" placeholder="Selecione o turno">
            <el-option label="Manhã" value="manhã" />
            <el-option label="Tarde" value="tarde" />
          </el-select>
        </el-form-item>

        <el-form-item label="Sintomas" :label-width="formLabelWidth">
          <el-input
            v-model="form.symptoms"
            :autosize="{ minRows: 2, maxRows: 4 }"
            type="textarea"
            placeholder="Descreva os sintomas"
          />
        </el-form-item>
      </el-form>
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="dialogFormVisible = false">Cancelar</el-button>
          <el-button type="primary" @click="handleConfirmAddOrEdit">
            Confirmar
          </el-button>
        </div>
      </template>
    </el-dialog>

    <el-dialog
      v-model="dialogDetailsVisible"
      title="Detalhes"
      width="90%"
      style="max-width: 500px"
    >
      <ul class="flex flex-col gap-2">
        <li>
          <span class="font-bold">Nome:<br /></span>
          {{ dialogDetailsData.name }}
        </li>
        <li>
          <span class="font-bold">Email:<br /></span>
          {{ dialogDetailsData.email }}
        </li>
        <li>
          <span class="font-bold">Nome do Animal:<br /></span>
          {{ dialogDetailsData.animalName }}
        </li>
        <li>
          <span class="font-bold">Tipo:<br /></span>
          {{ dialogDetailsData.animalType }}
        </li>
        <li>
          <span class="font-bold">Período:<br /></span>
          {{ dialogDetailsData.period }}
        </li>
        <li>
          <span class="font-bold">Sintomas:<br /></span>
          {{ dialogDetailsData.symptoms }}
        </li>
      </ul>
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="dialogDetailsVisible = false">Fechar</el-button>
        </div>
      </template>
    </el-dialog>
  </div>
</template>

<script setup>
import { useUserStore } from "../stores/UserStore";
import { View, Delete, Edit } from "@element-plus/icons-vue";
import { useRouter } from "vue-router";
definePageMeta({
  layout: "auth",
});

const router = useRouter();

const userStore = useUserStore();
const token = "Bearer " + userStore.token;
const config = useRuntimeConfig();
const { baseApiUrl } = config.public;

const loadingTable = ref(false);
const tableData = ref([]);

const loadingDoctorList = ref(false);
const doctorList = ref([]);

const loadingAddRegistro = ref(false);
const loadingEditRegistro = ref(false);
const loadingDeleteRegistro = ref(false);

const dialogDetailsVisible = ref(false);
const dialogDetailsData = ref({});

const dialogFormVisible = ref(false);
const dialogFormType = ref("");
const formLabelWidth = "140px";
const form = reactive({
  name: "",
  email: "",
  animalName: "",
  animalType: "",
  animalAge: 0,
  date: "",
  doctorId: null,
  symptoms: "",
});

const search = ref("");
const filterTableData = computed(() =>
  tableData.value?.filter(
    (data) =>
      !search.value ||
      data.name.toLowerCase().includes(search.value.toLowerCase()) ||
      data.animal_name.toLowerCase().includes(search.value.toLowerCase()) 
  )
);

onMounted(() => {
  getDoctorList();
  getTableData();
});

const resetForm = () => {
  form.doctorId = null;
  form.name = "";
  form.email = "";
  form.animalName = "";
  form.animalType = "";
  form.animalAge = 0;
  form.date = "";
  form.symptoms = "";
  form.period = "";
  form.id = null;
};

const handleConfirmAddOrEdit = () => {
  if (dialogFormType.value === "add") {
    confirmAddRegistro();
  } else if (dialogFormType.value === "edit") {
    confirmEditRegistro();
  }
};

const confirmAddRegistro = async () => {
  dialogFormVisible.value = false;

  try {
    loadingAddRegistro.value = true;

    const apiUrl = `${baseApiUrl}/scheduling/create`;

    const body = {
      doctor_id: form.doctorId,
      name: form.name,
      email: form.email,
      animal_name: form.animalName,
      animal_type: form.animalType,
      age: form.animalAge,
      symptoms: form.symptoms,
      date: form.date,
      period: form.period,
    };

    console.log("body", body);
    const response = await $fetch(apiUrl, {
      method: "POST",
      headers: {
        Authorization: token,
      },
      body: body,
    });

    ElMessage({
      showClose: true,
      message: "Registro adicionado com sucesso",
      type: "success",
    });

    getTableData();

  } catch (error) {
    console.log("error fetchTableData", error);
  } finally {
    loadingAddRegistro.value = false;
  }
};

const confirmEditRegistro = async () => {
  try {
    loadingEditRegistro.value = true;
    const apiUrl = `${baseApiUrl}/scheduling/update/${form.id}`;

    const body = {
      doctor_id: form.doctorId,
      id: form.id,
      name: form.name,
      email: form.email,
      animal_name: form.animalName,
      animal_type: form.animalType,
      age: form.animalAge,
      symptoms: form.symptoms,
      date: form.date,
      period: form.period,
    };

    const response = await $fetch(apiUrl, {
      method: "PUT",
      headers: {
        Authorization: token,
      },
      body: body,
    });

    console.log('response edit', response);

    ElMessage({
      showClose: true,
      message: "Registro editado com sucesso",
      type: "success",
    });

    getTableData();

  } catch (error) {
    console.log("error fetchTableData", error);
  } finally {
    loadingEditRegistro.value = false;
    dialogFormVisible.value = false;
  }
};

const handleAddClick = () => {
  dialogFormType.value = "add";
  resetForm();
  dialogFormVisible.value = true;
};

const handleEditClick = (index, row) => {
  console.log(index, row);
  dialogFormType.value = "edit";
  resetForm();
  form.name = row.name;
  form.email = row.email;
  form.animalName = row.animal_name;
  form.animalType = row.animal_type;
  form.animalAge = row.age;
  form.date = row.date;
  form.symptoms = row.symptoms;
  form.period = row.period;
  form.id = row.id;
  form.doctorId = row.doctor[0].id;

  dialogFormVisible.value = true;
};

const handleDeleteClick = async (index, row) => {
  console.log(index, row);
  try {
    loadingDeleteRegistro.value = true;
    const apiUrl = `${baseApiUrl}/scheduling/delete/${row.id}`;

    const response = await $fetch(apiUrl, {
      method: "DELETE",
      headers: {
        Authorization: token,
      },
    });

    console.log('response edit', response);
    ElMessage({
      showClose: true,
      message: "Registro removido com sucesso",
      type: "success",
    });
    getTableData();

  } catch (error) {
    console.log("error delete", error);
  } finally {
    loadingDeleteRegistro.value = false;
  }
};

const handleShowDetails = (index, row) => {
  console.log(index, row);
  dialogDetailsVisible.value = true;
  dialogDetailsData.value = {};
  dialogDetailsData.value = row;
};

const formatDate = (date) => {
  const options = { day: "2-digit", month: "2-digit", year: "2-digit" };
  return new Date(date).toLocaleDateString("pt-BR", options);
};

const getTableData = async () => {
  try {
    loadingTable.value = true;
    const apiUrl = `${baseApiUrl}/scheduling/list`;
    const response = await $fetch(apiUrl, {
      method: "GET",
      headers: {
        Authorization: token,
      },
    });

    console.log("response list", response[0]);
    tableData.value = response[0];
  } catch (error) {
    console.log("error fetchTableData", error);
  } finally {
      loadingTable.value = false;
  }
};

const getDoctorList = async () => {
  try {
    loadingDoctorList.value = true;

    const apiUrl = `${baseApiUrl}/doctor/list`;
    const response = await $fetch(apiUrl, {
      method: "GET",
      headers: {
        Authorization: token,
      },
    });

    doctorList.value = response[0];
    console.log("response doctor list", doctorList.value);
  } catch (error) {
    console.log("error fetchDoctorList", error);
  } finally {
    setTimeout(() => {
      loadingTable.value = false;
      console.log("loadingTable", loadingTable.value);
    }, 2000);
    console.log("loadingTable", loadingTable.value);
  }
};

const logout = () => {
      userStore.clear();
      router.push({ path: "/login" });
    };
</script>
