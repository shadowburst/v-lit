<script setup lang="ts">
import { cn } from '@/utils';
import { SelectGroup, type SelectGroupProps } from 'radix-vue';
import { computed, type HTMLAttributes } from 'vue';

const props = defineProps<SelectGroupProps & { class?: HTMLAttributes['class'] }>();

const delegatedProps = computed(() => {
    const { class: _, ...delegated } = props;

    return delegated;
});
</script>

<template>
    <SelectGroup v-bind="delegatedProps" :class="cn('w-full p-1', props.class)">
        <slot />
    </SelectGroup>
</template>
