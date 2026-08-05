<script setup lang="ts">
import { computed } from 'vue';


const currentYear = computed(() => new Date().getFullYear());

</script>

<template>
      <section class="w-full bg-gradient-to-r from-[#104C7D] via-[#2095E0] to-[#104C7D] py-20 text-white overflow-hidden">
    
    <div class="mx-auto flex w-full max-w-6xl flex-col justify-around gap-16 px-4 sm:px-6 lg:flex-row lg:gap-24 lg:px-8">
      
      <div class="flex w-full flex-col lg:max-w-lg">
        <img 
          src="/assets/logo 1 full.png" 
          alt="HDWSI Logo" 
          class="mb-8 h-auto w-72 object-contain sm:w-80" 
        />
        <h2 class="text-xl sm:text-2xl font-bold leading-relaxed text-white drop-shadow-sm">
          "Preparing Humanity for the Artificial Intelligence Economy Through Human-Centered Education."
        </h2>
      </div>

      <div class="flex w-full flex-col lg:max-w-md lg:pt-4">
        <h2 class="mb-8 text-3xl font-black uppercase tracking-wide text-white drop-shadow-sm">
          Quick Links:
        </h2>
        
        <ul class="grid grid-cols-2 gap-4 text-lg sm:text-xl font-medium">
          <li>
            <a href="#" class="transition-colors hover:text-gray-300">Home</a>
          </li>
          <li>
            <a href="#" class="transition-colors hover:text-gray-300">About HDWSI</a>
          </li>
          <li>
            <a href="#" class="transition-colors hover:text-gray-300">Academic</a>
          </li>
          <li>
            <a href="#" class="transition-colors hover:text-gray-300">Learning PathWays</a>
          </li>
          <li>
            <a href="#" class="transition-colors hover:text-gray-300">Research</a>
          </li>
          <li>
            <a href="#" class="transition-colors hover:text-gray-300">News & Insights</a>
          </li>
          <li>
            <a href="#" class="transition-colors hover:text-gray-300">Career</a>
          </li>
          <li>
            <a href="#" class="transition-colors hover:text-gray-300">Events</a>
          </li>
          <li>
            <a href="#" class="transition-colors hover:text-gray-300">Contact Us</a>
          </li>
        </ul>
        
      </div>

    </div>
    
  </section>
  <footer class="w-full bg-[#2095E0] p-5 text-white overflow-hidden border-t-5 border-white">
     <h2>
      © {{ currentYear }} HUMAN-CENTERED DIGITAL WELLNESS AND SOCIAL INTELLIGENCE. All Rights Reserved.
     </h2>
     <div>
                Designed & Developed by 
                <a 
                    class="hover:underline font-semibold" 
                    href="https://bb88advertising.com/" 
                    target="_blank" 
                    rel="noopener noreferrer"
                >
                    BB 88 Advertising and Digital Solutions Inc.
                </a>
            </div>
  </footer>
</template>