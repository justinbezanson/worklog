<template>
    <div class="grid grid-cols-3 text-center w-1/2 mx-auto">
        <div class="justify-self-end">
            <Link :href="route('dashboard', { date: yesterday})">
                <ChevronLeftIcon class="size-5" />
            </Link> 
        </div>
        <div class="">
            {{ today }}
        </div>
        <div class="">
            <Link :href="route('dashboard', { date: tomorrow})">
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
    yesterday: {
        type: String,
    },
    tomorrow: {
        type: String,
        required: true,
    },
});

</script>