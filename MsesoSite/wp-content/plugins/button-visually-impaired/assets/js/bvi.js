(function (b) {
    var a = {
        init: function (d) {
            var c = b(this).selector;
            var d = b.extend({
                panel_bvi: 1,
                panel_bg: "white",
                panel_font_size: "14",
                panel_img: 1
            }, d);
            if (Cookies.get("panel_bvi") == "1") {
                a.panel();
                a.link(d);
                a.panel_img();
                a.panel_bg_color();
                a.panel_font_size();
                b(c).hide();
                b(c).after(b('<span class="panel_close" style="cursor:pointer">').text("Обычная версия"))
            } else {
                b(".panel_close").remove();
                b(c).show()
            }
            b(c).click(function (f) {
                f.preventDefault();
                Cookies.set("panel_bvi", d.panel_bvi, {
                    path: "/"
                });
                Cookies.set("panel_bg", d.panel_bg, {
                    path: "/"
                });
                Cookies.set("panel_font_size", d.panel_font_size, {
                    path: "/"
                });
                Cookies.set("panel_img", d.panel_img, {
                    path: "/"
                });
                Cookies.set("panel_reload", d.panel_reload, {
                    path: "/"
                });
                a.panel();
                a.link(d);
                a.panel_img();
                a.panel_bg_color();
                a.panel_font_size();
                b(c).hide();
                b(c).after(b('<span class="panel_close" style="cursor:pointer">').text("Обычная версия"));
                return false
            })
        },
        return_set: function (c) {
            b("*").not(".panel_img_not_small, .panel_bvi, .panel_bvi *,.panel_bvi img .bvi_text-black, .bvi_text-white, .fa").each(function () {
                b(this).css({
                    "font-family": c.font_family,
                    "background-color": c.background_color,
                    "background-image": "none",
                    color: c.color,
                    "font-size": c.font_size,
                    "box-shadow": "none",
                    "text-shadow": "none",
                    "letter-spacing": c.letter_spacing,
                    "border-color": c.color
                })
            })
        },
        panel_font_size: function () {
            if (Cookies.get("panel_font_size") == "14") {
                b("#panel_font_size_14").addClass("active");
                a.return_set({
                    font_size: "30px"                    
                })
            } else {
                b("#panel_font_size_14").removeClass("active")
            }
            if (Cookies.get("panel_font_size") == "18") {
                b("#panel_font_size_18").addClass("active");
                a.return_set({
                    font_size: "18px"
                })
            } else {
                b("#panel_font_size_18").removeClass("active")
            }
            if (Cookies.get("panel_font_size") == "23") {
                b("#panel_font_size_23").addClass("active");
                a.return_set({
                    font_size: "14px"
                })
            } else {
                b("#panel_font_size_23").removeClass("active")
            }
        },
        panel_bg_color: function () {
            if (Cookies.get("panel_bg") == "white") {
                a.return_set({
                    background_color: "#ffffff",
                    color: "#000000"
                })
            }
            if (Cookies.get("panel_bg") == "black") {
                a.return_set({
                    background_color: "#000000",
                    color: "#ffffff"
                })
            }
            if (Cookies.get("panel_bg") == "blue") {
                a.return_set({
                    background_color: "#9DD1FF",
                    color: "#063462"
                })
            }
            if (Cookies.get("panel_bg") == "brown") {
                a.return_set({
                    background_color: "#f7f3d6",
                    color: "#4d4b43"
                })
            }
            if (Cookies.get("panel_bg") == "green") {
                a.return_set({
                    background_color: "#3B2716",
                    color: "#A9E44D"
                })
            }
        },
        panel_img: function () {
            b(".panel_img_not").remove();
            if (Cookies.get("panel_img") == 1) {
                b("img").each(function () {
                    b(this).show()
                });
                b(".panel_img_on").hide();
                b(".panel_img_off").show();
                b(".panel_img_on").removeClass("active");
                b(".panel_img_off").addClass("no-active")
            } else {
                b("img").each(function () {
                    var d = b(this).attr("alt") || "";
                    b(this).hide();
                    if (Cookies.get("panel_img_X_Y") == 1) {
                        b(this).after(b('<div class="panel_img_not" style="width: ' + b(this).width() + "px; height: " + b(this).height() + 'px">').html("Изображение : " + d))
                    } else {
                        b(this).after(b('<div class="panel_img_not">').text("Изображение : " + d))
                    }
                });
                b(".panel_img_off").hide();
                b(".panel_img_on").show();
                b(".panel_img_off").removeClass("no-active");
                b(".panel_img_on").addClass("active")
            }
        },
        link: function (c) {
            b(document).on("click", ".panel_close", function () {
                Cookies.set("panel_bvi", "0", {
                    path: "/"
                });
                b(".panel_bvi").remove();
                b(".panel_close").remove();
                b(".panel_img_not").remove();
                b("*").each(function () {
                    b(this).removeAttr("style")
                });
                a.panel()
            });
            b("#panel_close, .panel_close").click(function () {
                Cookies.set("panel_bvi", "0", {
                    path: "/"
                });
                b(".panel_bvi").remove();
                b(".panel_close").remove();
                b(".panel_img_not").remove();
                b("*").each(function () {
                    b(this).removeAttr("style")
                });
                a.panel();
                return false
            });
            b(".panel_img_on").click(function () {
                Cookies.set("panel_img", "1", {
                    path: "/"
                });
                a.panel_img();
                return false
            });
            b(".panel_img_off").click(function () {
                Cookies.set("panel_img", "0", {
                    path: "/"
                });
                a.panel_img();
                return false
            });
            b("#panel_bg_white, .panel_bg_white").click(function () {
                Cookies.set("panel_bg", "white", {
                    path: "/"
                });
                a.panel_bg_color();
                return false
            });
            b("#panel_bg_black, .panel_bg_black").click(function () {
                Cookies.set("panel_bg", "black", {
                    path: "/"
                });
                a.panel_bg_color();
                return false
            });
            b("#panel_bg_blue, .panel_bg_blue").click(function () {
                Cookies.set("panel_bg", "blue", {
                    path: "/"
                });
                a.panel_bg_color();
                return false
            });
            b("#panel_font_size_14").click(function () {
                Cookies.set("panel_font_size", "14", {
                    path: "/"
                });
                a.panel_font_size();
                return false
            });
            b("#panel_font_size_18").click(function () {
                Cookies.set("panel_font_size", "18", {
                    path: "/"
                });
                a.panel_font_size();
                return false
            });
            b("#panel_font_size_23").click(function () {
                Cookies.set("panel_font_size", "23", {
                    path: "/"
                });
                a.panel_font_size();
                return false
            })
        },
        panel: function () {
            if (Cookies.get("panel_bvi") == "1") {
                b('<div class="panel_bvi"></div>').prependTo("body");
                b(".panel_bvi").addClass("animated fadeInDown");
                b('<div class="panel_bvi_menu"></div>').appendTo(".panel_bvi");
                b('<span id="panel_bvi_2">Размер шрифта:<a href="#" id="panel_font_size_14" title="Размер шрифта 14 пиксилей">А</a><a href="#" id="panel_font_size_18" title="Размер шрифта 18 пиксилей">А</a><a href="#" id="panel_font_size_23" title="Размер шрифта 23 пиксиля">А</a></span>').appendTo(".panel_bvi_menu");
                b('<span id="panel_bvi_4">Цвета сайта:<a href="#" id="panel_bg_white" title="Цветовая схема Черным по белому">Ц</a><a href="#" id="panel_bg_black" title="Цветовая схема Белым по черному">Ц</a><a href="#" id="panel_bg_blue" title="Цветовая схема Темно-синим по голубому">Ц</a></span>').appendTo(".panel_bvi_menu");
                b('<span id="panel_bvi_3">Изображения <a href="#" class="panel_img_on" title="Включить изображения"></a><a href="#" class="panel_img_off" title="Отключить изображения"></a>&nbsp;&nbsp;&nbsp;<a href="#" class="panel_close" title="Обычная версия сайта"> </a></span>').appendTo(".panel_bvi_menu")
            } else {
                b(".panel_close").remove();
                document.location.reload()
                if (Cookies.get("panel_reload") == "1") {
                    document.location.reload(true)
                }
                Cookies.remove("panel_bvi", {
                    path: "/"
                });
                Cookies.remove("panel_bg", {
                    path: "/"
                });
                Cookies.remove("panel_font_size", {
                    path: "/"
                });
                Cookies.remove("panel_img", {
                    path: "/"
                });
                Cookies.remove("panel_reload", {
                    path: "/"
                })
                
            }
        }
    };
    b.fn.bvi = function (c) {
        if (a[c]) {
            return a[c].apply(this, Array.prototype.slice.call(arguments, 1))
        } else {
            if (typeof c === "object" || !c) {
                return a.init.apply(this, arguments)
            } else {
                b.error("Метод с именем " + c + " не существует для jQuery.bvi")
            }
        }
    }
})(jQuery);