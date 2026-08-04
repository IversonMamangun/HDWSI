<script setup lang="ts">
import { computed } from 'vue';


const currentYear = computed(() => new Date().getFullYear());

</script>

<template>
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