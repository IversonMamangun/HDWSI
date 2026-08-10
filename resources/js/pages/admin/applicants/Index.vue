<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem, Paginated, User } from '@/types'

import ApplicantTable from '@/components/admin/applicants/ApplicantTable.vue';
import ApplicantTableToolbar from '@/components/admin/applicants/ApplicantTableToolbar.vue';
import TablePagination from '@/components/admin/shared/TablePagination.vue';
import { index as adminApplicants } from '@/routes/admin/applicants';

const selectedApplicant = ref<User | null>(null);
const deleteDialogOpen = ref(false);

function onDelete(applicant: User) {
    selectedApplicant.value = applicant;
    deleteDialogOpen.value = true;
}

defineProps<{
    applicants: Paginated<User>;

    filters: {
        search: string | null;
    };

    sort: string;

    direction: 'asc' | 'desc';
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Applicants',
        href: adminApplicants(),
    },
];
</script>

<template>
    <Head title="Applicants" />

    <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-1 flex-col gap-4 p-4">
        <ApplicantTableToolbar :filters="filters" />

        <ApplicantTable
            :applicants="applicants"
            :filters="filters"
            :sort="sort"
            :direction="direction"
            @delete="onDelete"
        />

        <TablePagination :items="applicants" item-label="applicants" />

        <!-- <ApplicantDeleteDialog
            v-model:open="deleteDialogOpen"
            :applicant="selectedApplicant"
        /> -->
    </div>
    </AppLayout>
</template>
