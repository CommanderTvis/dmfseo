<?php
/**
 * Grohnpetrel learning games (EN and DE), embedded in the pages whose topic they practise:
 *   choice   - "Take it, leave it or get help?" (plastic article) and "Wadden Sea: true or false?" (Wadden article)
 *   order    - "Line them up": the six guide birds from smallest to largest (seabird guide)
 *   memory   - photo and name pairs of the six birds (Knowledge Centre)
 *   glossary - "Which term is it?": definitions from the glossary on the same page (glossary)
 *
 * Progressive enhancement, like the Coastal Guardian Challenge: each page holds its game as normal HTML
 * (section.gp-game with the questions, answers, explanations and score bands), readable by search engines
 * and usable without JavaScript. This snippet turns that HTML into the game. Interface wording comes from
 * data-* attributes on the section, so one script serves both languages. Nothing is loaded from other
 * servers, nothing is stored (no cookies, no localStorage) and nothing is sent anywhere.
 * To remove the games, drop this snippet from pages/site.json: the pages fall back to the static HTML.
 */

add_action( 'wp_footer', function () {
	if ( ! is_singular() || false === strpos( (string) get_post_field( 'post_content', get_queried_object_id() ), 'gp-game' ) ) {
		return;
	}
	?>
<style id="gp-game-style">
.gp-game{margin:2.5rem 0}
.gp-game .sr-only{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap}
.gp-game.is-ready .gp-game__static{display:none}
.gp-game__static .gp-game__items>li{margin:0 0 .75rem}
.gp-game__static .gp-game__a{font-weight:700}
.gp-game__static .gp-game__items img{max-width:9rem;height:auto;display:block;margin:.3rem 0}
.gp-game__credits{color:var(--gp-muted);font-size:.8rem;line-height:1.5}
.gp-game__app{border-top:2px solid var(--gp-teal-dark);border-bottom:1px solid var(--gp-line);padding:clamp(1.1rem,3vw,1.75rem) 0;margin:1.25rem 0 0}
.gp-game__app :focus-visible{outline:2px solid var(--gp-focus,#B85A36);outline-offset:3px}
.gp-game__app h3{margin:.2rem 0 .7rem;font-size:clamp(1.2rem,2.6vw,1.55rem);line-height:1.3}
.gp-game__app h3:focus{outline:none}
.gp-game__facts{display:flex;flex-wrap:wrap;list-style:none;padding:0;margin:.4rem 0 1.25rem;color:var(--gp-muted);font-size:.875rem;font-weight:500}
.gp-game__facts li+li::before{content:"\00b7";margin:0 .6rem;color:var(--gp-line-strong)}
.gp-game__top{display:flex;justify-content:space-between;gap:1rem;font-size:.9rem;color:var(--gp-muted);font-weight:600}
.gp-game__bar{height:.4rem;border-radius:2px;background:var(--gp-foam);overflow:hidden;margin:.45rem 0 1.1rem}
.gp-game__bar span{display:block;height:100%;background:var(--gp-teal);border-radius:2px;transition:width .3s}
.gp-game__prompt{color:var(--gp-muted);font-weight:600;margin:0 0 .8rem}
.gp-game__opts{display:grid;grid-template-columns:repeat(auto-fit,minmax(11rem,1fr));gap:.5rem;margin:0 0 1rem;padding:0;border:0}
.gp-game__opts legend{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0)}
.gp-game__opt{font:inherit;font-size:1rem;text-align:left;min-height:48px;padding:.7rem .9rem;border:1px solid var(--gp-line-strong,#9fb3b0);border-radius:4px;background:#fff;color:var(--gp-ink,#14302f);cursor:pointer;transition:background .15s,border-color .15s;line-height:1.35}
.gp-game__opt:hover{background:var(--gp-foam);border-color:var(--gp-teal)}
.gp-game__opt[disabled]{cursor:default}
.gp-game__opt.is-wrong{background:#FBEFEA;border-color:#B5523A;color:#8E3B27}
.gp-game__opt.is-right{background:#EAF5EE;border-color:#2F7A55;color:#1F5C3E;font-weight:700}
.gp-game__opt.is-shake{animation:gpGameShake .35s}
@keyframes gpGameShake{25%{transform:translateX(-4px)}75%{transform:translateX(4px)}}
.gp-game__feedback{border-radius:4px;padding:1rem 1.15rem;margin:0 0 1rem;border-top:2px solid var(--gp-teal);background:var(--gp-foam)}
.gp-game__feedback.is-right{border-top-color:#2F7A55;background:#EAF5EE}
.gp-game__feedback.is-wrong{border-top-color:#B5523A;background:#FBEFEA}
.gp-game__feedback p{margin:.3rem 0}
.gp-game__feedback:focus{outline:none}
.gp-game__status{font-weight:700;font-size:1.05rem}
.gp-game__hint{min-height:1.4em;margin:.2rem 0 .7rem;color:#8E3B27;font-weight:600}
.gp-game__actions{display:flex;flex-wrap:wrap;gap:.7rem;align-items:center}
.gp-game__actions .wp-block-button__link{border:0;cursor:pointer;font:inherit;font-size:.9375rem;font-weight:600;min-height:44px}
.gp-game__actions .is-outline{background:transparent!important;color:var(--gp-teal-dark)!important;border:2px solid var(--gp-teal)!important}
.gp-game__score{font-family:var(--gp-serif);font-size:clamp(2.4rem,7vw,3.4rem);font-weight:500;color:var(--gp-teal);line-height:1;margin:.2rem 0}
.gp-game__review{list-style:none;padding:0;margin:1rem 0;display:grid}
.gp-game__review li{display:flex;justify-content:space-between;gap:1rem;padding:.55rem 0;border-top:1px solid var(--gp-line)}
.gp-game__review b{white-space:nowrap}
.gp-game__review .ok b{color:#1F5C3E}
.gp-game__review .no b{color:#8E3B27}
.gp-game__line{list-style:none;padding:0;margin:0 0 1rem;counter-reset:pos;min-height:2.5rem}
.gp-game__line li{counter-increment:pos;display:flex;gap:.85rem;align-items:baseline;padding:.55rem 0;border-top:1px solid var(--gp-line);animation:gpGameIn .3s ease-out}
.gp-game__line li::before{content:counter(pos);flex:0 0 1.4rem;font-family:var(--gp-serif);font-size:1.3rem;line-height:1;color:var(--gp-beak-ink,#9a4a2c)}
.gp-game__line small{color:var(--gp-muted);margin-left:auto;white-space:nowrap}
@keyframes gpGameIn{from{opacity:0;transform:translateY(4px)}to{opacity:1;transform:none}}
.gp-game__board{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:.55rem;margin:0 0 1rem}
.gp-game__card{position:relative;aspect-ratio:1;border:1px solid var(--gp-line-strong,#9fb3b0);border-radius:6px;padding:0;cursor:pointer;overflow:hidden;font:inherit;color:var(--gp-ink,#14302f);background:var(--gp-teal-dark,#123f46);transition:background .2s}
.gp-game__card::after{content:"";position:absolute;inset:18%;border:2px solid rgba(255,255,255,.18);border-radius:50%}
.gp-game__card.is-open,.gp-game__card.is-done{background:#fff;cursor:default}
.gp-game__card.is-open::after,.gp-game__card.is-done::after{display:none}
.gp-game__card.is-done{border-color:#2F7A55;box-shadow:inset 0 0 0 2px #2F7A55}
.gp-game__card img{width:100%;height:100%!important;object-fit:cover;display:block;margin:0}
.gp-game__card span{display:flex;align-items:center;justify-content:center;height:100%;padding:.4rem;font-weight:700;font-size:clamp(.78rem,2.2vw,1rem);line-height:1.2;text-align:center;hyphens:auto}
.gp-game__card .gp-game__face{display:none;height:100%}
.gp-game__card.is-open .gp-game__face,.gp-game__card.is-done .gp-game__face{display:block}
.gp-game__def{font-size:1.1rem;line-height:1.55;border-left:3px solid var(--gp-beak,#c4673f);padding:.2rem 0 .2rem 1rem;margin:0 0 1rem}
@media (prefers-reduced-motion:reduce){.gp-game__bar span,.gp-game__opt,.gp-game__card{transition:none}.gp-game__opt.is-shake,.gp-game__line li{animation:none}}
@media (max-width:600px){.gp-game__opts{grid-template-columns:1fr}.gp-game__actions .wp-block-button__link{width:100%;text-align:center}.gp-game__board{grid-template-columns:repeat(3,minmax(0,1fr))}}
</style>
<script id="gp-game-script">
(function () {
	var d = document;
	function txt(el) { return el ? el.textContent.replace(/\s+/g, ' ').trim() : ''; }
	function esc(s) { var x = d.createElement('div'); x.textContent = s; return x.innerHTML; }
	function fill(s, map) { return String(s || '').replace(/\{(\w+)\}/g, function (m, k) { return map[k] !== undefined ? map[k] : m; }); }
	function shuffle(a) { a = a.slice(); for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)), t = a[i]; a[i] = a[j]; a[j] = t; } return a; }
	function button(label, cls) { var b = d.createElement('button'); b.type = 'button'; b.className = 'wp-block-button__link wp-element-button' + (cls ? ' ' + cls : ''); b.textContent = label; return b; }

	function Game(root) {
		var ui = root.dataset, app = d.createElement('div'), live = d.createElement('div');
		app.className = 'gp-game__app'; live.className = 'sr-only'; live.setAttribute('aria-live', 'polite');
		var bands = [].slice.call(root.querySelectorAll('.gp-game__ranks li')).map(function (li) {
			return { min: li.hasAttribute('data-min') ? +li.getAttribute('data-min') : null, max: li.hasAttribute('data-max') ? +li.getAttribute('data-max') : null,
				title: txt(li.querySelector('strong')).replace(/^[^:]*:\s*/, '').replace(/\.$/, ''), text: txt(li.querySelector('span')) };
		});
		var g = {
			root: root, ui: ui, app: app,
			mount: function () { root.insertBefore(app, root.querySelector('.gp-game__credits')); root.appendChild(live); root.classList.add('is-ready'); },
			say: function (s) { live.textContent = s; },
			band: function (v) {
				var hit = bands.filter(function (b) { return b.max !== null ? v <= b.max : v >= b.min; });
				if (bands.length && bands[0].min !== null) { hit.sort(function (a, b) { return b.min - a.min; }); }
				else { hit.sort(function (a, b) { return a.max - b.max; }); }
				return hit[0] || { title: '', text: '' };
			},
			focus: function () { var h = app.querySelector('h3'); if (h) { h.setAttribute('tabindex', '-1'); h.focus({ preventScroll: true }); } },
			top: function () {
				var head = d.querySelector('header.wp-block-template-part'), idx = d.querySelector('.gp-species-index');
				var off = (head ? head.offsetHeight : 0) + (idx && getComputedStyle(idx).position === 'sticky' ? idx.offsetHeight : 0) + 16;
				var y = app.getBoundingClientRect().top + pageYOffset - off;
				if (Math.abs(pageYOffset - y) > 40) { scrollTo(0, y); }
			},
			into: function (el) { var r = el.getBoundingClientRect(); if (r.bottom > innerHeight) { scrollBy(0, Math.min(r.bottom - innerHeight + 90, r.top - 140)); } },
			start: function (go) {
				app.innerHTML = '<h3>' + esc(ui.startTitle) + '</h3><ul class="gp-game__facts">' +
					[ui.fact1, ui.fact2, ui.fact3].filter(Boolean).map(function (f) { return '<li>' + esc(f) + '</li>'; }).join('') + '</ul><div class="gp-game__actions"></div>';
				var b = button(ui.start); b.addEventListener('click', function () { go(); });
				app.querySelector('.gp-game__actions').appendChild(b);
			},
			ending: function (scoreHtml, band, line, review, again) {
				app.innerHTML = '<p class="gp-game__score" aria-hidden="true">' + scoreHtml + '</p><h3>' + esc(band.title || line) + '</h3>' +
					'<p><strong>' + esc(line) + '</strong> ' + esc(band.text) + '</p>' + (review ? '<ul class="gp-game__review">' + review + '</ul>' : '') + '<div class="gp-game__actions"></div>';
				var acts = app.querySelector('.gp-game__actions'), b = button(ui.again);
				b.addEventListener('click', again); acts.appendChild(b);
				if (ui.moreHref) { var a = d.createElement('a'); a.className = 'wp-block-button__link wp-element-button is-outline'; a.href = ui.moreHref; a.textContent = ui.moreLabel; acts.appendChild(a); }
				g.say(line + ' ' + (band.title || '')); g.top(); g.focus();
			}
		};
		return g;
	}

	/* A sequence of questions, each answered with one of a few buttons, then explained. */
	function quiz(g, items, total) {
		var ui = g.ui, st;
		function run() { st = { list: shuffle(items).slice(0, total || items.length), i: 0, score: 0, log: [] }; ask(); }
		function ask() {
			var it = st.list[st.i], n = st.list.length;
			g.app.innerHTML = '<div class="gp-game__top"><span>' + esc(fill(ui.progress, { i: st.i + 1, n: n })) + '</span><span>' + esc(fill(ui.scoreSoFar, { s: st.score, n: n })) + '</span></div>' +
				'<div class="gp-game__bar" aria-hidden="true"><span style="width:' + (st.i / n * 100) + '%"></span></div>' +
				(it.def ? '<h3>' + esc(ui.prompt) + '</h3><p class="gp-game__def">' + esc(it.def) + '</p>' : '<h3>' + esc(it.q) + '</h3><p class="gp-game__prompt">' + esc(ui.prompt) + '</p>') +
				'<fieldset class="gp-game__opts"><legend>' + esc(ui.prompt) + '</legend>' +
				it.opts.map(function (o, k) { return '<button type="button" class="gp-game__opt" data-k="' + k + '">' + esc(o.label) + '</button>'; }).join('') + '</fieldset>' +
				'<div class="gp-game__slot"></div><div class="gp-game__actions"></div>';
			[].forEach.call(g.app.querySelectorAll('.gp-game__opt'), function (b) { b.addEventListener('click', function () { answer(it, +b.getAttribute('data-k')); }); });
			g.top(); g.focus();
		}
		function answer(it, k) {
			if (st.done === st.i) { return; } st.done = st.i;
			var ok = it.opts[k].key === it.key, right = it.opts.filter(function (o) { return o.key === it.key; })[0];
			if (ok) { st.score += 1; }
			st.log.push({ q: it.q || it.answerLabel, ok: ok });
			[].forEach.call(g.app.querySelectorAll('.gp-game__opt'), function (b) {
				var o = it.opts[+b.getAttribute('data-k')]; b.disabled = true;
				if (o.key === it.key) { b.classList.add('is-right'); } else if (+b.getAttribute('data-k') === k) { b.classList.add('is-wrong'); }
			});
			var fb = d.createElement('div'); fb.className = 'gp-game__feedback ' + (ok ? 'is-right' : 'is-wrong'); fb.setAttribute('tabindex', '-1');
			fb.innerHTML = '<p class="gp-game__status">' + esc(ok ? ui.right : ui.wrong) + ' ' + esc(fill(ui.answerIs, { a: right.label })) + '</p>' + (it.why ? '<p>' + it.why + '</p>' : '');
			g.app.querySelector('.gp-game__slot').appendChild(fb);
			var bar = g.app.querySelector('.gp-game__bar span'); bar.style.width = ((st.i + 1) / st.list.length * 100) + '%';
			g.app.querySelector('.gp-game__top span:last-child').textContent = fill(ui.scoreSoFar, { s: st.score, n: st.list.length });
			var last = st.i === st.list.length - 1, nx = button(last ? ui.results : ui.next);
			nx.addEventListener('click', function () { if (last) { end(); } else { st.i += 1; ask(); } });
			g.app.querySelector('.gp-game__actions').appendChild(nx);
			g.say((ok ? ui.right : ui.wrong) + ' ' + fill(ui.answerIs, { a: right.label }));
			fb.focus({ preventScroll: true }); g.into(nx);
		}
		function end() {
			var n = st.list.length, review = st.log.map(function (l) { return '<li class="' + (l.ok ? 'ok' : 'no') + '"><span>' + esc(l.q) + '</span><b>' + esc(l.ok ? ui.markRight : ui.markWrong) + '</b></li>'; }).join('');
			g.ending(st.score + '/' + n, g.band(st.score), fill(ui.final, { s: st.score, n: n }), review, run);
		}
		g.mount(); g.start(run);
	}

	var kinds = {
		choice: function (g) {
			var root = g.root, bins = [].slice.call(root.querySelectorAll('.gp-game__bins li')).map(function (li) { return { key: li.getAttribute('data-key'), label: txt(li) }; });
			var items = [].slice.call(root.querySelectorAll('.gp-game__items > li')).map(function (li) {
				var why = li.querySelector('.gp-game__why');
				return { q: txt(li.querySelector('.gp-game__q')), key: li.getAttribute('data-key'), why: why ? why.innerHTML.trim() : '', opts: bins };
			});
			if (bins.length < 2 || items.length < 3) { return; }
			quiz(g, items);
		},
		glossary: function (g) {
			var root = g.root, scope = root.closest('.wp-block-post-content') || d.body, terms = [], cat = '';
			[].forEach.call(scope.querySelectorAll('h2, h3'), function (h) {
				if (root.contains(h)) { return; }
				if (h.tagName === 'H2') { cat = txt(h); return; }
				var p = h.nextElementSibling; if (!p || p.tagName !== 'P') { return; }
				var c = p.cloneNode(true), lastA = c.lastElementChild;
				if (lastA && lastA.tagName === 'A' && !/\S/.test((lastA.nextSibling && lastA.nextSibling.textContent || '').replace('.', ''))) { lastA.remove(); } // the "see also" link at the end
				var term = txt(h), def = txt(c).replace(/\s*\.\s*\.\s*$/, '.').replace(/\s+\.$/, '.');
				var core = term.replace(/\s*\(.*\)\s*/, '').trim();
				[term, core].forEach(function (w) { if (w.length > 2) { def = def.split(new RegExp(w.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'gi')).join('…'); } });
				if (def.length > 25) { terms.push({ term: term, def: def, cat: cat }); }
			});
			if (terms.length < 8) { return; }
			var items = terms.map(function (t) {
				var same = terms.filter(function (o) { return o !== t && o.cat === t.cat; }), other = terms.filter(function (o) { return o !== t && o.cat !== t.cat; });
				var pick = shuffle(same).slice(0, 3); pick = pick.concat(shuffle(other).slice(0, 3 - pick.length));
				return { def: t.def, answerLabel: t.term, key: t.term, why: '', opts: shuffle(pick.concat([t]).map(function (o) { return { key: o.term, label: o.term }; })) };
			});
			quiz(g, items, +(g.ui.count || 8));
		},
		order: function (g) {
			var ui = g.ui, root = g.root, items = [].slice.call(root.querySelectorAll('.gp-game__items > li')).map(function (li, i) {
				return { rank: i, name: txt(li.querySelector('.gp-game__q')), note: txt(li.querySelector('.gp-game__why')) };
			}), st;
			if (items.length < 4) { return; }
			function run() {
				st = { next: 0, miss: 0 };
				g.app.innerHTML = '<div class="gp-game__top"><span>' + esc(fill(ui.progress, { i: 0, n: items.length })) + '</span><span>' + esc(fill(ui.missLabel, { m: 0 })) + '</span></div>' +
					'<h3>' + esc(ui.prompt) + '</h3><ol class="gp-game__line" aria-label="' + esc(ui.lineLabel) + '"></ol>' +
					'<fieldset class="gp-game__opts"><legend>' + esc(ui.prompt) + '</legend>' +
					shuffle(items).map(function (it) { return '<button type="button" class="gp-game__opt" data-r="' + it.rank + '">' + esc(it.name) + '</button>'; }).join('') + '</fieldset>' +
					'<p class="gp-game__hint" role="status"></p><div class="gp-game__actions"></div>';
				[].forEach.call(g.app.querySelectorAll('.gp-game__opt'), function (b) { b.addEventListener('click', function () { tap(b); }); });
				g.top(); g.focus();
			}
			function tap(b) {
				var r = +b.getAttribute('data-r'), it = items[r], hint = g.app.querySelector('.gp-game__hint');
				if (r !== st.next) {
					st.miss += 1; b.classList.remove('is-shake'); void b.offsetWidth; b.classList.add('is-shake');
					hint.textContent = fill(ui.notYet, { name: it.name });
					g.app.querySelector('.gp-game__top span:last-child').textContent = fill(ui.missLabel, { m: st.miss });
					g.say(hint.textContent); return;
				}
				b.disabled = true; b.style.display = 'none'; hint.textContent = '';
				var li = d.createElement('li'); li.innerHTML = esc(it.name) + ' <small>' + esc(it.note) + '</small>';
				g.app.querySelector('.gp-game__line').appendChild(li); st.next += 1;
				g.app.querySelector('.gp-game__top span').textContent = fill(ui.progress, { i: st.next, n: items.length });
				g.say(it.name + ', ' + it.note);
				if (st.next === items.length) { setTimeout(end, 500); }
			}
			function end() {
				var review = items.map(function (it) { return '<li><span>' + esc(it.name) + '</span><b>' + esc(it.note) + '</b></li>'; }).join('');
				g.ending(String(st.miss), g.band(st.miss), fill(st.miss === 1 ? ui.finalOne : ui.final, { m: st.miss }), review, run);
			}
			g.mount(); g.start(run);
		},
		memory: function (g) {
			var ui = g.ui, root = g.root, pairs = [].slice.call(root.querySelectorAll('.gp-game__items > li')).map(function (li, i) {
				var img = li.querySelector('img');
				return { k: i, name: txt(li.querySelector('.gp-game__q')), src: img ? (img.currentSrc || img.src) : '', alt: img ? img.alt : '' };
			}), st;
			if (pairs.length < 4 || pairs.some(function (p) { return !p.src; })) { return; }
			function run() {
				var cards = [];
				pairs.forEach(function (p) { cards.push({ k: p.k, type: 'photo', p: p }); cards.push({ k: p.k, type: 'name', p: p }); });
				st = { cards: shuffle(cards), open: [], moves: 0, found: 0, busy: false };
				g.app.innerHTML = '<div class="gp-game__top"><span class="gp-game__pairs">' + esc(fill(ui.pairs, { p: 0, n: pairs.length })) + '</span><span class="gp-game__moves">' + esc(fill(ui.moves, { m: 0 })) + '</span></div>' +
					'<h3>' + esc(ui.prompt) + '</h3><div class="gp-game__board">' + st.cards.map(function (c, i) {
						var face = c.type === 'photo' ? '<img src="' + esc(c.p.src) + '" alt="' + esc(c.p.alt) + '" decoding="async">' : '<span>' + esc(c.p.name) + '</span>';
						return '<button type="button" class="gp-game__card" data-i="' + i + '" aria-label="' + esc(fill(ui.cardHidden, { n: i + 1 })) + '"><span class="gp-game__face">' + face + '</span></button>';
					}).join('') + '</div><p class="gp-game__hint" role="status"></p>';
				[].forEach.call(g.app.querySelectorAll('.gp-game__card'), function (b) { b.addEventListener('click', function () { flip(b); }); });
				g.top(); g.focus();
			}
			function label(b, c) { b.setAttribute('aria-label', fill(c.type === 'photo' ? ui.cardPhoto : ui.cardName, { n: +b.getAttribute('data-i') + 1, name: c.p.name })); }
			function flip(b) {
				var c = st.cards[+b.getAttribute('data-i')];
				if (st.busy || b.classList.contains('is-open') || b.classList.contains('is-done')) { return; }
				b.classList.add('is-open'); label(b, c); st.open.push(b);
				if (st.open.length < 2) { g.say(b.getAttribute('aria-label')); return; }
				st.moves += 1; g.app.querySelector('.gp-game__moves').textContent = fill(ui.moves, { m: st.moves });
				var a = st.open[0], ca = st.cards[+a.getAttribute('data-i')];
				if (ca.k === c.k) {
					[a, b].forEach(function (x) { x.classList.remove('is-open'); x.classList.add('is-done'); x.disabled = true; });
					st.open = []; st.found += 1;
					g.app.querySelector('.gp-game__pairs').textContent = fill(ui.pairs, { p: st.found, n: pairs.length });
					g.app.querySelector('.gp-game__hint').textContent = fill(ui.match, { name: c.p.name });
					g.say(fill(ui.match, { name: c.p.name }));
					if (st.found === pairs.length) { setTimeout(end, 700); }
				} else {
					st.busy = true; g.say(b.getAttribute('aria-label') + '. ' + ui.noMatch);
					setTimeout(function () { [a, b].forEach(function (x) { x.classList.remove('is-open'); x.setAttribute('aria-label', fill(ui.cardHidden, { n: +x.getAttribute('data-i') + 1 })); }); st.open = []; st.busy = false; }, 1100);
				}
			}
			function end() { g.ending(String(st.moves), g.band(st.moves), fill(ui.final, { m: st.moves, n: pairs.length }), '', run); }
			g.mount(); g.start(run);
		}
	};

	[].forEach.call(d.querySelectorAll('section.gp-game[data-game]'), function (root) {
		var k = kinds[root.getAttribute('data-game')];
		if (k) { try { k(Game(root)); } catch (e) { root.classList.remove('is-ready'); } }
	});
}());
</script>
	<?php
}, 30 );
