<script setup lang="ts">
import Separator from '@/Components/ui/separator/Separator.vue';
import { cn } from '@/utils';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <Separator data-sidebar="separator" :class="cn('bg-sidebar-border mx-2 w-auto', props.class)">
        <slot />
    </Separator>
</template>
