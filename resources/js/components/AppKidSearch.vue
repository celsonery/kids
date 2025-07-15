<template>
    <div class="w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">
        <div class="flex justify-between gap-4">
            <div class="mb-4 grid w-full items-center gap-1.5">
                <Label for="name">Nome</Label>
                <Input id="name" type="text" placeholder="Seu nome completo" v-model="form.name" />
            </div>

            <div class="mb-4 grid w-full max-w-lg items-center gap-1.5">
                <Label for="cpf">CPF</Label>
                <CpfInput id="cpf" v-model="form.cpf" />
                <span v-if="cpfError" class="text-sm text-red-500">{{ cpfError }}</span>
            </div>
        </div>
        <div class="my-4 flex justify-end">
            <Button
                @click.prevent="sendData"
                :disabled="!form.name || form.cpf.length < 14 || form.processing">
                <Loader2 v-if="form.processing" class="w-4 h-4 mr-1 animate-spin" />
                Verificar situação
            </Button>
        </div>

        <Alert v-if="$page.props.flash.success" class="dark:bg-write my-4 bg-blue-200">
            <AlertTitle class="text-gray-500">Situação atual</AlertTitle>
            <AlertDescription class="mt-4 text-2xl font-extrabold text-black"> {{ $page.props.flash.success }} </AlertDescription>
        </Alert>

        <Alert v-if="$page.props.flash.error" class="my-4 bg-red-400">
            <AlertTitle class="text-gray-500">Situação atual</AlertTitle>
            <AlertDescription class="mt-4 text-2xl font-extrabold text-red-700"> {{ $page.props.flash.error }} </AlertDescription>
        </Alert>
    </div>
</template>

<script setup lang="ts">

import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { CpfInput } from '@/components/ui/cpf-input';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { isValidCPF } from '@/composables/useValidateCpf';
import { Loader2 } from 'lucide-vue-next'

const cpfError = ref<string>('');
const form = useForm({
    cpf: '',
    name: '',
});

function sendData() {
    cpfError.value = '';

    if (!isValidCPF(form.cpf)) {
        cpfError.value = 'CPF inválido!';
        return;
    }

    form.post(route('kid.result'), {
        onSuccess: () => {
            console.log('Sincronizado com sucesso!');
        },
        onError: () => {
            console.log(`Erro: ${form.errors}`);
        },
    });
}
</script>
