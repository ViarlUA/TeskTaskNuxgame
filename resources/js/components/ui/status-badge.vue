<script setup lang="ts">
const props = defineProps<{
  status: 'success' | 'error' | 'warning' | 'info' | 'neutral';
  text: string;
  size?: 'sm' | 'md' | 'lg';
}>();

// Default values for props
const { size = 'sm' } = props;

// Map of status types to their corresponding classes
const statusClasses = {
  success: 'bg-success/20 text-white',
  error: 'bg-destructive/20 text-destructive',
  warning: 'bg-warning/20 text-warning',
  info: 'bg-info/20 text-info',
  neutral: 'bg-muted text-muted-foreground',
};

// Map of sizes to their corresponding classes
const sizeClasses = {
  sm: 'text-xs px-2 py-0.5',
  md: 'text-sm px-2 py-1',
  lg: 'text-xl px-3 py-1.5',
};
</script>

<template>
  <span 
    :class="[statusClasses[status], sizeClasses[size]]" 
    class="rounded-full font-medium"
  >
    {{ text }}
  </span>
</template>
