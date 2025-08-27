<template>
    <Tabs default-value="overview" class="space-y-4">
        <TabsContent value="overview" class="space-y-4">
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <Card v-for="item in props.overviews" :key="item.name" class="bg-blue-950 text-white">
                    <CardHeader class="flex flex-row items-center justify-between space-y-0">
                        <CardTitle class="font-small text-sm"> {{ item.name }} </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="text-xl font-semibold">{{ item.data }}</div>
                    </CardContent>
                </Card>
            </div>
        </TabsContent>
    </Tabs>
</template>

<script setup lang="ts">
import { Tabs, TabsContent } from '@/components/ui/tabs';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

const props = defineProps({
    overviews: Object,
});
</script>
