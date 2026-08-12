<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
};

defineProps<Props>();
</script>

<template>
    <img
        src="/assets/registration/registration_logo.png"
        alt="HDWSI"
        :class="className"
        class="mx-auto h-full w-auto max-w-full object-contain"
        v-bind="$attrs"
    />
</template>
