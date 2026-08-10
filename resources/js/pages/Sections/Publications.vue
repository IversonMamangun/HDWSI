<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Footer from '@/components/landing/Footer.vue';
import NavBar from '@/components/landing/NavBar.vue';
</script>

<template>
  <Head title="Publications" />

  <div class="min-h-screen bg-gray-50 flex flex-col">
    <NavBar />
    
    <main class="pt-24 pb-20 flex-grow w-full max-w-7xl mx-auto px-4">
      <div class="relative w-full max-w-5xl mx-auto rounded-3xl shadow-xl overflow-hidden bg-white dark:bg-neutral-800 border border-gray-100 dark:border-neutral-700 mt-12">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-[#2095E0] opacity-5 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-[#104C7D] opacity-5 blur-3xl"></div>

        <div class="relative z-10 px-6 py-16 sm:px-12 sm:py-20 md:p-24 text-center flex flex-col items-center">
          <span class="inline-block py-1 px-3 rounded-full bg-[#2095E0]/10 text-[#2095E0] text-sm font-semibold tracking-wider mb-6 border border-[#2095E0]/20 uppercase">
            Join Our Community
          </span>
          
          <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#2095E0] leading-tight mb-6">
            Take the Next Step With Us
          </h2>
          
          <p class="text-lg sm:text-xl text-[#2095E0] max-w-2xl mb-10 leading-relaxed opacity-90">
            Become a member to access exclusive resources, stay updated on our activities, and enroll in our programs.
          </p>
          
          <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6 w-full">
            <Link href="/register" class="w-full sm:w-auto px-8 py-4 bg-[#2095E0] text-white font-bold text-lg rounded-full shadow-lg hover:bg-[#1A75BA] transition-all duration-300 ease-out flex items-center justify-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.22 4.621.999.999 0 01-.868.891 8.968 8.968 0 00-4.072 1.488 1 1 0 01-1.487-.225z" />
              </svg>
              Enroll Now
            </Link>
            
            <Link href="/register" class="w-full sm:w-auto px-8 py-4 bg-transparent border-2 border-[#2095E0] text-[#2095E0] font-bold text-lg rounded-full hover:bg-[#2095E0]/5 transition-all duration-300 ease-out flex items-center justify-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
              </svg>
              Become a Member
            </Link>
          </div>
        </div>
      </div>
    </main>
    
    <Footer />
  </div>
</template>