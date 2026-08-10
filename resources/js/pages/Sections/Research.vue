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
      return 'z-20 scale-90 translate-x-[90%] sm:translate-x-[110%] opacity-90 cursor-pointer shadow-xl';
    case -1:
      return 'z-20 scale-90 -translate-x-[90%] sm:-translate-x-[110%] opacity-90 cursor-pointer shadow-xl';
    case 2:
      return 'z-10 scale-75 translate-x-[170%] sm:translate-x-[210%] opacity-60 cursor-pointer shadow-lg';
    case -2:
      return 'z-10 scale-75 -translate-x-[170%] sm:-translate-x-[210%] opacity-60 cursor-pointer shadow-lg';
    default:
      return 'z-0 scale-50 opacity-0 pointer-events-none';
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

  <div class="relative min-h-screen flex flex-col">
    <!-- Responsive full background -->
    <div 
      class="absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat"
      style="background-image: url('/assets/Research center assets/research bg.jpg');"
    ></div>

    <!-- Content layered above -->
    <NavBar class="relative z-10" />

    <main class="pt-32 flex-grow w-full max-w-7xl mx-auto px-4 flex flex-col items-center relative z-10">
      <div class="text-center text-white mb-16">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 drop-shadow-lg">
          Research Center
        </h1>
        <h3 class="text-xl md:text-2xl font-semibold text-blue-100 drop-shadow-md">
          The HDWSI Research Institute supports research in:
        </h3>
      </div>
      
      <div class="relative w-full h-[500px] sm:h-[600px] flex items-center justify-center mt-6">
        <div 
          v-for="(item, index) in researches" 
          :key="index"
          @click="setIndex(index)"
          :class="[
            'absolute transition-all duration-700 ease-in-out flex flex-col bg-white rounded-xl p-3',
            'w-48 sm:w-56 lg:w-64 aspect-[2/3]',
            getCardClass(index)
          ]"
        >
          <div class="w-full aspect-square rounded-xl overflow-hidden mb-3 flex-shrink-0">
            <img 
              :src="item.image" 
              :alt="item.title" 
              class="w-full h-full object-cover"
            />
          </div>
          <h4 class="flex-grow flex items-start justify-center text-center font-bold text-[#2095E0] text-sm sm:text-base lg:text-lg leading-tight mb-2">
            {{ item.title }}
          </h4>
        </div>
      </div>
    </main>
    
    <Footer class="relative z-10" />
  </div>
</template>
