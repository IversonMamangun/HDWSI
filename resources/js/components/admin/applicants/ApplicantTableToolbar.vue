<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { Search } from '@lucide/vue';
import { ref, watch } from 'vue';

import { Input } from '@/components/ui/input';
import { index } from '@/routes/admin/applicants';

interface Props {
    filters: {
        search: string | null;
    };
}

const props = defineProps<Props>();
const search = ref(props.filters.search ?? '');

let timeout: ReturnType<typeof setTimeout>;

watch(search, (value) => {
    clearTimeout(timeout);

    timeout = setTimeout(() => {
        router.visit(
            index({
                query: {
                    search: value || undefined,
                },
            }),
            {
                preserveState: true,
                preserveScroll: true,
                replace: true,
            },
        );
    }, 300);
});
</script>

<template>
    <div class="flex items-center justify-between gap-4">
        <div class="relative w-full max-w-sm">
            <Search
                class="absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground"
            />
            <Input
                v-model="search"
                placeholder="Search applicants..."
                class="pl-9"
            />
        </div>
    </div>
</template>
