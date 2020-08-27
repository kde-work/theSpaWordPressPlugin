(function ($) {
    if (!$) {
        console.error('jQuery and $ are missing');
        return;
    }

    /**
     * Form water testing Template Class.
     */
    function SpaActions() {
        this.$body = $('body');

        this.events_init();
    }

    /**
     * Events init.
     */
    SpaActions.prototype.events_init = function() {
        let _this = this;

        // Print
        this.$body.on('click', '.wt-result-action--print', function (e) {
            window.print();
        });

        // New test
        this.$body.on('click', '.wt-result-action--new', function (e) {
            Cookies.remove('TheSpaShopPE.data_map', { path: '/' });
            document.location.href = $(this).data('href');
        });

        // Save with login
        this.$body.on('click', '.wt-result-action--save.wt-result-action--log-in', function (e) {
            // history.pushState(null, null, '.?js_id=' + thespashoppe.get_id());
        });

        // Save
        this.$body.on('click', '.wt-result-action--save:not(.wt-result-action--log-in)', function (e) {
            history.pushState(null, null, '.?js_id=' + thespashoppe.get_id());
            Cookies.remove('TheSpaShopPE.save', { path: '/' });
            _this.save_form();
        });

        // Log in
        this.$body.on('click', '.wt-result-action--log-in', function (e) {

            // Set cookie to save after login
            Cookies.set('TheSpaShopPE.save', '1', { expires: 7, path: '/' });
        });

        // Remove
        this.$body.on('click', '.wt-previous__remove', function (e) {
            let $this = $(this);

            if (confirm('Are you sure you want to delete it?')) {
                _this.remove_test($this);
            }
        });
    };

    /**
     * Remove test.
     */
    SpaActions.prototype.remove_test = function($this) {
        let this_id = $this.data('js-id');

        $.ajax({
            type: 'POST',
            url: theSpaShoppeSettings.url,
            dataType: 'json',
            async: true,
            data: {
                'action' : 'thespa_remove_test',
                'js_id' : this_id,
                'nonce' : theSpaShoppeSettings.nonce,
            },
            beforeSend: function (xhr, ajaxOptions, thrownError) {
                thespashoppe.loader_start();
            },
            success: function (data) {
                try {
                    console.log(data);
                    if (data.success !== void 0 && data.success === 'remove 1') {
                        let $box = $('.wt-previous--'+this_id);

                        $box.hide();
                    } else {
                        thespashoppe.error('data empty');
                    }

                } catch (err) {
                    thespashoppe.error(err);
                }
            },
            complete: function (xhr, ajaxOptions, thrownError) {
                thespashoppe.loader_stop();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.error('THESPA_Requests-@11: '+xhr.status);
                console.error('THESPA_Requests-@12: '+thrownError);
                thespashoppe.error(thrownError + ', status: ' + xhr.status);
            }
        });
    };

    /**
     * Save form.
     */
    SpaActions.prototype.save_form = function() {
        $.ajax({
            type: 'POST',
            url: theSpaShoppeSettings.url,
            dataType: 'json',
            async: true,
            data: {
                'action' : 'thespa_save',
                'data' : thespashoppe.get_data(),
                'id' : thespashoppe.get_id(),
                'nonce' : theSpaShoppeSettings.nonce,
            },
            beforeSend: function (xhr, ajaxOptions, thrownError) {
                thespashoppe.loader_start();
            },
            success: function (data) {
                try {
                    console.log(data);
                    if (data.html !== void 0 && data.html) {
                        let $wt_previous = $('.wt-previous');
                        let template = new SpaTemplate();

                        $wt_previous.html(data.html);
                        template.utc_time_to_local_with_masc();
                        thespashoppe.onbeforeunload(JSON.stringify(thespashoppe.data_map));
                    } else {
                        thespashoppe.error('data empty');
                    }

                } catch (err) {
                    thespashoppe.error(err);
                }
            },
            complete: function (xhr, ajaxOptions, thrownError) {
                thespashoppe.loader_stop();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.error('THESPA_Requests-@11: '+xhr.status);
                console.error('THESPA_Requests-@12: '+thrownError);
                thespashoppe.error(thrownError + ', status: ' + xhr.status);
            }
        });
    };

    // Init.
    $(function () {
        window.SpaActions = SpaActions;
        window.thespaactions = new SpaActions();
    });
}($ || window.jQuery));