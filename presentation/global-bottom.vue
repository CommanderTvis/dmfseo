<!-- Page number and project name on every slide except the cover and section dividers -->
<template>
  <footer
    v-if="!['cover', 'section'].includes($slidev.nav.currentLayout)"
    class="abs-b w-full px-8 pb-2 flex justify-between text-[11px] opacity-60"
  >
    <span>Grohnpetrel · Team Guillemots · DMFSEO Fall 2026</span>
    <span>{{ $slidev.nav.currentPage }} / {{ $slidev.nav.total }}</span>
  </footer>
</template>
