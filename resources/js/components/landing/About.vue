<script setup lang="ts">
import { ref, computed } from 'vue';

const showAllMission = ref(false);

const missionList = [
  'Human Intelligence',
  'Artificial Intelligence',
  'Ethical Leadership',
  'Digital Wellness',
  'Social Intelligence',
  'Innovation',
  'Sustainable Development'
];

const displayedMissions = computed(() => {
  return showAllMission.value ? missionList : missionList.slice(0, 4);
});

const toggleMission = () => {
  showAllMission.value = !showAllMission.value;
};
</script>

<template>
  <!-- Main Background: Navy fading to Blue and back to Navy -->
  <section class="w-full bg-gradient-to-r from-[#104C7D] via-[#2095E0] to-[#104C7D] px-6 py-24 sm:px-8 lg:px-16">
    
    <!-- Top Section: Centered Text -->
    <div class="mx-auto max-w-4xl text-center text-white">
      <h2 class="text-xl font-bold uppercase tracking-widest text-blue-200 sm:text-2xl">
        About HDWSI
      </h2>
      
      <h1 class="mt-2 text-4xl font-black uppercase tracking-tighter sm:text-5xl lg:text-6xl">
        What is HDWSI?
      </h1>
      
      <p class="mt-6 text-lg font-medium leading-relaxed text-blue-50 sm:text-xl">
        HDWSI (Human-Centered Digital Wellness and Social Intelligence) is a proposed interdisciplinary educational framework developed by <strong class="text-white">Henry V. Bayubay</strong> that prepares humanity for responsible participation in the AI Economy through the integration of technology, ethics, wellness, leadership, innovation, behavioral sciences, and digital responsibility.
      </p>
    </div>

    <!-- Bottom Section: Vision & Mission (Side-by-Side on Desktop) -->
    <div class="mx-auto mt-16 grid max-w-7xl grid-cols-1 gap-8 md:grid-cols-2">
      
      <!-- Vision Card -->
      <div class="flex h-full flex-col items-start rounded-2xl bg-white py-10 shadow-xl">
        
        <!-- Full-width Blue Background Banner (Padding adjusted & Icon moved inside) -->
        <div class="relative mb-8 flex w-full items-center bg-[#2095E0] p-1 py-4 pl-28 pr-6 shadow-sm sm:pl-32">
          
          <!-- Floating Icon: Moved inside (left-6) but still floating out of the top/bottom -->
          <div class="absolute left-6 top-1/2 flex h-20 w-20 -translate-y-1/2 items-center justify-center rounded-full border-2 border-[#389F7F] bg-white shadow-lg sm:left-8 sm:h-24 sm:w-24">
            <img 
              src="/assets/front-page/ICONS/Vision.png" 
              alt="Vision Icon" 
              class="h-14 w-14 object-contain sm:h-15 sm:w-15" 
            />
          </div>
          
          <!-- Title Text -->
          <h2 class="text-2xl font-black uppercase tracking-tight text-white sm:text-3xl">
            Vision
          </h2>
        </div>
        
        <!-- Text Content Area -->
        <div class="px-8 sm:px-10">
          <p class="text-lg font-bold leading-relaxed text-[#2095E0]">
            To establish HDWSI as a globally recognized educational discipline that develops responsible AI citizens capable of leading sustainable digital societies.
          </p>
        </div>
        
      </div>

      <!-- Mission Card -->
      <div class="flex h-full flex-col items-start rounded-2xl bg-white py-10 shadow-xl">
        
        <!-- Full-width Blue Background Banner (Padding adjusted & Icon moved inside) -->
        <div class="relative mb-8 flex w-full items-center bg-[#2095E0] p-1 py-4 pl-28 pr-6 shadow-sm sm:pl-32">
          
          <div class="absolute left-6 top-1/2 flex h-20 w-20 -translate-y-1/2 items-center justify-center rounded-full border-2 border-[#389F7F] bg-white shadow-lg sm:left-8 sm:h-24 sm:w-24">
            <img 
              src="/assets/front-page/ICONS/Mission.png" 
              alt="Mission Icon" 
              class="h-14 w-14 object-contain sm:h-15 sm:w-15" 
            />
          </div>
          
          <!-- Title Text -->
          <h2 class="text-2xl font-black uppercase tracking-tight text-white sm:text-3xl">
            Mission
          </h2>
        </div>
        
        <!-- Text Content Area -->
        <div class="flex flex-1 flex-col px-8 sm:px-10 w-full">
          <p class="text-xl font-medium leading-relaxed text-[#2095E0]">
            Develop future-ready professionals who combine:
          </p>
          
          <!-- Dynamic List based on state -->
          <ul class="mt-6 flex-1 list-inside list-disc space-y-4 text-lg font-bold text-[#389F7F] transition-all duration-300">
            <li v-for="(item, index) in displayedMissions" :key="index">
              {{ item }}
            </li>
          </ul>

          <!-- See More / See Less Button aligned to bottom right -->
          <div class="mt-6 text-right">
            <button 
              @click="toggleMission" 
              class="text-sm font-bold text-[#389F7F] transition-colors hover:text-[#389F7F]"
            >
              {{ showAllMission ? 'See less...' : 'See more...' }}
            </button>
          </div>
        </div>
        
      </div>

    </div>
  </section>
</template>