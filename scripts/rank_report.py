# /// script
# requires-python = ">=3.11"
# dependencies = ["matplotlib"]
# ///
"""Derived rank table and chart for the SEO / GEO Lab data report. Usage:

    git show origin/gh-pages:data/results.csv > results.csv
    uv run scripts/rank_report.py results.csv [--until 2026-11-11] [--png out.png] [--csv out.csv]

Reads the rank tracker's raw results (collect.py writes them to the gh-pages branch, data/results.csv),
keeps Google rows only, takes each day's LAST check for every query and country (as the dashboard does),
and prints a table of our best organic position (blank = not in the top 10 returned by the API).
Same method as the dashboard; no other data is used.
"""
import argparse, csv
from collections import defaultdict

QUERIES = ["grohnpetrel", '"grohnpetrel"']
COUNTRIES = ["de", "us", "gb"]


def daily(path: str, until: str | None) -> tuple[list[str], dict, dict]:
    last: dict[tuple, dict] = {}
    checks: dict[str, int] = defaultdict(int)
    for r in csv.DictReader(open(path, encoding="utf-8")):
        if r["engine"] != "google" or (until and r["date"] > until):
            continue
        checks[r["date"]] += 1
        k = (r["date"], r["query"], r["country"])
        if k not in last or r["time_utc"] >= last[k]["time_utc"]:
            last[k] = r
    dates = sorted({k[0] for k in last})
    ranks = {k: (int(v["our_rank"]) if v["our_rank"] else None) for k, v in last.items()}
    return dates, ranks, checks


def main() -> None:
    ap = argparse.ArgumentParser()
    ap.add_argument("results")
    ap.add_argument("--until")
    ap.add_argument("--png")
    ap.add_argument("--csv")
    a = ap.parse_args()
    dates, ranks, checks = daily(a.results, a.until)
    cols = [(q, c) for q in QUERIES for c in COUNTRIES]
    print("date | " + " | ".join(f"{q} {c.upper()}" for q, c in cols) + " | Google checks")
    for d in dates:
        print(d + " | " + " | ".join(str(ranks.get((d, q, c)) or "–") for q, c in cols) + f" | {checks[d]}")
    for q, c in cols:
        vals = [ranks.get((d, q, c)) for d in dates]
        seen = [v for v in vals if v]
        print(f"{q} {c}: in top 10 on {len(seen)}/{len(dates)} days, #1 on {sum(v == 1 for v in seen)} days")
    if a.csv:
        with open(a.csv, "w", newline="", encoding="utf-8") as f:
            w = csv.writer(f)
            w.writerow(["date", "query", "country", "our_rank_last_check"])
            for d in dates:
                for q, c in cols:
                    w.writerow([d, q, c, ranks.get((d, q, c)) or ""])
    if a.png:
        import matplotlib
        matplotlib.use("Agg")
        import matplotlib.pyplot as plt
        colours = {"de": "#124E5A", "us": "#C49A47", "gb": "#7A4E8C"}
        markers = {"de": "o", "us": "s", "gb": "^"}
        offset = {"de": 10.9, "us": 11.2, "gb": 11.5}  # "not in top 10" rows, one per country
        fig, axes = plt.subplots(1, 2, figsize=(11, 4.2), sharey=True)
        x = list(range(len(dates)))
        for ax, q in zip(axes, QUERIES):
            for c in COUNTRIES:
                y = [ranks.get((d, q, c)) for d in dates]
                ax.plot(x, [v if v else float("nan") for v in y], color=colours[c], marker=markers[c], lw=2, ms=6, label=c.upper())
                ax.scatter([i for i, v in enumerate(y) if not v], [offset[c]] * sum(1 for v in y if not v), marker="x", color=colours[c], s=22)
            ax.set_title(f"Query: {q}", fontsize=12, color="#103F46")
            ax.set_xticks(x, [d[5:].replace("-", "/") for d in dates], rotation=45, fontsize=8)
            ax.set_ylim(11.9, 0.4)
            ax.set_yticks([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11.2], ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "not in\ntop 10"], fontsize=8)
            ax.grid(axis="y", color="#D9E3E1", lw=.8)
            for s in ("top", "right"):
                ax.spines[s].set_visible(False)
        axes[0].set_ylabel("Our best organic position (last check of the day)", fontsize=9)
        h, l = axes[0].get_legend_handles_labels()
        fig.legend(h, l, title="Google country (× = not in top 10)", frameon=False, fontsize=9, title_fontsize=9, loc="lower center", ncol=3)
        fig.suptitle("Grohnpetrel in Google: rank tracker, 31 Oct–" + dates[-1][8:] + " Nov 2026 (Serper API, hl=en, top 10)", fontsize=11, color="#243A3F")
        fig.tight_layout(rect=(0, 0.1, 1, 1))
        fig.savefig(a.png, dpi=150)
        print("chart:", a.png)


if __name__ == "__main__":
    main()
