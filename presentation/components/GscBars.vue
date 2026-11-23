<!-- Search Console impressions per day, 2–21 Nov: "grohnpetrel" vs other searches (gh-pages data/gsc.csv) -->
<script setup>
import data from './chart-data.json'

const W = 560, L = 34, R = 4, TOP = 22, PH = 170, MAX = 250
const n = data.gsc.length
const bw = (W - L - R) / n
const y = v => TOP + PH - (PH * v) / MAX
const label = d => `${+d.split('-')[1]} Nov`
</script>

<template>
  <svg :viewBox="`0 0 ${W} ${TOP + PH + 26}`" class="w-full" font-family="Lato, sans-serif">
    <g v-for="t in [0, 50, 100, 150, 200, 250]" :key="t">
      <line :x1="L" :x2="W - R" :y1="y(t)" :y2="y(t)" stroke="#e3eaeb" stroke-width="0.7" />
      <text :x="L - 5" :y="y(t) + 3" style="font-size: 8px" fill="#5b6b6f" text-anchor="end">{{ t }}</text>
    </g>
    <text :transform="`translate(9, ${TOP + PH / 2}) rotate(-90)`" style="font-size: 7.5px" fill="#5b6b6f" text-anchor="middle">Impressions per day</text>
    <g v-for="([d, brand, other], i) in data.gsc" :key="d">
      <rect :x="L + i * bw + bw * 0.14" :y="y(brand)" :width="bw * 0.72" :height="y(0) - y(brand)" fill="#143f48" />
      <rect :x="L + i * bw + bw * 0.14" :y="y(brand + other)" :width="bw * 0.72" :height="y(0) - y(other)" fill="#a9d0d6" />
      <text v-if="i % 2 === 0" :x="L + i * bw + bw / 2" :y="TOP + PH + 11" style="font-size: 8px" fill="#5b6b6f" text-anchor="middle">{{ label(d) }}</text>
    </g>
    <rect :x="W - 150" y="2" width="8" height="8" fill="#a9d0d6" />
    <text :x="W - 138" y="9" style="font-size: 8px" fill="#1d2b2f">Other searches (mostly seabird topics)</text>
    <rect :x="W - 150" y="13" width="8" height="8" fill="#143f48" />
    <text :x="W - 138" y="20" style="font-size: 8px" fill="#1d2b2f">“grohnpetrel”</text>
    <text :x="W - R" :y="TOP + PH + 24" style="font-size: 7px" fill="#5b6b6f" text-anchor="end">Google Search Console, 02–21 Nov: 2,453 impressions, 50 clicks</text>
  </svg>
</template>
