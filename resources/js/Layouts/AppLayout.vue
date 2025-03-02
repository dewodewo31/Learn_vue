<script setup lang="ts">
import Navbar from '../Components/Navbar.vue';

</script>

<template>
  <Navbar />
    <main class="py-4">
        <slot />
    </main>
</template>