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


// Explicitly type the array
const programs = ref<Program[]>([
  { title: 'Design Thinking', image: '/assets/Programs assets/Design Thinking .png' },
  { title: 'Human-Centered Design', image: '/assets/Programs assets/Human-Centered Design.png' },
  { title: 'Product Innovation', image: '/assets/Programs assets/Product Innovation.png' },
  { title: 'Service Innovation', image: '/assets/Programs assets/Service Innovation.png' },
  { title: 'Sustainable Innovation', image: '/assets/Programs assets/Sustainable Innovation.png' },
  { title: 'Community Innovation', image: '/assets/Programs assets/Community Innovation.png' }
])

const showAll = ref(false)

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

  <!-- Section 2: Human-Centered Innovation -->
  <section class="bg-gray-50 flex flex-col">
    <NavBar />
    
    <main class="pt-24 flex-grow w-full max-w-7xl mx-auto px-4 pb-16">
      <div class="mb-10 text-center md:text-left">
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
