<script lang="ts" setup>
import { cn } from '@/utils';
import { CalendarHeader, type CalendarHeaderProps, useForwardProps } from 'radix-vue';
import { computed, type HTMLAttributes } from 'vue';

const props = defineProps<CalendarHeaderProps & { class?: HTMLAttributes['class'] }>();

const delegatedProps = computed(() => {
    const { class: _, ...delegated } = props;

    return delegated;
});

const forwardedProps = useForwardProps(delegatedProps);
</script>

<template>
    <CalendarHeader
        v-bind="forwardedProps"
        :class="cn('relative flex w-full items-center justify-between pt-1', props.class)"
    >
        <slot />
    </CalendarHeader>
</template>
