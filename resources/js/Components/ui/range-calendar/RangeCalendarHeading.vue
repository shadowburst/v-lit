<script lang="ts" setup>
import { cn } from '@/utils';
import { RangeCalendarHeading, type RangeCalendarHeadingProps, useForwardProps } from 'radix-vue';
import { computed, type HTMLAttributes } from 'vue';

const props = defineProps<RangeCalendarHeadingProps & { class?: HTMLAttributes['class'] }>();

const delegatedProps = computed(() => {
    const { class: _, ...delegated } = props;

    return delegated;
});

const forwardedProps = useForwardProps(delegatedProps);
</script>

<template>
    <RangeCalendarHeading
        v-slot="{ headingValue }"
        v-bind="forwardedProps"
        :class="cn('text-sm font-medium', props.class)"
    >
        <slot :heading-value>
            {{ headingValue }}
        </slot>
    </RangeCalendarHeading>
</template>
