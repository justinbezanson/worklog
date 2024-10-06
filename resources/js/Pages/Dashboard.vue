<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DatePager from '@/Components/Dashboard/DatePager.vue';

defineProps({
    today: {
        type: String,
    },
    todayFormatted: {
        type: String,
    },
    yesterday: {
        type: String,
    },
    yesterdayFormatted: {
        type: String,
    },
    tomorrow: {
        type: String,
    },
    tomorrowFormatted: {
        type: String,
    },
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">                        
                        <DatePager 
                            :today="today" 
                            :today-formatted="todayFormatted"
                            :yesterday="yesterday" 
                            :yesterday-formatted="yesterdayFormatted"
                            :tomorrow="tomorrow" 
                            :tomorrow-formatted="tomorrowFormatted"
                        />
                    </div>

                    <div class="text-center md:text-right md:pr-6 pb-6">
                        <Button type="button" label="New Entry" icon="pi pi-plus" class="p-button-success" />
                    </div>

                    <table class="w-full md:w-1/2 mx-auto">
                        <thead>
                            <tr class="border-b border-gray-200 text-left">
                                <th>Status</th>
                                <th>Task description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Status
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
