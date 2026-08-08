<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Nav from '@/components/Nav.vue'; // Adjust path to Nav if needed

// Import your actual content from the Section folder
import AcademicSchoolContent from '@/Section/AcademicSchool.vue'; 
</script>

<template>
  <Head title="Academic School - HDWSI" />

  <div class="min-h-screen bg-gray-50 dark:bg-neutral-900">
    <Nav />
    
    <!-- Render your component here -->
    <main class="pt-24">
      <AcademicSchoolContent />
    </main>
  </div>
</template>