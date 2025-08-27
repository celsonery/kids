<template>
    <Head title="Welcome"></Head>
    <div class="flex min-h-screen flex-col text-[#1b1b18] dark:text-white">
        <AppWelcome />
    </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppWelcome from '@/components/AppWelcome.vue';

</script>
