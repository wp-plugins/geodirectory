/* Placeholders.js v3.0.2  fixes placeholder support for older browsers */
(function (t) {
    "use strict";
    function e(t, e, r) {
        return t.addEventListener ? t.addEventListener(e, r, !1) : t.attachEvent ? t.attachEvent("on" + e, r) : void 0
    }

    function r(t, e) {
        var r, n;
        for (r = 0, n = t.length; n > r; r++)if (t[r] === e)return !0;
        return !1
    }

    function n(t, e) {
        var r;
        t.createTextRange ? (r = t.createTextRange(), r.move("character", e), r.select()) : t.selectionStart && (t.focus(), t.setSelectionRange(e, e))
    }

    function a(t, e) {
        try {
            return t.type = e, !0
        } catch (r) {
            return !1
        }
    }

    t.Placeholders = {Utils: {addEventListener: e, inArray: r, moveCaret: n, changeType: a}}
})(this), function (t) {
    "use strict";
    function e() {
    }

    function r() {
        try {
            return document.activeElement
        } catch (t) {
        }
    }

    function n(t, e) {
        var r, n, a = !!e && t.value !== e, u = t.value === t.getAttribute(V);
        return (a || u) && "true" === t.getAttribute(D) ? (t.removeAttribute(D), t.value = t.value.replace(t.getAttribute(V), ""), t.className = t.className.replace(R, ""), n = t.getAttribute(F), parseInt(n, 10) >= 0 && (t.setAttribute("maxLength", n), t.removeAttribute(F)), r = t.getAttribute(P), r && (t.type = r), !0) : !1
    }

    function a(t) {
        var e, r, n = t.getAttribute(V);
        return "" === t.value && n ? (t.setAttribute(D, "true"), t.value = n, t.className += " " + I, r = t.getAttribute(F), r || (t.setAttribute(F, t.maxLength), t.removeAttribute("maxLength")), e = t.getAttribute(P), e ? t.type = "text" : "password" === t.type && M.changeType(t, "text") && t.setAttribute(P, "password"), !0) : !1
    }

    function u(t, e) {
        var r, n, a, u, i, l, o;
        if (t && t.getAttribute(V))e(t); else for (a = t ? t.getElementsByTagName("input") : b, u = t ? t.getElementsByTagName("textarea") : f, r = a ? a.length : 0, n = u ? u.length : 0, o = 0, l = r + n; l > o; o++)i = r > o ? a[o] : u[o - r], e(i)
    }

    function i(t) {
        u(t, n)
    }

    function l(t) {
        u(t, a)
    }

    function o(t) {
        return function () {
            m && t.value === t.getAttribute(V) && "true" === t.getAttribute(D) ? M.moveCaret(t, 0) : n(t)
        }
    }

    function c(t) {
        return function () {
            a(t)
        }
    }

    function s(t) {
        return function (e) {
            return A = t.value, "true" === t.getAttribute(D) && A === t.getAttribute(V) && M.inArray(C, e.keyCode) ? (e.preventDefault && e.preventDefault(), !1) : void 0
        }
    }

    function d(t) {
        return function () {
            n(t, A), "" === t.value && (t.blur(), M.moveCaret(t, 0))
        }
    }

    function g(t) {
        return function () {
            t === r() && t.value === t.getAttribute(V) && "true" === t.getAttribute(D) && M.moveCaret(t, 0)
        }
    }

    function v(t) {
        return function () {
            i(t)
        }
    }

    function p(t) {
        t.form && (T = t.form, "string" == typeof T && (T = document.getElementById(T)), T.getAttribute(U) || (M.addEventListener(T, "submit", v(T)), T.setAttribute(U, "true"))), M.addEventListener(t, "focus", o(t)), M.addEventListener(t, "blur", c(t)), m && (M.addEventListener(t, "keydown", s(t)), M.addEventListener(t, "keyup", d(t)), M.addEventListener(t, "click", g(t))), t.setAttribute(j, "true"), t.setAttribute(V, x), (m || t !== r()) && a(t)
    }

    var b, f, m, h, A, y, E, x, L, T, N, S, w, B = ["text", "search", "url", "tel", "email", "password", "number", "textarea"], C = [27, 33, 34, 35, 36, 37, 38, 39, 40, 8, 46], k = "#ccc", I = "placeholdersjs", R = RegExp("(?:^|\\s)" + I + "(?!\\S)"), V = "data-placeholder-value", D = "data-placeholder-active", P = "data-placeholder-type", U = "data-placeholder-submit", j = "data-placeholder-bound", q = "data-placeholder-focus", z = "data-placeholder-live", F = "data-placeholder-maxlength", G = document.createElement("input"), H = document.getElementsByTagName("head")[0], J = document.documentElement, K = t.Placeholders, M = K.Utils;
    if (K.nativeSupport = void 0 !== G.placeholder, !K.nativeSupport) {
        for (b = document.getElementsByTagName("input"), f = document.getElementsByTagName("textarea"), m = "false" === J.getAttribute(q), h = "false" !== J.getAttribute(z), y = document.createElement("style"), y.type = "text/css", E = document.createTextNode("." + I + " { color:" + k + "; }"), y.styleSheet ? y.styleSheet.cssText = E.nodeValue : y.appendChild(E), H.insertBefore(y, H.firstChild), w = 0, S = b.length + f.length; S > w; w++)N = b.length > w ? b[w] : f[w - b.length], x = N.attributes.placeholder, x && (x = x.nodeValue, x && M.inArray(B, N.type) && p(N));
        L = setInterval(function () {
            for (w = 0, S = b.length + f.length; S > w; w++)N = b.length > w ? b[w] : f[w - b.length], x = N.attributes.placeholder, x ? (x = x.nodeValue, x && M.inArray(B, N.type) && (N.getAttribute(j) || p(N), (x !== N.getAttribute(V) || "password" === N.type && !N.getAttribute(P)) && ("password" === N.type && !N.getAttribute(P) && M.changeType(N, "text") && N.setAttribute(P, "password"), N.value === N.getAttribute(V) && (N.value = x), N.setAttribute(V, x)))) : N.getAttribute(D) && (n(N), N.removeAttribute(V));
            h || clearInterval(L)
        }, 100)
    }
    M.addEventListener(t, "beforeunload", function () {
        K.disable()
    }), K.disable = K.nativeSupport ? e : i, K.enable = K.nativeSupport ? e : l
}(this);



jQuery(document).ready(function () {

    //toggle detail page tabs mobile menu
    jQuery('#geodir-tab-mobile-menu').click(function(){
        jQuery('#gd-tabs .geodir-tab-head').toggle();
    });

    gd_infowindow = new google.maps.InfoWindow();

    // Chosen selects
    if (jQuery("select.chosen_select").length > 0) {
        jQuery("select.chosen_select").chosen({
            no_results_text: "Sorry, nothing found!"
        });
        jQuery("select.chosen_select_nostd").chosen({
            allow_single_deselect: 'true'
        });
    }

    jQuery('.gd-cats-display-checkbox input[type="checkbox"]').click(function () {
        var isChecked = jQuery(this).is(':checked');
        var chkVal = jQuery(this).val();
        jQuery(this).closest('.gd-parent-cats-list').find('.gd-cat-row-' + chkVal + ' input[type="checkbox"]').prop("checked", isChecked);
    });

});

jQuery(document).ready(function () {


    jQuery('.geodir-delete').click(function () {
        if (confirm(geodir_all_js_msg.my_place_listing_del)) {
            return true;
        } else
            return false;
    });

    //jQuery('#gd-content').height(jQuery('#gd-content').parent('div').height());


    jQuery('.gd-category-dd').hover(function () {
        jQuery('.gd-category-dd ul').show();
    });

    jQuery('.gd-category-dd ul li a').click(function (ele) {

        jQuery('.gd-category-dd').find('input').val(jQuery(this).attr('data-slug'));
        jQuery('.gd-category-dd > a').html(jQuery(this).attr('data-name'));
        jQuery('.gd-category-dd ul').hide();
    });


});


jQuery(window).load(function () {

    /*-----------------------------------------------------------------------------------*/
    /*	Tabs
     /*-----------------------------------------------------------------------------------*/
    jQuery('.geodir-tabs-content').show(); // set the tabs to show once js loaded to avoid double scroll bar in chrome
    tabNoRun = false;
    function activateTab(tab) {

        // change name for mobile tabs menu
        tabName = urlHash = tab.find('a').html();
        if(tabName && jQuery('.geodir-mobile-active-tab').length){
            jQuery('.geodir-mobile-active-tab').html(tabName);
        }

        if (tabNoRun) {
            tabNoRun = false;
            return;
        }
        var activeTab = tab.closest('dl').find('dd.geodir-tab-active'),
            contentLocation = tab.find('a').attr("data-tab") + 'Tab';

        urlHash = tab.find('a').attr("data-tab");
        if (jQuery(tab).hasClass("geodir-tab-active")) {
        } else {

            if (typeof urlHash === 'undefined') {
                if (window.location.hash.substring(0, 8) == '#comment') {
                    tab = jQuery('*[data-tab="#reviews"]').parent();
                    tabNoRun = true;
                }


            } else {

                if (history.pushState) {
                    //history.pushState(null, null, urlHash);
                    history.replaceState(null, null, urlHash);// wont make the browser back button go back to prev has value
                }
                else {
                    window.location.hash = urlHash;
                }

            }
        }

        //Make Tab Active
        activeTab.removeClass('geodir-tab-active');
        tab.addClass('geodir-tab-active');

        //Show Tab Content
        jQuery(contentLocation).closest('.geodir-tabs-content').children('li').hide();
        jQuery(contentLocation).fadeIn();
        jQuery(contentLocation).css({'display': 'inline-block'});

        if (urlHash == '#post_map') {
            window.setTimeout(function () {
                jQuery("#detail_page_map_canvas").goMap();
                var center = jQuery.goMap.map.getCenter();
                google.maps.event.trigger(jQuery.goMap.map, 'resize');
                jQuery.goMap.map.setCenter(center);
            }, 100);
        }

        if (history.pushState && window.location.hash && jQuery('#publish_listing').length === 0) {
            if (jQuery(window).width() < 1060) {
                jQuery('html, body').animate({scrollTop: jQuery(urlHash).offset().top}, 500);
            }
        }
    }

    jQuery('dl.geodir-tab-head').each(function () {

        //Get all tabs
        var tabs = jQuery(this).children('dd');

        tabs.click(function (e) {
            if (jQuery(this).find('a').attr('data-status') == 'enable') {
                activateTab(jQuery(this));
            }
        });

    });


    if (window.location.hash) {
        activateTab(jQuery('a[data-tab="' + window.location.hash + '"]').parent());
    }

    /*jQuery('p').each(function() {
     var $this = jQuery(this);
     if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
     $this.remove();
     });*/

    jQuery('.gd-tabs .gd-tab-next').click(function (ele) {

        var is_validate = true;

        /*jQuery(this).parent('li').find(".required_field").each(function(){
         jQuery(this).find("select, textarea, input").each(function(rq_field){
         validate_field( rq_field );
         });
         });*/

        if (is_validate) {
            var tab = jQuery('dl.geodir-tab-head').find('dd.geodir-tab-active').next();

            if (tab.find('a').attr('data-status') == 'enable') {
                activateTab(tab);
            }


            if (!jQuery('dl.geodir-tab-head').find('dd.geodir-tab-active').next().is('dd')) {
                jQuery(this).hide();
                jQuery('#gd-add-listing-submit').show();
            }
        }

    });

    jQuery('#gd-login-options input').change(function () {
        jQuery('.gd-login_submit').toggle();
    });

    jQuery('ul.geodir-tabs-content').css({'z-index': '0', 'position': 'relative'});
    jQuery('dl.geodir-tab-head dd.geodir-tab-active').trigger('click');

});


/*-----------------------------------------------------------------------------------*/
/*	Auto Fill
 /*-----------------------------------------------------------------------------------*/

function autofill_click(ele) {
    var fill_value = jQuery(ele).html();
    jQuery(ele).closest('div.gd-autofill-dl').closest('div.gd-autofill').find('input[type=text]').val(fill_value);
    jQuery(ele).closest('.gd-autofill-dl').remove();
};

jQuery(document).ready(function () {
    jQuery('input[type=text]').keyup(function () {
        var input_field = jQuery(this);
        if (input_field.attr('data-type') == 'autofill' && input_field.attr('data-fill') != '') {
            var data_fill = input_field.attr('data-fill');
            var fill_value = jQuery(this).val();
            jQuery.get(geodir_var.geodir_ajax_url, {
                autofill: data_fill,
                fill_str: fill_value
            }, function (data) {
                if (data != '') {
                    if (input_field.closest('div.gd-autofill').length == 0) input_field.wrap('<div class="gd-autofill"></div>');
                    input_field.closest('div.gd-autofill').find('.gd-autofill-dl').remove();
                    input_field.after('<div class="gd-autofill-dl"></div>');
                    input_field.next('.gd-autofill-dl').html(data);
                    input_field.focus();
                }
            });
        }
    });

    jQuery('input[type=text]').parent().mouseleave(function () {
        jQuery(this).find('.gd-autofill-dl').remove();
    });

    jQuery(".trigger").click(function () {
        jQuery(this).toggleClass("active").next().slideToggle("slow");
		var aD = jQuery(this).toggleClass("active").next().hasClass('map_category') ? true : false;
		if (jQuery(".trigger").hasClass("triggeroff")) {
			jQuery(".trigger").removeClass('triggeroff');
            jQuery(".trigger").addClass('triggeron');
			if (aD) {
				gd_compress_animate(this, 0);
			}
        } else {
			jQuery(".trigger").removeClass('triggeron');
            jQuery(".trigger").addClass('triggeroff');
			
			if (aD) {
				gd_compress_animate(this, parseFloat(jQuery(this).toggleClass("active").next().outerWidth()));
			}
        }
    });
	jQuery(".trigger").each(function() {
		if (jQuery(this).hasClass('triggeroff') && jQuery(this).next().hasClass('map_category')) {
			gd_compress_animate(this, parseFloat(jQuery(this).next().outerWidth()));
		}
	});

    jQuery(".trigger_sticky").click(function () {
        var effect = 'slide';
        var options = {
            direction: 'right'
        };
        var duration = 500;
        var tigger_sticky = jQuery(this);
        tigger_sticky.hide();
        jQuery('div.stickymap').toggle(effect, options, duration, function () {
            tigger_sticky.show();
        });
        if (tigger_sticky.hasClass("triggeroff_sticky")) {
            tigger_sticky.removeClass('triggeroff_sticky');
            tigger_sticky.addClass('triggeron_sticky');
            setCookie('geodir_stickystatus', 'shide', 1);
        } else {
            tigger_sticky.removeClass('triggeron_sticky');
            tigger_sticky.addClass('triggeroff_sticky');
            setCookie('geodir_stickystatus', 'sshow', 1);
        }
    });
	
	function gd_compress_animate(e, r) {
		jQuery(e).animate({"margin-right":r + "px"}, "fast");
	}
	
	var gd_modal = "undefined" != typeof geodir_var.geodir_gd_modal && 1 == parseInt(geodir_var.geodir_gd_modal) ? false : true;
	if (gd_modal) {
		jQuery(".geodir-custom-post-gallery").each(function(){
			jQuery("a", this).lightBox({
				overlayOpacity: .5,
				imageLoading: geodir_var.geodir_plugin_url + "/geodirectory-assets/images/lightbox-ico-loading.gif",
				imageBtnNext: geodir_var.geodir_plugin_url + "/geodirectory-assets/images/lightbox-btn-next.gif",
				imageBtnPrev: geodir_var.geodir_plugin_url + "/geodirectory-assets/images/lightbox-btn-prev.gif",
				imageBtnClose: geodir_var.geodir_plugin_url + "/geodirectory-assets/images/lightbox-btn-close.gif",
				imageBlank: geodir_var.geodir_plugin_url + "/geodirectory-assets/images/lightbox-blank.gif"
			})
		});
	}
});

/* Show Hide Rating for reply */
jQuery(document).ready(function () {
    jQuery('.gd_comment_replaylink a').bind('click', function () {
        jQuery('#commentform #err_no_rating').remove();
        jQuery('#commentform .gd_rating').hide();
        jQuery('#respond .form-submit input#submit').val(geodir_all_js_msg.gd_cmt_btn_post_reply);
        jQuery('#respond .comment-form-comment label').html(geodir_all_js_msg.gd_cmt_btn_reply_text);
    });
    jQuery('#gd_cancle_replaylink a').bind('click', function () {
        jQuery('#commentform #err_no_rating').remove();
        jQuery('#commentform .gd_rating').show();
        jQuery('#respond .form-submit input#submit').val(geodir_all_js_msg.gd_cmt_btn_post_review);
        jQuery('#respond .comment-form-comment label').html(geodir_all_js_msg.gd_cmt_btn_review_text);
    });
    jQuery('#commentform .gd_rating').each(function () {
        var rat_obj = this;
        var $frm_obj = jQuery(rat_obj).closest('#commentform');
        if (parseInt($frm_obj.find('#comment_parent').val()) > 0) {
            jQuery('#commentform #err_no_rating').remove();
            jQuery('#commentform .gd_rating').hide();
            jQuery('#respond .form-submit input#submit').val(geodir_all_js_msg.gd_cmt_btn_post_reply);
            jQuery('#respond .comment-form-comment label').html(geodir_all_js_msg.gd_cmt_btn_reply_text);
        }
        $frm_obj.find('input[name="submit"]').click(function (e) {
            $frm_obj.find('#err_no_rating').remove();
            // skip rating stars validation if rating stars disabled
            if (typeof geodir_all_js_msg.gd_cmt_disable_rating != 'undefined' && geodir_all_js_msg.gd_cmt_disable_rating) {
                return true;
            }
            //
            var is_review = parseInt($frm_obj.find('#comment_parent').val());
            is_review = is_review == 0 ? true : false;
            if (is_review) {
                var btn_obj = this;
                var invalid = 0;
                $frm_obj.find('input[name^=geodir_overallrating]').each(function () {
                    var star_obj = this;
                    var star = parseInt(jQuery(star_obj).val());
                    if (!star > 0) {
                        invalid++;
                    }
                });
                if (invalid > 0) {
                    jQuery(rat_obj).after('<div id="err_no_rating" class="err-no-rating">' + geodir_all_js_msg.gd_cmt_err_no_rating + '</div>');
                    return false;
                }
                return true;
            }
        });
    });
});


/* Show Hide Filters End*/
/* Hide Pinpoint If Listing MAP Not On Page*/
jQuery(window).load(function () {
    if (jQuery(".map_background").length == 0) {
        jQuery('.geodir-pinpoint').hide();
    } else {
        jQuery('.geodir-pinpoint').show();
    }
});

//-------count post according to term--
function geodir_get_post_term(el) {
    limit = jQuery(el).data('limit');
    term = jQuery(el).val();//data('term');
    jQuery(el).parent().parent().find('.geodir-popular-cat-list').html('<i class="fa fa-cog fa-spin"></i>');
    jQuery(el).parent().parent().parent().find('.geodir-cat-list-more').hide();
    jQuery.post(geodir_all_js_msg.geodir_admin_ajax_url + '?action=geodir_ajax_action', {
        ajax_action: "geodir_get_term_list",
        term: term,
        limit: limit
    }).done(function (data) {
        if (jQuery.trim(data) != '') {
            jQuery(el).parent().parent().find('.geodir-popular-cat-list').hide().html(data).fadeIn('slow');
            if (jQuery(el).parent().parent().find('.geodir-popular-cat-list li').length > limit) {
                jQuery(el).parent().parent().parent().find('.geodir-cat-list-more').fadeIn('slow');
            }
        }
    });
}

/*
 we recalc the stars because some browsers can't do subpixle percents, we should be able to remove this in a few years.
 */
jQuery(window).load(function() {
	geodir_resize_rating_stars();
});
jQuery(window).resize(function() {
	geodir_resize_rating_stars(true);
});
/**
 * Adjust/resize rating stars width.
 */
function geodir_resize_rating_stars(re) {
	jQuery('.geodir-rating').each(function() {
		var $this = jQuery(this);
		var parent_width = $this.width();
		if (!parent_width) {
			return true;
		}
		var star_width = $this.find(".geodir_Star img").width();
		var star_count = $this.find(".geodir_Star img").length;
		var width_calc = star_width * star_count;
		width_calc = typeof re != 'undefined' && re ? 'auto' : width_calc;
		$this.width(width_calc);
	});
}
// fix for related accents search.
function gd_replace_accents (s) {
    var chars = [{'base':'A', 'letters':/[\u0041\u24B6\uFF21\u00C0\u00C1\u00C2\u1EA6\u1EA4\u1EAA\u1EA8\u00C3\u0100\u0102\u1EB0\u1EAE\u1EB4\u1EB2\u0226\u01E0\u00C4\u01DE\u1EA2\u00C5\u01FA\u01CD\u0200\u0202\u1EA0\u1EAC\u1EB6\u1E00\u0104\u023A\u2C6F]/g},
    {'base':'AA','letters':/[\uA732]/g},
    {'base':'AE','letters':/[\u00C6\u01FC\u01E2]/g},
    {'base':'AO','letters':/[\uA734]/g},
    {'base':'AU','letters':/[\uA736]/g},
    {'base':'AV','letters':/[\uA738\uA73A]/g},
    {'base':'AY','letters':/[\uA73C]/g},
    {'base':'B', 'letters':/[\u0042\u24B7\uFF22\u1E02\u1E04\u1E06\u0243\u0182\u0181]/g},
    {'base':'C', 'letters':/[\u0043\u24B8\uFF23\u0106\u0108\u010A\u010C\u00C7\u1E08\u0187\u023B\uA73E]/g},
    {'base':'D', 'letters':/[\u0044\u24B9\uFF24\u1E0A\u010E\u1E0C\u1E10\u1E12\u1E0E\u0110\u018B\u018A\u0189\uA779]/g},
    {'base':'DZ','letters':/[\u01F1\u01C4]/g},
    {'base':'Dz','letters':/[\u01F2\u01C5]/g},
    {'base':'E', 'letters':/[\u0045\u24BA\uFF25\u00C8\u00C9\u00CA\u1EC0\u1EBE\u1EC4\u1EC2\u1EBC\u0112\u1E14\u1E16\u0114\u0116\u00CB\u1EBA\u011A\u0204\u0206\u1EB8\u1EC6\u0228\u1E1C\u0118\u1E18\u1E1A\u0190\u018E]/g},
    {'base':'F', 'letters':/[\u0046\u24BB\uFF26\u1E1E\u0191\uA77B]/g},
    {'base':'G', 'letters':/[\u0047\u24BC\uFF27\u01F4\u011C\u1E20\u011E\u0120\u01E6\u0122\u01E4\u0193\uA7A0\uA77D\uA77E]/g},
    {'base':'H', 'letters':/[\u0048\u24BD\uFF28\u0124\u1E22\u1E26\u021E\u1E24\u1E28\u1E2A\u0126\u2C67\u2C75\uA78D]/g},
    {'base':'I', 'letters':/[\u0049\u24BE\uFF29\u00CC\u00CD\u00CE\u0128\u012A\u012C\u0130\u00CF\u1E2E\u1EC8\u01CF\u0208\u020A\u1ECA\u012E\u1E2C\u0197]/g},
    {'base':'J', 'letters':/[\u004A\u24BF\uFF2A\u0134\u0248]/g},
    {'base':'K', 'letters':/[\u004B\u24C0\uFF2B\u1E30\u01E8\u1E32\u0136\u1E34\u0198\u2C69\uA740\uA742\uA744\uA7A2]/g},
    {'base':'L', 'letters':/[\u004C\u24C1\uFF2C\u013F\u0139\u013D\u1E36\u1E38\u013B\u1E3C\u1E3A\u0141\u023D\u2C62\u2C60\uA748\uA746\uA780]/g},
    {'base':'LJ','letters':/[\u01C7]/g},
    {'base':'Lj','letters':/[\u01C8]/g},
    {'base':'M', 'letters':/[\u004D\u24C2\uFF2D\u1E3E\u1E40\u1E42\u2C6E\u019C]/g},
    {'base':'N', 'letters':/[\u004E\u24C3\uFF2E\u01F8\u0143\u00D1\u1E44\u0147\u1E46\u0145\u1E4A\u1E48\u0220\u019D\uA790\uA7A4]/g},
    {'base':'NJ','letters':/[\u01CA]/g},
    {'base':'Nj','letters':/[\u01CB]/g},
    {'base':'O', 'letters':/[\u004F\u24C4\uFF2F\u00D2\u00D3\u00D4\u1ED2\u1ED0\u1ED6\u1ED4\u00D5\u1E4C\u022C\u1E4E\u014C\u1E50\u1E52\u014E\u022E\u0230\u00D6\u022A\u1ECE\u0150\u01D1\u020C\u020E\u01A0\u1EDC\u1EDA\u1EE0\u1EDE\u1EE2\u1ECC\u1ED8\u01EA\u01EC\u00D8\u01FE\u0186\u019F\uA74A\uA74C]/g},
    {'base':'OI','letters':/[\u01A2]/g},
    {'base':'OO','letters':/[\uA74E]/g},
    {'base':'OU','letters':/[\u0222]/g},
    {'base':'P', 'letters':/[\u0050\u24C5\uFF30\u1E54\u1E56\u01A4\u2C63\uA750\uA752\uA754]/g},
    {'base':'Q', 'letters':/[\u0051\u24C6\uFF31\uA756\uA758\u024A]/g},
    {'base':'R', 'letters':/[\u0052\u24C7\uFF32\u0154\u1E58\u0158\u0210\u0212\u1E5A\u1E5C\u0156\u1E5E\u024C\u2C64\uA75A\uA7A6\uA782]/g},
    {'base':'S', 'letters':/[\u0053\u24C8\uFF33\u1E9E\u015A\u1E64\u015C\u1E60\u0160\u1E66\u1E62\u1E68\u0218\u015E\u2C7E\uA7A8\uA784]/g},
    {'base':'T', 'letters':/[\u0054\u24C9\uFF34\u1E6A\u0164\u1E6C\u021A\u0162\u1E70\u1E6E\u0166\u01AC\u01AE\u023E\uA786]/g},
    {'base':'TZ','letters':/[\uA728]/g},
    {'base':'U', 'letters':/[\u0055\u24CA\uFF35\u00D9\u00DA\u00DB\u0168\u1E78\u016A\u1E7A\u016C\u00DC\u01DB\u01D7\u01D5\u01D9\u1EE6\u016E\u0170\u01D3\u0214\u0216\u01AF\u1EEA\u1EE8\u1EEE\u1EEC\u1EF0\u1EE4\u1E72\u0172\u1E76\u1E74\u0244]/g},
    {'base':'V', 'letters':/[\u0056\u24CB\uFF36\u1E7C\u1E7E\u01B2\uA75E\u0245]/g},
    {'base':'VY','letters':/[\uA760]/g},
    {'base':'W', 'letters':/[\u0057\u24CC\uFF37\u1E80\u1E82\u0174\u1E86\u1E84\u1E88\u2C72]/g},
    {'base':'X', 'letters':/[\u0058\u24CD\uFF38\u1E8A\u1E8C]/g},
    {'base':'Y', 'letters':/[\u0059\u24CE\uFF39\u1EF2\u00DD\u0176\u1EF8\u0232\u1E8E\u0178\u1EF6\u1EF4\u01B3\u024E\u1EFE]/g},
    {'base':'Z', 'letters':/[\u005A\u24CF\uFF3A\u0179\u1E90\u017B\u017D\u1E92\u1E94\u01B5\u0224\u2C7F\u2C6B\uA762]/g},
    {'base':'a', 'letters':/[\u0061\u24D0\uFF41\u1E9A\u00E0\u00E1\u00E2\u1EA7\u1EA5\u1EAB\u1EA9\u00E3\u0101\u0103\u1EB1\u1EAF\u1EB5\u1EB3\u0227\u01E1\u00E4\u01DF\u1EA3\u00E5\u01FB\u01CE\u0201\u0203\u1EA1\u1EAD\u1EB7\u1E01\u0105\u2C65\u0250]/g},
    {'base':'aa','letters':/[\uA733]/g},
    {'base':'ae','letters':/[\u00E6\u01FD\u01E3]/g},
    {'base':'ao','letters':/[\uA735]/g},
    {'base':'au','letters':/[\uA737]/g},
    {'base':'av','letters':/[\uA739\uA73B]/g},
    {'base':'ay','letters':/[\uA73D]/g},
    {'base':'b', 'letters':/[\u0062\u24D1\uFF42\u1E03\u1E05\u1E07\u0180\u0183\u0253]/g},
    {'base':'c', 'letters':/[\u0063\u24D2\uFF43\u0107\u0109\u010B\u010D\u00E7\u1E09\u0188\u023C\uA73F\u2184]/g},
    {'base':'d', 'letters':/[\u0064\u24D3\uFF44\u1E0B\u010F\u1E0D\u1E11\u1E13\u1E0F\u0111\u018C\u0256\u0257\uA77A]/g},
    {'base':'dz','letters':/[\u01F3\u01C6]/g},
    {'base':'e', 'letters':/[\u0065\u24D4\uFF45\u00E8\u00E9\u00EA\u1EC1\u1EBF\u1EC5\u1EC3\u1EBD\u0113\u1E15\u1E17\u0115\u0117\u00EB\u1EBB\u011B\u0205\u0207\u1EB9\u1EC7\u0229\u1E1D\u0119\u1E19\u1E1B\u0247\u025B\u01DD]/g},
    {'base':'f', 'letters':/[\u0066\u24D5\uFF46\u1E1F\u0192\uA77C]/g},
    {'base':'g', 'letters':/[\u0067\u24D6\uFF47\u01F5\u011D\u1E21\u011F\u0121\u01E7\u0123\u01E5\u0260\uA7A1\u1D79\uA77F]/g},
    {'base':'h', 'letters':/[\u0068\u24D7\uFF48\u0125\u1E23\u1E27\u021F\u1E25\u1E29\u1E2B\u1E96\u0127\u2C68\u2C76\u0265]/g},
    {'base':'hv','letters':/[\u0195]/g},
    {'base':'i', 'letters':/[\u0069\u24D8\uFF49\u00EC\u00ED\u00EE\u0129\u012B\u012D\u00EF\u1E2F\u1EC9\u01D0\u0209\u020B\u1ECB\u012F\u1E2D\u0268\u0131]/g},
    {'base':'j', 'letters':/[\u006A\u24D9\uFF4A\u0135\u01F0\u0249]/g},
    {'base':'k', 'letters':/[\u006B\u24DA\uFF4B\u1E31\u01E9\u1E33\u0137\u1E35\u0199\u2C6A\uA741\uA743\uA745\uA7A3]/g},
    {'base':'l', 'letters':/[\u006C\u24DB\uFF4C\u0140\u013A\u013E\u1E37\u1E39\u013C\u1E3D\u1E3B\u017F\u0142\u019A\u026B\u2C61\uA749\uA781\uA747]/g},
    {'base':'lj','letters':/[\u01C9]/g},
    {'base':'m', 'letters':/[\u006D\u24DC\uFF4D\u1E3F\u1E41\u1E43\u0271\u026F]/g},
    {'base':'n', 'letters':/[\u006E\u24DD\uFF4E\u01F9\u0144\u00F1\u1E45\u0148\u1E47\u0146\u1E4B\u1E49\u019E\u0272\u0149\uA791\uA7A5]/g},
    {'base':'nj','letters':/[\u01CC]/g},
    {'base':'o', 'letters':/[\u006F\u24DE\uFF4F\u00F2\u00F3\u00F4\u1ED3\u1ED1\u1ED7\u1ED5\u00F5\u1E4D\u022D\u1E4F\u014D\u1E51\u1E53\u014F\u022F\u0231\u00F6\u022B\u1ECF\u0151\u01D2\u020D\u020F\u01A1\u1EDD\u1EDB\u1EE1\u1EDF\u1EE3\u1ECD\u1ED9\u01EB\u01ED\u00F8\u01FF\u0254\uA74B\uA74D\u0275]/g},
    {'base':'oi','letters':/[\u01A3]/g},
    {'base':'ou','letters':/[\u0223]/g},
    {'base':'oo','letters':/[\uA74F]/g},
    {'base':'p','letters':/[\u0070\u24DF\uFF50\u1E55\u1E57\u01A5\u1D7D\uA751\uA753\uA755]/g},
    {'base':'q','letters':/[\u0071\u24E0\uFF51\u024B\uA757\uA759]/g},
    {'base':'r','letters':/[\u0072\u24E1\uFF52\u0155\u1E59\u0159\u0211\u0213\u1E5B\u1E5D\u0157\u1E5F\u024D\u027D\uA75B\uA7A7\uA783]/g},
    {'base':'s','letters':/[\u0073\u24E2\uFF53\u00DF\u015B\u1E65\u015D\u1E61\u0161\u1E67\u1E63\u1E69\u0219\u015F\u023F\uA7A9\uA785\u1E9B]/g},
    {'base':'t','letters':/[\u0074\u24E3\uFF54\u1E6B\u1E97\u0165\u1E6D\u021B\u0163\u1E71\u1E6F\u0167\u01AD\u0288\u2C66\uA787]/g},
    {'base':'tz','letters':/[\uA729]/g},
    {'base':'u','letters':/[\u0075\u24E4\uFF55\u00F9\u00FA\u00FB\u0169\u1E79\u016B\u1E7B\u016D\u00FC\u01DC\u01D8\u01D6\u01DA\u1EE7\u016F\u0171\u01D4\u0215\u0217\u01B0\u1EEB\u1EE9\u1EEF\u1EED\u1EF1\u1EE5\u1E73\u0173\u1E77\u1E75\u0289]/g},
    {'base':'v','letters':/[\u0076\u24E5\uFF56\u1E7D\u1E7F\u028B\uA75F\u028C]/g},
    {'base':'vy','letters':/[\uA761]/g},
    {'base':'w','letters':/[\u0077\u24E6\uFF57\u1E81\u1E83\u0175\u1E87\u1E85\u1E98\u1E89\u2C73]/g},
    {'base':'x','letters':/[\u0078\u24E7\uFF58\u1E8B\u1E8D]/g},
    {'base':'y','letters':/[\u0079\u24E8\uFF59\u1EF3\u00FD\u0177\u1EF9\u0233\u1E8F\u00FF\u1EF7\u1E99\u1EF5\u01B4\u024F\u1EFF]/g},
    {'base':'z','letters':/[\u007A\u24E9\uFF5A\u017A\u1E91\u017C\u017E\u1E93\u1E95\u01B6\u0225\u0240\u2C6C\uA763]/g}];
    for (var i=0; i < chars.length; i++) {
        s = s.replace(chars[i].letters, chars[i].base);
    }
    return s;
}