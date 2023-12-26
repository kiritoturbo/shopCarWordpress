<?php 
function change_woocommerce_currency_symbol( $currency_symbol, $currency ) {
    switch( $currency ) {
        case 'VND':
            $currency_symbol = ' đ';
            break;
    }
    return $currency_symbol;
}
add_filter('woocommerce_currency_symbol', 'change_woocommerce_currency_symbol', 10, 2);
