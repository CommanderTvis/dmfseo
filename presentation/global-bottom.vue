<!-- Footer as in the PowerPoint: project line and page number; section dividers show only the number, the cover nothing -->
<template>
  <footer
    v-if="$slidev.nav.currentLayout !== 'cover'"
    class="abs-b w-full px-7 pb-3 flex justify-between text-[8.5px] opacity-70"
    :class="['section'].includes($slidev.nav.currentLayout) || $slidev.nav.currentSlideRoute?.meta?.slide?.frontmatter?.class === 'dark' ? 'text-white' : ''"
  >
    <span>{{ $slidev.nav.currentLayout === 'section' ? '' : 'Team Guillemots · DMFSEO Fall 2026' }}</span>
    <span>{{ $slidev.nav.currentPage }}</span>
  </footer>
</template>
