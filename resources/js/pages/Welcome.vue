<script setup lang="ts">
import About from '@/components/landing/About.vue';
import ContactUs from '@/components/landing/ContactUs.vue';
import Footer from '@/components/landing/Footer.vue';
import HdwsiEducation from '@/components/landing/HdwsiEducation.vue';
import Home from '@/components/landing/Home.vue';
import LearnPath from '@/components/landing/LearnPath.vue';
import NavBar from '@/components/landing/NavBar.vue';
import Traditional from '@/components/landing/Traditional.vue';
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
    <Traditional />
    <HdwsiEducation />
    <LearnPath />
    <ContactUs />
    <Footer />
</template>
