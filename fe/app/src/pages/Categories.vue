<template>
  <v-app-bar :elevation="2">
  <template v-slot:prepend>
    <v-app-bar-nav-icon></v-app-bar-nav-icon>
  </template>

  <v-app-bar-title>Categories</v-app-bar-title>
</v-app-bar>
  <AddCategory />
  <br />
  <CategoriesList />
</template>

<script lang="ts" setup>
import AddCategory from '../components/AddCategory.vue';
import CategoriesList from '../components/CategoriesList.vue';

  //
</script>
