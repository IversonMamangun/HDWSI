<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import Footer from '@/components/landing/Footer.vue';
import NavBar from '@/components/landing/NavBar.vue';

const researches = [
  { title: 'Human-Centered AI', image: '/assets/Research center assets/Human-Centered AI.jpg' },
  { title: 'AI Ethics', image: '/assets/Research center assets/AI Ethics.jpg' },
  { title: 'Digital Wellness', image: '/assets/Research center assets/Digital Wellness.jpg' },
  { title: 'Future Education', image: '/assets/Research center assets/Future Education.jpg' },
  { title: 'Human Behavior', image: '/assets/Research center assets/Human Behavior.jpg' },
  { title: 'AI Governance', image: '/assets/Research center assets/AI Governance.jpg' },
  { title: 'Social Intelligence', image: '/assets/Research center assets/Social.jpg' },
  { title: 'Sustainable Innovation', image: '/assets/Research center assets/Sustainable.jpg' },
];

const labs = [
  'AI Laboratory',
  'Robotics Laboratory',
  'Human Behavior Laboratory',
  'Neuroscience Laboratory',
  'Digital Wellness Center',
  'Smart Classroom',
  'XR Learning Center',
  'Human-AI Collaboration Laboratory',
  'Future Economy Innovation Hub',
];

const items = ref([
  { id: 1, title: 'Universities', icon: '/assets/Research center assets/Universities.png' },
  { id: 2, title: 'Governments', icon: '/assets/Research center assets/Governments.png' },
  { id: 3, title: 'Technology Companies', icon: '/assets/Research center assets/Technology.png' },
  { id: 4, title: 'Healthcare Institutions', icon: '/assets/Research center assets/Healthcare.png' },
  { id: 5, title: 'NGOs', icon: '/assets/Research center assets/NGOs.png' },
  { id: 6, title: 'International Organizations', icon: '/assets/Research center assets/International.png' },
  { id: 7, title: 'Research Institutes', icon: '/assets/Research center assets/Research Institutes.png' }
]);

const careers = [
  { title: 'AI Specialist', ext: 'png' },
  { title: 'Human-Centered AI Designer', ext: 'png' },
  { title: 'Digital Wellness Consultant', ext: 'png' },
  { title: 'AI Ethics Officer', ext: 'png' },
  { title: 'Human Behavior Analyst', ext: 'png' },
  { title: 'AI Policy Specialist', ext: 'png' },
  { title: 'Innovation Consultant', ext: 'png' },
  { title: 'Leadership Coach', ext: 'png' },
  { title: 'Organizational Development Specialist', ext: 'png' },
  { title: 'Smart City Planner', ext: 'png' },
  { title: 'Digital Transformation Consultant', ext: 'png' },
];

// Separated the state so opening one section doesn't open the other
const showAllLabs = ref(false);
const showAllCareers = ref(false);

const currentIndex = ref(0);
let autoScrollInterval: ReturnType<typeof setInterval> | null = null;

const next = () => {
  currentIndex.value = (currentIndex.value + 1) % researches.length;
};

const getCardClass = (index: number) => {
  const len = researches.length;
  let offset = ((index - currentIndex.value) % len + len) % len;
  if (offset > len / 2) offset -= len;

  switch (offset) {
    case 0:
      return 'z-30 scale-110 translate-x-0 opacity-100 shadow-2xl';
    case 1:
      return 'z-20 scale-90 translate-x-[85%] sm:translate-x-[110%] opacity-90 cursor-pointer shadow-xl';
    case -1:
      return 'z-20 scale-90 -translate-x-[85%] sm:-translate-x-[110%] opacity-90 cursor-pointer shadow-xl';
    case 2:
      return 'z-10 scale-75 translate-x-[150%] sm:translate-x-[210%] opacity-60 cursor-pointer shadow-lg hidden sm:flex'; // Hidden on very small screens to avoid excessive overflow
    case -2:
      return 'z-10 scale-75 -translate-x-[150%] sm:-translate-x-[210%] opacity-60 cursor-pointer shadow-lg hidden sm:flex';
    default:
      return 'z-0 scale-50 opacity-0 pointer-events-none hidden';
  }
};

const setIndex = (index: number) => {
  currentIndex.value = index;
};

onMounted(() => {
  autoScrollInterval = setInterval(() => {
    next();
  }, 3000);
});

onUnmounted(() => {
  if (autoScrollInterval) {
    clearInterval(autoScrollInterval);
  }
});
</script>

<template>
  <Head title="Research" />

  <!-- Added overflow-x-clip to prevent horizontal scrolling on mobile from carousel -->
  <div class="relative flex flex-col overflow-x-clip">
    <div 
      class="absolute inset-0 w-full bg-cover bg-center bg-no-repeat"
      style="background-image: url('/assets/Research center assets/research bg.jpg');"
    ></div>

    <NavBar class="relative z-10" />

    <main class="pt-24 pb-12 sm:pt-32 flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center relative z-10">
      <div class="text-center text-white mb-8 sm:mb-12">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 drop-shadow-lg">
          Research Center
        </h1>
        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold text-blue-100 drop-shadow-md max-w-3xl mx-auto">
          The HDWSI Research Institute supports research in:
        </h3>
      </div>
      
      <div class="relative w-full h-[220px] sm:h-[400px] md:h-[480px] flex items-center justify-center">
        <div 
          v-for="(item, index) in researches" 
          :key="index"
          @click="setIndex(index)"
          :class="[
            'absolute transition-all duration-700 ease-in-out flex flex-col bg-white rounded-xl p-3',
            'w-44 sm:w-56 lg:w-64 aspect-[2/3]',
            getCardClass(index)
          ]"
        >
          <div class="w-full aspect-square rounded-xl overflow-hidden mb-3 flex-shrink-0 bg-gray-100">
            <img 
              :src="item.image" 
              :alt="item.title" 
              class="w-full h-full object-cover"
              loading="lazy"
            />
          </div>
          <h4 class="flex-grow flex items-start justify-center text-center font-bold text-[#2095E0] text-sm sm:text-base lg:text-lg leading-tight mb-2">
            {{ item.title }}
          </h4>
        </div>
      </div>
    </main>
  </div>
  
  <section class="bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
   <div class="relative w-full max-w-7xl mx-auto overflow-hidden bg-white rounded-xl shadow-lg border border-gray-200">
        <img 
          src="/assets/Research center assets/Innovation Laboratory.jpg" 
          alt="Learning Pathways" 
          class="w-full object-cover"
        />
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6  text-white">
          <h1 class="text-3xl font-extrabold uppercase md:text-5xl tracking-wide">
            Learning Pathways
          </h1>
          <h2 class="mt-2 text-lg font-medium md:text-2xl">
            HDWSI offers education through multiple formats:
          </h2>
        </div>
      </div>

    <div class="max-w-7xl mx-auto py-8">
      <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <li
          v-for="(lab, index) in (showAllLabs ? labs : labs.slice(0, 8))"
          :key="index"
          class="rounded-xl bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-md h-full"
        >
          <div class="h-full min-h-[3.5rem] rounded-xl p-4 text-white font-semibold text-sm sm:text-base bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
            <span class="w-3 h-3 bg-white rounded-full mr-3 flex-shrink-0"></span>
            <span class="leading-tight">{{ lab }}</span>
          </div>
        </li>
      </ul>

      <div class="flex justify-center mt-8">
        <button
          type="button"
          @click="showAllLabs = !showAllLabs"
          class="px-8 py-3 rounded-md bg-[#2095E0] text-white text-base md:text-lg font-bold hover:bg-[#1A75BA] active:scale-95 transition-all shadow-md"
        >
          {{ showAllLabs ? 'See Less' : 'See More' }}
        </button>
      </div>
    </div>
  </section>

  <section 
    class="py-14 px-4 sm:px-6 lg:px-8 bg-cover bg-center bg-no-repeat relative"
    style="background-image: url('/assets/Research center assets/research bg.jpg');"
  >
    <div class="absolute inset-0"></div> <!-- Ensures contrast over bg image -->
    <div class="relative z-10 flex flex-col items-center text-center text-white mb-10 md:mb-14">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-black uppercase tracking-wide drop-shadow-md">
        Global Partnerships
      </h2>
      <p class="mt-3 text-lg md:text-xl font-medium text-gray-200 drop-shadow">
        Collaborate with:
      </p>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div 
        v-for="item in items" 
        :key="item.id"
        class="aspect-[4/3] sm:aspect-[2/1] flex flex-col items-start justify-start rounded-xl border border-blue-300/50 bg-gradient-to-br from-[#2095E0] to-[#104C7D] p-6 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
      >
        <div class="mb-2 md:mb-5 flex-shrink-0 bg-white/10 p-3 rounded-lg backdrop-blur-sm">
          <img 
            :src="item.icon" 
            :alt="item.title + ' Icon'" 
            class="h-12 w-12 sm:h-14 sm:w-14 object-contain filter brightness-0 invert"
          />
        </div>
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold leading-tight text-white mt-auto pb-2">
          {{ item.title }}
        </h3>
      </div>
    </div>
  </section>
  
  <section class="bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="relative w-full max-w-7xl mx-auto overflow-hidden bg-white rounded-xl shadow-lg border border-gray-200">
        <img 
          src="/assets/Research center assets/Careers.png" 
          alt="Careers Background" 
          class="w-full object-cover"
        />
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-6 text-white">
          <h1 class="text-3xl font-extrabold uppercase md:text-5xl tracking-wide">
            Careers
          </h1>
          <h2 class="mt-2 text-lg font-medium md:text-2xl">
            Future graduates can become:
          </h2>
        </div>
      </div>

    <div class="max-w-7xl mx-auto py-8">
      <!-- Added extra padding to container so the negative margin on icons doesn't get clipped on mobile -->
      <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-5 sm:gap-x-8 sm:gap-y-6 px-3 sm:px-4 md:px-0">
        <li
          v-for="(career, index) in (showAllCareers ? careers : careers.slice(0, 6))"
          :key="index"
          class="rounded-xl bg-[#2095E0] shadow-md flex items-center p-3 sm:p-4 relative min-h-[3.5rem] ml-4 md:ml-6 transition-transform hover:-translate-y-1"
        >
          <!-- Using standard Tailwind sizing (w-14/16) instead of non-existent w-15 -->
          <div class="absolute -left-6 sm:-left-8 top-1/2 transform -translate-y-1/2 bg-white rounded-full shadow-lg p-0.5">
            <img 
              :src="`/assets/Research center assets/${career.title}.${career.ext}`" 
              :alt="career.title" 
              class="w-12 h-12 sm:w-14 sm:h-14 rounded-full border-2 border-blue-100 object-cover"
              loading="lazy"
            />
          </div>

          <!-- Adjusted margin left to accommodate standardized icon size -->
          <span class="ml-8 sm:ml-10 text-white font-semibold text-sm sm:text-base leading-tight">
            {{ career.title }}
          </span>
        </li>
      </ul>

      <div class="flex justify-center mt-10">
        <button
          type="button"
          @click="showAllCareers = !showAllCareers"
          class="px-8 py-3 rounded-md bg-[#2095E0] text-white text-base md:text-lg font-bold hover:bg-[#1A75BA] active:scale-95 transition-all shadow-md"
        >
          {{ showAllCareers ? 'See Less' : 'See More' }}
        </button>
      </div>
    </div>
  </section>
    
  <Footer class="relative z-10" />
</template>