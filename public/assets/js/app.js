! function () {
    var e, t, a, o, n, s, d, l, i, r, c, m = document.querySelector(".navbar-menu").innerHTML,
        u = localStorage.getItem("language");

    function g(e) {
        document.getElementById("header-lang-img") && ("en" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/us.svg" : "sp" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/spain.svg" : "gr" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/germany.svg" : "it" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/italy.svg" : "ru" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/russia.svg" : "ch" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/china.svg" : "fr" == e && (document.getElementById("header-lang-img").src = "assets/images/flags/french.svg"), localStorage.setItem("language", e), u = localStorage.getItem("language"), function () {
            null == u && g("en");
            var e = new XMLHttpRequest;
            e.open("GET", "assets/lang/" + u + ".json"), e.onreadystatechange = function () {
                var e;
                4 === this.readyState && 200 === this.status && (e = JSON.parse(this.responseText), Object.keys(e).forEach((function (t) {
                    document.querySelectorAll("[data-key='" + t + "']").forEach((function (a) {
                        a.textContent = e[t]
                    }))
                })))
            }, e.send()
        }())
    }

    function y() {
        document.querySelectorAll(".navbar-nav .collapse") && document.querySelectorAll(".navbar-nav .collapse").forEach((function (e) {
            var t = new bootstrap.Collapse(e, {
                toggle: !1
            });
            e.addEventListener("show.bs.collapse", (function (a) {
                a.stopPropagation(), (a = e.parentElement.closest(".collapse")) ? a.querySelectorAll(".collapse").forEach((function (e) {
                    (e = bootstrap.Collapse.getInstance(e)) !== t && e.hide()
                })) : function (e) {
                    for (var t = [], a = e.parentNode.firstChild; a;) 1 === a.nodeType && a !== e && t.push(a), a = a.nextSibling;
                    return t
                }(e.parentElement).forEach((function (e) {
                    2 < e.childNodes.length && e.firstElementChild.setAttribute("aria-expanded", "false"), e.querySelectorAll("*[id]").forEach((function (e) {
                        e.classList.remove("show"), 2 < e.childNodes.length && e.querySelectorAll("ul li a").forEach((function (e) {
                            e.hasAttribute("aria-expanded") && e.setAttribute("aria-expanded", "false")
                        }))
                    }))
                }))
            })), e.addEventListener("hide.bs.collapse", (function (t) {
                t.stopPropagation(), e.querySelectorAll(".collapse").forEach((function (e) {
                    childCollapseInstance = bootstrap.Collapse.getInstance(e), childCollapseInstance.hide()
                }))
            }))
        }))
    }

    function b() {
        var e, t, a = document.documentElement.getAttribute("data-layout"),
            o = sessionStorage.getItem("defaultAttribute");
        !(o = JSON.parse(o)) || "twocolumn" != a && "twocolumn" != o["data-layout"] || (document.querySelector(".navbar-menu").innerHTML = m, (e = document.createElement("ul")).innerHTML = '<a href="#" class="logo"><img src="assets/images/logo-sm.png" alt="" height="22"></a>', document.getElementById("navbar-nav").querySelectorAll(".menu-link").forEach((function (t) {
            e.className = "twocolumn-iconview";
            var a = document.createElement("li"),
                o = t;
            o.querySelectorAll("span").forEach((function (e) {
                e.classList.add("d-none")
            })), t.parentElement.classList.contains("twocolumn-item-show") && t.classList.add("active"), a.appendChild(o), e.appendChild(a), o.classList.contains("nav-link") && o.classList.replace("nav-link", "nav-icon"), o.classList.remove("collapsed", "menu-link")
        })), (o = (o = "/" == location.pathname ? "index.html" : location.pathname.substring(1)).substring(o.lastIndexOf("/") + 1)) && (!(o = document.getElementById("navbar-nav").querySelector('[href="' + o + '"]')) || (t = o.closest(".collapse.menu-dropdown")) && (t.classList.add("show"), t.parentElement.children[0].classList.add("active"), t.parentElement.children[0].setAttribute("aria-expanded", "true"), t.parentElement.closest(".collapse.menu-dropdown") && (t.parentElement.closest(".collapse").classList.add("show"), t.parentElement.closest(".collapse").previousElementSibling && t.parentElement.closest(".collapse").previousElementSibling.classList.add("active")))), document.getElementById("two-column-menu").innerHTML = e.outerHTML, document.querySelector("#two-column-menu ul").querySelectorAll("li a").forEach((function (e) {
            var t = (t = "/" == location.pathname ? "index.html" : location.pathname.substring(1)).substring(t.lastIndexOf("/") + 1);
            e.addEventListener("click", (function (a) {
                var o;
                (t != "/" + e.getAttribute("href") || e.getAttribute("data-bs-toggle")) && document.body.classList.contains("twocolumn-panel") && document.body.classList.remove("twocolumn-panel"), document.getElementById("navbar-nav").classList.remove("twocolumn-nav-hide"), document.querySelector(".hamburger-icon").classList.remove("open"), (a.target && a.target.matches("a.nav-icon") || a.target && a.target.matches("i")) && (null !== document.querySelector("#two-column-menu ul .nav-icon.active") && document.querySelector("#two-column-menu ul .nav-icon.active").classList.remove("active"), (a.target.matches("i") ? a.target.closest("a") : a.target).classList.add("active"), 0 < (o = document.getElementsByClassName("twocolumn-item-show")).length && o[0].classList.remove("twocolumn-item-show"), a = (a.target.matches("i") ? a.target.closest("a") : a.target).getAttribute("href").slice(1), document.getElementById(a) && document.getElementById(a).parentElement.classList.add("twocolumn-item-show"))
            })), t != "/" + e.getAttribute("href") || e.getAttribute("data-bs-toggle") || (e.classList.add("active"), document.getElementById("navbar-nav").classList.add("twocolumn-nav-hide"), document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.add("open"))
        })), "horizontal" !== document.documentElement.getAttribute("data-layout") && ((t = new SimpleBar(document.getElementById("navbar-nav"))) && t.getContentElement(), (t = new SimpleBar(document.getElementsByClassName("twocolumn-iconview")[0])) && t.getContentElement()))
    }

    function h(e) {
        if (e) {
            var t = e.offsetTop,
                a = e.offsetLeft,
                o = e.offsetWidth,
                n = e.offsetHeight;
            if (e.offsetParent)
                for (; e.offsetParent;) t += (e = e.offsetParent).offsetTop, a += e.offsetLeft;
            return t >= window.pageYOffset && a >= window.pageXOffset && t + n <= window.pageYOffset + window.innerHeight && a + o <= window.pageXOffset + window.innerWidth
        }
    }

    function f() {
        "vertical" == document.documentElement.getAttribute("data-layout") && (document.getElementById("two-column-menu").innerHTML = "", document.querySelector(".navbar-menu").innerHTML = m, document.getElementById("scrollbar").setAttribute("data-simplebar", ""), document.getElementById("navbar-nav").setAttribute("data-simplebar", ""), document.getElementById("scrollbar").classList.add("h-100")), "twocolumn" == document.documentElement.getAttribute("data-layout") && (document.getElementById("scrollbar").removeAttribute("data-simplebar"), document.getElementById("scrollbar").classList.remove("h-100")), "horizontal" == document.documentElement.getAttribute("data-layout") && I()
    }

    function p() {
        feather.replace();
        var e = document.documentElement.clientWidth;
        e < 1025 && 767 < e ? (document.body.classList.remove("twocolumn-panel"), "twocolumn" == sessionStorage.getItem("data-layout") && (document.documentElement.setAttribute("data-layout", "twocolumn"), document.getElementById("customizer-layout03") && document.getElementById("customizer-layout03").click(), b(), w(), y()), "vertical" == sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", "sm"), document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.add("open")) : 1025 <= e ? (document.body.classList.remove("twocolumn-panel"), "twocolumn" == sessionStorage.getItem("data-layout") && (document.documentElement.setAttribute("data-layout", "twocolumn"), document.getElementById("customizer-layout03") && document.getElementById("customizer-layout03").click(), b(), w(), y()), "vertical" == sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size")), document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.remove("open")) : e <= 767 && (document.body.classList.remove("vertical-sidebar-enable"), document.body.classList.add("twocolumn-panel"), "twocolumn" == sessionStorage.getItem("data-layout") && (document.documentElement.setAttribute("data-layout", "vertical"), L("vertical"), y()), "horizontal" != sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", "lg"), document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.add("open")), document.querySelectorAll("#navbar-nav > li.nav-item").forEach((function (e) {
            e.addEventListener("click", E.bind(this), !1), e.addEventListener("mouseover", E.bind(this), !1)
        }))
    }

    function E(e) {
        if (e.target && e.target.matches("a.nav-link span"))
            if (0 == h(e.target.parentElement.nextElementSibling)) e.target.parentElement.nextElementSibling.classList.add("dropdown-custom-right"), e.target.parentElement.parentElement.parentElement.parentElement.classList.add("dropdown-custom-right"), e.target.parentElement.nextElementSibling.querySelectorAll(".menu-dropdown").forEach((function (e) {
                e.classList.add("dropdown-custom-right")
            }));
            else if (1 == h(e.target.parentElement.nextElementSibling) && 1848 <= window.innerWidth)
            for (var t = document.getElementsByClassName("dropdown-custom-right"); 0 < t.length;) t[0].classList.remove("dropdown-custom-right");
        if (e.target && e.target.matches("a.nav-link"))
            if (0 == h(e.target.nextElementSibling)) e.target.nextElementSibling.classList.add("dropdown-custom-right"), e.target.parentElement.parentElement.parentElement.classList.add("dropdown-custom-right"), e.target.nextElementSibling.querySelectorAll(".menu-dropdown").forEach((function (e) {
                e.classList.add("dropdown-custom-right")
            }));
            else if (1 == h(e.target.nextElementSibling) && 1848 <= window.innerWidth)
            for (t = document.getElementsByClassName("dropdown-custom-right"); 0 < t.length;) t[0].classList.remove("dropdown-custom-right")
    }

    function v() {
        var e = document.documentElement.clientWidth;
        767 < e && document.querySelector(".hamburger-icon").classList.toggle("open"), "horizontal" === document.documentElement.getAttribute("data-layout") && (document.body.classList.contains("menu") ? document.body.classList.remove("menu") : document.body.classList.add("menu")), "vertical" === document.documentElement.getAttribute("data-layout") && (e < 1025 && 767 < e ? (document.body.classList.remove("vertical-sidebar-enable"), "sm" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "") : document.documentElement.setAttribute("data-sidebar-size", "sm")) : 1025 < e ? (document.body.classList.remove("vertical-sidebar-enable"), "lg" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm") : document.documentElement.setAttribute("data-sidebar-size", "lg")) : e <= 767 && (document.body.classList.add("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", "lg"))), "twocolumn" == document.documentElement.getAttribute("data-layout") && (document.body.classList.contains("twocolumn-panel") ? document.body.classList.remove("twocolumn-panel") : document.body.classList.add("twocolumn-panel"))
    }

    function w() {
        feather.replace();
        var e, t = "/" == location.pathname ? "index.html" : location.pathname.substring(1);
        (t = t.substring(t.lastIndexOf("/") + 1)) && ((e = document.getElementById("navbar-nav").querySelector('[href="' + t + '"]')) ? (e.classList.add("active"), t = (t = e.closest(".collapse.menu-dropdown")) && t.parentElement.closest(".collapse.menu-dropdown") ? (t.classList.add("show"), t.parentElement.children[0].classList.add("active"), t.parentElement.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"), t.parentElement.closest(".collapse.menu-dropdown").getAttribute("id")) : (e.closest(".collapse.menu-dropdown").parentElement.classList.add("twocolumn-item-show"), t.getAttribute("id")), document.getElementById("two-column-menu").querySelector('[href="#' + t + '"]') && document.getElementById("two-column-menu").querySelector('[href="#' + t + '"]').classList.add("active")) : document.body.classList.add("twocolumn-panel"))
    }

    function S() {
        var e = "/" == location.pathname ? "index.html" : location.pathname.substring(1);
        !(e = e.substring(e.lastIndexOf("/") + 1)) || (e = document.getElementById("navbar-nav").querySelector('[href="' + e + '"]')) && (e.classList.add("active"), (e = e.closest(".collapse.menu-dropdown")) && (e.classList.add("show"), e.parentElement.children[0].classList.add("active"), e.parentElement.children[0].setAttribute("aria-expanded", "true"), e.parentElement.closest(".collapse.menu-dropdown") && (e.parentElement.closest(".collapse").classList.add("show"), e.parentElement.closest(".collapse").previousElementSibling && e.parentElement.closest(".collapse").previousElementSibling.classList.add("active"))))
    }

    function h(e) {
        if (e) {
            var t = e.offsetTop,
                a = e.offsetLeft,
                o = e.offsetWidth,
                n = e.offsetHeight;
            if (e.offsetParent)
                for (; e.offsetParent;) t += (e = e.offsetParent).offsetTop, a += e.offsetLeft;
            return t >= window.pageYOffset && a >= window.pageXOffset && t + n <= window.pageYOffset + window.innerHeight && a + o <= window.pageXOffset + window.innerWidth
        }
    }

    function I() {
        document.getElementById("two-column-menu").innerHTML = "", document.querySelector(".navbar-menu").innerHTML = m, document.getElementById("scrollbar").removeAttribute("data-simplebar"), document.getElementById("navbar-nav").removeAttribute("data-simplebar"), document.getElementById("scrollbar").classList.remove("h-100");
        var e = document.querySelectorAll("ul.navbar-nav > li.nav-item"),
            t = "";
        e.forEach((function (a, o) {
            o + 1 === 7 && (t = a), 7 < o + 1 && (a.outerHTML, a.remove()), o + 1 === e.length && t.insertAdjacentHTML
        }))
    }

    function L(e) {
        "vertical" == e ? (document.getElementById("two-column-menu").innerHTML = "", document.querySelector(".navbar-menu").innerHTML = m, document.getElementById("theme-settings-offcanvas") && (document.getElementById("sidebar-size").style.display = "block", document.getElementById("sidebar-view").style.display = "block", document.getElementById("sidebar-color").style.display = "block", document.getElementById("layout-position").style.display = "block", document.getElementById("layout-width").style.display = "block"), f(), S(), A(), B()) : "horizontal" == e ? (I(), document.getElementById("theme-settings-offcanvas") && (document.getElementById("sidebar-size").style.display = "none", document.getElementById("sidebar-view").style.display = "none", document.getElementById("sidebar-color").style.display = "none", document.getElementById("layout-position").style.display = "block", document.getElementById("layout-width").style.display = "block"), S()) : "twocolumn" == e && (document.getElementById("scrollbar").removeAttribute("data-simplebar"), document.getElementById("scrollbar").classList.remove("h-100"), document.getElementById("theme-settings-offcanvas") && (document.getElementById("sidebar-size").style.display = "none", document.getElementById("sidebar-view").style.display = "none", document.getElementById("sidebar-color").style.display = "block", document.getElementById("layout-position").style.display = "none", document.getElementById("layout-width").style.display = "none"))
    }

    function A() {
        document.getElementById("vertical-hover").addEventListener("click", (function () {
            "sm-hover" === document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm-hover-active") : (document.documentElement.getAttribute("data-sidebar-size"), document.documentElement.setAttribute("data-sidebar-size", "sm-hover"))
        }))
    }

    function k(e) {
        if (e == e) {
            switch (e["data-layout"]) {
                case "vertical":
                    z("data-layout", "vertical"), sessionStorage.setItem("data-layout", "vertical"), document.documentElement.setAttribute("data-layout", "vertical"), L("vertical"), y();
                    break;
                case "horizontal":
                    z("data-layout", "horizontal"), sessionStorage.setItem("data-layout", "horizontal"), document.documentElement.setAttribute("data-layout", "horizontal"), L("horizontal");
                    break;
                case "twocolumn":
                    z("data-layout", "twocolumn"), sessionStorage.setItem("data-layout", "twocolumn"), document.documentElement.setAttribute("data-layout", "twocolumn"), L("twocolumn");
                    break;
                default:
                    "vertical" == sessionStorage.getItem("data-layout") && sessionStorage.getItem("data-layout") ? (z("data-layout", "vertical"), sessionStorage.setItem("data-layout", "vertical"), document.documentElement.setAttribute("data-layout", "vertical"), L("vertical"), y()) : "horizontal" == sessionStorage.getItem("data-layout") ? (z("data-layout", "horizontal"), sessionStorage.setItem("data-layout", "horizontal"), document.documentElement.setAttribute("data-layout", "horizontal"), L("horizontal")) : "twocolumn" == sessionStorage.getItem("data-layout") && (z("data-layout", "twocolumn"), sessionStorage.setItem("data-layout", "twocolumn"), document.documentElement.setAttribute("data-layout", "twocolumn"), L("twocolumn"))
            }
            switch (e["data-topbar"]) {
                case "light":
                    z("data-topbar", "light"), sessionStorage.setItem("data-topbar", "light"), document.documentElement.setAttribute("data-topbar", "light");
                    break;
                case "dark":
                    z("data-topbar", "dark"), sessionStorage.setItem("data-topbar", "dark"), document.documentElement.setAttribute("data-topbar", "dark");
                    break;
                default:
                    "dark" == sessionStorage.getItem("data-topbar") ? (z("data-topbar", "dark"), sessionStorage.setItem("data-topbar", "dark"), document.documentElement.setAttribute("data-topbar", "dark")) : (z("data-topbar", "light"), sessionStorage.setItem("data-topbar", "light"), document.documentElement.setAttribute("data-topbar", "light"))
            }
            switch (e["data-layout-style"]) {
                case "default":
                    z("data-layout-style", "default"), sessionStorage.setItem("data-layout-style", "default"), document.documentElement.setAttribute("data-layout-style", "default");
                    break;
                case "detached":
                    z("data-layout-style", "detached"), sessionStorage.setItem("data-layout-style", "detached"), document.documentElement.setAttribute("data-layout-style", "detached");
                    break;
                default:
                    "detached" == sessionStorage.getItem("data-layout-style") ? (z("data-layout-style", "detached"), sessionStorage.setItem("data-layout-style", "detached"), document.documentElement.setAttribute("data-layout-style", "detached")) : (z("data-layout-style", "default"), sessionStorage.setItem("data-layout-style", "default"), document.documentElement.setAttribute("data-layout-style", "default"))
            }
            switch (e["data-sidebar-size"]) {
                case "lg":
                    z("data-sidebar-size", "lg"), document.documentElement.setAttribute("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg");
                    break;
                case "sm":
                    z("data-sidebar-size", "sm"), document.documentElement.setAttribute("data-sidebar-size", "sm"), sessionStorage.setItem("data-sidebar-size", "sm");
                    break;
                case "md":
                    z("data-sidebar-size", "md"), document.documentElement.setAttribute("data-sidebar-size", "md"), sessionStorage.setItem("data-sidebar-size", "md");
                    break;
                case "sm-hover":
                    z("data-sidebar-size", "sm-hover"), document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover");
                    break;
                default:
                    "sm" == sessionStorage.getItem("data-sidebar-size") ? (document.documentElement.setAttribute("data-sidebar-size", "sm"), z("data-sidebar-size", "sm"), sessionStorage.setItem("data-sidebar-size", "sm")) : "md" == sessionStorage.getItem("data-sidebar-size") ? (document.documentElement.setAttribute("data-sidebar-size", "md"), z("data-sidebar-size", "md"), sessionStorage.setItem("data-sidebar-size", "md")) : "sm-hover" == sessionStorage.getItem("data-sidebar-size") ? (document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), z("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover")) : (document.documentElement.setAttribute("data-sidebar-size", "lg"), z("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg"))
            }
            switch (e["data-layout-mode"]) {
                case "light":
                    z("data-layout-mode", "light"), document.documentElement.setAttribute("data-layout-mode", "light"), sessionStorage.setItem("data-layout-mode", "light");
                    break;
                case "dark":
                    z("data-layout-mode", "dark"), document.documentElement.setAttribute("data-layout-mode", "dark"), sessionStorage.setItem("data-layout-mode", "dark");
                    break;
                default:
                    sessionStorage.getItem("data-layout-mode") && "dark" == sessionStorage.getItem("data-layout-mode") ? (sessionStorage.setItem("data-layout-mode", "dark"), document.documentElement.setAttribute("data-layout-mode", "dark"), z("data-layout-mode", "dark")) : (sessionStorage.setItem("data-layout-mode", "light"), document.documentElement.setAttribute("data-layout-mode", "light"), z("data-layout-mode", "light"))
            }
            switch (e["data-layout-width"]) {
                case "fluid":
                    z("data-layout-width", "fluid"), document.documentElement.setAttribute("data-layout-width", "fluid"), sessionStorage.setItem("data-layout-width", "fluid");
                    break;
                case "boxed":
                    z("data-layout-width", "boxed"), document.documentElement.setAttribute("data-layout-width", "boxed"), sessionStorage.setItem("data-layout-width", "boxed");
                    break;
                default:
                    "boxed" == sessionStorage.getItem("data-layout-width") ? (sessionStorage.setItem("data-layout-width", "boxed"), document.documentElement.setAttribute("data-layout-width", "boxed"), z("data-layout-width", "boxed")) : (sessionStorage.setItem("data-layout-width", "fluid"), document.documentElement.setAttribute("data-layout-width", "fluid"), z("data-layout-width", "fluid"))
            }
            switch (e["data-sidebar"]) {
                case "light":
                    z("data-sidebar", "light"), sessionStorage.setItem("data-sidebar", "light"), document.documentElement.setAttribute("data-sidebar", "light");
                    break;
                case "dark":
                    z("data-sidebar", "dark"), sessionStorage.setItem("data-sidebar", "dark"), document.documentElement.setAttribute("data-sidebar", "dark");
                    break;
                default:
                    sessionStorage.getItem("data-sidebar") && "light" == sessionStorage.getItem("data-sidebar") ? (sessionStorage.setItem("data-sidebar", "light"), z("data-sidebar", "light"), document.documentElement.setAttribute("data-sidebar", "light")) : (sessionStorage.setItem("data-sidebar", "dark"), z("data-sidebar", "dark"), document.documentElement.setAttribute("data-sidebar", "dark"))
            }
            switch (e["data-layout-position"]) {
                case "fixed":
                    z("data-layout-position", "fixed"), sessionStorage.setItem("data-layout-position", "fixed"), document.documentElement.setAttribute("data-layout-position", "fixed");
                    break;
                case "scrollable":
                    z("data-layout-position", "scrollable"), sessionStorage.setItem("data-layout-position", "scrollable"), document.documentElement.setAttribute("data-layout-position", "scrollable");
                    break;
                default:
                    sessionStorage.getItem("data-layout-position") && "scrollable" == sessionStorage.getItem("data-layout-position") ? (z("data-layout-position", "scrollable"), sessionStorage.setItem("data-layout-position", "scrollable"), document.documentElement.setAttribute("data-layout-position", "scrollable")) : (z("data-layout-position", "fixed"), sessionStorage.setItem("data-layout-position", "fixed"), document.documentElement.setAttribute("data-layout-position", "fixed"))
            }
        }
    }

    function B() {
        setTimeout((function () {
            var e, t, a = document.getElementById("navbar-nav");
            a && (a = a.querySelector(".nav-item .active"), 300 < (e = a ? a.offsetTop : 0) && (t = document.getElementsByClassName("app-menu") ? document.getElementsByClassName("app-menu")[0] : "") && t.querySelector(".simplebar-content-wrapper") && setTimeout((function () {
                t.querySelector(".simplebar-content-wrapper").scrollTop = 330 == e ? e + 85 : e
            }), 0))
        }), 250)
    }

    function z(e, t) {
        document.querySelectorAll("input[name=" + e + "]").forEach((function (a) {
            t == a.value ? a.checked = !0 : a.checked = !1, a.addEventListener("change", (function () {
                document.documentElement.setAttribute(e, a.value), sessionStorage.setItem(e, a.value), "data-layout-width" == e && "boxed" == a.value ? (document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover"), document.getElementById("sidebar-size-small-hover").checked = !0) : "data-layout-width" == e && "fluid" == a.value && (document.documentElement.setAttribute("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg"), document.getElementById("sidebar-size-default").checked = !0), "data-layout" == e && ("vertical" == a.value ? (L("vertical"), y(), feather.replace()) : "horizontal" == a.value ? (L("horizontal"), feather.replace()) : "twocolumn" == a.value && (L("twocolumn"), document.documentElement.setAttribute("data-layout-width", "fluid"), document.getElementById("layout-width-fluid").click(), b(), w(), y(), feather.replace()))
            }))
        }))
    }

    function q(e, t, a, o) {
        var n = document.getElementById(a);
        o.setAttribute(e, t), n && document.getElementById(a).click()
    }

    function x() {
        document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || document.body.classList.remove("fullscreen-enable")
    }

    function T() {
        var e = 0;
        document.getElementsByClassName("cart-item-price").forEach((function (t) {
            e += parseFloat(t.innerHTML)
        })), document.getElementById("cart-item-total") && (document.getElementById("cart-item-total").innerHTML = "$" + e.toFixed(2))
    }

    function C() {
        var e;
        "horizontal" !== document.documentElement.getAttribute("data-layout") && (!document.getElementById("navbar-nav") || (e = new SimpleBar(document.getElementById("navbar-nav"))) && e.getContentElement(), !document.getElementsByClassName("twocolumn-iconview")[0] || (e = new SimpleBar(document.getElementsByClassName("twocolumn-iconview")[0])) && e.getContentElement(), clearTimeout(c))
    }
    sessionStorage.getItem("defaultAttribute") ? ((e = {})["data-layout"] = sessionStorage.getItem("data-layout"), e["data-sidebar-size"] = sessionStorage.getItem("data-sidebar-size"), e["data-layout-mode"] = sessionStorage.getItem("data-layout-mode"), e["data-layout-width"] = sessionStorage.getItem("data-layout-width"), e["data-sidebar"] = sessionStorage.getItem("data-sidebar"), e["data-layout-position"] = sessionStorage.getItem("data-layout-position"), e["data-layout-style"] = sessionStorage.getItem("data-layout-style"), e["data-topbar"] = sessionStorage.getItem("data-topbar"), k(e)) : (i = document.documentElement.attributes, e = {}, i.forEach((function (t) {
            var a;
            t && t.nodeName && "undefined" != t.nodeName && (a = t.nodeName, e[a] = t.nodeValue, sessionStorage.setItem(a, t.nodeValue))
        })), sessionStorage.setItem("defaultAttribute", JSON.stringify(e)), k(e), (i = document.querySelector('.btn[data-bs-target="#theme-settings-offcanvas"]')) && i.click()), b(), t = document.getElementById("search-close-options"), a = document.getElementById("search-dropdown"), (o = document.getElementById("search-options")) && (o.addEventListener("focus", (function () {
            0 < o.value.length ? (a.classList.add("show"), t.classList.remove("d-none")) : (a.classList.remove("show"), t.classList.add("d-none"))
        })), o.addEventListener("keyup", (function (e) {
            var n;
            0 < o.value.length ? (a.classList.add("show"), t.classList.remove("d-none"), n = o.value.toLowerCase(), document.getElementsByClassName("notify-item").forEach((function (e) {
                var t = e.getElementsByTagName("span") ? e.getElementsByTagName("span")[0].innerText.toLowerCase() : "";
                t && (e.style.display = t.includes(n) ? "block" : "none")
            }))) : (a.classList.remove("show"), t.classList.add("d-none"))
        })), t.addEventListener("click", (function () {
            o.value = "", a.classList.remove("show"), t.classList.add("d-none")
        })), document.body.addEventListener("click", (function (e) {
            "search-options" !== e.target.getAttribute("id") && (a.classList.remove("show"), t.classList.add("d-none"))
        }))), n = document.getElementById("search-close-options"), s = document.getElementById("search-dropdown-reponsive"), d = document.getElementById("search-options-reponsive"), n && s && d && (d.addEventListener("focus", (function () {
            0 < d.value.length ? (s.classList.add("show"), n.classList.remove("d-none")) : (s.classList.remove("show"), n.classList.add("d-none"))
        })), d.addEventListener("keyup", (function () {
            0 < d.value.length ? (s.classList.add("show"), n.classList.remove("d-none")) : (s.classList.remove("show"), n.classList.add("d-none"))
        })), n.addEventListener("click", (function () {
            d.value = "", s.classList.remove("show"), n.classList.add("d-none")
        })), document.body.addEventListener("click", (function (e) {
            "search-options" !== e.target.getAttribute("id") && (s.classList.remove("show"), n.classList.add("d-none"))
        }))), (i = document.querySelector('[data-toggle="fullscreen"]')) && i.addEventListener("click", (function (e) {
            e.preventDefault(), document.body.classList.toggle("fullscreen-enable"), document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement ? document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen && document.webkitCancelFullScreen() : document.documentElement.requestFullscreen ? document.documentElement.requestFullscreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)
        })), document.addEventListener("fullscreenchange", x), document.addEventListener("webkitfullscreenchange", x), document.addEventListener("mozfullscreenchange", x), l = document.getElementsByTagName("HTML")[0], (i = document.querySelectorAll(".light-dark-mode")) && i.length && i[0].addEventListener("click", (function (e) {
            l.hasAttribute("data-layout-mode") && "dark" == l.getAttribute("data-layout-mode") ? q("data-layout-mode", "light", "layout-mode-light", l) : q("data-layout-mode", "dark", "layout-mode-dark", l)
        })),
        function () {
            document.addEventListener("DOMContentLoaded", (function () {
                document.getElementsByClassName("code-switcher").forEach((function (e) {
                    e.addEventListener("change", (function () {
                        var t = (a = e.closest(".card")).querySelector(".live-preview"),
                            a = a.querySelector(".code-view");
                        e.checked ? (t.classList.add("d-none"), a.classList.remove("d-none")) : (t.classList.remove("d-none"), a.classList.add("d-none"))
                    }))
                })), feather.replace()
            })), window.addEventListener("resize", p), p(), Waves.init(), document.addEventListener("scroll", (function () {
                var e;
                (e = document.getElementById("page-topbar")) && (50 <= document.body.scrollTop || 50 <= document.documentElement.scrollTop ? e.classList.add("topbar-shadow") : e.classList.remove("topbar-shadow"))
            })), window.addEventListener("load", (function () {
                var e;
                ("twocolumn" == document.documentElement.getAttribute("data-layout") ? w : S)(), (e = document.getElementsByClassName("vertical-overlay")) && e.forEach((function (e) {
                    e.addEventListener("click", (function () {
                        document.body.classList.remove("vertical-sidebar-enable"), "twocolumn" == sessionStorage.getItem("data-layout") ? document.body.classList.add("twocolumn-panel") : document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size"))
                    }))
                })), A()
            })), document.getElementById("topnav-hamburger-icon") && document.getElementById("topnav-hamburger-icon").addEventListener("click", v);
            var e = sessionStorage.getItem("defaultAttribute"),
                t = JSON.parse(e);
            e = document.documentElement.clientWidth, "twocolumn" == t["data-layout"] && e < 767 && document.getElementById("two-column-menu").querySelectorAll("li").forEach((function (e) {
                e.addEventListener("click", (function (e) {
                    document.body.classList.remove("twocolumn-panel")
                }))
            }))
        }(),
        function () {
            var e = document.querySelectorAll(".counter-value");

            function t(e) {
                return e.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
            e && e.forEach((function (e) {
                ! function a() {
                    var o = +e.getAttribute("data-target"),
                        n = +e.innerText,
                        s = o / 250;
                    s < 1 && (s = 1), n < o ? (e.innerText = (n + s).toFixed(0), setTimeout(a, 1)) : e.innerText = t(o), t(e.innerText)
                }()
            }))
        }(), f(), document.getElementsByClassName("dropdown-item-cart") && (r = document.querySelectorAll(".dropdown-item-cart").length, document.querySelectorAll("#page-topbar .dropdown-menu-cart .remove-item-btn").forEach((function (e) {
            e.addEventListener("click", (function (e) {
                r--, this.closest(".dropdown-item-cart").remove(), document.getElementsByClassName("cartitem-badge").forEach((function (e) {
                    e.innerHTML = r
                })), T(), document.getElementById("empty-cart") && (document.getElementById("empty-cart").style.display = 0 == r ? "block" : "none"), document.getElementById("checkout-elem") && (document.getElementById("checkout-elem").style.display = 0 == r ? "none" : "block")
            }))
        })), document.getElementsByClassName("cartitem-badge").forEach((function (e) {
            e.innerHTML = r
        })), document.getElementById("empty-cart") && (document.getElementById("empty-cart").style.display = "none"), document.getElementById("checkout-elem") && (document.getElementById("checkout-elem").style.display = "block"), T()), document.getElementsByClassName("notification-check") && document.querySelectorAll(".notification-check input").forEach((function (e) {
            e.addEventListener("click", (function (e) {
                e.target.closest(".notification-item").classList.toggle("active")
            }))
        })), [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map((function (e) {
            return new bootstrap.Tooltip(e)
        })), [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map((function (e) {
            return new bootstrap.Popover(e)
        })), document.getElementById("reset-layout") && document.getElementById("reset-layout").addEventListener("click", (function () {
            sessionStorage.clear(), window.location.reload()
        })), document.querySelectorAll("[data-toast]").forEach((function (e) {
            e.addEventListener("click", (function () {
                var t = {},
                    a = e.attributes;
                a["data-toast-text"] && (t.text = a["data-toast-text"].value.toString()), a["data-toast-gravity"] && (t.gravity = a["data-toast-gravity"].value.toString()), a["data-toast-position"] && (t.position = a["data-toast-position"].value.toString()), a["data-toast-className"] && (t.className = a["data-toast-className"].value.toString()), a["data-toast-duration"] && (t.duration = a["data-toast-duration"].value.toString()), a["data-toast-close"] && (t.close = a["data-toast-close"].value.toString()), a["data-toast-style"] && (t.style = a["data-toast-style"].value.toString()), a["data-toast-offset"] && (t.offset = a["data-toast-offset"]), Toastify({
                    newWindow: !0,
                    text: t.text,
                    gravity: t.gravity,
                    position: t.position,
                    className: "bg-" + t.className,
                    stopOnFocus: !0,
                    offset: {
                        x: t.offset ? 50 : 0,
                        y: t.offset ? 10 : 0
                    },
                    duration: t.duration,
                    close: "close" == t.close,
                    style: "style" == t.style ? {
                        background: "linear-gradient(to right, #0AB39C, #405189)"
                    } : ""
                }).showToast()
            }))
        })), document.querySelectorAll("[data-choices]").forEach((function (e) {
            var t = {},
                a = e.attributes;
            a["data-choices-groups"] && (t.placeholderValue = "This is a placeholder set in the config"), a["data-choices-search-false"] && (t.searchEnabled = !1), a["data-choices-search-true"] && (t.searchEnabled = !0), a["data-choices-removeItem"] && (t.removeItemButton = !0), a["data-choices-sorting-false"] && (t.shouldSort = !1), a["data-choices-sorting-true"] && (t.shouldSort = !0), a["data-choices-multiple-remove"] && (t.removeItemButton = !0), a["data-choices-limit"] && (t.maxItemCount = a["data-choices-limit"].value.toString()), a["data-choices-limit"] && (t.maxItemCount = a["data-choices-limit"].value.toString()), a["data-choices-editItem-true"] && (t.maxItemCount = !0), a["data-choices-editItem-false"] && (t.maxItemCount = !1), a["data-choices-text-unique-true"] && (t.duplicateItemsAllowed = !1), a["data-choices-text-disabled-true"] && (t.addItems = !1), a["data-choices-text-disabled-true"] ? new Choices(e, t).disable() : new Choices(e, t)
        })), document.querySelectorAll("[data-provider]").forEach((function (e) {
            var t, a, o;
            "flatpickr" == e.getAttribute("data-provider") ? (o = {}, (t = e.attributes)["data-date-format"] && (o.dateFormat = t["data-date-format"].value.toString()), t["data-enable-time"] && (o.enableTime = !0, o.dateFormat = t["data-date-format"].value.toString() + " H:i"), t["data-altFormat"] && (o.altInput = !0, o.altFormat = t["data-altFormat"].value.toString()), t["data-minDate"] && (o.minDate = t["data-minDate"].value.toString(), o.dateFormat = t["data-date-format"].value.toString()), t["data-maxDate"] && (o.maxDate = t["data-maxDate"].value.toString(), o.dateFormat = t["data-date-format"].value.toString()), t["data-deafult-date"] && (o.defaultDate = t["data-deafult-date"].value.toString(), o.dateFormat = t["data-date-format"].value.toString()), t["data-multiple-date"] && (o.mode = "multiple", o.dateFormat = t["data-date-format"].value.toString()), t["data-range-date"] && (o.mode = "range", o.dateFormat = t["data-date-format"].value.toString()), t["data-inline-date"] && (o.inline = !0, o.defaultDate = t["data-deafult-date"].value.toString(), o.dateFormat = t["data-date-format"].value.toString()), t["data-disable-date"] && ((a = []).push(t["data-disable-date"].value), o.disable = a.toString().split(",")), flatpickr(e, o)) : "timepickr" == e.getAttribute("data-provider") && (a = {}, (o = e.attributes)["data-time-basic"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i"), o["data-time-hrs"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.time_24hr = !0), o["data-min-time"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.minTime = o["data-min-time"].value.toString()), o["data-max-time"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.minTime = o["data-max-time"].value.toString()), o["data-default-time"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.defaultDate = o["data-default-time"].value.toString()), o["data-time-inline"] && (a.enableTime = !0, a.noCalendar = !0, a.defaultDate = o["data-time-inline"].value.toString(), a.inline = !0), flatpickr(e, a))
        })), document.querySelectorAll('.dropdown-menu a[data-bs-toggle="tab"]').forEach((function (e) {
            e.addEventListener("click", (function (e) {
                e.stopPropagation(), bootstrap.Tab.getInstance(e.target).show()
            }))
        })),
        function () {
            "null" != u && "en" !== u && g(u);
            var e = document.getElementsByClassName("language");
            e && e.forEach((function (e) {
                e.addEventListener("click", (function (t) {
                    g(e.getAttribute("data-lang"))
                }))
            }))
        }(), y(), B(), window.addEventListener("resize", (function () {
            c && clearTimeout(c), c = setTimeout(C, 2e3)
        }))
}();
var mybutton = document.getElementById("back-to-top");

function scrollFunction() {
    100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ? mybutton.style.display = "block" : mybutton.style.display = "none"
}

function topFunction() {
    document.body.scrollTop = 0, document.documentElement.scrollTop = 0
}
window.onscroll = function () {
    scrollFunction()
};
