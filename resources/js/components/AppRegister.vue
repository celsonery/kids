<template>
    <nav class="flex items-center justify-end gap-4">
        <Link
            v-if="$page.props.auth.user"
            :href="route('dashboard')"
            class="inline-block rounded-lg border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:bg-primary dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
        >
            Dashboard
        </Link>
        <template v-else>
            <Link
                :href="route('register')"
                class="inline-block rounded-md border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:bg-primary dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Entrar
            </Link>
        </template>
    </nav>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>
