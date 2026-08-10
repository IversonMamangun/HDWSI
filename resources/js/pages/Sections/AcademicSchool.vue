<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Footer from '@/components/landing/Footer.vue';
// import NavBar from '@/components/landing/NavBar.vue';
</script>

<template>
  <Head title="Academic School" />

  <div class="min-h-screen bg-gray-50 flex flex-col">
    
    <main class="flex-grow w-full">
      
      <!-- Hero Header Section -->
      <div class="mx-auto relative w-full flex items-center justify-center h-[180px] sm:h-[150px] overflow-hidden shadow-lg">
  
  <!-- Background Image -->
  <img 
    src="/assets/academic school assets/1.jpg" 
    alt="Academic Schools Background" 
    class="absolute py-2 inset-0 bg-[#2095E0] w-full h-full object-cover z-0" 
  />

  <!-- Overlay -->

  <!-- Text -->
  <div class="relative z-20 px-4 text-center">
    <h1 class="text-3xl sm:text-5xl md:text-6xl font-black text-white leading-tight uppercase tracking-wider drop-shadow-xl">
      Academic Schools
    </h1>
  </div>
</div>


      <div class="max-w-7xl mx-auto px-4 py-12">
      </div>

    </main>

    <Footer />
  </div>
</template>