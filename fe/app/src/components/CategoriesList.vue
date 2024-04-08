<template>
  <v-data-table :items="categories" class="elevation-1">
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Categories List</v-toolbar-title>
      </v-toolbar>
    </template>
  </v-data-table>
</template>

<script lang="ts" setup>
import { computed, onMounted } from 'vue';
import { useCategoriesStore } from '../stores/useCategoriesStore';
import { Category } from '../types/Category';

const store = useCategoriesStore();

const categories = computed<Category[]>(() => store.getCategoriesList);

onMounted(async () => {
  store.setCategories();
});
</script>
