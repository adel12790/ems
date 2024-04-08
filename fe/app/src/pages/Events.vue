<template>
  <v-app-bar :elevation="2">
  <template v-slot:prepend>
    <v-app-bar-nav-icon></v-app-bar-nav-icon>
  </template>

  <v-app-bar-title>Events</v-app-bar-title>
</v-app-bar>
  <EventsList />
</template>

<script lang="ts" setup>
  //
</script>
