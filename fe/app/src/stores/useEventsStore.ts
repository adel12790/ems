import { defineStore } from "pinia";
import { EventAPI } from "../types/Events";
import { computed, ref } from "vue";
import axios from 'axios';


export const useEventsStore = defineStore('events', () => {
  const events = ref<EventAPI[]>([]);

  const setEvents = async () => {
    // Fetch events from API
    // TODO: Replace URL with environment variable, Also consider using api wrapper for modularity.
  const response = await axios.get('http://dev.localhost/api/events');

  events.value = response.data;
  }

  const getEventById = (id: number) => {
    return events.value.find(event => event.id === id);
  };

  const getEventsList = computed(() => {
    return events.value.map(event => {
      return {
        id: event.id,
        name: event.name,
        description: event.description,
        attendees: event.attendees,
        date_time: event.date_time,
        address: event.address,
        country: event.country,
        city: event.city,
        country_code: event.country_code,
        lon: event.lon,
        lat: event.lat,
        timezone_name: event.timezone_name,
        categories: event.categories.map(category => category.name)
      }
    });
  });

  return {
    events,
    setEvents,
    getEventById,
    getEventsList
  }
});
