<script setup lang="ts">
import { Separator } from '@/components/ui/separator';
import { Head, Link } from '@inertiajs/vue3';
import AppKidSearch from '@/components/AppKidSearch.vue';
</script>

<template>
    <Head title="Welcome"></Head>
    <div class="flex min-h-screen flex-col items-center p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:text-white">
        <header class="mb-6 w-full text-sm not-has-[nav]:hidden">
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Entrar
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Registrar
                    </Link>
                </template>
            </nav>
        </header>
        <Separator class="my-4 bg-gray-800" />

        <AppKidSearch />
    </div>
    <div class="hidden h-14.5 lg:block"></div>
</template>
