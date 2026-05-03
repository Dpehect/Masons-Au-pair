<script setup>
defineProps({
  variant: {
    type: String,
    default: 'primary' // primary, secondary, outline, ghost
  },
  size: {
    type: String,
    default: 'md' // sm, md, lg
  }
})
</script>

<template>
  <button 
    class="inline-flex items-center justify-center font-semibold transition-all duration-200 rounded-full disabled:opacity-50 disabled:cursor-not-allowed"
    :class="[
      variant === 'primary' ? 'bg-primary text-white hover:bg-opacity-90 shadow-lg shadow-black/10' : '',
      variant === 'secondary' ? 'bg-accent text-primary hover:bg-opacity-90' : '',
      variant === 'outline' ? 'border-2 border-primary text-primary hover:bg-primary hover:text-white' : '',
      size === 'sm' ? 'px-4 py-2 text-sm' : '',
      size === 'md' ? 'px-6 py-3 text-base' : '',
      size === 'lg' ? 'px-8 py-4 text-lg' : ''
    ]"
  >
    <slot />
  </button>
</template>

<style scoped>
.bg-primary { background-color: #1a1a1a; }
.text-primary { color: #1a1a1a; }
.border-primary { border-color: #1a1a1a; }
.bg-accent { background-color: #d4af37; }
</style>
