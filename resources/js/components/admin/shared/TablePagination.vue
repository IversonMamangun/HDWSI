<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    ChevronLeft,
    ChevronRight,
    ChevronsLeft,
    ChevronsRight,
    MoreHorizontal,
} from '@lucide/vue';
import { computed } from 'vue';

import { Button } from '@/components/ui/button';
import type { Paginated, PaginationLink } from '@/types';

const props = withDefaults(
    defineProps<{
        items: Paginated<unknown>;
        itemLabel?: string;
    }>(),
    {
        itemLabel: 'users',
    },
);

const pageLinks = computed(() =>
    props.items.meta.links.filter(
        (link: PaginationLink) =>
            link.label !== '&laquo; Previous' && link.label !== 'Next &raquo;',
    ),
);
</script>

<template>
    <div
        class="flex flex-col gap-4 py-4 lg:flex-row lg:items-center lg:justify-between"
    >
        <div class="text-sm text-muted-foreground">
            Showing
            {{ items.meta.from ?? 0 }}
            to
            {{ items.meta.to ?? 0 }}
            of
            {{ items.meta.total }}
            {{ itemLabel }}
        </div>

        <div class="w-full overflow-x-auto lg:w-auto">
            <nav
                class="flex min-w-max items-center justify-center gap-1 lg:justify-end"
            >
                <!-- First -->
                <Button
                    variant="outline"
                    size="icon"
                    :disabled="items.meta.current_page === 1"
                    as-child
                >
                    <Link :href="`${items.meta.path}?page=1`">
                        <ChevronsLeft class="h-4 w-4" />
                    </Link>
                </Button>

                <!-- Previous -->
                <Button
                    variant="outline"
                    size="icon"
                    :disabled="!items.links.prev"
                    as-child
                >
                    <Link :href="items.links.prev ?? '#'">
                        <ChevronLeft class="h-4 w-4" />
                    </Link>
                </Button>

                <!-- Page Numbers -->
                <template
                    v-for="link in pageLinks"
                    :key="`${link.label}-${link.page}`"
                >
                    <Button
                        v-if="link.label !== '...'"
                        :variant="link.active ? 'default' : 'outline'"
                        size="icon"
                        as-child
                    >
                        <Link :href="link.url!">
                            {{ link.page }}
                        </Link>
                    </Button>

                    <Button v-else variant="ghost" size="icon" disabled>
                        <MoreHorizontal class="h-4 w-4" />
                    </Button>
                </template>

                <!-- Next -->
                <Button
                    variant="outline"
                    size="icon"
                    :disabled="!items.links.next"
                    as-child
                >
                    <Link :href="items.links.next ?? '#'">
                        <ChevronRight class="h-4 w-4" />
                    </Link>
                </Button>

                <!-- Last -->
                <Button
                    variant="outline"
                    size="icon"
                    :disabled="items.meta.current_page === items.meta.last_page"
                    as-child
                >
                    <Link
                        :href="`${items.meta.path}?page=${items.meta.last_page}`"
                    >
                        <ChevronsRight class="h-4 w-4" />
                    </Link>
                </Button>
            </nav>
        </div>
    </div>
</template>
