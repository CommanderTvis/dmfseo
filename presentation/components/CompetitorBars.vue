<!-- Country-days in the Google top 10 / top 3 / #1 for the bare word, 72 country-days (24 days × DE, US, UK), last check per day.
     Counts from gh-pages data/results.csv; team names from the tracker. -->
<script setup>
const rows = [
  { name: 'Guillemots (us)', top10: 42, top3: 26, first: 13, us: true },
  { name: 'Fulmars', top10: 41, top3: 32, first: 18 },
  { name: 'Puffins', top10: 28, top3: 23, first: 15 },
  { name: 'Skuas', top10: 14, top3: 7, first: 5 },
  { name: 'Terns', top10: 6, top3: 1, first: 0 },
]
const W = 520, L = 86, R = 4, RH = 30, TOP = 4
const sx = v => ((W - L - R) * v) / 72
const H = TOP + rows.length * RH
</script>

<template>
  <svg :viewBox="`0 0 ${W} ${H + 34}`" class="w-full" font-family="Lato, sans-serif">
    <g v-for="t in [0, 10, 20, 30, 40, 50, 60, 70]" :key="t">
      <line :x1="L + sx(t)" :x2="L + sx(t)" :y1="TOP" :y2="H" stroke="#e3eaeb" stroke-width="0.7" />
      <text :x="L + sx(t)" :y="H + 10" style="font-size: 8px" fill="#5b6b6f" text-anchor="middle">{{ t }}</text>
    </g>
    <g v-for="(r, i) in rows" :key="r.name" :transform="`translate(0, ${TOP + i * RH})`">
      <text :x="L - 6" y="15" style="font-size: 8.5px" text-anchor="end" :font-weight="r.us ? 700 : 400" :fill="r.us ? '#1d2b2f' : '#5b6b6f'">{{ r.name }}</text>
      <rect :x="L" y="4" :width="sx(r.top10)" height="18" :fill="r.us ? '#a9d0d6' : '#d6e6e8'" />
      <rect :x="L" y="4" :width="sx(r.top3)" height="18" :fill="r.us ? '#2f8a94' : '#7fa9b0'" />
      <rect :x="L" y="4" :width="sx(r.first)" height="18" :fill="r.us ? '#bf5f37' : '#2c5f69'" />
      <text :x="L + sx(r.top10) + 5" y="16" style="font-size: 7.5px" :font-weight="r.us ? 700 : 400" fill="#1d2b2f">{{ r.top10 }} top 10 · {{ r.top3 }} top 3 · {{ r.first }} × #1</text>
    </g>
    <text :x="L + sx(36)" :y="H + 21" style="font-size: 7.5px" fill="#5b6b6f" text-anchor="middle">Country-days out of 72 (24 days × DE, US, UK, 31 Oct – 23 Nov, last check per day, bare query “grohnpetrel”)</text>
    <text :x="W - R" :y="H + 30" style="font-size: 7px" fill="#5b6b6f" text-anchor="end">Darkest = #1 · middle = top 3 · lightest = top 10 · source: our tracker</text>
  </svg>
</template>
