<template>
  <h1>Add Category</h1>
  <v-form @submit.prevent="addCategory">
    <v-text-field
      v-model="categoryName"
      label="Category Name"
      required
    ></v-text-field>
    <v-text-field
      v-model="parentCategory"
      label="Parent Category"
      type="number"
      required
    ></v-text-field>
    <v-btn type="submit">Add Category</v-btn>
  </v-form>
</template>

<script lang="ts" setup>
  // create a form to add a new category
  import { ref } from 'vue';
  import { useCategoriesStore } from '../stores/useCategoriesStore';

  const store = useCategoriesStore();
  const categoryName = ref('');
  const parentCategory = ref<number | null>(null);

  const addCategory = () => {
    store.addCategory(categoryName.value, parentCategory.value);
    categoryName.value = '';
    parentCategory.value = null;
  };
</script>
