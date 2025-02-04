(function () {
    var t,
        e,
        n,
        i,
        r,
        o,
        s,
        a,
        u,
        l,
        d,
        h,
        p,
        c,
        f,
        m,
        g,
        $,
        v,
        y,
        b,
        M,
        _,
        E,
        T,
        w,
        x,
        S,
        L,
        D,
        A,
        C,
        F = [].slice;
    (i =
        '<span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner">' +
        (c = '<span class="odometer-ribbon"><span class="odometer-ribbon-inner">' + (g = '<span class="odometer-value"></span>') + "</span></span>") +
        "</span></span>"),
        (s = '<span class="odometer-formatting-mark"></span>'),
        (n = "(,ddd).dd"),
        (a = /^\(?([^)]*)\)?(?:(.)(d+))?$/),
        (o = 2e3),
        (t = 20),
        (l = 2),
        (r = 0.5),
        (d = 1e3 / (u = 30)),
        (e = 1e3 / t),
        (f = "transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd"),
        (m = null != (T = document.createElement("div").style).transition || null != T.webkitTransition || null != T.mozTransition || null != T.oTransition),
        (_ = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame),
        (h = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver),
        (v = function (t) {
            var e;
            return ((e = document.createElement("div")).innerHTML = t), e.children[0];
        }),
        (M = function (t, e) {
            return (t.className = t.className.replace(RegExp("(^| )" + e.split(" ").join("|") + "( |$)", "gi"), " "));
        }),
        ($ = function (t, e) {
            return M(t, e), (t.className += " " + e);
        }),
        (w = function (t, e) {
            var n;
            if (null != document.createEvent) return (n = document.createEvent("HTMLEvents")).initEvent(e, !0, !0), t.dispatchEvent(n);
        }),
        (b = function () {
            var t, e;
            return null != (t = null != (e = window.performance) && "function" == typeof e.now ? e.now() : void 0) ? t : +new Date();
        }),
        (E = function (t, e) {
            return (null == e && (e = 0), e) ? ((t *= Math.pow(10, e)), (t += 0.5), (t = Math.floor(t)) / Math.pow(10, e)) : Math.round(t);
        }),
        (x = function (t) {
            return t < 0 ? Math.ceil(t) : Math.floor(t);
        }),
        (y = function (t) {
            return t - E(t);
        }),
        (L = !1),
        (S = function () {
            var t, e, n, i, r;
            if (!L && null != window.jQuery) {
                for (e = 0, L = !0, r = [], n = (i = ["html", "text"]).length; e < n; e++)
                    (t = i[e]),
                        r.push(
                            (function (t) {
                                var e;
                                return (
                                    (e = window.jQuery.fn[t]),
                                    (window.jQuery.fn[t] = function (t) {
                                        var n;
                                        return null == t || (null != (n = this[0]) ? n.odometer : void 0) == null ? e.apply(this, arguments) : this[0].odometer.update(t);
                                    })
                                );
                            })(t)
                        );
                return r;
            }
        })(),
        setTimeout(S, 0),
        ((p = (function () {
            function t(e) {
                var n,
                    i,
                    r,
                    s,
                    a,
                    u,
                    h,
                    p,
                    c,
                    f,
                    m = this;
                if (((this.options = e), (this.el = this.options.el), null != this.el.odometer)) return this.el.odometer;
                for (i in ((this.el.odometer = this), (p = t.options))) (s = p[i]), null == this.options[i] && (this.options[i] = s);
                null == (a = this.options).duration && (a.duration = o),
                    (this.MAX_VALUES = (this.options.duration / d / l) | 0),
                    this.resetFormat(),
                    (this.value = this.cleanValue(null != (c = this.options.value) ? c : "")),
                    this.renderInside(),
                    this.render();
                try {
                    for (u = 0, h = (f = ["innerHTML", "innerText", "textContent"]).length; u < h; u++)
                        (r = f[u]),
                            null != this.el[r] &&
                                (function (t) {
                                    Object.defineProperty(m.el, t, {
                                        get: function () {
                                            var e;
                                            return "innerHTML" === t ? m.inside.outerHTML : null != (e = m.inside.innerText) ? e : m.inside.textContent;
                                        },
                                        set: function (t) {
                                            return m.update(t);
                                        },
                                    });
                                })(r);
                } catch (g) {
                    (n = g), this.watchForMutations();
                }
            }
            return (
                (t.prototype.renderInside = function () {
                    return (this.inside = document.createElement("div")), (this.inside.className = "odometer-inside"), (this.el.innerHTML = ""), this.el.appendChild(this.inside);
                }),
                (t.prototype.watchForMutations = function () {
                    var t,
                        e = this;
                    if (null != h)
                        try {
                            return (
                                null == this.observer &&
                                    (this.observer = new h(function (t) {
                                        var n;
                                        return (n = e.el.innerText), e.renderInside(), e.render(e.value), e.update(n);
                                    })),
                                (this.watchMutations = !0),
                                this.startWatchingMutations()
                            );
                        } catch (n) {
                            t = n;
                        }
                }),
                (t.prototype.startWatchingMutations = function () {
                    if (this.watchMutations) return this.observer.observe(this.el, { childList: !0 });
                }),
                (t.prototype.stopWatchingMutations = function () {
                    var t;
                    return null != (t = this.observer) ? t.disconnect() : void 0;
                }),
                (t.prototype.cleanValue = function (t) {
                    var e;
                    return "string" == typeof t && (t = parseFloat((t = (t = (t = t.replace(null != (e = this.format.radix) ? e : ".", "<radix>")).replace(/[.,]/g, "")).replace("<radix>", ".")), 10) || 0), E(t, this.format.precision);
                }),
                (t.prototype.bindTransitionEnd = function () {
                    var t,
                        e,
                        n,
                        i,
                        r,
                        o,
                        s = this;
                    if (!this.transitionEndBound) {
                        for (n = 0, this.transitionEndBound = !0, e = !1, r = f.split(" "), o = [], i = r.length; n < i; n++)
                            (t = r[n]),
                                o.push(
                                    this.el.addEventListener(
                                        t,
                                        function () {
                                            return (
                                                !!e ||
                                                ((e = !0),
                                                setTimeout(function () {
                                                    return s.render(), (e = !1), w(s.el, "odometerdone");
                                                }, 0),
                                                !0)
                                            );
                                        },
                                        !1
                                    )
                                );
                        return o;
                    }
                }),
                (t.prototype.resetFormat = function () {
                    var t, e, i, r, o, s, u, l;
                    if (((t = null != (u = this.options.format) ? u : n) || (t = "d"), !(i = a.exec(t)))) throw Error("Odometer: Unparsable digit format");
                    return (s = (l = i.slice(1, 4))[0]), (o = l[1]), (r = (null != (e = l[2]) ? e.length : void 0) || 0), (this.format = { repeating: s, radix: o, precision: r });
                }),
                (t.prototype.render = function (t) {
                    var e, n, i, r, o, s, a, u, l, d, h, p;
                    for (null == t && (t = this.value), this.stopWatchingMutations(), this.resetFormat(), this.inside.innerHTML = "", s = this.options.theme, e = this.el.className.split(" "), o = [], u = 0, d = e.length; u < d; u++) {
                        if ((n = e[u]).length) {
                            if ((r = /^odometer-theme-(.+)$/.exec(n))) {
                                s = r[1];
                                continue;
                            }
                            !/^odometer(-|$)/.test(n) && o.push(n);
                        }
                    }
                    for (
                        o.push("odometer"),
                            m || o.push("odometer-no-transitions"),
                            s ? o.push("odometer-theme-" + s) : o.push("odometer-auto-theme"),
                            this.el.className = o.join(" "),
                            this.ribbons = {},
                            this.digits = [],
                            a = !this.format.precision || !y(t),
                            p = t.toString().split("").reverse(),
                            l = 0,
                            h = p.length;
                        l < h;
                        l++
                    )
                        "." === (i = p[l]) && (a = !0), this.addDigit(i, a);
                    return this.startWatchingMutations();
                }),
                (t.prototype.update = function (t) {
                    var e,
                        n = this;
                    if ((e = (t = this.cleanValue(t)) - this.value))
                        return (
                            M(this.el, "odometer-animating-up odometer-animating-down odometer-animating"),
                            e > 0 ? $(this.el, "odometer-animating-up") : $(this.el, "odometer-animating-down"),
                            this.stopWatchingMutations(),
                            this.animate(t),
                            this.startWatchingMutations(),
                            setTimeout(function () {
                                return n.el.offsetHeight, $(n.el, "odometer-animating");
                            }, 0),
                            (this.value = t)
                        );
                }),
                (t.prototype.renderDigit = function () {
                    return v(i);
                }),
                (t.prototype.insertDigit = function (t, e) {
                    return null != e ? this.inside.insertBefore(t, e) : this.inside.children.length ? this.inside.insertBefore(t, this.inside.children[0]) : this.inside.appendChild(t);
                }),
                (t.prototype.addSpacer = function (t, e, n) {
                    var i;
                    return ((i = v(s)).innerHTML = t), n && $(i, n), this.insertDigit(i, e);
                }),
                (t.prototype.addDigit = function (t, e) {
                    var n, i, r, o;
                    if ((null == e && (e = !0), "-" === t)) return this.addSpacer(t, null, "odometer-negation-mark");
                    if ("." === t) return this.addSpacer(null != (o = this.format.radix) ? o : ".", null, "odometer-radix-mark");
                    if (e)
                        for (r = !1; ; ) {
                            if (!this.format.repeating.length) {
                                if (r) throw Error("Bad odometer format without digits");
                                this.resetFormat(), (r = !0);
                            }
                            if (((n = this.format.repeating[this.format.repeating.length - 1]), (this.format.repeating = this.format.repeating.substring(0, this.format.repeating.length - 1)), "d" === n)) break;
                            this.addSpacer(n);
                        }
                    return ((i = this.renderDigit()).querySelector(".odometer-value").innerHTML = t), this.digits.push(i), this.insertDigit(i);
                }),
                (t.prototype.animate = function (t) {
                    return m && "count" !== this.options.animation ? this.animateSlide(t) : this.animateCount(t);
                }),
                (t.prototype.animateCount = function (t) {
                    var n,
                        i,
                        r,
                        o,
                        s,
                        a = this;
                    if ((i = +t - this.value))
                        return (
                            (o = r = b()),
                            (n = this.value),
                            (s = function () {
                                var u, l, d;
                                if (b() - o > a.options.duration) {
                                    (a.value = t), a.render(), w(a.el, "odometerdone");
                                    return;
                                }
                                return ((u = b() - r) > e && ((r = b()), (n += l = i * (d = u / a.options.duration)), a.render(Math.round(n))), null != _) ? _(s) : setTimeout(s, e);
                            })()
                        );
                }),
                (t.prototype.getDigitCount = function () {
                    var t, e, n, i, r, o;
                    for (i = 1 <= arguments.length ? F.call(arguments, 0) : [], t = r = 0, o = i.length; r < o; t = ++r) (n = i[t]), (i[t] = Math.abs(n));
                    return Math.ceil(Math.log((e = Math.max.apply(Math, i)) + 1) / Math.log(10));
                }),
                (t.prototype.getFractionalDigitCount = function () {
                    var t, e, n, i, r, o, s;
                    for (r = 1 <= arguments.length ? F.call(arguments, 0) : [], e = /^\-?\d*\.(\d*?)0*$/, t = o = 0, s = r.length; o < s; t = ++o)
                        (i = r[t]), (r[t] = i.toString()), null == (n = e.exec(r[t])) ? (r[t] = 0) : (r[t] = n[1].length);
                    return Math.max.apply(Math, r);
                }),
                (t.prototype.resetDigits = function () {
                    return (this.digits = []), (this.ribbons = []), (this.inside.innerHTML = ""), this.resetFormat();
                }),
                (t.prototype.animateSlide = function (t) {
                    var e, n, i, o, s, a, u, l, d, h, p, c, f, m, g, v, y, b, M, _, E, T, w, S, L, D, A;
                    if (((v = this.value), (l = this.getFractionalDigitCount(v, t)) && ((t *= Math.pow(10, l)), (v *= Math.pow(10, l))), (i = t - v))) {
                        for (this.bindTransitionEnd(), o = this.getDigitCount(v, t), s = [], e = 0, p = M = 0; 0 <= o ? M < o : M > o; p = 0 <= o ? ++M : --M) {
                            if (((y = x(v / Math.pow(10, o - p - 1))), Math.abs((a = (u = x(t / Math.pow(10, o - p - 1))) - y)) > this.MAX_VALUES)) {
                                for (h = [], c = a / (this.MAX_VALUES + this.MAX_VALUES * e * r), n = y; (a > 0 && n < u) || (a < 0 && n > u); ) h.push(Math.round(n)), (n += c);
                                h[h.length - 1] !== u && h.push(u), e++;
                            } else
                                h = function () {
                                    A = [];
                                    for (var t = y; y <= u ? t <= u : t >= u; y <= u ? t++ : t--) A.push(t);
                                    return A;
                                }.apply(this);
                            for (p = _ = 0, T = h.length; _ < T; p = ++_) (d = h[p]), (h[p] = Math.abs(d % 10));
                            s.push(h);
                        }
                        for (this.resetDigits(), D = s.reverse(), p = E = 0, w = D.length; E < w; p = ++E)
                            for (
                                h = D[p],
                                    this.digits[p] || this.addDigit(" ", p >= l),
                                    null == (b = this.ribbons)[p] && (b[p] = this.digits[p].querySelector(".odometer-ribbon-inner")),
                                    this.ribbons[p].innerHTML = "",
                                    i < 0 && (h = h.reverse()),
                                    f = L = 0,
                                    S = h.length;
                                L < S;
                                f = ++L
                            )
                                (d = h[f]),
                                    ((g = document.createElement("div")).className = "odometer-value"),
                                    (g.innerHTML = d),
                                    this.ribbons[p].appendChild(g),
                                    f === h.length - 1 && $(g, "odometer-last-value"),
                                    0 === f && $(g, "odometer-first-value");
                        if ((y < 0 && this.addDigit("-"), null != (m = this.inside.querySelector(".odometer-radix-mark")) && m.parent.removeChild(m), l)) return this.addSpacer(this.format.radix, this.digits[l - 1], "odometer-radix-mark");
                    }
                }),
                t
            );
        })()).options = null != (A = window.odometerOptions) ? A : {}),
        setTimeout(function () {
            var t, e, n, i, r;
            if (window.odometerOptions) {
                for (t in ((i = window.odometerOptions), (r = []), i)) (e = i[t]), r.push(null != (n = p.options)[t] ? (n = p.options)[t] : (n[t] = e));
                return r;
            }
        }, 0),
        (p.init = function () {
            var t, e, n, i, r, o;
            if (null != document.querySelectorAll) {
                for (n = 0, e = document.querySelectorAll(p.options.selector || ".odometer"), o = [], i = e.length; n < i; n++) (t = e[n]), o.push((t.odometer = new p({ el: t, value: null != (r = t.innerText) ? r : t.textContent })));
                return o;
            }
        }),
        (null != (C = document.documentElement) ? C.doScroll : void 0) != null && null != document.createEventObject
            ? ((D = document.onreadystatechange),
              (document.onreadystatechange = function () {
                  return "complete" === document.readyState && !1 !== p.options.auto && p.init(), null != D ? D.apply(this, arguments) : void 0;
              }))
            : document.addEventListener(
                  "DOMContentLoaded",
                  function () {
                      if (!1 !== p.options.auto) return p.init();
                  },
                  !1
              ),
        "function" == typeof define && define.amd
            ? define(["jquery"], function () {
                  return p;
              })
            : (window.Odometer = p);
}.call(this));
