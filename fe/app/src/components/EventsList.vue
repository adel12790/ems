<template>
  <v-data-table :items="events" class="elevation-1">
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>Events List</v-toolbar-title>
      </v-toolbar>
    </template>
  </v-data-table>
</template>

<script lang="ts" setup>
import { computed, onMounted } from 'vue';
import { Event } from '../types/Events';
import { useEventsStore } from '../stores/useEventsStore';

const store = useEventsStore();
const events = computed<Event[]>(() => store.getEventsList);

onMounted(async () => {
  store.setEvents();
});
</script>
