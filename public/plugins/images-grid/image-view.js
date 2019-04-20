! function (t) {
    function i(i, s) {
        this.init = function (i, s) {
            this.$obj = t(i), this.$targets = t(s.targetSelector, this.$obj), this.opts = s, this.i = 0, this.last = this.$targets.length - 1, this.deploy()
        }, this.deploy = function () {
            this.$viewer = t('<div class="imageview"><div class="title"></div><a href="javascript:;" class="hide"></a><a href="javascript:;" class="prev"></a><a href="javascript:;" class="next"></a><div class="image"><img src="" /></div></div>').appendTo("body"), this.$title = t(".title", this.$viewer), this.$hide = t(".hide", this.$viewer), this.$prev = t(".prev", this.$viewer), this.$next = t(".next", this.$viewer), this.$image = t(".image img", this.$viewer), this.$hide.click(t.proxy(this.hide, this)), this.$prev.click(t.proxy(this.prev, this)), this.$next.click(t.proxy(this.next, this)), this.$image.bind("load", function () {
                t(this).fadeIn()
            }), t("body").keydown(t.proxy(this.keydown, this));
            var i = this;
            this.$targets.each(function (s) {
                t(this).click(function (t) {
                    return i.show(s), !1
                })
            })
        }, this.hide = function () {
            this.$viewer.fadeOut()
        }, this.keydown = function (t) {
            this.$viewer.is(":visible") && (37 == t.keyCode && this.i > 0 && this.prev(), 39 == t.keyCode && this.i < this.last && this.next())
        }, this.next = function () {
            this.show(this.i + 1)
        }, this.prev = function () {
            this.show(this.i - 1)
        }, this.show = function (t) {
            var i = this.$targets.eq(t);
            this.i = t, this.$title.text(i.attr(this.opts.titleAttr)), this.$prev.toggle(t > 0), this.$next.toggle(t < this.last), this.$viewer.fadeIn(), this.$image.hide().attr("src", i.attr(this.opts.srcAttr))
        }, this.init(i, s)
    }
    t.fn.imageview = function (s) {
        var e = {
                targetSelector: "a",
                srcAttr: "href",
                titleAttr: "title"
            },
            h = t.extend(e, s);
        return this.each(function () {
            t(this).data("imageview", new i(this, h))
        })
    }
}(jQuery);