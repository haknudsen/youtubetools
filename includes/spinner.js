// JavaScript Document
function Spinner() {}
Spinner.prototype.getText = function(q, p) {
    var c = [],
        b = "",
        g = [],
        h = 0,
        f = 0,
        e = 0,
        d = 0,
        n = 0,
        o = 1,
        m = q.c,
        a = "";
    for (h = 0; h < q.h.c.length; h++) {
        a = "{" + h + "}";
        f = 0;
        d = Math.floor(p / o) % q.h.r[h];
        e = q.h.c[h][f].r;
        while (Math.floor(p / o) % q.h.r[h] >= e) {
            d -= q.h.c[h][f].r;
            f++;
            e += q.h.c[h][f].r
        }
        o = o * q.h.r[h];
        b = this.getText(q.h.c[h][f], d);
        n = m.indexOf(a);
        m = m.substring(0, n) + b + m.substring(n + a.length)
    }
    return m
};
Spinner.prototype.getTree = function(r, g) {
    var q = "",
        p = "",
        a = 0,
        h = 0,
        t = {
            c: "",
            h: {
                c: [],
                r: []
            },
            d: !g ? 0 : g,
            r: 1,
            s: {
                l: 0,
                w: 0,
                h: 0,
                r: 0,
                wmin: 0,
                wmax: 0,
                lmin: 0,
                lmax: 0
            }
        },
        d = [],
        m = 0,
        b = 0,
        o = 0,
        s = "",
        f = false,
        e = false,
        n = 0,
        k = 0;
    if (r.indexOf("{") < 0) {
        t.c = r;
        t.s.w = this.countWords(r);
        t.s.l = r.length;
        t.s.wmin = t.s.w;
        t.s.wmax = t.s.w;
        t.s.lmin = t.s.l;
        t.s.lmax = t.s.l;
        return t
    }
    for (h = 0; h < r.length; h++) {
        p = r[h];
        if (p === "{") {
            if (a === 0) {
                s += q;
                t.c = t.c + q;
                q = ""
            } else {
                q = q + p
            }
            a++
        } else {
            if (p === "|") {
                if (a === 1) {
                    q = this.getTree(q, t.d + 1);
                    if (q === false) {
                        return false
                    }
                    m += q.r;
                    b += q.s.l;
                    o += q.s.w;
                    t.s.h += q.s.h;
                    t.s.r += Math.max(1, q.s.r);
                    f = f === false ? q.s.wmin : Math.min(f, q.s.wmin);
                    e = e === false ? q.s.lmin : Math.min(e, q.s.lmin);
                    n = Math.max(n, q.s.wmax);
                    k = Math.max(k, q.s.lmax);
                    d.push(q);
                    q = ""
                } else {
                    q = q + p
                }
            } else {
                if (p === "}") {
                    if (a === 1) {
                        q = this.getTree(q, t.d + 1);
                        if (q === false) {
                            return false
                        }
                        t.c = t.c + "{" + t.h.c.length + "}";
                        d.push(q);
                        m += q.r;
                        b += q.s.l;
                        o += q.s.w;
                        t.s.h += q.s.h + 1;
                        t.s.r += Math.max(1, q.s.r);
                        t.s.w = o * t.r + t.s.w * m;
                        t.s.l = b * t.r + t.s.l * m;
                        t.s.wmin += f === false ? q.s.wmin : Math.min(f, q.s.wmin);
                        t.s.lmin += e === false ? q.s.lmin : Math.min(e, q.s.lmin);
                        t.s.wmax += Math.max(n, q.s.wmax);
                        t.s.lmax += Math.max(k, q.s.lmax);
                        f = false;
                        e = false;
                        n = 0;
                        k = 0;
                        t.r = t.r * m;
                        t.h.r[t.h.c.length] = m;
                        m = 0;
                        b = 0;
                        o = 0;
                        t.h.c.push(d);
                        d = [];
                        q = ""
                    } else {
                        q = q + p
                    }
                    a--
                } else {
                    q = q + p
                }
            }
        }
    }
    if (a !== 0) {
        if (a > 0) {
            this.error("spin", "0")
        } else {
            this.error("spin", "1")
        }
        return false
    }
    if (q !== "") {
        s += q;
        t.c = t.c + q
    }
    o = this.countWords(s);
    t.s.l += t.r * s.length;
    t.s.w += t.r * o;
    t.s.wmin += o;
    t.s.wmax += o;
    t.s.lmin += s.length;
    t.s.lmax += s.length;
    return t
};
Spinner.prototype.step = 0;
Spinner.prototype.maxStep = 0;
Spinner.prototype.random = false;
Spinner.prototype.node = false;
Spinner.prototype.container = false;
Spinner.prototype.counter = false;
Spinner.prototype.letterRegex = new RegExp("[^A-Za-z\u00AA\u00B5\u00BA\u00C0-\u00D6\u00D8-\u00F6\u00F8-\u02C1\u02C6-\u02D1\u02E0-\u02E4\u02EC\u02EE\u0370-\u0374\u0376\u0377\u037A-\u037D\u0386\u0388-\u038A\u038C\u038E-\u03A1\u03A3-\u03F5\u03F7-\u0481\u048A-\u0525\u0531-\u0556\u0559\u0561-\u0587\u05D0-\u05EA\u05F0-\u05F2\u0621-\u064A\u066E\u066F\u0671-\u06D3\u06D5\u06E5\u06E6\u06EE\u06EF\u06FA-\u06FC\u06FF\u0710\u0712-\u072F\u074D-\u07A5\u07B1\u07CA-\u07EA\u07F4\u07F5\u07FA\u0800-\u0815\u081A\u0824\u0828\u0904-\u0939\u093D\u0950\u0958-\u0961\u0971\u0972\u0979-\u097F\u0985-\u098C\u098F\u0990\u0993-\u09A8\u09AA-\u09B0\u09B2\u09B6-\u09B9\u09BD\u09CE\u09DC\u09DD\u09DF-\u09E1\u09F0\u09F1\u0A05-\u0A0A\u0A0F\u0A10\u0A13-\u0A28\u0A2A-\u0A30\u0A32\u0A33\u0A35\u0A36\u0A38\u0A39\u0A59-\u0A5C\u0A5E\u0A72-\u0A74\u0A85-\u0A8D\u0A8F-\u0A91\u0A93-\u0AA8\u0AAA-\u0AB0\u0AB2\u0AB3\u0AB5-\u0AB9\u0ABD\u0AD0\u0AE0\u0AE1\u0B05-\u0B0C\u0B0F\u0B10\u0B13-\u0B28\u0B2A-\u0B30\u0B32\u0B33\u0B35-\u0B39\u0B3D\u0B5C\u0B5D\u0B5F-\u0B61\u0B71\u0B83\u0B85-\u0B8A\u0B8E-\u0B90\u0B92-\u0B95\u0B99\u0B9A\u0B9C\u0B9E\u0B9F\u0BA3\u0BA4\u0BA8-\u0BAA\u0BAE-\u0BB9\u0BD0\u0C05-\u0C0C\u0C0E-\u0C10\u0C12-\u0C28\u0C2A-\u0C33\u0C35-\u0C39\u0C3D\u0C58\u0C59\u0C60\u0C61\u0C85-\u0C8C\u0C8E-\u0C90\u0C92-\u0CA8\u0CAA-\u0CB3\u0CB5-\u0CB9\u0CBD\u0CDE\u0CE0\u0CE1\u0D05-\u0D0C\u0D0E-\u0D10\u0D12-\u0D28\u0D2A-\u0D39\u0D3D\u0D60\u0D61\u0D7A-\u0D7F\u0D85-\u0D96\u0D9A-\u0DB1\u0DB3-\u0DBB\u0DBD\u0DC0-\u0DC6\u0E01-\u0E30\u0E32\u0E33\u0E40-\u0E46\u0E81\u0E82\u0E84\u0E87\u0E88\u0E8A\u0E8D\u0E94-\u0E97\u0E99-\u0E9F\u0EA1-\u0EA3\u0EA5\u0EA7\u0EAA\u0EAB\u0EAD-\u0EB0\u0EB2\u0EB3\u0EBD\u0EC0-\u0EC4\u0EC6\u0EDC\u0EDD\u0F00\u0F40-\u0F47\u0F49-\u0F6C\u0F88-\u0F8B\u1000-\u102A\u103F\u1050-\u1055\u105A-\u105D\u1061\u1065\u1066\u106E-\u1070\u1075-\u1081\u108E\u10A0-\u10C5\u10D0-\u10FA\u10FC\u1100-\u1248\u124A-\u124D\u1250-\u1256\u1258\u125A-\u125D\u1260-\u1288\u128A-\u128D\u1290-\u12B0\u12B2-\u12B5\u12B8-\u12BE\u12C0\u12C2-\u12C5\u12C8-\u12D6\u12D8-\u1310\u1312-\u1315\u1318-\u135A\u1380-\u138F\u13A0-\u13F4\u1401-\u166C\u166F-\u167F\u1681-\u169A\u16A0-\u16EA\u1700-\u170C\u170E-\u1711\u1720-\u1731\u1740-\u1751\u1760-\u176C\u176E-\u1770\u1780-\u17B3\u17D7\u17DC\u1820-\u1877\u1880-\u18A8\u18AA\u18B0-\u18F5\u1900-\u191C\u1950-\u196D\u1970-\u1974\u1980-\u19AB\u19C1-\u19C7\u1A00-\u1A16\u1A20-\u1A54\u1AA7\u1B05-\u1B33\u1B45-\u1B4B\u1B83-\u1BA0\u1BAE\u1BAF\u1C00-\u1C23\u1C4D-\u1C4F\u1C5A-\u1C7D\u1CE9-\u1CEC\u1CEE-\u1CF1\u1D00-\u1DBF\u1E00-\u1F15\u1F18-\u1F1D\u1F20-\u1F45\u1F48-\u1F4D\u1F50-\u1F57\u1F59\u1F5B\u1F5D\u1F5F-\u1F7D\u1F80-\u1FB4\u1FB6-\u1FBC\u1FBE\u1FC2-\u1FC4\u1FC6-\u1FCC\u1FD0-\u1FD3\u1FD6-\u1FDB\u1FE0-\u1FEC\u1FF2-\u1FF4\u1FF6-\u1FFC\u2071\u207F\u2090-\u2094\u2102\u2107\u210A-\u2113\u2115\u2119-\u211D\u2124\u2126\u2128\u212A-\u212D\u212F-\u2139\u213C-\u213F\u2145-\u2149\u214E\u2183\u2184\u2C00-\u2C2E\u2C30-\u2C5E\u2C60-\u2CE4\u2CEB-\u2CEE\u2D00-\u2D25\u2D30-\u2D65\u2D6F\u2D80-\u2D96\u2DA0-\u2DA6\u2DA8-\u2DAE\u2DB0-\u2DB6\u2DB8-\u2DBE\u2DC0-\u2DC6\u2DC8-\u2DCE\u2DD0-\u2DD6\u2DD8-\u2DDE\u2E2F\u3005\u3006\u3031-\u3035\u303B\u303C\u3041-\u3096\u309D-\u309F\u30A1-\u30FA\u30FC-\u30FF\u3105-\u312D\u3131-\u318E\u31A0-\u31B7\u31F0-\u31FF\u3400-\u4DB5\u4E00-\u9FCB\uA000-\uA48C\uA4D0-\uA4FD\uA500-\uA60C\uA610-\uA61F\uA62A\uA62B\uA640-\uA65F\uA662-\uA66E\uA67F-\uA697\uA6A0-\uA6E5\uA717-\uA71F\uA722-\uA788\uA78B\uA78C\uA7FB-\uA801\uA803-\uA805\uA807-\uA80A\uA80C-\uA822\uA840-\uA873\uA882-\uA8B3\uA8F2-\uA8F7\uA8FB\uA90A-\uA925\uA930-\uA946\uA960-\uA97C\uA984-\uA9B2\uA9CF\uAA00-\uAA28\uAA40-\uAA42\uAA44-\uAA4B\uAA60-\uAA76\uAA7A\uAA80-\uAAAF\uAAB1\uAAB5\uAAB6\uAAB9-\uAABD\uAAC0\uAAC2\uAADB-\uAADD\uABC0-\uABE2\uAC00-\uD7A3\uD7B0-\uD7C6\uD7CB-\uD7FB\uF900-\uFA2D\uFA30-\uFA6D\uFA70-\uFAD9\uFB00-\uFB06\uFB13-\uFB17\uFB1D\uFB1F-\uFB28\uFB2A-\uFB36\uFB38-\uFB3C\uFB3E\uFB40\uFB41\uFB43\uFB44\uFB46-\uFBB1\uFBD3-\uFD3D\uFD50-\uFD8F\uFD92-\uFDC7\uFDF0-\uFDFB\uFE70-\uFE74\uFE76-\uFEFC\uFF21-\uFF3A\uFF41-\uFF5A\uFF66-\uFFBE\uFFC2-\uFFC7\uFFCA-\uFFCF\uFFD2-\uFFD7\uFFDA-\uFFDC]+", "gi");
Spinner.prototype.countWords = function(a) {
    var c = a.replace(this.letterRegex, " ").replace(/^ +/g, "").replace(/ +$/g, ""),
        b = 0;
    if (c !== "") {
        b = c.split(" ").length
    }
    return b
};
Spinner.prototype.start = function() {
    this.node = document.createElement("textarea");
    this.node.setAttribute("rows", 5);
    this.node.setAttribute("cols", 100);
    this.step = Math.round(parseFloat(document.getElementById("spinStart").value));
    this.maxStep = Math.round(this.step + parseFloat(document.getElementById("spinCount").value));
    this.display()
};
Spinner.prototype.setCounter = function(a) {
    this.counter.innerHTML = a + "/" + this.maxStep
};
Spinner.prototype.onChange = function() {
    this.startTimer("change", function() {
        Spinner.updateStats();
        if (Spinner.tree !== false) {
            document.getElementById("spinCount").value = Spinner.tree.r
        } else {
            document.getElementById("spinCount").value = 0
        }
    }, 200)
};
Spinner.prototype.updateStats = function() {
    var a = '<img src="/static/img/loadingSmall.gif" alt="Spinning"/>';
    document.getElementById("spinStatsResult").innerHTML = a;
    document.getElementById("spinStatsReplace").innerHTML = a;
    document.getElementById("spinStatsHole").innerHTML = a;
    document.getElementById("spinStatsLength").innerHTML = a;
    document.getElementById("spinStatsWords").innerHTML = a;
    document.getElementById("spinStatsReplacePerHole").innerHTML = a;
    document.getElementById("spinStatsHoleRate").innerHTML = a;
    document.getElementById("spinStatsReplaceRate").innerHTML = a;
    document.getElementById("spinStatsMinWords").innerHTML = a;
    document.getElementById("spinStatsMaxWords").innerHTML = a;
    document.getElementById("spinStatsMinLength").innerHTML = a;
    document.getElementById("spinStatsMaxLength").innerHTML = a;
    if (document.getElementById("spinStartBtn").style.display === "none") {
        this.clearTimer("spin");
        this.stop()
    }
    this.tree = this.getTree(this.getSpin());
    if (this.tree !== false) {
        document.getElementById("spinStatsResult").innerHTML = this.tree.r;
        document.getElementById("spinStatsReplace").innerHTML = this.tree.s.r;
        document.getElementById("spinStatsHole").innerHTML = this.tree.s.h;
        document.getElementById("spinStatsLength").innerHTML = this.tree.r > 0 ? Math.round(this.tree.s.l / this.tree.r * 100) / 100 : 0;
        document.getElementById("spinStatsWords").innerHTML = this.tree.r > 0 ? Math.round(this.tree.s.w / this.tree.r * 100) / 100 : 0;
        document.getElementById("spinStatsReplacePerHole").innerHTML = this.tree.s.h > 0 ? Math.round(this.tree.s.r / this.tree.s.h * 100) / 100 : 0;
        document.getElementById("spinStatsHoleRate").innerHTML = this.tree.s.w > 0 && this.tree.r > 0 ? Math.round(this.tree.s.h / (this.tree.s.w / this.tree.r) * 100 * 100) / 100 : 0;
        document.getElementById("spinStatsReplaceRate").innerHTML = this.tree.s.w > 0 && this.tree.r > 0 ? Math.round(this.tree.s.r / (this.tree.s.w / this.tree.r) * 100 * 100) / 100 : 0;
        document.getElementById("spinStatsMinWords").innerHTML = this.tree.s.wmin;
        document.getElementById("spinStatsMaxWords").innerHTML = this.tree.s.wmax;
        document.getElementById("spinStatsMinLength").innerHTML = this.tree.s.lmin;
        document.getElementById("spinStatsMaxLength").innerHTML = this.tree.s.lmax
    }
};
Spinner.prototype.lastError = false;
Spinner.prototype.timers = [];
Spinner.prototype.error = function(b, a) {
    this.clearTimer(b);
    if (this.lastError !== false) {
        this.clearTimer(this.lastError.timer);
        document.getElementById(this.lastError.id).style.display = "none"
    }
    this.lastError = {
        id: b + "-" + a,
        timer: b
    };
    document.getElementById(b + "-" + a).style.display = "";
    this.startTimer(b, function() {
        document.getElementById(Spinner.lastError.id).style.display = "none";
        Spinner.lastError = false
    }, 3000)
};
Spinner.prototype.startTimer = function(c, b, a) {
    this.clearTimer(c);
    this.timers[c] = window.setTimeout(b, a)
};
Spinner.prototype.clearTimer = function(a) {
    if (this.timers[a]) {
        window.clearTimeout(this.timers[a])
    }
    this.timers[a] = null
};
Spinner.prototype.spin = function() {
    var b = false;
    if (document.getElementById("spinStartBtn").style.display === "none") {
        b = true
    }
    this.clearTimer("spin");
    if (b === false) {
        this.counter = document.getElementById("spinCounter");
        this.container = document.getElementById("spinResults");
        if (this.tree === undefined) {
            this.updateStats()
        }
        if (this.tree !== false) {
            var c = Math.round(parseFloat(document.getElementById("spinCount").value));
            if (c === 0 || c > this.tree.r) {
                c = this.tree.r
            }
            document.getElementById("spinCount").value = c;
            if (c > 1000 && confirm("Generating " + c + " texts may freeze your browser ! Do you wish to continue ?") === false) {
                return false
            }
            if (document.getElementById("spinRandom").checked === true && c < this.tree.r) {
                document.getElementById("spinStart").value = 0;
                this.random = {
                    i: {},
                    v: []
                };
                for (var a = 0; a < c; a++) {
                    while (false !== (j = Math.floor(Math.random() * this.tree.r)) && this.random.i[j] !== undefined) {}
                    this.random.i[j] = 1;
                    this.random.v[this.random.v.length] = j
                }
                this.random = this.random.v
            } else {
                this.random = false
            }
            var d = Math.round(parseFloat(document.getElementById("spinStart").value));
            if (d >= c || d < 0) {
                this.error("spin", "2");
                return false
            }
            document.getElementById("spinStart").setAttribute("readonly", "readonly");
            document.getElementById("spinCount").setAttribute("readonly", "readonly");
            document.getElementById("spinStart").value = d;
            document.getElementById("spinStartBtn").style.display = "none";
            document.getElementById("spinStopBtn").style.display = "";
            this.setCounter(0);
            this.container.innerHTML = '<p class="loading"><img src="/static/img/loading.gif" alt="Spinning"/></p>';
            this.startTimer("spin", "Spinner.start();", 0);
            return true
        } else {
            document.getElementById("spinStartBtn").style.display = "";
            document.getElementById("spinStopBtn").style.display = "none";
            document.getElementById("spinStart").removeAttribute("readonly");
            document.getElementById("spinCount").removeAttribute("readonly");
            return false
        }
    } else {
        this.stop();
        return true
    }
};
Spinner.prototype.exportTimer = false;
Spinner.prototype.exportToUrl = function() {
    this.clearTimer("export");
    var b = document.getElementById("exportUrl").value,
        a = document.getElementById("spinResults");
    document.getElementById("export-0").style.display = "none";
    document.getElementById("export-1").style.display = "none";
    if (!a.firstChild || a.firstChild.tagName !== "TEXTAREA") {
        this.error("export", "1")
    } else {
        if (b !== "") {
            form = document.getElementById("formResults");
            if (form) {
                form.setAttribute("method", "post");
                form.setAttribute("target", "_blank");
                form.setAttribute("action", b);
                form.submit()
            }
        } else {
            this.error("export", "0")
        }
    }
};
Spinner.prototype.download = function() {
    this.clearTimer("download");
    container = document.getElementById("spinResults");
    document.getElementById("download-0").style.display = "none";
    if (!container.firstChild || container.firstChild.tagName !== "TEXTAREA") {
        this.error("download", "0")
    } else {
        form = document.getElementById("formResults");
        if (form) {
            form.setAttribute("method", "post");
            form.setAttribute("target", "_blank");
            form.setAttribute("action", "/dl");
            form.submit()
        }
    }
    return false
};
Spinner.prototype.stop = function() {
    document.getElementById("spinStartBtn").style.display = "";
    document.getElementById("spinStopBtn").style.display = "none";
    document.getElementById("spinStart").removeAttribute("readonly");
    document.getElementById("spinCount").removeAttribute("readonly");
    this.container.removeChild(this.container.firstChild);
    this.setCounter(this.container.childNodes.length);
    this.step = Math.round(parseFloat(document.getElementById("spinStart").value))
};
Spinner.prototype.display = function() {
    if ((this.step + 1) !== this.container.childNodes.length) {
        this.startTimer("spin", "Spinner.display();", 0)
    } else {
        var b = 0,
            a = Math.min(this.maxStep, this.step + 10);
        for (b = this.step; b < a; b++) {
            this.node.value = this.getText(this.tree, this.random !== false ? this.random[b] : b);
            this.node.setAttribute("name", "txt[]");
            this.container.appendChild(this.node);
            this.node = this.node.cloneNode(false)
        }
        this.step = b;
        this.setCounter(this.step);
        if (this.step < this.maxStep) {
            this.startTimer("spin", "Spinner.display();", 0)
        } else {
            this.stop()
        }
    }
};
Spinner.prototype.getSelection = function() {
    return window.aceEditor.getSession().doc.getTextRange(window.aceEditor.getSelectionRange())
};
Spinner.prototype.find = function(a, b) {
    a = !a ? document.getElementById("replaceSearch").value : a;
    window.aceEditor.find(a);
    if (window.aceEditor.selection.isEmpty()) {
        if (b === true) {
            if (window.aceEditor.selection.isEmpty()) {
                this.error("search", "0")
            }
        }
        return false
    } else {
        return true
    }
};
Spinner.prototype.replace = function(b, a, c) {
    if (window.aceEditor.selection.isEmpty() === false) {
        window.aceEditor.navigateLeft()
    }
    if (this.find(b, true) === true) {
        window.aceEditor.navigateLeft();
        if (c === true) {
            window.aceEditor.replaceAll(a)
        } else {
            window.aceEditor.replace(a)
        }
        window.aceEditor.navigateRight()
    }
};
Spinner.prototype.getSynonyms = function(a) {
    this.clearTimer("syn");
    labsAjax.post("/syn?q=" + a + "&l=" + labsElement.getValue("synLanguage"), function(e, c, b, d) {
        Spinner.updateSynonyms(e, c, b, d)
    }, [], false);
    labsElement.setDisplayStyle("synSynonymsBtn", "none");
    labsElement.setDisplayStyle("synSynonymsLoad", "");
    return false
};
Spinner.prototype.updateSynonyms = function(f, b, a, c) {
    labsElement.setDisplayStyle("synSynonymsBtn", "");
    labsElement.setDisplayStyle("synSynonymsLoad", "none");
    if (a != 200) {
        this.error("syn", "0")
    } else {
        try {
            b = JSON.parse(b);
            if (typeof(b) !== "object" || !b.length) {
                b = []
            }
            for (var d = 0; d < b.length; d++) {
                this.synAdd(b[d])
            }
            if (d === 0) {
                this.error("syn", "2")
            }
        } catch (e) {
            this.error("syn", "1")
        }
    }
};
Spinner.prototype.replaceBar = function(a) {
    var c = document.getElementById("replaceBar");
    if (a === true) {
        c.style.display = "";
        var b = this.getSelection();
        if (b !== "") {
            document.getElementById("replaceSearch").value = b;
            document.getElementById("replaceReplace").focus()
        }
    } else {
        c.style.display = "none"
    }
    return false
};
Spinner.prototype.synBar = function(a) {
    var c = document.getElementById("synBar");
    if (a === true) {
        c.style.display = "";
        var b = this.getSelection();
        if (b !== "") {
            document.getElementById("synSearch").value = b;
            document.getElementById("synSynonymsSearch").value = b;
            this.synSelectAll();
            this.synRemoveSelected();
            document.getElementById("synReplace").focus()
        }
    } else {
        c.style.display = "none"
    }
    return false
};
Spinner.prototype.spinBar = function(a) {
    var b = document.getElementById("spinBar");
    if (a === true) {
        b.style.display = ""
    } else {
        b.style.display = "none"
    }
    return false
};
Spinner.prototype.exportBar = function(a) {
    var b = document.getElementById("exportBar");
    if (a === true) {
        b.style.display = ""
    } else {
        b.style.display = "none"
    }
    return false
};
Spinner.prototype.synAdd = function(b) {
    var c = false,
        a = labsMultiCheckbox.get("synReplacements");
    if (!b) {
        b = document.getElementById("synReplace").value;
        labsElement.setValue("synReplace", "");
        c = true
    }
    a.add(b, b, c);
    if (a.length === 1) {
        labsElement.setDisplayStyle("synSelectAllBtn", "");
        labsElement.setDisplayStyle("synInvert", "");
        labsElement.setDisplayStyle("synRemoveSelectedBtn", "")
    }
    return false
};
Spinner.prototype.synSelectAll = function() {
    labsMultiCheckbox.get("synReplacements").selectAll()
};
Spinner.prototype.synInvert = function() {
    labsMultiCheckbox.get("synReplacements").invert()
};
Spinner.prototype.synRemoveSelected = function() {
    labsMultiCheckbox.get("synReplacements").removeSelected()
};
Spinner.prototype.synGetReplace = function() {
    var a = labsMultiCheckbox.get("synReplacements"),
        c = document.getElementById("synSearch").value,
        b = 0,
        d = [];
    d = a.getValues();
    if (d.length === 0) {
        return c
    }
    c = [c];
    for (b = 0; b < d.length; b++) {
        c[c.length] = d[b]
    }
    return "{" + c.join("|") + "}"
};
Spinner.prototype.getSpin = function() {
    return window.aceEditor.getSession().getValue()
};
var Spinner = new Spinner();
define("ace/theme/eclipse", ["require", "exports", "module"], function(g, f, m) {
    var k = g("pilot/dom"),
        h = ".ace-eclipse .ace_editor {  border: 2px solid rgb(159, 159, 159);}.ace-eclipse .ace_editor.ace_focus {  border: 2px solid #327fbd;}.ace-eclipse .ace_gutter {  width: 50px;  background: rgb(227, 227, 227);  border-right: 1px solid rgb(159, 159, 159);\t   color: rgb(136, 136, 136);}.ace-eclipse .ace_gutter-layer {  width: 100%;  text-align: right;}.ace-eclipse .ace_gutter-layer .ace_gutter-cell {  padding-right: 6px;}.ace-eclipse .ace_print_margin {  width: 1px;  background: #b1b4ba;}.ace-eclipse .ace_text-layer {  cursor: text;}.ace-eclipse .ace_cursor {  border-left: 1px solid black;}.ace-eclipse .ace_line .ace_keyword, .ace-eclipse .ace_line .ace_variable {  color: rgb(127, 0, 85);}.ace-eclipse .ace_line .ace_constant.ace_buildin {  color: rgb(88, 72, 246);}.ace-eclipse .ace_line .ace_constant.ace_library {  color: rgb(6, 150, 14);}.ace-eclipse .ace_line .ace_function {  color: rgb(60, 76, 114);}.ace-eclipse .ace_line .ace_string {  color: rgb(42, 0, 255);}.ace-eclipse .ace_line .ace_comment {  color: rgb(63, 127, 95);}.ace-eclipse .ace_line .ace_comment.ace_doc {  color: rgb(63, 95, 191);}.ace-eclipse .ace_line .ace_comment.ace_doc.ace_tag {  color: rgb(127, 159, 191);}.ace-eclipse .ace_line .ace_constant.ace_numeric {}.ace-eclipse .ace_line .ace_tag {  color: rgb(63, 127, 127);}.ace-eclipse .ace_line .ace_type {  color: rgb(127, 0, 127);}.ace-eclipse .ace_line .ace_xml_pe {  color: rgb(104, 104, 91);}.ace-eclipse .ace_marker-layer .ace_selection {  background: rgb(181, 213, 255);}.ace-eclipse .ace_marker-layer .ace_bracket {  margin: -1px 0 0 -1px;  border: 1px solid rgb(192, 192, 192);}.ace-eclipse .ace_line .ace_meta.ace_tag {  color:rgb(63, 127, 127);}.ace-eclipse .ace_entity.ace_other.ace_attribute-name {  color:rgb(127, 0, 127);}.ace-eclipse .ace_marker-layer .ace_active_line {  background: rgb(232, 242, 254);}";
    k.importCssString(h), f.cssClass = "ace-eclipse"
});