<script lang="ts" setup>
import { buttonVariants } from '@/Components/ui/button';
import { cn } from '@/utils';
import { ChevronLeft } from 'lucide-vue-next';
import { RangeCalendarPrev, type RangeCalendarPrevProps, useForwardProps } from 'radix-vue';
import { computed, type HTMLAttributes } from 'vue';

const props = defineProps<RangeCalendarPrevProps & { class?: HTMLAttributes['class'] }>();

const delegatedProps = computed(() => {
    const { class: _, ...delegated } = props;

    return delegated;
});

const forwardedProps = useForwardProps(delegatedProps);
</script>

<template>
    <RangeCalendarPrev
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
            <ChevronLeft class="h-4 w-4" />
        </slot>
    </RangeCalendarPrev>
</template>
