<?php
/**
 * Shortcodes Class.
 *
 * @package THESPA_waterTesting\Classes
 * @version 1.0.3
 */
defined( 'ABSPATH' ) || exit;

/**
 * THESPA_Shortcodes Class.
 */
class THESPA_shortcodes {

	/**
	 * Show button Subscribe button.
	 *
	 * @param  array $attributes
	 * @return string
	 */
	public static function waterTesting( $attributes ) {
		$atts = shortcode_atts( array(
		), $attributes );

		THESPA_Media::resources();
        $obj_data = new THESPA_data();
        $data = $obj_data->get_data();
        $volume = $obj_data->get_list_of( 'volume' );
		$devises = $obj_data->get_list_of( 'devices' );
		$products = $obj_data->get_list_of( 'products' );

		ob_start();
//		echo "<div style='white-space: pre;'>"; print_r($products); echo "</div>";
		?>
		<div class="water-testing">
            <form class="water-testing__form">
                <div class="water-testing__row">
                    <h4 class="water-testing__h">Water test</h4>
                </div>
                <div class="water-testing__row">
                    <div class="water-testing__col water-testing__col--100p">
                        <div class="water-testing__title">1. Select type of your model</div>
                    </div>
                    <div class="water-testing__col">
                        <label for="water-testing--devises" class="water-testing__label">Your model</label>
                        <select name="devises" id="water-testing--devises" class="water-testing__select water-testing__select--devises" title="Select your model" autocomplete="off">
			                <?php foreach ( $devises as $item ) {
				                echo "<option value=\"{$item['id']}\">{$item['name']}</option>";
			                }?>
                        </select>
                    </div>
                    <div class="water-testing__col water-testing__col--or">or</div>
                    <div class="water-testing__col">
                        <label for="water-testing--volume" class="water-testing__label">Type of</label>
                        <select name="type" id="water-testing--type" class="water-testing__select water-testing__select--type" title="Type of your tub" autocomplete="off">
			                <?php foreach ( $volume as $item ) {
				                echo "<option value=\"{$item['id']}\">{$item['name']}</option>";
			                }?>
                        </select>
                    </div>
                </div>
                <div class="water-testing__row">
                    <div class="water-testing__col water-testing__col--100p">
                        <div class="water-testing__title">2. Insert the volume</div>
                    </div>
                    <div class="water-testing__col">
                        <label for="water-testing--volume" class="water-testing__label">The volume in Liters</label>
                        <input type="text" name="volume" id="water-testing--volume" disabled title="The volume in Liters" autocomplete="off" class="water-testing__input water-testing__input--validate-number water-testing__input--volume">
                    </div>
                </div>
                <div class="water-testing__row">
                    <div class="water-testing__col water-testing__col--100p">
                        <div class="water-testing__title">3. Chemical name</div>
                    </div>
                    <div class="water-testing__col">
                        <label for="water-testing--chemical" class="water-testing__label">Type of your test</label>
                        <select name="chemical" id="water-testing--chemical" disabled class="water-testing__select water-testing__select--chemical" title="Type of your test" autocomplete="off">
                        </select>
                    </div>
                </div>
                <div class="water-testing__row">
                    <div class="water-testing__col water-testing__col--100p">
                        <div class="water-testing__title">4. Test name</div>
                    </div>
                    <div class="water-testing__col">
                        <label for="water-testing--test" class="water-testing__label">Name of your test</label>
                        <select name="test" id="water-testing--test" disabled class="water-testing__select water-testing__select--test" title="Name of your test" autocomplete="off">
                        </select>
                    </div>
                </div>
                <div class="water-testing__row">
                    <div class="water-testing__col water-testing__col--100p">
                        <div class="water-testing__title">5. Where test strip reading</div>
                    </div>
                    <div class="water-testing__col water-testing__col--strip">
                        <label for="water-testing--strip" class="water-testing__label">Type of test</label>
                        <select name="strip" id="water-testing--strip" disabled class="water-testing__select water-testing__select--strip" title="Type of test" autocomplete="off">
                        </select>
                    </div>
                    <div class="water-testing__col water-testing__col--value">
                        <label for="water-testing--strip" class="water-testing__label">Value of test</label>
                        <select name="value" id="water-testing--value" disabled class="water-testing__select water-testing__select--value" title="Value of test" autocomplete="off">
                        </select>
                    </div>
                </div>
            </form>
            <div class="water-testing__row water-testing__row--result">
                <div class="water-testing__col water-testing__col--100p">
                    <div class="water-testing__hs"><span>Result</span></div>
                </div>
                <div class="water-testing__col">
                    <div class="water-testing__result-box">
                        <div class="water-testing__result water-testing__result--regular"><span class="water-testing__prefix">You need add </span><span class="water-testing__value">%VALUE%</span><span class="water-testing__postfix"> of </span><span class="water-testing__result-product">%PRODUCT%</span><span class="water-testing__dot">.</span></div>
                        <div class="water-testing__result water-testing__result--text"></div>
                    </div>
                </div>
                <div class="water-testing__col water-testing__col--100p water-testing__col--products">
                    <div class="water-testing__title">Related Products</div>
                    <div class="wt-products">
                        <div class="wt-product wt-product--t">
                            <a class="wt-product__img" href="/" target="_blank" style="background-image: url()"></a>
                            <div class="wt-product__cont">
                                <a href="/" target="_blank" class="wt-product__title"></a>
                                <div class="wt-product__meta">
                                    <div class="wt-product__cost"></div>
                                    <div class="wt-product__count">
                                        <div class="wt-product__count-btn wt-product__count-btn--minus">−</div>
                                        <input type="text" name="count" title="Count of product" value="1" autocomplete="off">
                                        <div class="wt-product__count-btn wt-product__count-btn--plus">+</div>
                                    </div>
                                </div>
                                <div class="wt-product__button">Add to cart</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="application/json" id="water-testing-data"><?php echo json_encode( $data ); ?></script>
        <script type="application/json" id="water-testing-products"><?php echo json_encode( $products ); ?></script>
        <script type="application/json" id="water-testing-devises"><?php echo json_encode( $devises ); ?></script>
		<?php
		return ob_get_clean();
	}
}
