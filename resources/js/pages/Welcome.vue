<template>
    <Head title="Welcome"></Head>
    <div class="flex min-h-screen flex-col text-[#1b1b18] lg:p-4 dark:text-white">
        <AppWelcome />
    </div>
    <div class="hidden h-14.5 lg:block"></div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppWelcome from '@/components/AppWelcome.vue';

</script>
