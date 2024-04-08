// Utilities
import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import { CategoryAPI } from '../types/Category'
import axios from 'axios';

export const useCategoriesStore = defineStore('categories', () =>{
  const categories = ref<CategoryAPI[]>([]);

  const setCategories = async() => {
    // Fetch categories from API
    // TODO: Replace URL with environment variable, Also consider using api wrapper for modularity.
    const response = await axios.get('http://dev.localhost/api/categories');

    categories.value = response.data;
  }

  const addCategory = async (categoryName: string, parentCategory: number | null) => {
    // Add category to API
    const response = await axios.post('http://dev.localhost/api/categories', {
      name: categoryName,
      parent_id: parentCategory
    });

    return response.data;
  }

  const getCategoryById = (id: number) => {
    return categories.value.find(category => category.id === id);
  };

  const getCategoriesList = computed(() => {
    return categories.value.map(category => {
      return {
        id: category.id,
        name: category.name,
        parent_category: getCategoryById(category.parent_id)?.name
      }
    });
  });

  return {
    categories,
    setCategories,
    addCategory,
    getCategoryById,
    getCategoriesList
  }
})
