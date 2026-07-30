<script setup lang="ts">
import About from '@/components/landing/About.vue';
import Home from '@/components/landing/Home.vue';
import NavBar from '@/components/landing/NavBar.vue';

// import { Head, Link } from '@inertiajs/vue3';
// import { dashboard, login, register } from '@/routes';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <NavBar />
    <Home />
    <About />
</template>
