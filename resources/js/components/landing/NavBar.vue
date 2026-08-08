<script setup lang="ts">
import { Link, usePage, router } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
import { login } from '@/routes';

const isMenuOpen = ref(false);
const isDarkMode = ref(false);

const page = usePage();
const currentUrl = computed(() => page.url);

// We define which items are separate pages vs landing page sections
const navLinks = [
  { name: 'Home', href: '/', id: 'home', isPage: false },
  { name: 'About HDWSI', href: '/#about', id: 'about', isPage: false },
  { name: 'Academic School', href: '/academic', isPage: true },
  { name: 'Programs', href: '/programs', isPage: true },
  { name: 'Research', href: '/research', isPage: true },
  { name: 'News & Insights', href: '/news', isPage: true },
  { name: 'Events', href: '/events', isPage: true },
  { name: 'Publications', href: '/publications', isPage: true },
  { name: 'Admission', href: '/admission', isPage: true },
  { name: 'Contact', href: '/#contact', id: 'contact', isPage: false },
];

onMounted(() => {
  if (
    document.documentElement.classList.contains('dark') ||
    window.matchMedia('(prefers-color-scheme: dark)').matches
  ) {
    isDarkMode.value = true;
    document.documentElement.classList.add('dark');
  }
});

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

const toggleDarkMode = () => {
  isDarkMode.value = !isDarkMode.value;
  document.documentElement.classList.toggle('dark', isDarkMode.value);
};

// Smart handler for Section Links (Home, About, Contact)
const scrollToSection = (link: any) => {
  isMenuOpen.value = false;
  
  // Check if we are currently on the landing page
  if (window.location.pathname === '/') {
    
    if (link.id === 'home') {
      window.scrollTo({ top: 0, behavior: 'smooth' });
      window.history.pushState(null, '', '/');
      return;
    }

    const element = document.getElementById(link.id);
    if (element) {
      const y = element.getBoundingClientRect().top + window.scrollY - 90;
      window.scrollTo({ top: y, behavior: 'smooth' });
      window.history.pushState(null, '', link.href);
    }
  } else {
    // If we are on a different page (like /academic), navigate back to the landing page hash
    router.visit(link.href);
  }
};

// Helper to determine active state
const isActive = (link: any) => {
  if (link.isPage) return currentUrl.value.startsWith(link.href);
  if (link.id === 'home') return currentUrl.value === '/';
  return currentUrl.value.includes('#' + link.id);
};
</script>

<template>
  <nav
    class="fixed left-0 right-0 top-4 z-50 mx-auto w-[96%] max-w-[1440px] rounded-md border border-neutral-200 bg-white shadow-lg transition-all duration-300 dark:border-neutral-800 dark:bg-neutral-900"
  >
    <div class="flex items-center justify-between px-4 py-3">

      <!-- Logo goes to Home smoothly -->
      <a
        href="/"
        @click.prevent="scrollToSection(navLinks[0])"
        class="flex shrink-0 items-center"
      >
        <img
          src="/assets/logo.png"
          alt="HDWSI Logo"
          class="h-10 w-auto object-contain transition-transform duration-300 hover:scale-105 md:h-12"
        />
      </a>

      <div class="hidden flex-1 justify-center xl:flex">
        <div class="flex items-center gap-4">
          
          <template v-for="link in navLinks" :key="link.name">
            <!-- Render Inertia <Link> for Actual Pages -->
            <Link
              v-if="link.isPage"
              :href="link.href"
              :class="
                isActive(link)
                  ? 'font-semibold text-hdwsi-blue'
                  : 'text-gray-700 dark:text-gray-300'
              "
              class="text-sm transition-colors duration-200 hover:text-hdwsi-blue"
            >
              {{ link.name }}
            </Link>

            <!-- Render standard <a> tag for Landing Page Sections -->
            <a
              v-else
              :href="link.href"
              @click.prevent="scrollToSection(link)"
              :class="
                isActive(link)
                  ? 'font-semibold text-hdwsi-blue'
                  : 'text-gray-700 dark:text-gray-300'
              "
              class="text-sm transition-colors duration-200 hover:text-hdwsi-blue"
            >
              {{ link.name }}
            </a>
          </template>

        </div>
      </div>

      <div class="flex items-center gap-2">
        <Link
          :href="login()"
          class="hidden rounded-md bg-hdwsi-teal px-5 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:opacity-90 active:scale-95 xl:inline-flex"
        >
          Log in
        </Link>

        <button
          @click="toggleDarkMode"
          class="flex h-10 w-10 items-center justify-center rounded-md transition hover:bg-blue-50 dark:hover:bg-neutral-800"
        >
          <svg v-if="isDarkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364-.707-.707M6.343 6.343l-.707-.707m12.728 0-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>

        <button
          @click="toggleMenu"
          class="flex h-10 w-10 items-center justify-center rounded-md transition hover:bg-blue-50 xl:hidden dark:hover:bg-neutral-800"
        >
          <svg class="h-5 w-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path v-if="!isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <transition name="menu-slide">
      <div
        v-show="isMenuOpen"
        class="absolute left-0 top-[calc(100%+0.5rem)] w-full overflow-hidden rounded-md border border-neutral-200 bg-white shadow-2xl xl:hidden dark:border-neutral-800 dark:bg-neutral-900"
      >
        <ul class="space-y-1 p-3">
          <li v-for="link in navLinks" :key="link.name">
            
            <Link
              v-if="link.isPage"
              :href="link.href"
              @click="isMenuOpen = false"
              :class="
                isActive(link)
                  ? 'bg-blue-50 font-medium text-hdwsi-blue dark:bg-neutral-800'
                  : 'text-gray-700 dark:text-gray-300'
              "
              class="block rounded-md px-4 py-3 transition-colors hover:bg-blue-50 hover:text-hdwsi-blue dark:hover:bg-neutral-800"
            >
              {{ link.name }}
            </Link>

            <a
              v-else
              :href="link.href"
              @click.prevent="scrollToSection(link)"
              :class="
                isActive(link)
                  ? 'bg-blue-50 font-medium text-hdwsi-blue dark:bg-neutral-800'
                  : 'text-gray-700 dark:text-gray-300'
              "
              class="block rounded-md px-4 py-3 transition-colors hover:bg-blue-50 hover:text-hdwsi-blue dark:hover:bg-neutral-800"
            >
              {{ link.name }}
            </a>

          </li>
        </ul>

        <div class="border-t border-neutral-200 p-4 dark:border-neutral-800">
          <Link
            :href="login()"
            class="block rounded-md bg-hdwsi-teal px-4 py-3 text-center text-sm font-semibold text-white transition hover:opacity-90"
          >
            Log in
          </Link>
        </div>
      </div>
    </transition>
  </nav>
</template>

<style scoped>
.menu-slide-enter-active,
.menu-slide-leave-active {
  transition: all 0.3s ease;
}

.menu-slide-enter-from,
.menu-slide-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>