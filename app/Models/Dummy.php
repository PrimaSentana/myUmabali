<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dummy
{
    public static function all(): array {
        return [
            [
                'id' => 1,
                'title' => 'Villa Ubud',
                'price' => '1.000.000',
                'image' => '/images/kamar-hotel.jpg',
                'description' => 'Villa Ubud menawarkan akomodasi mewah yang sangat dicari, terkenal karena lokasinya yang terpencil di tengah sawah dan lembah hijau, menjanjikan ketenangan dan privasi total. Sebagian besar vila dilengkapi kolam renang pribadi dan arsitektur yang memadukan desain modern dengan unsur alam Bali. Vila Ubud adalah pilihan ideal untuk pengalaman liburan yang damai dan menyegarkan jiwa.'
            ],
            [
                'id' => 2,
                'title' => 'Villa Tabanan',
                'price' => '2.000.000',
                'image' => '/images/kamar-hotel2.jpg',
                'description' => 'Villa Ubud menawarkan akomodasi mewah yang sangat dicari, terkenal karena lokasinya yang terpencil di tengah sawah dan lembah hijau, menjanjikan ketenangan dan privasi total. Sebagian besar vila dilengkapi kolam renang pribadi dan arsitektur yang memadukan desain modern dengan unsur alam Bali. Vila Ubud adalah pilihan ideal untuk pengalaman liburan yang damai dan menyegarkan jiwa.'
            ],
            [
                'id' => 3,
                'title' => 'Villa Denpasar',
                'price' => '3.000.000',
                'image' => '/images/kamar-hotel3.jpg',
                'description' => 'Villa Ubud menawarkan akomodasi mewah yang sangat dicari, terkenal karena lokasinya yang terpencil di tengah sawah dan lembah hijau, menjanjikan ketenangan dan privasi total. Sebagian besar vila dilengkapi kolam renang pribadi dan arsitektur yang memadukan desain modern dengan unsur alam Bali. Vila Ubud adalah pilihan ideal untuk pengalaman liburan yang damai dan menyegarkan jiwa.'
            ],
        ];
    }
}
