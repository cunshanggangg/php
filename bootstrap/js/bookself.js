function _extends(t, e) {
    for (var o in t) for (var n in e) n === o && (t[o] = e[o]);
    return t
}

function Modal(t) {
    var e = this, o = {
        type: "alert",
        title: "提示",
        content: "",
        overlay: !0,
        overlayBackground: "rgba(0,0,0,0.4)",
        buttonClose: !1,
        buttonConfirmText: "确定",
        buttonConfirmClass: "",
        buttonCancelText: "取消",
        buttonCancelClass: "",
        buttons: [],
        onConfirmButtonCallback: null,
        onCancelButtonCallback: null,
        onBeforeShow: null,
        onShow: null,
        onBeforeClose: null,
        onClosedCallback: null
    };
    e.settings = _extends(o, t || {}), e._init()
}

function Toast(t) {
    var e = this, o = {
        message: "",
        icon: "",
        duration: 2e3,
        position: "middle",
        overlay: !0,
        overlayBackground: "rgba(0,0,0,0)",
        onClosedCallback: null
    };
    e.settings = _extends(o, t || {}), e._init()
}

function historyGoBack() {
    var t = mobileUtil.getSearch().channel || "wxbookbenzhan", e = mobileUtil.getSearch().platform || "H5";
    "" !== document.referrer ? window.history.go(-1) : window.location.replace(g_data.url.home + "&channel=" + t + "&platform=" + e)
}

function getUserId() {
    return $("#gg").val() || ""
}

function redirectLogin(t) {
    var e = t || window.location.href, o = "", n = "";
    if (mobileUtil.isWeiXin) console.log("未登录, 重定向到微信授权页"), n = encodeURIComponent(g_data.url.loginByWechat + "&from=" + e), o = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxef465f9989986e85&redirect_uri=" + n + "&response_type=code&scope=snsapi_userinfo&state=weChat#wechat_redirect"; else {
        console.log("未登录, 重定向到 H5 登录页面"), n = encodeURIComponent(e);
        var a = mobileUtil.getSearch().channel || "wxbookbenzhan", i = mobileUtil.getSearch().platform || "H5";
        o = g_data.url.login + "?platform=" + i + "&channel=" + a + "&redirect=" + n
    }
    window.location.href = o
}

function loginByWechat(t) {
    var e = t || g_data.url.home, o = encodeURIComponent(g_data.url.loginByWechat + "&from=" + e),
        n = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxef465f9989986e85&redirect_uri=" + o + "&response_type=code&scope=snsapi_userinfo&state=weChat#wechat_redirect";
    window.location.replace(n)
}

function loginRedirect() {
    var t = mobileUtil.getSearch().redirect ? decodeURIComponent(mobileUtil.getSearch().redirect) : g_data.url.userIndex;
    window.location.replace(t)
}

function redirectLoginToast(t, e) {
    var o = t || "请先登录", n = e || redirectLogin();
    new Toast({
        message: o, overlay: !1, duration: 1500, onClosedCallback: function () {
            n()
        }
    })
}

function getUrlQuery() {
    var t = mobileUtil.getSearch().platform || "H5";
    return {
        platform: t,
        channel: mobileUtil.getSearch().channel || "wxbookbenzhan",
        vps: "1#" + t + "#MicroMessenger/6.5.6#00000000000000#128#540_960#0.0.0"
    }
}

function get(t, e, o, n, a) {
    var o = o || "json";
    $.ajax({
        type: "GET", url: t, data: e, async: !0, cache: !1, dataType: o, timeout: 0, success: function (t) {
            n && n(t)
        }, error: function (t, e) {
            a && a(t, e)
        }
    })
}

function post(t, e, o, n, a) {
    var o = o || "json";
    $.ajax({
        type: "POST", url: t, data: e, async: !0, cache: !1, dataType: o, timeout: 0, success: function (t) {
            n && n(t)
        }, error: function (t, e) {
            a && a(t, e)
        }
    })
}

window.mobileUtil = function (t, e) {
    var o = navigator.userAgent, n = /android|adr/gi.test(o), a = /iphone|ipod|ipad/gi.test(o) && !n, i = n || a,
        s = !!o.match(/MicroMessenger/i), r = a ? "ios" : n ? "android" : "default",
        l = a ? /os [\d._]*/gi : /android [\d._]*/gi, c = o.match(l),
        d = (c + "").replace(/[^0-9|_.]/gi, "").replace(/_/gi, ".");
    return {
        isAndroid: n,
        isIOS: a,
        isMobile: i,
        isWeiXin: s,
        platform: r,
        version: parseFloat(d),
        tapEvent: i ? "tap" : "click",
        getSearch: function (t) {
            t = t || e.location.search;
            var o = {}, n = new RegExp("([^?=&]+)(=([^&]*))?", "g");
            return t && t.replace(n, function (t, e, n, a) {
                o[e] = a
            }), o
        },
        setPlatformIdentify: function () {
            var t = document.getElementsByTagName("html")[0], e = t.getAttribute("class") || "", o = r + " " + e;
            t.setAttribute("class", o)
        },
        setShowLimit: function () {
            var t = "limit-normal", e = document.querySelector("html");
            s && (t = "limit-wechat"), e.classList.add(t)
        }()
    }
}(document, window), function () {
    "use strict";

    function t(e, o, n) {
        return ("string" == typeof o ? o : o.toString()).replace(e.define || i, function (t, o, a, i) {
            return 0 === o.indexOf("def.") && (o = o.substring(4)), o in n || (":" === a ? (e.defineParams && i.replace(e.defineParams, function (t, e, a) {
                n[o] = {arg: e, text: a}
            }), o in n || (n[o] = i)) : new Function("def", "def['" + o + "']=" + i)(n)), ""
        }).replace(e.use || i, function (o, a) {
            e.useParams && (a = a.replace(e.useParams, function (t, e, o, a) {
                if (n[o] && n[o].arg && a) {
                    var i = (o + ":" + a).replace(/'|\\/g, "_");
                    return n.__exp = n.__exp || {}, n.__exp[i] = n[o].text.replace(new RegExp("(^|[^\\w$])" + n[o].arg + "([^\\w$])", "g"), "$1" + a + "$2"), e + "def.__exp['" + i + "']"
                }
            }));
            var i = new Function("def", "return " + a)(n);
            return i ? t(e, i, n) : i
        })
    }

    function e(t) {
        return t.replace(/\\('|\\)/g, "$1").replace(/[\r\t\n]/g, " ")
    }

    var o, n = {
        name: "doT",
        version: "1.1.1",
        templateSettings: {
            evaluate: /\{\{([\s\S]+?(\}?)+)\}\}/g,
            interpolate: /\{\{=([\s\S]+?)\}\}/g,
            encode: /\{\{!([\s\S]+?)\}\}/g,
            use: /\{\{#([\s\S]+?)\}\}/g,
            useParams: /(^|[^\w$])def(?:\.|\[[\'\"])([\w$\.]+)(?:[\'\"]\])?\s*\:\s*([\w$\.]+|\"[^\"]+\"|\'[^\']+\'|\{[^\}]+\})/g,
            define: /\{\{##\s*([\w\.$]+)\s*(\:|=)([\s\S]+?)#\}\}/g,
            defineParams: /^\s*([\w$]+):([\s\S]+)/,
            conditional: /\{\{\?(\?)?\s*([\s\S]*?)\s*\}\}/g,
            iterate: /\{\{~\s*(?:\}\}|([\s\S]+?)\s*\:\s*([\w$]+)\s*(?:\:\s*([\w$]+))?\s*\}\})/g,
            varname: "it",
            strip: !0,
            append: !0,
            selfcontained: !1,
            doNotSkipEncoded: !1
        },
        template: void 0,
        compile: void 0,
        log: !0
    };
    n.encodeHTMLSource = function (t) {
        var e = {"&": "&#38;", "<": "&#60;", ">": "&#62;", '"': "&#34;", "'": "&#39;", "/": "&#47;"},
            o = t ? /[&<>"'\/]/g : /&(?!#?\w+;)|<|>|"|'|\//g;
        return function (t) {
            return t ? t.toString().replace(o, function (t) {
                return e[t] || t
            }) : ""
        }
    }, o = function () {
        return this || (0, eval)("this")
    }(), "undefined" != typeof module && module.exports ? module.exports = n : "function" == typeof define && define.amd ? define(function () {
        return n
    }) : o.doT = n;
    var a = {
        append: {start: "'+(", end: ")+'", startencode: "'+encodeHTML("},
        split: {start: "';out+=(", end: ");out+='", startencode: "';out+=encodeHTML("}
    }, i = /$^/;
    n.template = function (s, r, l) {
        r = r || n.templateSettings;
        var c, d, u = r.append ? a.append : a.split, f = 0, p = r.use || r.define ? t(r, s, l || {}) : s;
        p = ("var out='" + (r.strip ? p.replace(/(^|\r|\n)\t* +| +\t*(\r|\n|$)/g, " ").replace(/\r|\n|\t|\/\*[\s\S]*?\*\//g, "") : p).replace(/'|\\/g, "\\$&").replace(r.interpolate || i, function (t, o) {
            return u.start + e(o) + u.end
        }).replace(r.encode || i, function (t, o) {
            return c = !0, u.startencode + e(o) + u.end
        }).replace(r.conditional || i, function (t, o, n) {
            return o ? n ? "';}else if(" + e(n) + "){out+='" : "';}else{out+='" : n ? "';if(" + e(n) + "){out+='" : "';}out+='"
        }).replace(r.iterate || i, function (t, o, n, a) {
            return o ? (f += 1, d = a || "i" + f, o = e(o), "';var arr" + f + "=" + o + ";if(arr" + f + "){var " + n + "," + d + "=-1,l" + f + "=arr" + f + ".length-1;while(" + d + "<l" + f + "){" + n + "=arr" + f + "[" + d + "+=1];out+='") : "';} } out+='"
        }).replace(r.evaluate || i, function (t, o) {
            return "';" + e(o) + "out+='"
        }) + "';return out;").replace(/\n/g, "\\n").replace(/\t/g, "\\t").replace(/\r/g, "\\r").replace(/(\s|;|\}|^|\{)out\+='';/g, "$1").replace(/\+''/g, ""), c && (r.selfcontained || !o || o._encodeHTML || (o._encodeHTML = n.encodeHTMLSource(r.doNotSkipEncoded)), p = "var encodeHTML = typeof _encodeHTML !== 'undefined' ? _encodeHTML : (" + n.encodeHTMLSource.toString() + "(" + (r.doNotSkipEncoded || "") + "));" + p);
        try {
            return new Function(r.varname, p)
        } catch (t) {
            throw"undefined" != typeof console && console.log("Could not create a template function: " + p), t
        }
    }, n.compile = function (t, e) {
        return n.template(t, null, e)
    }
}(), function (t, e) {
    function o(t) {
        var e = this, o = {type: "localStorage"};
        e.storeType = t || o.type
    }

    o.prototype = {
        constructor: "Store", support: function () {
            var t = this;
            try {
                return !!e[t.storeType]
            } catch (e) {
                console.log("No support " + t.storeType, e)
            }
        }, get: function (t) {
            var o = this, n = e[o.storeType].getItem(t);
            try {
                return JSON.parse(n)
            } catch (t) {
                return n
            }
        }, set: function (t, o) {
            var n = this;
            try {
                return e[n.storeType].setItem(t, JSON.stringify(o))
            } catch (a) {
                return e[n.storeType].setItem(t, o)
            }
        }, remove: function (t) {
            return e[this.storeType].removeItem(t)
        }, clear: function () {
            return e[this.storeType].clear()
        }
    };
    var n = new o, a = new o("sessionStorage");
    window.store = n, window.session = a
}(document, window), Modal.prototype = {
    constructor: Modal, _init: function () {
        var t = this;
        t.$body = $("body"), t.$modal = $('<div class="modal"></div>'), t.$modalOverlay = $('<div class="modal-overlay"></div>'), t.$modalWrap = $('<div class="modal-wrap"></div>'), t.$modalContent = $('<div class="modal-content"></div>'), t.$modalContentCloseButton = $('<div class="modal__close__button"></div>'), t.$modalContentHeader = $('<div class="modal-content__header"></div>'), t.$modalContentBody = $('<div class="modal-content__body"></div>'), t.$modalContentFooter = $('<div class="modal-content__footer"></div>'), t.$modalButtonGroup = $('<div class="modal-button__group"></div>'), t.$modalButtonCancel = $('<button class="modal-button">' + t.settings.buttonCancelText + "</button>"), t.$modalButtonCancel.addClass(t.settings.buttonCancelClass), t.$modalButtonConfirm = $('<button class="modal-button modal-button__primary">' + t.settings.buttonConfirmText + "</button>"), t.$modalButtonConfirm.addClass(t.settings.buttonConfirmClass), t.settings.onBeforeShow && t.settings.onBeforeShow(), t._renderModal()
    }, _bindEvents: function () {
        var t = this;
        t.$modalButtonConfirm.on("click", function () {
            var e = t.settings.onConfirmButtonCallback && t.settings.onConfirmButtonCallback();
            (void 0 === e || null === e || e) && t.closeModal()
        }).on("click", function (t) {
            t.preventDefault()
        }), t.$modalContentCloseButton.on("click", function () {
            t.settings.onCancelButtonCallback && t.settings.onCancelButtonCallback(), t.closeModal()
        }).on("click", function (t) {
            t.preventDefault()
        }), t.$modalButtonCancel.on("click", function () {
            t.settings.onCancelButtonCallback && t.settings.onCancelButtonCallback(), t.closeModal()
        }).on("click", function (t) {
            t.preventDefault()
        });
        var e = t.settings.buttons;
        e.length && $.each(e, function (e, o) {
            t.$modalButtonGroup.children("button").eq(e).on("click", function (e) {
                e.stopPropagation(), t.closeModal(), o.callback && o.callback()
            })
        }), t._stopTouchMove()
    }, _bindAnimationEnd: function () {
        var t = this;
        t.$modalContent.on("webkitAnimationEnd", function () {
            t._removeModal()
        })
    }, closeModal: function () {
        var t = this;
        t.settings.onBeforeClose && t.settings.onBeforeClose(), t.$modal.addClass("modal-hide"), t._bindAnimationEnd()
    }, _removeModal: function () {
        var t = this;
        t.$modal.remove(), t.settings.onClosedCallback && t.settings.onClosedCallback()
    }, _stopTapBug: function () {
        this.$modalOverlay.on("touchend", function (t) {
            t.preventDefault()
        })
    }, _stopTouchMove: function () {
        this.$modalOverlay.on("touchmove", function (t) {
            t.preventDefault()
        })
    }, _renderModal: function () {
        var t = this;
        t.settings.overlay && t._renderOverlay(), t.settings.buttonClose && t._renderButtonClose(), "" !== t.settings.title && (t.$modalContentHeader.html('<div class="modal-title">' + t.settings.title + "</div>"), t.$modalContent.append(t.$modalContentHeader)), t.$modalContentBody.html(t.settings.content), t.$modalContent.append(t.$modalContentBody), t._renderContentFooter(), t.$modalWrap.append(t.$modalContent), t.$modal.append(t.$modalWrap), t.$body.append(t.$modal), t.settings.onShow && t.settings.onShow(), t._bindEvents()
    }, _renderContentFooter: function () {
        var t = this;
        t._renderButtonGroup(), t.$modalContentFooter.append(t.$modalButtonGroup), t.$modalContent.append(t.$modalContentFooter)
    }, _renderOverlay: function () {
        var t = this;
        t.$modalOverlay.css({"background-color": t.settings.overlayBackground}), t.$modal.append(t.$modalOverlay)
    }, _renderButtonClose: function () {
        var t = this;
        t.$modalContent.append(t.$modalContentCloseButton)
    }, _renderButtonGroup: function () {
        var t = this, e = t.settings.type, o = t._getButtonGroupDirection();
        switch (e) {
            case"alert":
                t.$modalButtonGroup.append(t.$modalButtonConfirm);
                break;
            case"confirm":
                var n = t.settings.buttons;
                if (n.length) {
                    var a = [];
                    $.each(n, function (t, e) {
                        var o = '<button class="modal-button ' + e.style + '">' + e.text + "</button>";
                        a.push(o)
                    }), t.$modalButtonGroup.html(a.join(""))
                } else t.$modalButtonGroup.append(t.$modalButtonCancel).append(t.$modalButtonConfirm)
        }
        t.$modalButtonGroup.addClass(o)
    }, _getButtonGroupDirection: function () {
        return this.settings.buttons.length < 3 ? "modal-button__group_horizontal" : "modal-button__group_vertical"
    }
}, Toast.prototype = {
    constructor: Toast, _init: function () {
        var t = this;
        t.$body = $("body"), t.$toast = $('<div class="toast"></div>'), t.$toastOverlay = $('<div class="toast-overlay"></div>'), t.$toastContent = $('<div class="toast-content"></div>'), t.$toastIcon = $("<i></i>"), t.$toastContentIcon = $('<div class="toast-content__icon"></div>'), t.$toastContentMessage = $('<div class="toast-content__message"></div>'), t._renderToastDOM()
    }, _bindEvents: function () {
        var t = this;
        0 !== t.settings.duration && t._autoClose(), t._stopTouchMove()
    }, _bindAnimationEnd: function () {
        var t = this;
        t.$toastContent.on("webkitAnimationEnd", function () {
            t._removeToast()
        })
    }, _autoClose: function () {
        var t = this;
        t._autoCloseTimer = setTimeout(function () {
            t.close()
        }, t.settings.duration)
    }, close: function () {
        var t = this;
        t.$toast.addClass("toast-hide"), t._bindAnimationEnd()
    }, update: function (t) {
        var e = this, o = {
            message: "",
            icon: "",
            duration: 2e3,
            position: "middle",
            overlay: !0,
            overlayBackground: "rgba(0,0,0,0)",
            onClosedCallback: null
        };
        e.settings = _extends(o, t || {}), e._updateToastDOM()
    }, _updateToastDOM: function () {
        var t = this;
        if ("" !== t.settings.icon) {
            t.$toastIcon.removeAttr("class");
            var e = t._getToastIconClass();
            t.$toastIcon.addClass(e), t.$toastContentIcon.html(t.$toastIcon)
        }
        t.$toastContentMessage.html(t.settings.message), 0 !== t.settings.duration && t._autoClose()
    }, _removeToast: function () {
        var t = this;
        t.$toast.remove(), t.settings.onClosedCallback && t.settings.onClosedCallback()
    }, _stopTouchMove: function () {
        var t = this;
        t.$toastOverlay.on("touchmove", function (t) {
            t.preventDefault()
        }), t.$toastContent.on("touchmove", function (t) {
            t.preventDefault()
        })
    }, _renderToastDOM: function () {
        var t = this;
        t.settings.overlay && t._renderToastOverlay(), "" !== t.settings.icon && t._renderToastIcon(), t._renderToastContent(), t.$toast.append(t.$toastContent), t.$body.append(t.$toast), t._bindEvents()
    }, _renderToastContent: function () {
        var t = this, e = t._getToastPositionClass();
        "" !== t.settings.message && (t.$toastContentMessage.html(t.settings.message), t.$toastContent.append(t.$toastContentMessage)), t.$toastContent.addClass(e), t.$toast.append(t.$toastContent)
    }, _getToastPositionClass: function () {
        return "toast-content__" + this.settings.position
    }, _renderToastOverlay: function () {
        var t = this;
        t.$toastOverlay.css({"background-color": t.settings.overlayBackground}), t.$toast.append(t.$toastOverlay)
    }, _renderToastIcon: function () {
        var t = this, e = t._getToastIconClass();
        t.$toastIcon.addClass(e), t.$toastContentIcon.append(t.$toastIcon), t.$toastContent.append(t.$toastContentIcon)
    }, _getToastIconClass: function () {
        return "iconfont icon-" + this.settings.icon
    }
}, function (t, e, o, n) {
    var a = t(e);
    t.fn.lazyload = function (o) {
        function i() {
            var e = 0;
            r.each(function () {
                var o = t(this);
                if (!l.skip_invisible || "none" !== o.css("display")) if (t.abovethetop(this, l) || t.leftofbegin(this, l)) ; else if (t.belowthefold(this, l) || t.rightoffold(this, l)) {
                    if (++e > l.failure_limit) return !1
                } else o.trigger("appear"), e = 0
            })
        }

        var s, r = this, l = {
            threshold: 0,
            failure_limit: 0,
            event: "scroll",
            effect: "show",
            container: e,
            data_attribute: "original",
            skip_invisible: !0,
            appear: null,
            load: null
        };
        return o && (n !== o.failurelimit && (o.failure_limit = o.failurelimit, delete o.failurelimit), n !== o.effectspeed && (o.effect_speed = o.effectspeed, delete o.effectspeed), t.extend(l, o)), s = l.container === n || l.container === e ? a : t(l.container), 0 === l.event.indexOf("scroll") && s.on(l.event, function () {
            return i()
        }), this.each(function () {
            var e = this, o = t(e);
            e.loaded = !1, o.one("appear", function () {
                if (!this.loaded) {
                    if (l.appear) {
                        var n = r.length;
                        l.appear.call(e, n, l)
                    }
                    t("<img />").on("load", function () {
                        var n, a;
                        o.hide().attr("src", o.data(l.data_attribute))[l.effect](l.effect_speed), e.loaded = !0, n = t.grep(r, function (t) {
                            return !t.loaded
                        }), r = t(n), l.load && (a = r.length, l.load.call(e, a, l))
                    }).attr("src", o.data(l.data_attribute))
                }
            }), 0 !== l.event.indexOf("scroll") && o.on(l.event, function () {
                e.loaded || o.trigger("appear")
            })
        }), a.on("resize", function () {
            i()
        }), /iphone|ipod|ipad.*os 5/gi.test(navigator.appVersion) && a.on("pageshow", function (e) {
            e = e.originalEvent || e, e.persisted && r.each(function () {
                t(this).trigger("appear")
            })
        }), t(e).on("load", function () {
            i()
        }), this
    }, t.belowthefold = function (o, i) {
        return (i.container === n || i.container === e ? a.height() + a.scrollTop() : t(i.container).offset().top + t(i.container).height()) <= t(o).offset().top - i.threshold
    }, t.rightoffold = function (o, i) {
        return (i.container === n || i.container === e ? a.width() + a[0].scrollX : t(i.container).offset().left + t(i.container).width()) <= t(o).offset().left - i.threshold
    }, t.abovethetop = function (o, i) {
        return (i.container === n || i.container === e ? a.scrollTop() : t(i.container).offset().top) >= t(o).offset().top + i.threshold + t(o).height()
    }, t.leftofbegin = function (o, i) {
        return (i.container === n || i.container === e ? a[0].scrollX : t(i.container).offset().left) >= t(o).offset().left + i.threshold + t(o).width()
    }, t.inviewport = function (e, o) {
        return !(t.rightoffold(e, o) || t.leftofbegin(e, o) || t.belowthefold(e, o) || t.abovethetop(e, o))
    }, t.extend(t.fn, {
        "below-the-fold": function (e) {
            return t.belowthefold(e, {threshold: 0})
        }, "above-the-top": function (e) {
            return !t.belowthefold(e, {threshold: 0})
        }, "right-of-screen": function (e) {
            return t.rightoffold(e, {threshold: 0})
        }, "left-of-screen": function (e) {
            return !t.rightoffold(e, {threshold: 0})
        }, "in-viewport": function (e) {
            return t.inviewport(e, {threshold: 0})
        }, "above-the-fold": function (e) {
            return !t.belowthefold(e, {threshold: 0})
        }, "right-of-fold": function (e) {
            return t.rightoffold(e, {threshold: 0})
        }, "left-of-fold": function (e) {
            return !t.rightoffold(e, {threshold: 0})
        }
    })
}($, window, document), function (t, e) {
    function o(t) {
        var e = this, o = {storeKey: "PAGE_GUIDE", step: ".js-page-guide-step"};
        e.setttings = _extends(o, t || {}), e._init()
    }

    o.prototype = {
        constructor: o, _init: function () {
            var t = this;
            t.pageGuideStoreKey = t.setttings.storeKey, t.pageGuideStoreValue = store.get(t.pageGuideStoreKey) || [], t.$pageGuideStep = $(t.setttings.step), t.$currentPage = $('[data-guide="page-guide"]'), t.currentPageGuideName = t.$currentPage.attr("data-name");
            var e = t._checkIsShow();
            t._bindEvents(), e || (t.show(), t.setStore())
        }, _bindEvents: function () {
            var t = this;
            t.onNextStep(), t._stopMove()
        }, onNextStep: function () {
            var t = this;
            t.$pageGuideStep.on("click", function (e) {
                e.stopPropagation(), e.preventDefault();
                var o = $(this).attr("data-next");
                if (void 0 === o) t.$currentPage.hide(); else {
                    var n = $('.js-page-guide-step[data-step="' + o + '"]');
                    t.$pageGuideStep.hide(), n.show()
                }
            })
        }, _stopMove: function () {
            this.$currentPage.on("touchmove", function (t) {
                t.preventDefault()
            })
        }, show: function () {
            this.$currentPage.show()
        }, hide: function () {
            this.$currentPage.hide()
        }, setStore: function () {
            var t = this;
            t.pageGuideStoreValue.push(t.currentPageGuideName), store.set(t.pageGuideStoreKey, t.pageGuideStoreValue)
        }, removeStore: function (t) {
            for (var e = this, o = 0; o < e.pageGuideStoreValue.length; o++) e.pageGuideStoreValue[o] === t && e.pageGuideStoreValue.splice(o, 1);
            store.set(e.pageGuideStoreKey, e.pageGuideStoreValue)
        }, _checkIsShow: function () {
            var t = this;
            if (t.pageGuideStoreValue) {
                for (var e = 0; e < t.pageGuideStoreValue.length; e++) if (t.pageGuideStoreValue[e] === t.currentPageGuideName) return !0;
                return !1
            }
            return !1
        }
    }, e.PageGuide = o
}(document, window), function (t) {
    t.urlQuery = {
        get: function () {
            return {
                platform: mobileUtil.getSearch().platform || "H5",
                channel: mobileUtil.getSearch().channel || "wxbookbenzhan"
            }
        }, concat: function () {
            var t = this, e = $.param(t.get());
            $("a").each(function (o, n) {
                var a = $(n), i = a.attr("href");
                if ("true" !== a.attr("data-native") & "#" !== i && !/javascript/gi.test(i)) if (/\?/gi.test(i)) {
                    var s = i.substring(0, i.indexOf("?")), r = i.substring(i.indexOf("?")),
                        l = mobileUtil.getSearch(r), c = $.extend(l, t.get());
                    a.attr({href: s + "?" + $.param(c)})
                } else a.attr({href: i + "?" + e})
            })
        }
    }
}(window), function (t) {
    var e = store.get("BOOKSHELF") || [];
    t.addBookshelfStore = {
        get: function (t) {
            var o = this.checkRecord(t, e);
            return {hasCache: o.hasCache, index: o.index, list: e}
        }, set: function (t, o) {
            var n = this.checkRecord(t, e), a = {bid: t, cid: o};
            n.hasCache ? (console.log("有记录, 重新缓存"), e[n.index] = a) : (console.log("没有记录, 添加"), e.push(a)), store.set("BOOKSHELF", e)
        }, remove: function (t) {
            var o = this.checkRecord(t, e);
            o.hasCache && (e.splice(o.index, 1), store.set("BOOKSHELF", e))
        }, checkRecord: function (t, e) {
            for (var o = {
                hasCache: !1,
                index: -1
            }, n = 0; n < e.length; n++) e[n].bid === t && (o.hasCache = !0, o.index = n);
            return o
        }
    }
}(window), function (t) {
    var e = store.get("RECENTLY_READ") || [];
    t.recentlyReadStore = {
        get: function (t) {
            var o = this.checkRecord(t, e);
            return {hasCache: o.hasCache, index: o.index, list: e}
        }, set: function (t) {
        }, remove: function (t) {
            var o = this.checkRecord(t, e);
            o.hasCache && (e.splice(o.index, 1), store.set("RECENTLY_READ", e))
        }, checkRecord: function (t, e) {
            for (var o = {
                hasCache: !1,
                index: -1
            }, n = 0; n < e.length; n++) e[n].bid === t && (o.hasCache = !0, o.index = n);
            return o
        }
    }
}(window), function (t, e) {
    function o(t) {
        var e = this, o = {button: ".js-nav-toggle", buttonActive: "active", nav: ".js-popup-nav", navOpen: "active"};
        e.settings = _extends(o, t || {}), e._init()
    }

    o.prototype = {
        constructor: o, _init: function () {
            var t = this;
            t.$body = $("body"), t.$toggleButton = $(t.settings.button), t.$popupNav = $(t.settings.nav), t.$popupNavOverlay = t.$popupNav.find(".js-popup-nav-overlay"), t._bindEvents()
        }, _bindEvents: function () {
            var t = this;
            t.onToggle(), t.onDocument()
        }, onToggle: function () {
            var t = this;
            t.$toggleButton.on("click", function (e) {
                e.preventDefault(), e.stopPropagation(), $(this).hasClass("active") ? t.close() : (t.open(), t.addPrevent())
            }), t.$popupNavOverlay.on("click touchmove", function (e) {
                e.preventDefault(), e.stopPropagation(), t.close()
            })
        }, onDocument: function () {
            var t = this;
            $(document).on("click", function (e) {
                t.close()
            })
        }, open: function () {
            var t = this;
            t.$toggleButton.addClass(t.settings.buttonActive).attr({title: "收起菜单"}), t.$popupNav.addClass(this.settings.navOpen)
        }, close: function () {
            var t = this;
            t.$toggleButton.removeClass(t.settings.buttonActive).attr({title: "展开菜单"}), t.$popupNav.removeClass(this.settings.navOpen)
        }, addPrevent: function () {
            this.$popupNav.on("touchmove", function (t) {
                t.preventDefault()
            })
        }
    }, e.ToggleNav = o
}(document, window), function (t, e) {
    function o(t) {
        var e = this, o = {
            openButton: ".js-open-header-action-btn",
            closeButton: ".js-close-header-action-btn",
            activeClass: "active",
            onOpenButtonCallback: null
        };
        e.settings = _extends(o, t || {}), e._init()
    }

    o.prototype = {
        constructor: o, _init: function () {
            var t = this;
            t.$body = $("body"), t.$openButton = $(t.settings.openButton), t.$closeButton = $(t.settings.closeButton), t._bindEvents()
        }, _bindEvents: function () {
            var t = this;
            t.onOpen(), t.onClose()
        }, onOpen: function () {
            var t = this;
            t.$openButton.on("click", function (e) {
                e.preventDefault();
                var o = t.settings.onOpenButtonCallback && t.settings.onOpenButtonCallback();
                (void 0 === o || null === o || o) && t._getTarget($(this).attr("data-rel")).addClass(t.settings.activeClass)
            })
        }, onClose: function () {
            var t = this;
            t.$closeButton.on("click", function (e) {
                e.preventDefault(), t._getTarget($(this).attr("data-rel")).removeClass(t.settings.activeClass)
            })
        }, _getTarget: function (t) {
            return $("#" + t)
        }
    }, e.HeaderAction = o
}(document, window), function (t, e) {
    var o = getUrlQuery();
    $("#wc_sid").val();
    e.bookshelfRequest = {
        add: function (t, e, n) {
            get(g_data.url.basePath + "?m=Home&c=BookCollect&a=addcollect", {
                bookid: t.bookId,
                menuid: t.chapterId,
                pName: t.chapterName ? encodeURIComponent(t.chapterName) : "",
                vps: o.vps,
                channel: o.channel,
                platform: o.platform
            }, "", e, n)
        }, del: function (t, e, n) {
            get(g_data.url.basePath + "?m=Home&c=BookCollect&a=delBookCollect", {
                bookids: t,
                vps: o.vps,
                channel: o.channel,
                platform: o.platform,
                wc_sid: o.wc_sid
            }, "", e, n)
        }, list: function (t, e) {
            get(g_data.url.basePath + "?m=Home&c=BookCollect&a=collectlist", {
                vps: o.vps,
                channel: o.channel,
                platform: o.platform,
                wc_sid: o.wc_sid
            }, "", t, e)
        }
    }
}(document, window), function (t, e) {
    function o(t) {
        var e = this, o = {bookListWrapper: "#bookshelf", successCallback: null};
        e.settings = _extends(o, t || {}), e._init()
    }

    var n = [];
    o.prototype = {
        constructor: o, _init: function () {
            var t = this;
            t.$body = $("body"), t.$bookListWrapper = $(t.settings.bookListWrapper), t.hasInit = !1, t._bindEvents()
        }, _bindEvents: function () {
            var t = this;
            t.getList(), t.onLoadAgain()
        }, onLoadAgain: function () {
            var t = this;
            $(document).on("click", ".js-load-again", function (e) {
                e.stopPropagation(), e.preventDefault(), getUserId() ? t.getList() : t._setUnLogin()
            })
        }, update: function () {
            console.log("update....");
            var t = this;
            t.hasInit && t.getList()
        }, getList: function () {
            var t = this;
            t.hasInit || t._setPageLoading(), bookshelfRequest.list(function (e) {
                console.log("书架内容 =>>", e);
                var o = {
                    list: e,
                    basePath: g_data.url.basePath,
                    home: g_data.url.home,
                    bookCatalogUrl: g_data.url.bookCatalog,
                    bookIntroductionUrl: g_data.url.bookIntroduction,
                    bookReadUrl: g_data.url.bookRead
                };
                n = [];
                for (var a = 0; a < o.list.length; a++) {
                    var i = o.list[a];
                    i.readPid = "0" === i.readPid ? "1" : i.readPid;
                    var s = {bid: i.bookid, cid: i.readPid};
                    n.push(s)
                }
                var r = doT.template($("#tpl-bookshelf").html());
                t.$bookListWrapper.html(r(o)), t.hasInit = !0, t._resetBookshelfStore(), t.settings.successCallback && t.settings.successCallback(), $("img.lazy").lazyload(), $("body").scroll(), urlQuery.concat()
            }, function (e) {
                console.log("网络异常", e), t._setPageLoadError()
            })
        }, _setUnLogin: function () {
            var t = mobileUtil.isWeiXin ? "微信安全登录" : "立即登录",
                e = '<div class="unlogin-content-wrapper"><div class="unlogin-content"><p>登录后实时同步进度</p><a class="btn btn-primary btn-block btn-radius-50 js-login" href="javascript:redirectLogin();">' + t + "</a></div></div>";
            $("#bookshelf").html(e)
        }, _resetBookshelfStore: function () {
            store.remove("BOOKSHELF"), store.set("BOOKSHELF", n)
        }, _setPageLoadError: function (t) {
            var e = this, o = t || "网络异常, 请点击重试";
            e.$bookListWrapper.html('<div class="page-loading--state js-load-again"><img src="' + g_data.url.basePath + '/assets/images/icon-status-normal.png" alt=""><p>' + o + "</p></div>")
        }, _setPageLoading: function () {
            this.$bookListWrapper.html('<div class="loading-simple">正在加载中<dot>...</dot></div>')
        }
    }, e.BookshelfGet = o
}(document, window), function (t, e) {
    function o(t) {
        var e = this, o = {
            editButton: ".js-bookshelf-edit-btn",
            cancelButton: ".js-bookshelf-cancel-btn",
            delButton: ".js-bookshelf-del-btn",
            selectButton: ".js-bookshelf-select-btn",
            bookshelfList: ".js-bookshelf-list",
            bookItem: ".bookshelf-item",
            activeClass: "enabled",
            checkedClass: "checked"
        };
        e.settings = _extends(o, t || {}), e._init()
    }

    o.prototype = {
        constructor: o, _init: function () {
            var t = this;
            t.$body = $("body"), t.$editBtn = $(t.settings.editButton), t.$cancelBtn = $(t.settings.cancelButton), t.$delBtn = $(t.settings.delButton), t.$selectBtn = $(t.settings.selectButton), t.$bookshelfList = $(t.settings.bookshelfList), t.$bookItem = $(t.settings.bookItem), t.books = [], t.bookItems = [], t.isInit = !1, t._bindEvents()
        }, _bindEvents: function () {
            var t = this;
            t.onEdit(), t.onCancel(), t.onSelectToggle(), t.onDel()
        }, onDel: function () {
            var t = this;
            t.$delBtn.on("click", function (e) {
                if (e.preventDefault(), e.stopPropagation(), t._resetDelBooks(), t._getDelBooks(), 0 === t.books.length) return void t._showToast("请选择要删除的书籍");
                t.books.length > 0 && (console.log("需要删除的书籍 =>> ", t.books), 0 === $(".modal").length && new Modal({
                    type: "confirm",
                    content: "确定要删除这些书籍 ?",
                    buttonConfirmText: "删除",
                    onConfirmButtonCallback: function () {
                        t._doDelRequest()
                    }
                }))
            })
        }, _doDelRequest: function () {
            var t = this, e = t.books.join(";") + ";";
            bookshelfRequest.del(e, function (e) {
                if (console.log(e), e.errorCode && "fail" === e.errorCode.toLowerCase()) {
                    var o = e.errorMsg || "删除失败, 请重试";
                    return t._showToast(o), !1
                }
                t._removeBookItem(), t._removeBookshelfStore(), t._removeRecentlyReadStore(), t.$cancelBtn.triggerHandler("click"), 0 === t.$bookshelfList.find(".bookshelf-item").size() && t._setBookshelfEmpty()
            }, function (e) {
                console.log(e), t._showToast("网络异常, 请稍后重试")
            })
        }, _removeBookItem: function () {
            var t = this;
            $.each(t.bookItems, function (t, e) {
                $(e).remove()
            })
        }, _removeBookshelfStore: function () {
            for (var t = this, e = 0; e < t.books.length; e++) addBookshelfStore.remove(t.books[e])
        }, _removeRecentlyReadStore: function () {
            for (var t = this, e = 0; e < t.books.length; e++) recentlyReadStore.remove(t.books[e])
        }, _getDelBooks: function () {
            var t = this;
            $(".item").each(function (e, o) {
                var n = $(o);
                n.hasClass("checked") && (t.books.push(n.attr("data-book-id")), t.bookItems.push(n))
            })
        }, _resetDelBooks: function () {
            var t = this;
            t.books = [], t.bookItems = []
        }, onEdit: function () {
            var t = this;
            t.$editBtn.on("click", function (e) {
                e.preventDefault(), t.$bookshelfList.addClass(t.settings.activeClass)
            })
        }, onCancel: function () {
            var t = this;
            t.$cancelBtn.on("click", function (e) {
                e.preventDefault(), t._doCancelEdit(), t._cancelAllSelected()
            })
        }, _doCancelEdit: function () {
            var t = this;
            t.$bookshelfList.removeClass(t.settings.activeClass)
        }, onSelectToggle: function () {
            var t = this;
            t.$selectBtn.on("click", function (e) {
                e.preventDefault();
                var o = $(this).parents(t.settings.bookItem);
                o.hasClass(t.settings.checkedClass);
                void 0 !== o.attr("data-checked") ? t._cancelSelected(o, t.settings.checkedClass) : t._doSelected(o, t.settings.checkedClass)
            })
        }, _doSelected: function (t, e) {
            t.addClass(e).attr({"data-checked": "1"})
        }, _cancelSelected: function (t, e) {
            t.removeClass(e).removeAttr("data-checked")
        }, _cancelAllSelected: function () {
            var t = this;
            t.$bookItem.removeClass(t.settings.checkedClass).removeAttr("data-checked")
        }, _setBookshelfEmpty: function () {
            var t = this,
                e = '<div class="empty-tip-wrapper"><div class="empty-tip"><div class="empty-tip__text">书架还是空的哟，去首页挑本书看看吧~</div><div class="empty-tip__actions"><a class="btn btn-primary btn-block btn-radius-50 js-go-home" href="' + g_data.url.home + '">去首页挑书</a></div></div></div>';
            t.$bookshelfList.parent().html(e)
        }, _getTarget: function (t) {
            return $("#" + t)
        }, _showToast: function (t) {
            new Toast({message: t, overlay: !1, duration: 1800})
        }
    }, e.BookshelfEdit = o
}(document, window), $(document).ready(function () {
    try {
        FastClick.attach(document.body)
    } catch (t) {
        console.log(t)
    }
    var t = getUserId();
    new PageGuide;
    var e = new ToggleNav;
    if (urlQuery.concat(), t) {
        var o = new BookshelfGet({
            successCallback: function () {
                new BookshelfEdit({
                    editButton: ".js-edit-btn",
                    cancelButton: ".js-cancel-btn",
                    delButton: ".js-del-btn",
                    selectButton: ".js-select-btn",
                    bookshelfList: ".js-bookshelf-list"
                })
            }
        }), n = !1;
        window.addEventListener("pageshow", function (t) {
            n && (console.log("触发 pageshow 事件"), o.update()), n = !0
        })
    } else {
        var a = mobileUtil.isWeiXin ? "微信安全登录" : "立即登录",
            i = '<div class="unlogin-content-wrapper"><div class="unlogin-content"><p>登录后实时同步进度</p><a class="btn btn-primary btn-block btn-radius-50 js-login" href="javascript:redirectLogin();">' + a + "</a></div></div>";
        $("#bookshelf").html(i)
    }
    new HeaderAction({
        openButton: ".js-edit-btn", closeButton: ".js-cancel-btn", onOpenButtonCallback: function () {
            return t ? 0 === $(".js-bookshelf-list").find(".bookshelf-item").size() ? (new Toast({
                message: "书架还是空的哟，去首页挑本书看看吧~",
                overlay: !1,
                duration: 1800
            }), !1) : void 0 : (new Toast({message: "小主，您还没有登录哟~", overlay: !1, duration: 1800}), !1)
        }
    }), $(".js-edit-btn").on("click", function () {
        e.close()
    })
});