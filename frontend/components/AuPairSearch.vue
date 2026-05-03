<script setup>
import { onMounted, watch } from 'vue'
import { useAuPairStore } from '@/stores/auPairStore'

const store = useAuPairStore()

onMounted(() => {
  store.fetchAuPairs()
})

// Watch filters for instant updates
watch(() => store.filters, () => {
  store.fetchAuPairs()
}, { deep: true })
</script>

<template>
  <div class="search-container p-6 bg-white rounded-2xl shadow-xl border border-gray-100">
    <div class="filters grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
      <div class="filter-group">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Minimum Age</label>
        <input 
          v-model="store.filters.min_age" 
          type="number" 
          placeholder="e.g. 18"
          class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-accent outline-none"
        />
      </div>

      <div class="filter-group">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Nationality</label>
        <select 
          v-model="store.filters.nationality"
          class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-accent outline-none"
        >
          <option value="">All Countries</option>
          <option value="China">China</option>
          <option value="Germany">Germany</option>
          <option value="France">France</option>
        </select>
      </div>

      <div class="filter-group flex items-end">
        <button 
          @click="store.fetchAuPairs"
          class="w-full bg-primary text-white py-2 rounded-lg font-bold hover:bg-opacity-90 transition-all"
        >
          Search Now
        </button>
      </div>
    </div>

    <div v-if="store.loading" class="flex justify-center py-12">
      <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-accent"></div>
    </div>

    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="aupair in store.auPairs" :key="aupair.id" class="aupair-card group">
        <div class="relative overflow-hidden rounded-xl bg-gray-200 aspect-[3/4]">
          <!-- Placeholder for image -->
          <div class="absolute inset-0 flex items-center justify-center text-gray-400">
            Profile Image
          </div>
          <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent text-white">
            <h3 class="text-xl font-bold">{{ aupair.full_name }}</h3>
            <p class="text-sm opacity-90">{{ aupair.age }} years • {{ aupair.nationality }}</p>
          </div>
        </div>
        <div class="mt-4 px-1">
          <p class="text-gray-600 text-sm line-clamp-2">{{ aupair.bio || 'No bio available' }}</p>
          <button class="mt-3 text-accent font-bold text-sm group-hover:underline">View Profile →</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.bg-primary { background-color: #1a1a1a; }
.text-accent { color: #d4af37; }
.border-accent { border-color: #d4af37; }
.focus\:ring-accent:focus { --tw-ring-color: #d4af37; }
</style>
