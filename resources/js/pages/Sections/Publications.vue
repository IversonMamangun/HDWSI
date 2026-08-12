<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Footer from '@/components/landing/Footer.vue';
import NavBar from '@/components/landing/NavBar.vue';

const publicationCards = [
  { 
    id: 1, 
    title: 'White Papers', 
    borderColor: 'border-t-hdwsi-blue',
    icon: '/assets/Publications assets/White.png' 
  },
  { 
    id: 2, 
    title: 'Research Journals', 
    borderColor: 'border-t-hdwsi-teal',
    icon: '/assets/Publications assets/Research.png' 
  },
  { 
    id: 3, 
    title: 'Books', 
    borderColor: 'border-t-hdwsi-green',
    icon: '/assets/Publications assets/Books.png' 
  },
  { 
    id: 4, 
    title: 'AI Reports', 
    borderColor: 'border-t-hdwsi-blue',
    icon: '/assets/Publications assets/AI Reports.png' 
  },
  { 
    id: 5, 
    title: 'Educational Resources', 
    borderColor: 'border-t-hdwsi-teal',
    icon: '/assets/Publications assets/Educational.png' 
  },
  { 
    id: 6, 
    title: 'Learning Modules', 
    borderColor: 'border-t-hdwsi-green',
    icon: '/assets/Publications assets/Learning.png' 
  },
];
</script>

<template>
  <Head title="Publications" />

  <div class="min-h-screen flex flex-col bg-gray-50">
    <NavBar />
    
    <section>
      <div class="relative z-10 flex h-[320px] w-full items-center justify-start overflow-hidden shadow-lg sm:h-[350px]">
        <img 
          src="/assets/Publications assets/Publications.jpg" 
          alt="News & Insights Background" 
          class="absolute inset-0 z-0 h-full w-full object-cover" 
        />
        <div class="relative z-20 mx-auto w-full max-w-7xl px-4 pb-16 text-start sm:px-6 lg:px-8">
          <h1 class="text-3xl font-black leading-tight tracking-wider text-white drop-shadow-xl sm:text-5xl md:text-7xl">
            Publications
          </h1>
          <h2 class="mt-2 text-xl font-black text-[#2095E0] drop-shadow-md sm:text-3xl md:text-4xl">
            Access:
          </h2>
            
          <button class="mt-4 flex items-center gap-2 rounded-md bg-[#2095E0] px-6 py-3 font-bold text-white transition hover:opacity-90">
              Explore All Publications
              <img src="/assets/front-page/ICONS/arrow.png" alt="Arrow Right" class="h-4 w-4">
          </button>
        </div>
      </div>
    </section>

    <main class="mx-auto flex-grow w-full max-w-7xl px-4 pt-16 pb-20">
      
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2 sm:gap-4 w-full">
        
        <div 
          v-for="card in publicationCards" 
          :key="card.id"
          :class="[
            'flex flex-col items-center justify-start pt-8 sm:pt-10 bg-white rounded-xl border border-gray-200 border-t-[6px] aspect-[3/4] shadow-sm hover:shadow-md transition-shadow cursor-pointer',
            card.borderColor
          ]"
        >
          <div class="flex h-16 w-16 sm:h-20 sm:w-20 shrink-0 items-center justify-center mb-3 sm:mb-5 overflow-hidden rounded-full">
            <img 
              :src="card.icon" 
              :alt="card.title" 
              class="h-14 w-14 sm:h-16 sm:w-16 object-contain"
            />
          </div>
          
          <div class="w-full px-2 flex justify-center items-start">
            <h3 class="text-center text-xl sm:text-2xl font-bold text-[#2095E0] leading-tight">
              {{ card.title }}
            </h3>
          </div>
        </div>

      </div>
    </main>
    
    <Footer />
  </div>
</template>