<template>
    <Label for="name">CPF</Label>
    <div class="flex grid-cols-5 items-center gap-1.5">
        XXX .
        <PinInput id="pin-input" v-model="cpf1" placeholder="o" @complete="handleComplete">
            <PinInputGroup>
                <PinInputSlot v-for="(id, index) in 3" :key="id" :index="index" />
            </PinInputGroup>
        </PinInput>
        .
        <PinInput id="pin-input2" v-model="cpf2" placeholder="o" @complete="handleComplete">
            <PinInputGroup>
                <PinInputSlot v-for="(id, index) in 3" :key="id" :index="index" />
            </PinInputGroup>
        </PinInput>
        . XXX

    </div>
</template>