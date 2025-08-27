<template>
    <div class="w-full mx-auto flex gap-4">
        <div class="hidden md:block md:w-2/5 bg-[url(/assets/images/kids-united.jpg)] bg-center bg-cover"></div>

        <div class="w-full md:w-3/5 p-2 md:p-12">
            <AppRegister />
            <AppKidSearch />
        </div>
    </div>
</template>

<script setup lang="ts">

import AppKidSearch from '@/components/AppKidSearch.vue';
import AppRegister from '@/components/AppRegister.vue';
</script>
