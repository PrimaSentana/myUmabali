<?php
    namespace App\Services;

    use Midtrans\Config;
    use Midtrans\Snap;

    class MidtransService {
        public function __construct() {
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;
        }

        public function generateSnapToken($params) {
            return Snap::getSnapToken($params);
        }
    }
?>