<!-- Google rank (0 = no valid check that day) for the bare word "grohnpetrel", last check per day (tracker data from gh-pages data/results.csv) -->
<script setup>
import data from './chart-data.json'

const W = 640, L = 46, R = 8, PH = 92, GAP = 14, TOP = 4
const n = data.dates.length
const x = i => L + (i * (W - L - R)) / (n - 1)
const y = (p, r) => TOP + p * (PH + GAP) + 16 + ((r - 1) * (PH - 30)) / 9
const band = p => TOP + p * (PH + GAP) + PH - 8
const panels = [['de', 'Germany'], ['us', 'United States'], ['gb', 'United Kingdom']]
const H = TOP + 3 * (PH + GAP)
const label = d => { const [, m, day] = d.split('-'); return `${+day} ${m === '10' ? 'Oct' : 'Nov'}` }
const marks = [[data.dates.indexOf('2026-11-03'), 'German site live'], [data.dates.indexOf('2026-11-16'), 'one canonical page']]

function segments(rs) {
  const out = []
  let cur = []
  rs.forEach((r, i) => {
    if (!r) { if (cur.length) out.push(cur); cur = [] } else cur.push([i, r])
  })
  if (cur.length) out.push(cur)
  return out
}
</script>

<template>
  <svg :viewBox="`0 0 ${W} ${H + 18}`" class="w-full" font-family="Lato, sans-serif">
    <g v-for="([c, name], p) in panels" :key="c">
      <text :x="L" :y="TOP + p * (PH + GAP) + 9" style="font-size: 10px" font-weight="700" fill="#1d2b2f">{{ name }}</text>
      <rect :x="L" :y="band(p) - 4" :width="W - L - R" height="8" fill="#f3e6dd" />
      <g v-for="r in [1, 5, 10]" :key="r">
        <line :x1="L" :x2="W - R" :y1="y(p, r)" :y2="y(p, r)" stroke="#e3eaeb" stroke-width="0.7" />
        <text :x="L - 6" :y="y(p, r) + 3" style="font-size: 8px" fill="#5b6b6f" text-anchor="end">#{{ r }}</text>
      </g>
      <g v-for="[i, t] in marks" :key="t">
        <line :x1="x(i) - 0.5 * (W - L - R) / (n - 1)" :x2="x(i) - 0.5 * (W - L - R) / (n - 1)" :y1="TOP + p * (PH + GAP) + 12" :y2="band(p) + 4" stroke="#9cc6cc" stroke-dasharray="2 2" stroke-width="0.8" />
        <text v-if="p === 0" :x="x(i) - 0.5 * (W - L - R) / (n - 1) + 3" :y="y(0, 4)" style="font-size: 7.5px" fill="#5b6b6f">{{ t }}</text>
      </g>
      <polyline v-for="(s, k) in segments(data.ranks[c])" :key="k" fill="none" stroke="#143f48" stroke-width="1.4"
        :points="s.map(([i, r]) => `${x(i)},${y(p, r)}`).join(' ')" />
      <template v-for="(r, i) in data.ranks[c]" :key="i">
        <circle v-if="r === 0" :cx="x(i)" :cy="band(p)" r="2.4" fill="#d5dcdd" />
        <circle v-else-if="r == null" :cx="x(i)" :cy="band(p)" r="2.4" fill="#fff" stroke="#a9b8bb" stroke-width="0.8" />
        <circle v-else :cx="x(i)" :cy="y(p, r)" :r="r === 1 ? 3.6 : 2.4" :fill="r === 1 ? '#bf5f37' : '#143f48'" />
      </template>
    </g>
    <text v-for="(d, i) in data.dates" v-show="i % 2 === 0" :key="d" :x="x(i)" :y="H + 6" style="font-size: 8px" fill="#5b6b6f" text-anchor="middle">{{ label(d) }}</text>
    <text :x="W - R" :y="H + 16" style="font-size: 7.5px" fill="#5b6b6f" text-anchor="end">Pink band = not in the top 10 · grey = no data (Google auto-corrected the word) · orange = #1 · last valid check of each day · source: our tracker (Serper API, Google)</text>
  </svg>
</template>
