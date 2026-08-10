<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, computed } from 'vue';
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
  {
    id: 1,
    title: 'Universities',
    icon: '/assets/Research center assets/Universities.png',
  },
  {
    id: 2,
    title: 'Governments',
    icon: '/assets/Research center assets/Governments.png',
  },
  {
    id: 3,
    title: 'Technology Companies',
    icon: '/assets/Research center assets/Technology.png',
  },
  {
    id: 4,
    title: 'Healthcare Institutions',
    icon: '/assets/Research center assets/Healthcare.png',
  },
  {
    id: 5,
    title: 'NGOs',
    icon: '/assets/Research center assets/NGOs.png',
  },
  {
    id: 6,
    title: 'International Organizations',
    icon: '/assets/Research center assets/International.png',
  },
  {
    id: 7,
    title: 'Research Institutes',
    icon: '/assets/Research center assets/Research Institutes.png',
  }
])


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

const showAll = ref(false)


const visibleItems = computed(() => {
  return showAll.value ? items.value : items.value.slice(0, 8)
})

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

  <div class="relative  flex flex-col">
    <div 
      class="absolute inset-0 w-full bg-cover bg-center bg-no-repeat"
      style="background-image: url('/assets/Research center assets/research bg.jpg');"
    ></div>

    <NavBar class="relative z-10" />

    <main class="pt-32 flex-grow w-full max-w-7xl mx-auto px-4 flex flex-col items-center relative z-10">
      <div class="text-center text-white mb-6">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-4 drop-shadow-lg">
          Research Center
        </h1>
        <h3 class="text-xl md:text-2xl font-semibold text-blue-100 drop-shadow-md">
          The HDWSI Research Institute supports research in:
        </h3>
      </div>
      
      <div class="relative w-full h-[200px] sm:h-[480px] flex items-center justify-center">
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
    
    
  </div>
  
    <section class="bg-white py-5">
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

      <div class="max-w-7xl mx-auto py-6">

        <ul class="grid grid-cols-1 sm:grid-cols-4 gap-3">
          <li
            v-for="(lab, index) in (showAll ? labs : labs.slice(0, 8))"
            :key="index"
            class="rounded-xl bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-md"
          >
            <div
              class="h-full rounded-xl p-3 sm:p-4 text-white font-semibold text-sm sm:text-base bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center"
            >
              <span class="w-3 h-3 bg-white rounded-full mr-3 flex-shrink-0"></span>
              {{ lab }}
            </div>
          </li>
        </ul>

        <div class="flex justify-center mt-4">
          <button
            @click="showAll = !showAll"
            class="px-8 py-3 rounded-md bg-[#2095E0] text-white text-lg font-bold hover:bg-[#1A75BA] transition"
          >
            {{ showAll ? 'See Less' : 'See More' }}
          </button>
        </div>
    </div>


    </section>

    <section>
    <div class="py-7" style="background-image: url('/assets/Research center assets/research bg.jpg');" >
      
      <div class="flex flex-col items-center text-center text-white pt-12 mb-14">
        <h2 class="text-3xl md:text-5xl font-black uppercase tracking-wide">
          Global Partnerships
        </h2>
        <p class="mt-3 text-lg md:text-xl font-medium text-gray-200">
          Collaborate with:
        </p>
      </div>

      <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div 
          v-for="item in visibleItems" 
          :key="item.id"
          class="aspect-[3/2] flex flex-col items-start justify-start rounded-xl border-2 border-gray-300 bg-gradient-to-r from-[#2095E0] to-[#104C7D] p-6 sm:p-8 shadow-lg transition-transform duration-300 hover:-translate-y-1"
        >
          <div class="mb-5 flex-shrink-0">
            <img 
              :src="item.icon" 
              :alt="item.title + ' Icon'" 
              class="h-14 w-14 object-contain sm:h-16 sm:w-16"
            />
          </div>
          
          <h3 class="text-xl sm:text-2xl font-bold leading-tight text-white mt-auto pb-4">
            {{ item.title }}
          </h3>
        </div>

      </div>
    </div>
    </section>
    <section class="bg-white py-5">
      <div class="relative w-full max-w-7xl mx-auto overflow-hidden bg-white rounded-xl shadow-lg border border-gray-200">
        <img 
          src="/assets/Research center assets/Innovation Laboratory.jpg" 
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

    <div class="max-w-7xl mx-auto py-6">
      <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <li
        v-for="(career, index) in (showAll ? careers : careers.slice(0, 6))"
        :key="index"
        class="rounded-xl bg-[#2095E0] shadow-md flex items-center p-3 sm:p-4 relative"
      >
        <div class="absolute -left-3 top-1/2 transform -translate-y-1/2">
    <img 
      :src="`/assets/Research center assets/${career.title}.${career.ext}`" 
      :alt="career.title" 
      class="w-15 h-15 rounded-full border-2 border-blue-400 object-cover shadow-md"
    />
  </div>

  <span class="ml-12 text-white font-semibold text-sm sm:text-base">
    {{ career.title }}
  </span>
</li>

      </ul>

      <div class="flex justify-center mt-6">
        <button
          @click="showAll = !showAll"
          class="px-6 py-2 rounded-md bg-[#2095E0] text-white text-sm sm:text-base font-bold hover:bg-[#1A75BA] transition"
        >
          {{ showAll ? 'See Less' : 'See More' }}
        </button>
      </div>
    </div>
  </section>
    
      <Footer class="relative z-10" />

</template>
