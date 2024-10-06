<template>
    <div class="text-center">
        <Link 
            :href="route('dashboard')" 
            title="Today"
            class="text-sm text-blue-600 hover:text-blue-700 underline hover:no-underline"
        >
            Today
        </Link> 
    </div>
    <div class="grid grid-cols-3 text-center w-full md:w-1/2 mx-auto">
        <div class="justify-self-end">
            <Link :href="route('dashboard', { date: yesterday})" :title="yesterdayFormatted">
                <ChevronLeftIcon class="size-5" />
            </Link> 
        </div>
        <div>
            {{ todayFormatted }}
        </div>
        <div class="justify-self-start">
            <Link :href="route('dashboard', { date: tomorrow})" :title="tomorrowFormatted">
                <ChevronRightIcon class="size-5" />
            </Link>
        </div>
    </div>

</template>

<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline'
import { Link } from '@inertiajs/vue3';

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
        type: String
    },
    tomorrowFormatted: {
        type: String
    },
});

</script>