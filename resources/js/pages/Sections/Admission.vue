<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Footer from '@/components/landing/Footer.vue';
import NavBar from '@/components/landing/NavBar.vue';

// Data array for the admission cards
const admissionCards = [
  { id: 1, title: 'Individual Learners', image: '/assets/ADMMISSIONS assets/Individual.jpg' },
  { id: 2, title: 'Universities', image: '/assets/ADMMISSIONS assets/Universities.jpg' },
  { id: 3, title: 'Government Agencies', image: '/assets/ADMMISSIONS assets/Government.jpg' },
  { id: 4, title: 'Corporate Organizations', image: '/assets/ADMMISSIONS assets/Corporate.jpg' },
  { id: 5, title: 'Schools', image: '/assets/ADMMISSIONS assets/Schools.jpg' },
  { id: 6, title: 'International Students', image: '/assets/ADMMISSIONS assets/International.jpg' },
];
</script>

<template>
  <Head title="Admission" />

  <div class="bg-gray-50 flex flex-col">
    <NavBar />
    
    <main class="relative flex-grow w-full flex flex-col">
      
      <!-- Full Size Background Image -->
      <img 
        src="/assets/ADMMISSIONS assets/bg.jpg" 
        alt="Admissions Background" 
        class="absolute inset-0 z-0 h-full w-full object-cover" 
      />
      
      <div class="relative z-10 mx-auto w-full max-w-7xl px-4 pt-22 pb-8 sm:px-6 lg:px-8 text-start lg:pt-26">
        <h1 class="text-3xl font-black text-white drop-shadow-xl sm:text-5xl md:text-7xl">
          ADMISSIONS
        </h1>
        <h2 class="mt-2 text-3xl font-black text-[#2095E0] drop-shadow-md sm:text-4xl md:text-5xl">
          Future Enrollment
        </h2>
        <div class="mt-1 h-[4px] w-full max-w-sm bg-gradient-to-r from-[#2095E0] to-transparent"></div>
          
        <button class="mt-6 flex items-center gap-2 rounded-md bg-[#2095E0] px-6 py-3 font-bold text-white transition hover:opacity-90">
            Explore Enrollment Opportunities
            <img src="/assets/front-page/ICONS/arrow.png" alt="Arrow Right" class="h-4 w-4">
        </button>
      </div>

      <!-- 3x2 Grid Section -->
      <div class="relative z-10 mx-auto w-full max-w-7xl px-4 py-8 pb-20 sm:px-6 lg:px-8 flex-grow">
        
        <!-- Grid layout: 1 col on mobile, 2 on tablet, 3 on desktop -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
          
          <!-- Generated Cards -->
          <div 
            v-for="(card, index) in admissionCards" 
            :key="card.id"
            class="relative flex aspect-square overflow-hidden rounded-xl bg-gray-200 shadow-md group cursor-pointer"
          >
            <!-- Background Image -->
            <img 
              :src="card.image" 
              :alt="card.title" 
              class="absolute inset-0 z-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" 
            />
            
            <!-- Dark gradient overlay at the bottom so text is easily readable -->
            <div class="absolute inset-0 z-10 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>

            <div class="absolute left-0 top-0 z-20 flex h-12 w-15 items-center justify-center rounded-br-[2.5rem] bg-[#2095E0] text-xl font-bold text-white shadow-sm">
              {{ index + 1 }}
            </div>
            
            <div class="absolute bottom-0 left-0 z-20 w-full p-5 text-start">
              <h3 class="text-xl sm:text-2xl font-bold text-white drop-shadow-md">
                {{ card.title }}
              </h3>
            </div>
          </div>

        </div>
      </div>
      
    </main>

    <Footer />
  </div>
</template>