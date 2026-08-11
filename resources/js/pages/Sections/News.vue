<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

import Footer from '@/components/landing/Footer.vue';
import NavBar from '@/components/landing/NavBar.vue';

const newsInsights = ref([
  { id: 1, title: 'AI Research', image: '/assets/News & Insights assets/AI Research.jpg' },
  { id: 2, title: 'Digital Wellness', image: '/assets/News & Insights assets/Digital Wellness.jpg' },
  { id: 3, title: 'Human Behavior', image: '/assets/News & Insights assets/Human Behavior.jpg' },
  { id: 4, title: 'Emerging Technologies', image: '/assets/News & Insights assets/Emerging.jpg' },
  { id: 5, title: 'Future Economy', image: '/assets/News & Insights assets/Future Economy.jpg' },
  { id: 6, title: 'AI Policy', image: '/assets/News & Insights assets/AI Policy.jpg' },
  { id: 7, title: 'Innovation', image: '/assets/News & Insights assets/Innovation.jpg' },
  { id: 8, title: 'Leadership', image: '/assets/News & Insights assets/Leadership.jpg' }
]);

const showAll = ref(false);
</script>

<template>
  <Head title="News & Insights" />

  <div class="bg-white flex flex-col min-h-screen">
    <NavBar />
    
    <!-- Hero Banner Section -->
    <div class="relative w-full flex items-center justify-start h-[420px] sm:h-[450px] overflow-hidden shadow-lg z-10">
      <img 
        src="/assets/News & Insights assets/News & Insights.jpg" 
        alt="News & Insights Background" 
        class="absolute inset-0 w-full h-full object-cover z-0" 
      />
      <!-- Added pb-16 so the text is pushed up slightly to avoid being covered by the overlapping cards -->
      <div class="relative z-20 px-4 sm:px-6 lg:px-8 w-full max-w-7xl mx-auto text-start pb-16">
        <h1 class="text-3xl sm:text-5xl md:text-7xl font-black text-white leading-tight uppercase tracking-wider drop-shadow-xl">
          News & Insights
        </h1>
        <h2 class="text-xl sm:text-3xl md:text-4xl font-black text-white mt-2 drop-shadow-md">
          Latest:
        </h2>
      </div>
    </div>

    <section class="pb-10 md:pb-15 bg-white w-full flex-grow relative z-20">
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full -mt-24 sm:-mt-22">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8 items-stretch">
          
          <div 
            v-for="item in (showAll ? newsInsights : newsInsights.slice(0, 4))" 
            :key="item.id" 
            class="flex w-full flex-col overflow-hidden rounded-2xl bg-white shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 border border-gray-100"
          >
            <div class="aspect-[4/3] sm:aspect-square w-full overflow-hidden bg-white p-2">
              <img 
                :src="item.image" 
                :alt="item.title" 
                class="h-full w-full object-cover rounded-xl transition-transform duration-500 hover:scale-105" 
                loading="lazy"
              />
            </div>
            
            <div class="flex flex-col items-center justify-center flex-grow px-4 py-5 sm:py-6 text-center min-h-[5rem]">
              <h3 class="text-lg sm:text-xl md:text-2xl font-extrabold text-[#2095E0] leading-tight">
                {{ item.title }}
              </h3>
            </div>
            
          </div>
          
        </div>

        <div class="flex justify-center mt-12">
          <button
            type="button"
            @click="showAll = !showAll"
            class="px-8 py-3 text-white text-base md:text-lg font-bold shadow-sm  bg-[#2095E0] hover:text-[#2095E0] hover:bg-white hover:border-[#2095E0] border-2 border-[#2095E0] rounded-xl active:scale-95 transition-all"
          >
            {{ showAll ? 'See Less' : 'See More' }}
          </button>
        </div>

      </div>
    </section>
    
    <Footer />
  </div>
</template>