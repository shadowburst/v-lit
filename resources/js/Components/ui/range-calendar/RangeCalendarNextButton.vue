<script lang="ts" setup>
import { buttonVariants } from '@/Components/ui/button';
import { cn } from '@/utils';
import { ChevronRight } from 'lucide-vue-next';
import { RangeCalendarNext, type RangeCalendarNextProps, useForwardProps } from 'radix-vue';
import { computed, type HTMLAttributes } from 'vue';

const props = defineProps<RangeCalendarNextProps & { class?: HTMLAttributes['class'] }>();

const delegatedProps = computed(() => {
    const { class: _, ...delegated } = props;

    return delegated;
});

const forwardedProps = useForwardProps(delegatedProps);
</script>

<template>
    <RangeCalendarNext
        v-bind="forwardedProps"
        :class="
            cn(
                buttonVariants({ variant: 'outline' }),
                'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100',
                props.class
            )
        "
    >
        <slot>
            <ChevronRight class="h-4 w-4" />
        </slot>
    </RangeCalendarNext>
</template>
