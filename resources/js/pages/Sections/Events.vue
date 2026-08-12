<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue'

import Footer from '@/components/landing/Footer.vue';
import NavBar from '@/components/landing/NavBar.vue';

interface Event {
  title: string
  image: string
}

const events = ref<Event[]>([
  { title: 'HDWSI Summit', image: '/assets/events asssets/HDWSI Summit.jpg' },
  { title: 'AI Leadership Forum', image: '/assets/events asssets/AI Leadership.jpg' },
  { title: 'Digital Wellness Conference', image: '/assets/events asssets/Digital Wellness.jpg' },
  { title: 'Human-Centered AI Symposium', image: '/assets/events asssets/Human-Centered.jpg' },
  { title: 'Innovation Bootcamp', image: '/assets/events asssets/Innovation.jpg' },
  { title: 'Future Economy Congress', image: '/assets/events asssets/Future Economy.jpg' },
])
</script>

<template>
  <Head title="Events" />

  <div class="min-h-screen bg-gray-50 flex flex-col">
    <NavBar />
    <section 
      class="pt-24 pb-20 flex-grow w-fullmx-auto px-4" 
      style="background-image: url('/assets/events asssets/Events.jpg');"
    >
      <div class="mb-12 text-center max-w-7xl mx-auto px-4 pt-14">
        <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-black mb-4">
          Events
        </h1>
        <h2 class="text-white text-2xl md:text-3xl font-extrabold mb-4">
          Upcoming:
        </h2>
      </div>

      <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-6 pb-12">
        <div 
          v-for="(event, index) in events" 
          :key="index" 
          class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col items-center transition-transform hover:-translate-y-1"
        >
          <img 
            :src="event.image" 
            :alt="event.title" 
            class="w-full h-40 object-cover"
          />
          <div class="p-4 text-center">
            <h4 class="text-[#2095E0] font-bold text-lg md:text-xl">
              {{ event.title }}
            </h4>
          </div>
        </div>
      </div>
    </section>
    <Footer />
  </div>
</template>
