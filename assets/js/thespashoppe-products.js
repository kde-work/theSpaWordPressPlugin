(function ($) {
    if (!$) {
        console.error('jQuery and $ are missing');
        return;
    }

    /**
     * Form water testing Template Class.
     */
    function SpaProducts() {
        this.$body = $('body');

        this.events_init();
    }

    /**
     * Events init.
     */
    SpaProducts.prototype.events_init = function() {
        let _this = this;

        // Plus/Minus Button
        this.$body.on('click', '.wt-product__count-btn', function (e) {
            _this.change_counts($(this));
        });

        // Add to cart Button
        this.$body.on('click', '.wt-product__button', function (e) {
            _this.add_to_cart($(this));
        });
    };

    /**
     * Add to cart callback.
     *
     * @param  $this
     * @return void
     */
    SpaProducts.prototype.add_to_cart = function($this) {
        let $par = $this.closest('.wt-product__cont'),
            $input = $('.wt-product__input', $par),
            this_id = parseInt($this.data('id')),
            this_count = parseInt($input.val());

        console.log(this_id, this_count);
        $.ajax({
            type: 'POST',
            url: theSpaShoppeSettings.url,
            dataType: 'json',
            async: true,
            data: {
                'action' : 'woocommerce_add_variation_to_cart',
                'product_id' : this_id,
                'variation_id' : this_id,
                'quantity' : this_count,
            },
            beforeSend: function (xhr, ajaxOptions, thrownError) {
                // thespashoppe.loader_start();
            },
            success: function (data) {
                try {
                    console.log(data);

                } catch (err) {
                    thespashoppe.error(err);
                }
            },
            complete: function (xhr, ajaxOptions, thrownError) {
                // thespashoppe.loader_stop();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.error('THESPA_Requests-@11: '+xhr.status);
                console.error('THESPA_Requests-@12: '+thrownError);
                thespashoppe.error(thrownError + ', status: ' + xhr.status);
            }
        });
    };

    /**
     * Change count product.
     *
     * @param  $this
     * @return void
     */
    SpaProducts.prototype.change_counts = function($this) {
        let $par = $this.closest('.wt-product__count'),
            $input = $('.wt-product__input', $par),
            this_count = parseInt($this.data('count')),
            count = $input.val()*1 + this_count;

        count = (count > 0) ? count : 1;
        $input.val(count);
    };


    // Init.
    $(function () {
        window.SpaProducts = SpaProducts;
        window.thespaproducts = new SpaProducts();
    });
}($ || window.jQuery));