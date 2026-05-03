<script setup>
defineProps({
  modelValue: [String, Number],
  label: String,
  type: {
    type: String,
    default: 'text'
  },
  placeholder: String,
  error: String
})

defineEmits(['update:modelValue'])
</script>

<template>
  <div class="w-full">
    <label v-if="label" class="block text-sm font-medium text-gray-700 mb-1.5 ml-1">{{ label }}</label>
    <div class="relative">
      <input
        :type="type"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="placeholder"
        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-accent focus:ring-4 focus:ring-accent/10 transition-all outline-none text-gray-800 placeholder:text-gray-400"
        :class="{ 'border-red-500 focus:ring-red-500/10': error }"
      />
    </div>
    <p v-if="error" class="mt-1.5 text-xs text-red-500 ml-1">{{ error }}</p>
  </div>
</template>

<style scoped>
.focus\:border-accent:focus { border-color: #d4af37; }
.focus\:ring-accent\/10:focus { --tw-ring-color: rgba(212, 175, 55, 0.1); }
</style>
