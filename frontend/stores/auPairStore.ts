import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuPairStore = defineStore('auPair', {
  state: () => ({
    auPairs: [],
    loading: false,
    filters: {
      min_age: null,
      nationality: '',
      status: 'approved'
    }
  }),

  actions: {
    async fetchAuPairs() {
      this.loading = true
      try {
        const response = await axios.get('/api/aupairs', { params: this.filters })
        this.auPairs = response.data.data
      } catch (error) {
        console.error('Failed to fetch au pairs:', error)
      } finally {
        this.loading = false
      }
    },

    updateFilters(newFilters) {
      this.filters = { ...this.filters, ...newFilters }
      this.fetchAuPairs()
    }
  }
})
