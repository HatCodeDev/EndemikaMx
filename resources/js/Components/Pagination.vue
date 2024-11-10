<template>
  <div v-if="links.length > 3" class="flex justify-center mt-4">
    <div class="flex space-x-2">
      <template v-for="(link, key) in links">
        <!-- Estilo para enlaces deshabilitados -->
        <span
          v-if="link.url === null"
          :key="key"
          class="mr-1 mb-1 rounded-lg px-4 py-2 text-sm leading-4 text-darkgreen bg-lightgray border border-lightgray cursor-not-allowed"
          v-html="link.label"
        />

        <!-- Estilo para enlaces activos e inactivos -->
        <Link
          v-else
          :key="key + 1"
          :href="link.url"
          v-html="link.label"
          class="mr-1 mb-1 rounded-lg px-4 py-2 text-sm leading-4 transition duration-200 ease-in-out"
          :class="{
            'text-white bg-darkgreen border-darkgreen hover:bg-darkgreen hover:text-white': link.active,
            'text-darkgreen bg-white border-lightgray hover:bg-lightgray hover:text-darkgreen': !link.active,
          }"
        />
      </template>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  links: Array,
});
</script>

<style scoped>
/* Sombra y efecto de escala en hover */
.link-active,
.link-inactive {
  transition: transform 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.link-active:hover,
.link-inactive:hover {
  transform: scale(1.05);
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

/* Estilo adicional para un borde más suave en botones */
.link-button {
  border-radius: 0.375rem; /* Para que el borde sea sutilmente redondeado */
  padding: 0.5rem 1rem;
}
</style>
