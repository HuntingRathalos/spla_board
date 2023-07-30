<template>
  {{ error.message }}
  {{ error.statusCode }}
  <button @click="handleError">clear error</button>
</template>

<script setup>
const props = defineProps({ error: Object });
console.log(props);

const handleError = () => clearError({ redirect: '/' });
</script>
