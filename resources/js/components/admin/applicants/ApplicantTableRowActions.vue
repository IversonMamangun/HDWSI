<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

import { Ellipsis, Eye, Trash } from '@lucide/vue';

import { Button } from '@/components/ui/button';

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';

import type { User } from '@/types';

import { show } from '@/routes/admin/applicants';


defineProps<{
    applicant: User;
}>();

const emit = defineEmits<{
    delete: [applicant: User];
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
                <Link :href="show(applicant)">
                    <Eye class="mr-2 size-4" />
                    View
                </Link>
            </DropdownMenuItem>

            <!-- <DropdownMenuItem v-if="applicant.can?.update" as-child>
                <Link :href="edit(applicant)">
                    <Pencil class="mr-2 size-4" />
                    Edit
                </Link>
            </DropdownMenuItem> -->

            <DropdownMenuSeparator />

            <DropdownMenuItem
                v-if="applicant.can?.delete"
                class="text-destructive focus:text-destructive"
                @click="emit('delete', applicant)"
            >
                <Trash class="mr-2 size-4" />
                Delete
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
