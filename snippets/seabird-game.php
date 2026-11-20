<?php
/**
 * "Which seabird am I?": a six-round clue game on the seabird guide (EN and DE).
 *
 * Progressive enhancement, like the Coastal Guardian Challenge: the page itself contains the
 * heading, rules, all clues, answers and score bands as normal HTML (section.gp-sbg), so the game
 * is readable by search engines and works without JavaScript. This snippet turns that HTML into the
 * interactive game. Interface wording comes from data-* attributes on the section, so one script
 * serves both languages. Photos are the ones already on the page (the species plates); nothing is
 * loaded from other servers, nothing is stored (no cookies, no localStorage) and nothing is sent.
 * To remove the game, drop this snippet from pages/site.json: the page falls back to the static list.
 */

add_action( 'wp_footer', function () {
	if ( ! is_page( array( 'seabirds-of-the-north-sea', 'seevoegel-der-nordsee' ) ) ) {
		return;
	}
	?>
<style id="gp-sbg-style">
.gp-sbg{margin:2.5rem 0}
.gp-sbg .sr-only{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap}
.gp-sbg__rounds{padding-left:1.4rem}
.gp-sbg__rounds>li{margin:0 0 1rem}
.gp-sbg__clues{list-style:none;padding:0;margin:.2rem 0 .3rem}
.gp-sbg__clues li::before{content:"\2022\00a0";color:var(--gp-beak-ink,#9a4a2c)}
.gp-sbg__ranks{padding-left:1.2rem}
.gp-sbg.is-ready .gp-sbg__static{display:none}
.gp-sbg__app{border-top:2px solid var(--gp-teal-dark);border-bottom:1px solid var(--gp-line);padding:clamp(1.1rem,3vw,1.75rem) 0;margin:1.25rem 0 0}
.gp-sbg__app :focus-visible{outline:2px solid var(--gp-focus,#B85A36);outline-offset:3px}
.gp-sbg__app h3{margin:.2rem 0 .7rem;font-size:clamp(1.25rem,2.6vw,1.6rem)}
.gp-sbg__app h3:focus{outline:none}
.gp-sbg__facts{display:flex;flex-wrap:wrap;list-style:none;padding:0;margin:.4rem 0 1.25rem;color:var(--gp-muted);font-size:.875rem;font-weight:500}
.gp-sbg__facts li+li::before{content:"\00b7";margin:0 .6rem;color:var(--gp-line-strong)}
.gp-sbg__top{display:flex;justify-content:space-between;gap:1rem;font-size:.9rem;color:var(--gp-muted);font-weight:600}
.gp-sbg__bar{height:.4rem;border-radius:2px;background:var(--gp-foam);overflow:hidden;margin:.45rem 0 1.1rem}
.gp-sbg__bar span{display:block;height:100%;background:var(--gp-teal);border-radius:2px;transition:width .3s}
.gp-sbg__cluelist{list-style:none;padding:0;margin:0 0 1rem;counter-reset:clue}
.gp-sbg__cluelist li{counter-increment:clue;display:flex;gap:.85rem;align-items:baseline;padding:.7rem 0;border-top:1px solid var(--gp-line);line-height:1.5}
.gp-sbg__cluelist li::before{content:counter(clue);flex:0 0 1.4rem;font-family:var(--gp-serif);font-size:1.35rem;line-height:1;color:var(--gp-beak-ink,#9a4a2c)}
.gp-sbg__cluelist li.is-locked{color:var(--gp-muted);font-style:italic}
.gp-sbg__cluelist li.is-locked::before{color:var(--gp-line-strong,#9fb3b0)}
.gp-sbg__cluelist li.is-new{animation:gpSbgIn .35s ease-out}
@keyframes gpSbgIn{from{opacity:0;transform:translateY(4px)}to{opacity:1;transform:none}}
.gp-sbg__worth{font-weight:700;color:var(--gp-teal-dark);margin:.2rem 0 .8rem}
.gp-sbg__opts{display:grid;grid-template-columns:repeat(auto-fill,minmax(13rem,1fr));gap:.5rem;margin:0 0 1rem;padding:0;border:0}
.gp-sbg__opts legend{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0)}
.gp-sbg__opt{font:inherit;font-size:1rem;text-align:left;min-height:48px;padding:.7rem .9rem;border:1px solid var(--gp-line-strong,#9fb3b0);border-radius:4px;background:#fff;color:var(--gp-ink,#14302f);cursor:pointer;transition:background .15s,border-color .15s}
.gp-sbg__opt:hover{background:var(--gp-foam);border-color:var(--gp-teal)}
.gp-sbg__opt[disabled]{cursor:default}
.gp-sbg__opt.is-wrong{background:#FBEFEA;border-color:#B5523A;color:#8E3B27;text-decoration:line-through}
.gp-sbg__opt.is-right{background:#EAF5EE;border-color:#2F7A55;color:#1F5C3E;font-weight:700}
.gp-sbg__hint{min-height:1.4em;margin:.2rem 0 .7rem;color:#8E3B27;font-weight:600}
.gp-sbg__reveal{display:grid;grid-template-columns:minmax(0,9rem) 1fr;gap:1rem;align-items:center;border-top:2px solid #2F7A55;background:#EAF5EE;border-radius:4px;padding:1rem;margin:0 0 1rem}
.gp-sbg__reveal.is-zero{border-top-color:var(--gp-teal);background:var(--gp-foam)}
.gp-sbg__reveal img{width:100%;height:auto!important;max-height:none;aspect-ratio:4/3;object-fit:cover;border-radius:3px;display:block;margin:0}
.gp-sbg__reveal p{margin:.25rem 0}
.gp-sbg__reveal:focus{outline:none}
.gp-sbg__gain{font-weight:700;font-size:1.05rem}
.gp-sbg__actions{display:flex;flex-wrap:wrap;gap:.7rem;align-items:center}
.gp-sbg__actions .wp-block-button__link{border:0;cursor:pointer;font:inherit;font-size:.9375rem;font-weight:600;min-height:44px}
.gp-sbg__actions .is-outline{background:transparent!important;color:var(--gp-teal-dark)!important;border:2px solid var(--gp-teal)!important}
.gp-sbg__score{font-family:var(--gp-serif);font-size:clamp(2.6rem,7vw,3.6rem);font-weight:500;color:var(--gp-teal);line-height:1;margin:.2rem 0}
.gp-sbg__review{list-style:none;padding:0;margin:1rem 0;display:grid;gap:0}
.gp-sbg__review li{display:flex;justify-content:space-between;gap:1rem;padding:.55rem 0;border-top:1px solid var(--gp-line)}
.gp-sbg__review b{font-variant-numeric:tabular-nums;white-space:nowrap}
.gp-sbg__note{color:var(--gp-muted);font-size:.9rem;min-height:1.3em}
@media (prefers-reduced-motion:reduce){.gp-sbg__bar span,.gp-sbg__opt{transition:none}.gp-sbg__cluelist li.is-new{animation:none}}
@media (max-width:600px){.gp-sbg__opts{grid-template-columns:1fr 1fr}.gp-sbg__opt{font-size:.95rem;padding:.6rem .7rem}.gp-sbg__reveal{grid-template-columns:1fr}.gp-sbg__reveal img{max-width:16rem}.gp-sbg__actions .wp-block-button__link{width:100%;text-align:center}}
</style>
<script id="gp-sbg-script">
(function () {
	var root = document.querySelector('section.gp-sbg');
	if (!root) { return; }
	var ui = root.dataset;
	function txt(el) { return el ? el.textContent.trim() : ''; }
	function fill(s, map) { return String(s || '').replace(/\{(\w+)\}/g, function (m, k) { return map[k] !== undefined ? map[k] : m; }); }
	function esc(s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }

	// Read the birds, clues and score bands from the page's own HTML (single source of truth).
	var birds = [].slice.call(root.querySelectorAll('.gp-sbg__rounds > li')).map(function (li) {
		var a = li.querySelector('.gp-sbg__answer a');
		return {
			clues: [].slice.call(li.querySelectorAll('.gp-sbg__clues li')).map(txt),
			name: txt(a), href: a ? a.getAttribute('href') : '#',
			latin: txt(li.querySelector('.gp-sbg__answer em'))
		};
	});
	var bands = [].slice.call(root.querySelectorAll('.gp-sbg__ranks li[data-min]')).map(function (li) {
		return { min: +li.getAttribute('data-min'), title: txt(li.querySelector('strong')).replace(/^[^:]*:\s*/, '').replace(/\.$/, ''), text: txt(li.querySelector('span')) };
	}).sort(function (a, b) { return b.min - a.min; });
	if (birds.length !== 6 || !bands.length || birds.some(function (b) { return b.clues.length !== 3 || !b.name; })) { return; } // keep the static version
	var MAX = birds.length * 3;

	// The photo of each bird is the one on its species plate further up the page.
	function photo(b) {
		var link = document.querySelector('.gp-species h3 a[href="' + b.href + '"]');
		var img = link && link.closest('.gp-species') && link.closest('.gp-species').querySelector('img');
		if (!img) { return ''; }
		var c = document.createElement('img');
		c.src = img.currentSrc || img.src; c.alt = img.alt; c.loading = 'lazy'; c.decoding = 'async';
		if (img.getAttribute('width')) { c.width = img.getAttribute('width'); c.height = img.getAttribute('height'); }
		return c.outerHTML;
	}

	var app = document.createElement('div');
	app.className = 'gp-sbg__app';
	var live = document.createElement('div');
	live.className = 'sr-only'; live.setAttribute('aria-live', 'polite');
	root.appendChild(app); root.appendChild(live);
	root.classList.add('is-ready');

	var state;
	function shuffle(a) { a = a.slice(); for (var i = a.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)), t = a[i]; a[i] = a[j]; a[j] = t; } return a; }
	function button(label, cls) {
		var b = document.createElement('button');
		b.type = 'button'; b.className = 'wp-block-button__link wp-element-button' + (cls ? ' ' + cls : ''); b.textContent = label;
		return b;
	}
	function focusHeading() { var h = app.querySelector('h3'); if (h) { h.setAttribute('tabindex', '-1'); h.focus({ preventScroll: true }); } }
	function scrollTop() {
		var head = document.querySelector('header.wp-block-template-part'), idx = document.querySelector('.gp-species-index');
		var off = (head ? head.offsetHeight : 0) + (idx && getComputedStyle(idx).position === 'sticky' ? idx.offsetHeight : 0) + 16;
		var y = app.getBoundingClientRect().top + window.pageYOffset - off;
		if (Math.abs(window.pageYOffset - y) > 40) { window.scrollTo(0, y); }
	}
	function worth() { return state.points; }

	function renderStart(withFocus) {
		state = { order: shuffle(birds), index: 0, score: 0, got: [] };
		app.innerHTML = '<h3>' + esc(ui.startTitle) + '</h3>' +
			'<ul class="gp-sbg__facts"><li>' + esc(ui.fact1) + '</li><li>' + esc(ui.fact2) + '</li><li>' + esc(ui.fact3) + '</li></ul>' +
			'<div class="gp-sbg__actions"></div>';
		var start = button(ui.start);
		start.addEventListener('click', function () { renderRound(); });
		app.querySelector('.gp-sbg__actions').appendChild(start);
		if (withFocus) { focusHeading(); }
	}

	function renderRound() {
		var b = state.order[state.index], n = state.index + 1;
		state.shown = 1; state.points = 3; state.done = false;
		var opts = birds.map(function (o, i) { return '<button type="button" class="gp-sbg__opt" data-i="' + i + '">' + esc(o.name) + '</button>'; }).join('');
		app.innerHTML = '<div class="gp-sbg__top"><span>' + esc(fill(ui.round, { n: n, total: birds.length })) + '</span><span>' + esc(fill(ui.scoreSoFar, { s: state.score, max: MAX })) + '</span></div>' +
			'<div class="gp-sbg__bar" role="progressbar" aria-label="' + esc(ui.progress) + '" aria-valuemin="0" aria-valuemax="' + birds.length + '" aria-valuenow="' + state.index + '"><span style="width:' + (state.index / birds.length * 100) + '%"></span></div>' +
			'<h3>' + esc(ui.who) + '</h3>' +
			'<ol class="gp-sbg__cluelist" aria-label="' + esc(ui.cluesLabel) + '"></ol>' +
			'<p class="gp-sbg__worth"></p>' +
			'<fieldset class="gp-sbg__opts"><legend>' + esc(ui.pick) + '</legend>' + opts + '</fieldset>' +
			'<p class="gp-sbg__hint" role="status"></p>' +
			'<div class="gp-sbg__slot"></div>' +
			'<div class="gp-sbg__actions"></div>';
		var more = button(ui.nextClue, 'is-outline');
		more.addEventListener('click', function () { if (!state.done) { addClue(); live.textContent = fill(ui.clueAnnounce, { n: state.shown }) + ' ' + b.clues[state.shown - 1]; } });
		app.querySelector('.gp-sbg__actions').appendChild(more);
		state.more = more;
		var list = app.querySelector('.gp-sbg__cluelist');
		for (var i = 0; i < 3; i++) { var li = document.createElement('li'); li.className = 'is-locked'; li.textContent = ui.locked; list.appendChild(li); }
		showClue(0, false);
		updateWorth();
		[].forEach.call(app.querySelectorAll('.gp-sbg__opt'), function (btn) {
			btn.addEventListener('click', function () { guess(btn, b); });
		});
		scrollTop(); focusHeading();
	}

	function showClue(i, animate) {
		var li = app.querySelectorAll('.gp-sbg__cluelist li')[i];
		li.textContent = state.order[state.index].clues[i];
		li.className = animate ? 'is-new' : '';
	}
	function addClue() {
		if (state.shown >= 3) { return; }
		showClue(state.shown, true); state.shown += 1; state.points = Math.max(0, state.points - 1);
		updateWorth();
	}
	function updateWorth() {
		app.querySelector('.gp-sbg__worth').textContent = fill(state.points === 1 ? ui.worthOne : ui.worth, { p: state.points });
		if (state.shown >= 3 && state.more) { state.more.disabled = true; state.more.style.display = 'none'; }
	}

	function guess(btn, b) {
		if (state.done || btn.disabled) { return; }
		var pick = birds[+btn.getAttribute('data-i')];
		if (pick !== b) {
			btn.disabled = true; btn.classList.add('is-wrong'); btn.setAttribute('aria-label', fill(ui.wrongLabel, { name: pick.name }));
			var hint = app.querySelector('.gp-sbg__hint');
			if (state.shown < 3) { addClue(); hint.textContent = fill(ui.wrongMore, { name: pick.name }); }
			else { state.points = 0; updateWorth(); hint.textContent = fill(ui.wrongLast, { name: pick.name }); }
			live.textContent = hint.textContent;
			return;
		}
		state.done = true;
		state.score += state.points; state.got.push({ bird: b, points: state.points });
		[].forEach.call(app.querySelectorAll('.gp-sbg__opt'), function (o) { o.disabled = true; });
		btn.classList.add('is-right');
		app.querySelector('.gp-sbg__hint').textContent = '';
		if (state.more) { state.more.remove(); }
		var r = document.createElement('div');
		r.className = 'gp-sbg__reveal' + (state.points ? '' : ' is-zero'); r.setAttribute('tabindex', '-1');
		r.innerHTML = photo(b) + '<div><p class="gp-sbg__gain">' + esc(fill(state.points === 1 ? ui.rightOne : ui.right, { p: state.points })) + '</p>' +
			'<p><strong>' + esc(b.name) + '</strong> (<em>' + esc(b.latin) + '</em>)</p>' +
			'<p><a href="' + esc(b.href) + '">' + esc(fill(ui.profile, { name: b.name })) + '</a></p></div>';
		app.querySelector('.gp-sbg__slot').appendChild(r);
		var bar = app.querySelector('.gp-sbg__bar');
		bar.setAttribute('aria-valuenow', state.index + 1); bar.firstChild.style.width = ((state.index + 1) / birds.length * 100) + '%';
		app.querySelector('.gp-sbg__top span:last-child').textContent = fill(ui.scoreSoFar, { s: state.score, max: MAX });
		var last = state.index === birds.length - 1;
		var next = button(last ? ui.results : ui.next);
		next.addEventListener('click', function () { if (last) { renderResult(); } else { state.index += 1; renderRound(); } });
		app.querySelector('.gp-sbg__actions').appendChild(next);
		live.textContent = fill(state.points === 1 ? ui.rightOne : ui.right, { p: state.points }) + ' ' + b.name + '.';
		r.focus({ preventScroll: true });
		var rb = r.getBoundingClientRect(); if (rb.bottom > innerHeight) { window.scrollBy(0, Math.min(rb.bottom - innerHeight + 90, rb.top - 140)); }
	}

	function renderResult() {
		var s = state.score, band = bands.filter(function (x) { return s >= x.min; })[0] || bands[bands.length - 1];
		var review = state.got.map(function (g) {
			return '<li><a href="' + esc(g.bird.href) + '">' + esc(g.bird.name) + '</a><b>' + esc(fill(g.points === 1 ? ui.ptsOne : ui.pts, { p: g.points })) + '</b></li>';
		}).join('');
		app.innerHTML = '<p class="gp-sbg__score" aria-hidden="true">' + s + '/' + MAX + '</p>' +
			'<h3>' + esc(band.title) + '</h3>' +
			'<p><strong>' + esc(fill(ui.final, { s: s, max: MAX })) + '</strong> ' + esc(band.text) + '</p>' +
			'<div class="gp-sbg__bar" role="img" aria-label="' + esc(fill(ui.final, { s: s, max: MAX })) + '"><span style="width:' + (s / MAX * 100) + '%"></span></div>' +
			'<ul class="gp-sbg__review">' + review + '</ul>' +
			'<div class="gp-sbg__actions"></div><p class="gp-sbg__note" role="status"></p>';
		var acts = app.querySelector('.gp-sbg__actions');
		var again = button(ui.again);
		again.addEventListener('click', function () { renderStart(true); renderRound(); });
		acts.appendChild(again);
		var share = button(ui.share, 'is-outline');
		share.addEventListener('click', function () {
			var url = location.href.split('#')[0] + '#' + root.id, text = fill(ui.shareText, { s: s, max: MAX }), note = app.querySelector('.gp-sbg__note');
			if (navigator.share) { navigator.share({ title: document.title, text: text, url: url }).catch(function () {}); return; }
			if (navigator.clipboard) { navigator.clipboard.writeText(text + ' ' + url).then(function () { note.textContent = ui.copied; }, function () { note.textContent = url; }); }
			else { note.textContent = url; }
		});
		acts.appendChild(share);
		if (ui.moreHref) {
			var more = document.createElement('a');
			more.className = 'wp-block-button__link wp-element-button is-outline'; more.href = ui.moreHref; more.textContent = ui.moreLabel;
			acts.appendChild(more);
		}
		live.textContent = fill(ui.final, { s: s, max: MAX }) + ' ' + band.title + '.';
		scrollTop(); focusHeading();
	}
	renderStart(false);
}());
</script>
	<?php
}, 30 );
