<template>
    <div
        class="w-full p-2 md:p-8 items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">
        <div class="flex m-6 justify-center">
            <h1 class="p-2 md:p-6 text-lg md:text-2xl font-medium text-center">Informe seu nome completo e cpf, para verificar sua situação.</h1>
        </div>
        <div class="flex flex-col items-center justify-between gap-4">
            <div class="mb-4 grid w-full max-w-lg items-center gap-1.5">
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
                :disabled="!form.name || form.cpf.length < 14 || form.processing"
                class="text-white"
            >
                <Loader2 v-if="form.processing" class="mr-1 h-4 w-4 animate-spin" />
                Verificar
            </Button>
        </div>

        <Alert v-if="lstKids.id" class="dark:bg-write my-4 bg-blue-200">
            <AlertTitle class="text-gray-500">Situação atual</AlertTitle>
            <AlertDescription class="mt-4 text-2xl font-extrabold text-black">
                {{ lstKids.state }}
            </AlertDescription>
        </Alert>
        <div class="flex justify-end">
            <Button v-if="lstKids.id && $page.props.auth.user" @click.prevent="addFavorites(lstKids.id)">
                <Download />
                Adicionar aos Favoritos
            </Button>
        </div>

        <Alert v-if="Object.keys(errors).length > 0" class="my-4 bg-red-400">
            <AlertTitle class="text-gray-500">Situação atual</AlertTitle>
            <AlertDescription class="mt-4 text-2xl font-extrabold text-red-700">
                {{ errors }}
            </AlertDescription>
        </Alert>
    </div>
</template>

<script setup lang="ts">
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { CpfInput } from '@/components/ui/cpf-input';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Button } from '@/components/ui/button';
import { useForm } from '@inertiajs/vue3';
import { isValidCPF } from '@/composables/useValidateCpf';
import { Loader2, Download } from 'lucide-vue-next';
import { ref } from 'vue';
import axios from 'axios';

const cpfError = ref<string>('');
const lstKids = ref<[]>([]);
const errors = ref({});
const form = useForm({
    cpf: '',
    name: ''
});

const sendData = async () => {
    cpfError.value = '';

    if (!isValidCPF(form.cpf)) {
        cpfError.value = 'CPF inválido!';
        return;
    }

    try {
        const response = await axios.post(route('kid.result'), form);
        lstKids.value = response.data;
    } catch (error) {
        if (error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
    }
};

const addFavorites = async (id) => {
    console.log('Enviando: ', lstKids.value)
    console.log('com ID: ', id)
    try {
        const response = await axios.post(route('kid.store'), id);
        lstKids.value = response.data;
    } catch (error) {
        console.log(error.response.data.errors);
    }
};
</script>
