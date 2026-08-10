<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Ellipsis, Eye } from '@lucide/vue';

import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';

import { show } from '@/routes/admin/applicants';
import type { User } from '@/types';

defineProps<{
    applicant: User;
}>();
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="ghost" size="icon">
                <Ellipsis class="size-4" />
            </Button>
        </DropdownMenuTrigger>

        <DropdownMenuContent align="end">
            <DropdownMenuItem v-if="applicant.can?.view" as-child>
                <Link :href="show(applicant.id)">
                    <Eye class="mr-2 size-4" />
                    View
                </Link>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
