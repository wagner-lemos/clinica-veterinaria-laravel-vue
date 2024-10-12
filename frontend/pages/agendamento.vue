<template>
  <div
    class="w-full min-h-screen flex flex-col justify-center items-center gap-4"
  >
    <section class="flex justify-end w-full max-w-6xl px-4">
      <el-button type="success" @click="handleAdd"> Adicionar </el-button>
    </section>

    <section class="w-full max-w-6xl px-4">
      <el-table
        :data="filterTableData"
        style="width: 100%; height: 500px"
        align="center"
      >
        <el-table-column
          label="Data"
          prop="date"
          align="center"
          min-width="110"
          fixed
        >
          <template #default="scope">
            {{ formatDate(scope.row.date) }}
          </template>
        </el-table-column>
        <el-table-column
          label="Nome"
          prop="name"
          align="center"
          min-width="140"
        />
        <el-table-column
          label="Email"
          prop="email"
          align="center"
          min-width="140"
        />
        <el-table-column
          label="Nome do Animal"
          prop="animalName"
          align="center"
          min-width="110"
        />
        <el-table-column
          label="Período"
          prop="period"
          align="center"
          min-width="80"
        />
        <el-table-column align="center" min-width="160">
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
                @click="handleEdit(scope.$index, scope.row)"
                :icon="Edit"
                size="small"
              />
              <el-button
                title="Deletar"
                @click="handleDelete(scope.$index, scope.row)"
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
      title="Shipping address"
      width="90%"
      style="max-width: 500px"
    >
      <el-form :model="form">
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
            v-model="form.date"
            type="date"
            placeholder="Selecione a data"
          />
        </el-form-item>

        <el-form-item label="Período" :label-width="formLabelWidth">
          <el-select v-model="form.region" placeholder="Selecione o turno">
            <el-option label="Manhã" value="manha" />
            <el-option label="Tarde" value="tarde" />
          </el-select>
        </el-form-item>
      </el-form>
      <template #footer>
        <div class="dialog-footer">
          <el-button @click="dialogFormVisible = false">Cancelar</el-button>
          <el-button type="primary" @click="dialogFormVisible = false">
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
import { View, Delete, Edit } from "@element-plus/icons-vue";

definePageMeta({
  layout: "auth",
});

const dialogDetailsVisible = ref(false);
const dialogDetailsData = ref({});

const dialogFormVisible = ref(false);
const formLabelWidth = "140px";
const form = reactive({
  name: "",
  email: "",
  animalName: "",
  animalType: "",
  animalAge: 0,
  date: "",
});


const search = ref("");
const filterTableData = computed(() =>
  tableData.filter(
    (data) =>
      !search.value ||
      data.name.toLowerCase().includes(search.value.toLowerCase())
  )
);

const resetForm = () => {
  form.name = "";
  form.email = "";
  form.animalName = "";
  form.animalType = "";
  form.animalAge = 0;
  form.date = "";
};

const handleAdd = () => {
  resetForm();
  dialogFormVisible.value = true;
};

const handleEdit = (index, row) => {
  console.log(index, row);

  resetForm();
  form.name = row.name;
  form.email = row.email;
  form.animalName = row.animalName;
  form.animalType = row.animalType;
  form.animalAge = row.animalAge;
  form.date = row.date;

  dialogFormVisible.value = true;
};

const handleDelete = (index, row) => {
  console.log(index, row);
};

const handleShowDetails = (index, row) => {
  console.log(index, row);
  dialogDetailsVisible.value = true;
  dialogDetailsData.value = {};
  dialogDetailsData.value = row;
};

const formatDate = (date) => {
  const options = { day: '2-digit', month: '2-digit', year: '2-digit' };
  return new Date(date).toLocaleDateString('pt-BR', options);
};

</script>
