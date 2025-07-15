<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils';

import { ref, onMounted, defineProps, defineEmits, watch } from 'vue';
import IMask from 'imask';

const props = defineProps<{
    defaultValue?: string | number
    modelValue?: String | number
    class?: HTMLAttributes['class']
}>()

const emit = defineEmits<{
    (e: 'update:modelValue', payload: string | number): void
}>()

const inputRef = ref(null);
const localValue = ref(props.modelValue);

watch(() => props.modelValue, (val) => {
    if (val !== localValue.value) localValue.value = val;
});

watch(localValue, (val) => {
    emit('update:modelValue', val);
});

onMounted(() => {
    if (inputRef.value) {
        IMask(inputRef.value, {
            mask: '000.000.000-00'
        }).on('accept', function() {
            localValue.value = inputRef.value.value;
        });
    }
});
</script>

<template>
    <input
        id="cpf"
        ref="inputRef"
        :value="localValue"
        type="text"
        inputmode="numeric"
        maxlength="14"
        placeholder="000.000.000-00"
        :class="cn(
      'file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground bg-input/75 dark:bg-input/10 border-input flex h-9 w-full min-w-0 rounded-md border px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm',
      'focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]',
      'aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive',
      props.class,
    )"
    />
</template>
