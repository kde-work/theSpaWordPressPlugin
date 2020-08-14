<?php
/**
 * Shortcodes Class.
 *
 * @package THESPA_waterTesting\Classes
 * @version 1.0.5
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
//		echo "<div style='white-space: pre;'>"; print_r($data); echo "</div>"; die;
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
                        <div class="water-testing__title">4. Tests</div>
                    </div>
                    <div class="water-testing__col water-testing__col--100p">
                        <div class="water-testing__warning"><div class="water-testing__icon water-testing__icon--warning"></div><div class="water-testing__warning-text">Attention! Colors on your screen may differ from the reference colors. We recommend using colors from the respective test packs.</div></div>
                    </div>
                    <div class="water-testing__col water-testing__col--100p">
                        <div class="wt-tests">
                            <div class="wt-tests__item wt-tests__item--ph wt-tests__item--deactivate">
                                <div class="wt-tests__title">pH scale</div>
                                <div class="wt-tests__body">
                                    <div class="wt-tests__line wt-tests__line--res-1">
                                        <input type="radio" name="wt-tests--TEST-NAME" id="wt-tests--res-1" class="wt-tests__radio" autocomplete="off">
                                        <label for="wt-tests--res-1" class="wt-tests__label"><span style="background:#D70825;"></span>>8.4</label>
                                    </div>
                                    <div class="wt-tests__line wt-tests__line--res-2">
                                        <input type="radio" name="wt-tests--TEST-NAME" id="wt-tests--res-2" class="wt-tests__radio" autocomplete="off">
                                        <label for="wt-tests--res-2" class="wt-tests__label"><span style="background: #d7282d;"></span>8.0-8.4</label>
                                    </div>
                                    <div class="wt-tests__line wt-tests__line--res-3">
                                        <input type="radio" name="wt-tests--TEST-NAME" id="wt-tests--res-3" class="wt-tests__radio" autocomplete="off">
                                        <label for="wt-tests--res-3" class="wt-tests__label"><span style="background: #d84930;"></span>7.8-8.0</label>
                                    </div>
                                </div>
                            </div>
                            <?php /*
                            <div class="wt-tests__item wt-tests__item--ph">
                                <div class="wt-tests__title">pH scale</div>
                                <div class="wt-tests__body">
                                    <div class="wt-tests__line wt-tests__line--res-1">
                                        <input type="radio" name="wt-tests--TEST-NAME" id="wt-tests--res-1" class="wt-tests__radio" autocomplete="off">
                                        <label for="wt-tests--res-1" class="wt-tests__label"><span></span>>8.4</label>
                                    </div>
                                    <div class="wt-tests__line wt-tests__line--res-2">
                                        <input type="radio" name="wt-tests--TEST-NAME" id="wt-tests--res-2" class="wt-tests__radio" autocomplete="off">
                                        <label for="wt-tests--res-2" class="wt-tests__label"><span></span>8.0-8.4</label>
                                    </div>
                                    <div class="wt-tests__line wt-tests__line--res-3">
                                        <input type="radio" name="wt-tests--TEST-NAME" id="wt-tests--res-3" class="wt-tests__radio" autocomplete="off">
                                        <label for="wt-tests--res-3" class="wt-tests__label"><span></span>7.8-8.0</label>
                                    </div>
                                </div>
                            </div>
                            <div class="wt-tests__item wt-tests__item--a">
                                <div class="wt-tests__title">Alkalinity scale</div>
                                <div class="wt-tests__body">
                                    <div class="wt-tests__line wt-tests__line--res-4">
                                        <input type="radio" name="wt-tests--TEST-NAME-a" id="wt-tests--res-4" class="wt-tests__radio" autocomplete="off">
                                        <label for="wt-tests--res-4" class="wt-tests__label"><span></span>0 ppm</label>
                                    </div>
                                    <div class="wt-tests__line wt-tests__line--res-5">
                                        <input type="radio" name="wt-tests--TEST-NAME-a" id="wt-tests--res-5" class="wt-tests__radio" autocomplete="off">
                                        <label for="wt-tests--res-5" class="wt-tests__label"><span></span>20 – 40 ppm</label>
                                    </div>
                                    <div class="wt-tests__line wt-tests__line--res-6">
                                        <input type="radio" name="wt-tests--TEST-NAME-a" id="wt-tests--res-6" class="wt-tests__radio" autocomplete="off">
                                        <label for="wt-tests--res-6" class="wt-tests__label"><span></span>40 – 80 ppm</label>
                                    </div>
                                </div>
                            </div>
                            */ ?>
                        </div>
                    </div>
                    <div class="water-testing__col" style="display:none;">
                        <label for="water-testing--test" class="water-testing__label">Name of your test</label>
                        <select name="test" id="water-testing--test" disabled class="water-testing__select water-testing__select--test" title="Name of your test" autocomplete="off">
                        </select>
                    </div>
                </div>
            </form>
            <div class="water-testing__row water-testing__row--result">
                <div class="water-testing__col water-testing__col--100p">
                    <div class="water-testing__hs"><span>Results</span></div>
                </div>
                <div class="water-testing__col wt-result-boxes">
                    <div class="water-testing__title">Test result</div>
                    <div class="water-testing__result-box wt-result-box wt-result-box--t">
                        <div class="water-testing__icon water-testing__icon--bell water-testing__icon--brown"></div>
                        <div class="water-testing__result water-testing__result--regular"><span class="water-testing__test">%TEST%</span> <span class="water-testing__prefix">You need add </span><span class="water-testing__value">%VALUE%</span><span class="water-testing__postfix"> of </span><span class="water-testing__result-product">%PRODUCT%</span><span class="water-testing__dot">.</span></div>
                        <div class="water-testing__result water-testing__result--text"><span class="water-testing__test">%TEST%</span> <span class="water-testing__cont"></span></div>
                    </div>
                </div>
                <div class="water-testing__col water-testing__col--100p water-testing__col--actions">
                    <div class="water-testing__title">Actions</div>
                    <div class="wt-result-actions">
                        <div class="wt-result-action wt-button wt-result-action--print">
                            <div class="water-testing__icon water-testing__icon--print water-testing__icon--brown"></div>
                            <div class="wt-result-action__text">Print</div>
                        </div>
                        <div class="wt-result-action wt-button wt-result-action--to-email">
                            <div class="water-testing__icon water-testing__icon--mail water-testing__icon--brown"></div>
                            <div class="wt-result-action__text">Send me to email</div>
                        </div>
                    </div>
                    <div class="wt-help">
                        <div class="wt-help__title">Do you need help with test results?</div>
                        <div class="wt-help__text">We can help you.</div>
                        <div class="wt-help__button wt-button wt-button--shadow"><div class="water-testing__icon water-testing__icon--talk water-testing__icon--brown"></div>Get help</div>
                    </div>
                </div>
                <div class="water-testing__col water-testing__col--100p wt-info-boxes water-testing__col--info">
                    <div class="water-testing__title">This is useful</div>
                    <div class="water-testing__result-box wt-info-box wt-info-box--t">
                        <div class="water-testing__icon water-testing__icon--info"></div>
                        <div class="water-testing__result">
                            <div class="wt-info-box__title"></div>
                            <div class="wt-info-box__text"></div>
                            <div class="wt-info-box__result-product"><span class="wt-info-box__prefix">Products: </span><span class="wt-info-box__products"></span>.</div>
                        </div>
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
