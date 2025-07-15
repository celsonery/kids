<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import { ref } from 'vue';
import { Loader2 } from 'lucide-vue-next'

const message = ref('');
const form = useForm({
    file: null,
});

function handleFileChange(e) {
    form.file = e.target.files[0];
}

function submit() {
    message.value = '';

    form.post(route('kid.store'), {
        forceFormData: true,
        onSuccess: () => {
            form.file = null
            console.log('Enviado')
            message.value = 'Arquivo enviado com sucesso!'
        },
        onError: (err) => {
            console.log('Erro ' + err.toString())
            message.value = `Erro: ${form.errors}`;
        },
    });
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Importação',
        href: '/kids/import',
    },
];
</script>
<template>
    <Head title="Importação" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 md:w-10/12">
            <div class="grid w-full max-w-sm items-center gap-1.5">
                <Label for="picture">Planilha CSV</Label>
                <Input id="picture" type="file" accept=".csv" @change="handleFileChange" />
            </div>
            <div class="my-2">
                <Button
                    @click.prevent="submit"
                    :disabled="form.processing || !form.file">
                    <Loader2 v-if="form.processing" class="w-4 h-4 mr-1 animate-spin" />
                    Enviar planilha
                </Button>
            </div>
            {{ message }}
        </div>
    </AppLayout>
</template>
