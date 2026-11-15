<?php
/**
 * Coastal Guardian Challenge: a five-question learning game on /coastal-guardian-challenge/.
 *
 * Progressive enhancement: the page itself (pages/coastal-guardian-challenge.html) contains all
 * questions, answers, explanations and score messages as normal HTML, so it works without
 * JavaScript and is readable by search engines. This snippet turns that HTML into the interactive
 * game. It only prints anything on that one page, uses only .gp-cgc-scoped CSS, loads nothing
 * from other servers, stores nothing (no cookies, no localStorage) and sends nothing anywhere.
 * To remove the game, drop this snippet from pages/site.json: the page falls back to the static list.
 */

add_action( 'wp_footer', function () {
	if ( ! is_page( 'coastal-guardian-challenge' ) ) {
		return;
	}
	?>
<style id="gp-cgc-style">
.gp-cgc-meta{color:var(--gp-muted);font-size:.95rem}
.gp-cgc.is-ready .gp-cgc__fallback{display:none}
.gp-cgc__app{background:#fff;border:1px solid var(--gp-line);border-radius:14px;box-shadow:0 1px 2px rgba(16,63,70,.06),0 6px 18px rgba(16,63,70,.05);padding:clamp(1.1rem,3vw,2rem);margin:1.5rem 0}
.gp-cgc__app :focus-visible{outline:3px solid var(--gp-gold);outline-offset:3px}
.gp-cgc__badge{width:3.2rem;height:3.2rem;border-radius:14px;background:var(--gp-foam);display:flex;align-items:center;justify-content:center;color:var(--gp-teal);margin-bottom:.8rem}
.gp-cgc__badge svg{width:1.9rem;height:1.9rem}
.gp-cgc__app h2{margin:.2rem 0 .6rem;font-size:clamp(1.4rem,3vw,1.9rem)}
.gp-cgc__app h2:focus{outline:none}
.gp-cgc__facts{display:flex;flex-wrap:wrap;gap:.5rem;list-style:none;padding:0;margin:1rem 0 1.4rem}
.gp-cgc__facts li{background:var(--gp-foam);color:var(--gp-teal-dark);border-radius:99px;padding:.3rem .8rem;font-size:.88rem;font-weight:600}
.gp-cgc__top{display:flex;justify-content:space-between;gap:1rem;font-size:.9rem;color:var(--gp-muted);font-weight:600}
.gp-cgc__bar{height:.55rem;border-radius:99px;background:var(--gp-foam);overflow:hidden;margin:.45rem 0 1.2rem}
.gp-cgc__bar span{display:block;height:100%;background:var(--gp-teal);border-radius:99px;transition:width .3s}
.gp-cgc__opts-live{border:0;padding:0;margin:0 0 1rem;display:grid;gap:.7rem}
.gp-cgc__opts-live legend{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0)}
.gp-cgc__opt{display:flex;align-items:flex-start;gap:.8rem;border:2px solid var(--gp-line);border-radius:12px;padding:.85rem 1rem;cursor:pointer;background:var(--gp-ivory);line-height:1.45;transition:border-color .15s,background .15s}
.gp-cgc__opt:hover{border-color:var(--gp-teal)}
.gp-cgc__opt input{position:absolute;opacity:0;width:1px;height:1px}
.gp-cgc__opt:focus-within{outline:3px solid var(--gp-gold);outline-offset:2px}
.gp-cgc__letter{flex:0 0 auto;width:2rem;height:2rem;border-radius:50%;border:2px solid var(--gp-teal);color:var(--gp-teal);font-weight:700;display:flex;align-items:center;justify-content:center}
.gp-cgc__opt.is-selected{border-color:var(--gp-teal);background:var(--gp-foam)}
.gp-cgc__opt.is-selected .gp-cgc__letter{background:var(--gp-teal);color:#fff}
.gp-cgc__opt.is-locked{cursor:default}
.gp-cgc__opt.is-locked:hover{border-color:var(--gp-line)}
.gp-cgc__opt.is-right{border-color:#2F7A55;background:#EAF5EE}
.gp-cgc__opt.is-wrong{border-color:#B5523A;background:#FBEFEA}
.gp-cgc__tag{display:block;font-size:.82rem;font-weight:700;margin-top:.25rem}
.gp-cgc__opt.is-right .gp-cgc__tag{color:#1F5C3E}
.gp-cgc__opt.is-wrong .gp-cgc__tag{color:#8E3B27}
.gp-cgc__feedback{border-radius:12px;padding:1rem 1.1rem;margin:0 0 1rem;border-left:5px solid var(--gp-teal);background:var(--gp-foam)}
.gp-cgc__feedback.is-right{border-left-color:#2F7A55;background:#EAF5EE}
.gp-cgc__feedback.is-wrong{border-left-color:#B5523A;background:#FBEFEA}
.gp-cgc__feedback p{margin:.35rem 0}
.gp-cgc__status{display:flex;align-items:center;gap:.5rem;font-weight:700;font-size:1.05rem}
.gp-cgc__status svg{width:1.3rem;height:1.3rem;flex:0 0 auto}
.gp-cgc__hint{color:#8E3B27;font-weight:600;min-height:1.4em;margin:.2rem 0 .6rem}
.gp-cgc__actions{display:flex;flex-wrap:wrap;gap:.7rem;align-items:center}
.gp-cgc__actions .wp-block-button__link{border:0;cursor:pointer;font:inherit;min-height:44px}
.gp-cgc__actions .is-outline{background:transparent!important;color:var(--gp-teal-dark)!important;border:2px solid var(--gp-teal)!important}
.gp-cgc__score{font-family:var(--gp-serif);font-size:clamp(2.6rem,7vw,3.6rem);font-weight:700;color:var(--gp-teal);line-height:1}
.gp-cgc__review{list-style:none;padding:0;margin:1rem 0;display:grid;gap:.4rem}
.gp-cgc__review li{display:flex;gap:.5rem;align-items:center;font-size:.95rem}
.gp-cgc__review svg{width:1.1rem;height:1.1rem;flex:0 0 auto}
.gp-cgc__review .ok{color:#1F5C3E}
.gp-cgc__review .no{color:#8E3B27}
.gp-cgc__next{background:var(--gp-sand);border-radius:12px;padding:.8rem 1rem;margin:1rem 0}
.gp-cgc .sr-only{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap}
@media (prefers-reduced-motion:reduce){.gp-cgc__bar span,.gp-cgc__opt{transition:none}}
@media (max-width:600px){.gp-cgc__opt{padding:.75rem .8rem}.gp-cgc__actions .wp-block-button__link{width:100%;text-align:center}}
</style>
<script id="gp-cgc-script">
(function () {
	var root = document.getElementById('gp-cgc');
	if (!root || !root.querySelector('.gp-cgc__q')) { return; }
	var ICON = {
		bird: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 10c3.5 0 6.5 1.6 10 5.5 3.5-3.9 6.5-5.5 10-5.5"/><path d="M12 15.5V19"/><circle cx="12" cy="7" r="1.6"/></svg>',
		trophy: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0z"/><path d="M8 6H5a3 3 0 0 0 3 4"/><path d="M16 6h3a3 3 0 0 1-3 4"/><path d="M12 13v4"/><path d="M8.5 20h7"/></svg>',
		ok: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="m7.5 12.5 3 3 6-6.5"/></svg>',
		no: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="m9 9 6 6M15 9l-6 6"/></svg>'
	};
	function txt(el) { return el ? el.textContent.trim() : ''; }
	function inner(el) { return el ? el.innerHTML.trim() : ''; }
	// Read the questions and score messages from the page's own HTML (single source of truth).
	var questions = [].slice.call(root.querySelectorAll('.gp-cgc__q')).map(function (q) {
		return {
			topic: q.getAttribute('data-topic'),
			scenario: txt(q.querySelector('.gp-cgc__scenario')),
			correct: q.getAttribute('data-correct'),
			options: [].slice.call(q.querySelectorAll('.gp-cgc__opts li')).map(function (li) {
				return { key: li.getAttribute('data-key'), text: txt(li.querySelector('.gp-cgc__opt-text')) };
			}),
			ok: txt(q.querySelector('.gp-cgc__ok')),
			no: q.getAttribute('data-no'),
			more: inner(q.querySelector('.gp-cgc__more'))
		};
	});
	var results = {};
	[].slice.call(root.querySelectorAll('.gp-cgc__results tr[data-score]')).forEach(function (tr) {
		var td = tr.querySelectorAll('td');
		results[tr.getAttribute('data-score')] = { title: txt(td[1]), message: txt(td[2]), next: inner(td[3]) };
	});
	if (questions.length !== 5 || Object.keys(results).length !== 6) { return; } // keep the static version

	var state;
	function reset() { state = { index: 0, score: 0, answers: [], checked: false, choice: null }; }
	var app = document.createElement('section');
	app.className = 'gp-cgc__app';
	app.setAttribute('aria-label', 'Coastal Guardian Challenge');
	var live = document.createElement('div');
	live.className = 'sr-only';
	live.setAttribute('aria-live', 'polite');
	root.appendChild(app);
	root.appendChild(live);
	root.classList.add('is-ready');

	function esc(s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }
	function button(label, cls) {
		var b = document.createElement('button');
		b.type = 'button';
		b.className = 'wp-block-button__link wp-element-button' + (cls ? ' ' + cls : '');
		b.textContent = label;
		return b;
	}
	function focusHeading() { var h = app.querySelector('h2'); if (h) { h.setAttribute('tabindex', '-1'); h.focus({ preventScroll: false }); } }
	function scrollTop() { var y = app.getBoundingClientRect().top + window.pageYOffset - 90; if (window.pageYOffset > y) { window.scrollTo(0, y); } }

	function renderStart(withFocus) {
		reset();
		app.innerHTML = '<div class="gp-cgc__badge">' + ICON.bird + '</div>' +
			'<h2>Can You Protect Our Coasts?</h2>' +
			'<p>Five real situations on the coast. For each one, choose the best of three answers and get a short explanation.</p>' +
			'<ul class="gp-cgc__facts"><li>5 questions</li><li>About 2–3 minutes</li><li>No sign-up, nothing saved</li></ul>' +
			'<div class="gp-cgc__actions"></div>';
		var start = button('Start Challenge');
		start.addEventListener('click', function () { renderQuestion(); });
		app.querySelector('.gp-cgc__actions').appendChild(start);
		if (withFocus) { focusHeading(); }
	}

	function renderQuestion() {
		var q = questions[state.index], n = state.index + 1;
		state.checked = false; state.choice = null;
		var name = 'gp-cgc-q' + n;
		var opts = q.options.map(function (o) {
			return '<label class="gp-cgc__opt" data-key="' + o.key + '"><input type="radio" name="' + name + '" value="' + o.key + '">' +
				'<span class="gp-cgc__letter" aria-hidden="true">' + o.key + '</span><span><span class="gp-cgc__opt-label"><span class="sr-only">Option ' + o.key + ': </span>' + esc(o.text) + '</span><span class="gp-cgc__tag"></span></span></label>';
		}).join('');
		app.innerHTML = '<div class="gp-cgc__top"><span>Question ' + n + ' of 5</span><span>' + esc(q.topic) + '</span></div>' +
			'<div class="gp-cgc__bar" role="progressbar" aria-label="Progress" aria-valuemin="0" aria-valuemax="5" aria-valuenow="' + state.index + '" aria-valuetext="' + state.index + ' of 5 questions answered"><span style="width:' + (state.index * 20) + '%"></span></div>' +
			'<h2 id="gp-cgc-qh">' + esc(q.scenario) + '</h2>' +
			'<fieldset class="gp-cgc__opts-live"><legend>Choose one answer</legend>' + opts + '</fieldset>' +
			'<p class="gp-cgc__hint" role="alert"></p>' +
			'<div class="gp-cgc__feedback-slot"></div>' +
			'<div class="gp-cgc__actions"></div>';
		var check = button('Check Answer');
		app.querySelector('.gp-cgc__actions').appendChild(check);
		[].forEach.call(app.querySelectorAll('.gp-cgc__opt input'), function (input) {
			input.addEventListener('change', function () {
				if (state.checked) { return; }
				state.choice = input.value;
				[].forEach.call(app.querySelectorAll('.gp-cgc__opt'), function (l) { l.classList.toggle('is-selected', l.getAttribute('data-key') === input.value); });
				app.querySelector('.gp-cgc__hint').textContent = '';
			});
		});
		check.addEventListener('click', function () { checkAnswer(check); });
		scrollTop();
		focusHeading();
	}

	function checkAnswer(check) {
		var q = questions[state.index];
		if (state.checked) { return; } // no second scoring
		if (!state.choice) { app.querySelector('.gp-cgc__hint').textContent = 'Please choose an answer first.'; return; }
		state.checked = true;
		var right = state.choice === q.correct;
		if (right) { state.score += 1; }
		state.answers[state.index] = right;
		[].forEach.call(app.querySelectorAll('.gp-cgc__opt'), function (l) {
			var key = l.getAttribute('data-key'), input = l.querySelector('input');
			input.disabled = true;
			l.classList.add('is-locked');
			if (key === q.correct) { l.classList.add('is-right'); l.querySelector('.gp-cgc__tag').textContent = key === state.choice ? '✓ Your answer – correct' : '✓ Correct answer'; }
			else if (key === state.choice) { l.classList.add('is-wrong'); l.querySelector('.gp-cgc__tag').textContent = '✗ Your answer'; }
		});
		var fb = document.createElement('div');
		fb.className = 'gp-cgc__feedback ' + (right ? 'is-right' : 'is-wrong');
		fb.setAttribute('tabindex', '-1');
		var correctText = q.options.filter(function (o) { return o.key === q.correct; })[0].text;
		fb.innerHTML = '<p class="gp-cgc__status">' + (right ? ICON.ok + 'Correct' : ICON.no + 'Not quite') + '</p>' +
			'<p>' + esc(right ? q.ok : q.no) + '</p>' +
			(right ? '' : '<p><strong>Correct answer ' + q.correct + ':</strong> ' + esc(correctText) + '</p>') +
			'<p>Learn more: ' + q.more + '</p>';
		app.querySelector('.gp-cgc__feedback-slot').appendChild(fb);
		var bar = app.querySelector('.gp-cgc__bar');
		bar.setAttribute('aria-valuenow', state.index + 1);
		bar.setAttribute('aria-valuetext', (state.index + 1) + ' of 5 questions answered');
		bar.firstChild.style.width = ((state.index + 1) * 20) + '%';
		var last = state.index === questions.length - 1;
		var next = button(last ? 'View My Results' : 'Next Question');
		next.addEventListener('click', function () {
			if (last) { renderResult(); } else { state.index += 1; renderQuestion(); }
		});
		check.replaceWith(next);
		live.textContent = (right ? 'Correct. ' : 'Not quite. ') + 'Score so far: ' + state.score + ' of ' + (state.index + 1) + '.';
		fb.focus();
	}

	function renderResult() {
		var s = state.score, r = results[String(s)];
		var review = questions.map(function (q, i) {
			var ok = state.answers[i] === true;
			return '<li class="' + (ok ? 'ok' : 'no') + '">' + (ok ? ICON.ok : ICON.no) + '<span>Question ' + (i + 1) + ', ' + esc(q.topic) + ': ' + (ok ? 'correct' : 'not quite') + '</span></li>';
		}).join('');
		app.innerHTML = '<div class="gp-cgc__badge">' + ICON.trophy + '</div>' +
			'<p class="gp-cgc__score" aria-hidden="true">' + s + '/5</p>' +
			'<h2>' + esc(r.title) + '</h2>' +
			'<p><strong>' + s + ' out of 5 correct answers.</strong></p>' +
			'<div class="gp-cgc__bar" role="img" aria-label="Score: ' + s + ' out of 5"><span style="width:' + (s * 20) + '%"></span></div>' +
			'<p>' + esc(r.message) + '</p>' +
			'<ul class="gp-cgc__review">' + review + '</ul>' +
			'<p class="gp-cgc__next"><strong>Recommended next step:</strong> ' + r.next + '</p>' +
			'<div class="gp-cgc__actions"></div>';
		var again = button('Try Again');
		again.addEventListener('click', function () { renderStart(true); scrollTop(); });
		var guide = document.createElement('a');
		guide.className = 'wp-block-button__link wp-element-button is-outline';
		guide.href = root.getAttribute('data-more') || '/guillemots/grohnpetrel-knowledge-centre/';
		guide.textContent = 'Visit the Knowledge Centre';
		var acts = app.querySelector('.gp-cgc__actions');
		acts.appendChild(again);
		acts.appendChild(guide);
		live.textContent = 'Challenge complete. You scored ' + s + ' out of 5: ' + r.title + '.';
		scrollTop();
		focusHeading();
	}
	renderStart(false);
}());
</script>
	<?php
}, 30 );
