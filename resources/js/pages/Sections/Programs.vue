<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import Autoplay from 'embla-carousel-autoplay'
import { ref } from 'vue'
import Footer from '@/components/landing/Footer.vue'
import NavBar from '@/components/landing/NavBar.vue'
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from '@/components/ui/carousel'

// Define a type for clarity
interface Program {
  title: string
  image: string
}

const wellnessPrograms = ref<Program[]>([
  { title: 'Healthy Technology Use', image: '/assets/Programs assets/Healthy.jpg' },
  { title: 'Screen-Time Science', image: '/assets/Programs assets/Screen time science.jpg' },
  { title: 'Human-AI Interaction', image: '/assets/Programs assets/Human.jpg' },
  { title: 'Digital Habits', image: '/assets/Programs assets/Digital Habits.jpg' },
  { title: 'Technology-Life Balance', image: '/assets/Programs assets/Technology-.jpg' },
  { title: 'Social Media Psychology', image: '/assets/Programs assets/Social Media.jpg' },
  { title: 'Digital Addiction Prevention', image: '/assets/Programs assets/Digital Addiction.jpg' },
])

const labs = [
  'AI Fundamentals',
  'Machine Learning',
  'Generative AI',
  'Robotics',
  'Autonomous Systems',
  'AI Applications',
  'Prompt Engineering',
  'AI Ethics',
];


// Explicitly type the array
const programs = ref<Program[]>([
  { title: 'Design Thinking', image: '/assets/Programs assets/Design Thinking .png' },
  { title: 'Human-Centered Design', image: '/assets/Programs assets/Human-Centered Design.png' },
  { title: 'Product Innovation', image: '/assets/Programs assets/Product Innovation.png' },
  { title: 'Service Innovation', image: '/assets/Programs assets/Service Innovation.png' },
  { title: 'Sustainable Innovation', image: '/assets/Programs assets/Sustainable Innovation.png' },
  { title: 'Community Innovation', image: '/assets/Programs assets/Community Innovation.png' }
])


// const plugin = Autoplay({
//   delay: 3000,
//   stopOnInteraction: true,
// })

const humanity = ref([
  {
    id: 1,
    title: 'Behavioral Psychology',
    image: '/assets/Programs assets/Behavioral.jpg'
  },
  {
    id: 2,
    title: 'Neuroscience',
    image: '/assets/Programs assets/Neuroscience.jpg'
  },
  {
    id: 3,
    title: 'Sociology',
    image: '/assets/Programs assets/Sociology.jpg'
  },
  {
    id: 4,
    title: 'Anthropology',
    image: '/assets/Programs assets/Anthropology.jpg'
  },
  {
    id: 5,
    title: 'Organizational Behavior',
    image: '/assets/Programs assets/Organizational.jpg'
  },
  {
    id: 6,
    title: 'Consumer Psychology',
    image: '/assets/Programs assets/Customer.jpg'
  },
  {
    id: 7,
    title: 'Human Decision Making',
    image: '/assets/Programs assets/Human Decision.jpg'
  }

]);
const socialIntelligence = [
  { title: 'Emotional Intelligence', ext: 'png' },
  { title: 'Leadership', ext: 'png' },
  { title: 'Negotiation', ext: 'png' },
  { title: 'Communication', ext: 'png' },
  { title: 'Public Relations', ext: 'png' },
  { title: 'Team Dynamics', ext: 'png' },
  { title: 'Cross-Cultural Intelligence', ext: 'png' },
];

const showAll = ref(false);
const showAllLabs = ref(false);
const showAllSocialIntelligence = ref(false);

const toggleView = () => {
  showAll.value = !showAll.value
}

const plugin = Autoplay({
  delay: 3000,
  stopOnMouseEnter: true,
  stopOnInteraction: false,
})
</script>

<template>
  <Head title="Programs" />

  <!-- Section 1: Digital Wellness -->
  <section 
    class="py-10 pt-26 bg-cover bg-center" 
    style="background-image: url('/assets/Programs assets/bg.jpg');"
  >
    <!-- Header -->
    <div class="mb-10 text-center max-w-7xl mx-auto">
      <h1 class="text-[#289F7F] text-3xl md:text-4xl lg:text-5xl font-black mb-2">
        School of Digital Wellness
      </h1>
      <h2 class="text-[#2095E0] text-2xl md:text-3xl font-extrabold mb-4">
        Helping individuals create healthier relationships with technology.
      </h2>
      <h3 class="text-[#2095E0] text-xl font-bold">
        Programs:
      </h3>
    </div>

    <!-- Cards -->
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-6">
      <div 
        v-for="(program, index) in wellnessPrograms" 
        :key="index" 
        class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col items-center"
      >
        <!-- Image -->
        <img 
          :src="program.image" 
          :alt="program.title" 
          class="w-full h-40 object-cover"
        />
        <!-- Title -->
        <div class="p-4 text-center">
          <h4 class="text-[#2095E0] font-bold text-lg">
            {{ program.title }}
          </h4>
        </div>
      </div>
    </div>
  </section>

<section class="py-12 px-4 sm:px-6 lg:px-8 w-full">
  <div class="max-w-7xl mx-auto flex flex-col items-center w-full">
    
    <div class="mb-10 text-center flex flex-col items-center w-full">
      <h1 class="text-[#289F7F] text-3xl md:text-4xl lg:text-5xl font-black mb-3 leading-tight drop-shadow-sm">
        School of Artificial Intelligence
      </h1>
      <h2 class="text-[#2095E0] text-xl md:text-2xl lg:text-3xl font-extrabold mb-6">
        Human-Centered AI Education
      </h2>
      <h3 class="text-[#2095E0] text-lg md:text-xl font-bold uppercase tracking-wider">
        Programs:
      </h3>
      
    </div>

    <div class="w-full py-4">
      <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5 md:gap-6">
        <li
          v-for="(lab, index) in (showAllLabs ? labs : labs.slice(0, 8))"
          :key="index"
          class="rounded-xl bg-gradient-to-r from-blue-300 to-[#104C7D] shadow-md transition-transform duration-300 hover:-translate-y-1 hover:shadow-lg h-full"
        >
          <div class="h-full min-h-[4rem] rounded-xl p-4 sm:p-5 text-white font-semibold text-sm sm:text-base bg-gradient-to-r from-[#2095E0] from-[65%] to-[#1A75BA] flex items-center">
            <span class="w-3 h-3 bg-white rounded-full mr-3 sm:mr-4 flex-shrink-0 shadow-sm"></span>
            <span class="leading-snug">{{ lab }}</span>
          </div>
        </li>
      </ul>
    </div>
    
  </div>
</section>

<section class="py-16 md:py-20 bg-gradient-to-br from-[#2095E0] to-[#104C7D] w-full overflow-hidden">
  
  <!-- Header Block -->
  <div class="max-w-7xl mx-auto flex flex-col items-center text-center w-full mb-10 sm:mb-14 px-4">
    <h1 class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black mb-3 drop-shadow-lg leading-tight">
      School of Human Behavior
    </h1>
    <h2 class="text-blue-100 text-xl sm:text-2xl lg:text-3xl font-extrabold mb-6 drop-shadow-sm">
      Understanding Humanity in the AI Era
    </h2>
    <h3 class="text-white text-lg md:text-xl font-bold uppercase tracking-wider">
      Programs
    </h3>
  </div>

  <div class="mx-auto w-full max-w-7xl px-12 sm:px-16 lg:px-24 relative">
    <Carousel 
      class="w-full" 
      :opts="{ loop: true, align: 'start' }" 
      :plugins="[plugin]" 
      @mouseenter="plugin.stop" 
      @mouseleave="plugin.reset"
    >
      <CarouselContent class="-ml-4 sm:-ml-6 items-stretch">
        
        <CarouselItem 
          v-for="item in humanity" 
          :key="item.id" 
          class="pl-4 sm:pl-6 basis-full md:basis-1/2 lg:basis-1/3 flex"
        >
          <!-- Card Container -->
          <div class="flex w-full flex-col overflow-hidden rounded-xl bg-white shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            
            <div class="aspect-[4/3] sm:aspect-square w-full overflow-hidden bg-gray-100">
              <img 
                :src="item.image" 
                :alt="item.title" 
                class="h-full w-full object-cover transition-transform duration-500 hover:scale-105" 
                loading="lazy"
              />
            </div>
            
            <div class="flex flex-col items-center justify-center flex-grow px-4 py-5 sm:py-6 text-center min-h-[5rem]">
              <h3 class="text-lg sm:text-xl md:text-2xl font-extrabold text-[#289F7F] leading-tight">
                {{ item.title }}
              </h3>
            </div>

          </div>
        </CarouselItem>

      </CarouselContent>
      
      <!-- Fixed Navigation Arrows -->
      <!-- Adjusted negative left/right to fit perfectly inside the parent padding -->
      <CarouselPrevious class="absolute -left-10 sm:-left-12 lg:-left-16 top-1/2 -translate-y-1/2 h-10 w-10 sm:h-12 sm:w-12 border-0 bg-transparent hover:bg-transparent shadow-none [&>svg]:hidden focus:ring-0">
        <img src="/assets/front-page/ICONS/arrow1.png" alt="Previous" class="h-full w-full object-contain transition-transform hover:scale-110 active:scale-95" />
      </CarouselPrevious>
      
      <CarouselNext class="absolute -right-10 sm:-right-12 lg:-right-16 top-1/2 -translate-y-1/2 h-10 w-10 sm:h-12 sm:w-12 border-0 bg-transparent hover:bg-transparent shadow-none [&>svg]:hidden focus:ring-0">
        <img src="/assets/front-page/ICONS/arrow2.png" alt="Next" class="h-full w-full object-contain transition-transform hover:scale-110 active:scale-95" />
      </CarouselNext>

    </Carousel>
  </div>
</section>

<section>
    <main class="pt-24 flex-grow w-full max-w-7xl mx-auto px-4 pb-16">
      <div class="mb-10 text-center">
        <h1 class="text-[#289F7F] text-3xl md:text-4xl lg:text-5xl font-black mb-2">
          School of Social Intelligence
        </h1>
        <h2 class="text-[#2095E0] text-2xl md:text-3xl font-extrabold mb-4">
          Developing Future Leaders
        </h2>
        <h3 class="text-[#2095E0] text-xl font-bold">Programs:</h3>
      </div>
      <div class="max-w-7xl mx-auto py-8">
      <!-- Added extra padding to container so the negative margin on icons doesn't get clipped on mobile -->
  <ul class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-5 sm:gap-x-8 sm:gap-y-6 px-3 sm:px-4 md:px-0">
  <li
    v-for="(career, index) in (showAllSocialIntelligence
      ? socialIntelligence
      : socialIntelligence.slice(0, 10))"
    :key="index"
    class="rounded-xl bg-[#2095E0] shadow-md flex items-center p-3 sm:p-4 relative min-h-[3.5rem] ml-4 md:ml-6 transition-transform hover:-translate-y-1"
  >
    <div
      class="absolute -left-6 sm:-left-8 top-1/2 transform -translate-y-1/2 bg-white rounded-full shadow-lg p-0.5"
    >
      <img
        :src="`/assets/Programs assets/${career.title}.${career.ext}`"
        :alt="career.title"
        class="w-12 h-12 sm:w-14 sm:h-14 rounded-full border-2 border-blue-100 object-cover"
        loading="lazy"
      />
    </div>

    <span
      class="ml-8 sm:ml-10 text-white font-semibold text-sm sm:text-base leading-tight"
    >
      {{ career.title }}
    </span>
  </li>
</ul>
      </div>
      </main>
</section>

  <section class="bg-gray-50 flex flex-col">
    <NavBar />
    
    <main class="pt-24 flex-grow w-full max-w-7xl mx-auto px-4 pb-16">
      <div class="mb-10 text-center">
        <h1 class="text-[#289F7F] text-3xl md:text-4xl lg:text-5xl font-black mb-2">
          School of Human-Centered Innovation
        </h1>
        <h2 class="text-[#2095E0] text-2xl md:text-3xl font-extrabold mb-4">
          Innovation Designed Around People
        </h2>
        <h3 class="text-[#2095E0] text-xl font-bold">Programs include:</h3>
      </div>
      
      <div class="w-full relative mt-8">
        <div v-if="!showAll" class="w-full">
          <Carousel 
            :plugins="[plugin]" 
            class="w-full"
            :opts="{ align: 'start', loop: true }"
          >
            <CarouselContent class="-ml-4">
              <CarouselItem 
                v-for="(program, index) in programs" 
                :key="index" 
                class="pl-4 basis-full sm:basis-1/2 lg:basis-1/3"
              >
                <div class="bg-gradient-to-r from-[#2095E0] to-[#104C7D] rounded-2xl shadow-lg p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1 aspect-[2/1] w-full">
                  <img 
                    :src="program.image" 
                    :alt="program.title" 
                    class="w-20 h-20 md:w-24 md:h-24 object-contain mb-6 drop-shadow-md" 
                  />
                  <h4 class="text-white text-lg md:text-xl font-bold text-center leading-snug">
                    {{ program.title }}
                  </h4>
                </div>
              </CarouselItem>
            </CarouselContent>
          </Carousel>
        </div>

        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div 
            v-for="(program, index) in programs" 
            :key="index"
            class="bg-gradient-to-r from-[#2095E0] to-[#104C7D] rounded-2xl shadow-lg p-6 flex flex-col items-center justify-center transition-transform hover:-translate-y-1 aspect-[2/1] w-full"
          >
            <img 
              :src="program.image" 
              :alt="program.title" 
              class="w-20 h-20 md:w-24 md:h-24 object-contain mb-6 drop-shadow-md" 
            />
            <h4 class="text-white text-2xl md:text-xl font-extrabold text-center leading-snug">
              {{ program.title }}
            </h4>
          </div>
        </div>

        <div class="mt-12 flex justify-center">
          <button 
            @click="toggleView" 
            class="bg-gradient-to-r from-[#2095E0] to-[#104C7D] hover:bg-[#0B385E] text-white font-bold text-2xl py-5 px-12 rounded-xl shadow-md transition-colors transform hover:scale-105"
          >
            {{ showAll ? 'See Less' : 'See More' }}
          </button>
        </div>
      </div>
    </main>
    
    <Footer />
  </section>
</template>
