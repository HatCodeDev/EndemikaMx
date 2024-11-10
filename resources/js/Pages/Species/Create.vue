<script setup>
import Form from './Form.vue';
const props = defineProps({
  protectedAreas: { type: Object }
});

</script>

<template>
  <Form :protectedAreas="protectedAreas" />
</template>
