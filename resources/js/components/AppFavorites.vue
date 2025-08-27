<template>
    <Table>
        <TableHeader>
            <TableRow>
                <TableHead class="w-[100px]">
                    Nº Processo
                </TableHead>
                <TableHead>Nome</TableHead>
                <TableHead>CPF</TableHead>
                <TableHead>Situação</TableHead>
                <TableHead>Última atualização</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow>
                <TableCell>00123.456789/1010-11</TableCell>
                <TableCell>Fulano da Silva Sauro</TableCell>
                <TableCell>012.345.678-90</TableCell>
                <TableCell>
                    <Badge variant="default">Digitalizado</Badge>
                </TableCell>
                <TableCell>26/08/2025</TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>

<script setup lang="ts">
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow
} from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';
</script>
