<?php

/*
 | DATA SEMENTARA (dummy) untuk tahap "tampilan dulu".
 | Nanti diganti dengan data asli dari database.
 | Dipakai di view dengan: config('dummy.products'), dst.
 */

return [

    'farmers' => [
        1 => ['id' => 1, 'name' => 'Pak Budi', 'loc' => 'Boyolali, Jateng', 'rating' => 4.8, 'emoji' => '🧑‍🌾'],
        2 => ['id' => 2, 'name' => 'Bu Sari',  'loc' => 'Malang, Jatim',    'rating' => 4.9, 'emoji' => '👩‍🌾'],
        3 => ['id' => 3, 'name' => 'Pak Joko', 'loc' => 'Sleman, DIY',      'rating' => 4.7, 'emoji' => '🧑‍🌾'],
    ],

    'categories' => ['Semua', 'Buah', 'Sayur', 'Biji-bijian', 'Organik', 'Paket'],

    'products' => [
        ['id' => 1, 'name' => 'Jeruk Manis',          'cat' => 'Buah',        'farmer' => 1, 'price' => 18000, 'unit' => 'kg',    'emoji' => '🍊', 'organik' => false, 'stok' => 40],
        ['id' => 2, 'name' => 'Bayam Segar',          'cat' => 'Sayur',       'farmer' => 2, 'price' => 6000,  'unit' => 'ikat',  'emoji' => '🥬', 'organik' => true,  'stok' => 25],
        ['id' => 3, 'name' => 'Beras Merah',          'cat' => 'Biji-bijian', 'farmer' => 3, 'price' => 22000, 'unit' => 'kg',    'emoji' => '🌾', 'organik' => true,  'stok' => 60],
        ['id' => 4, 'name' => 'Tomat Ranti',          'cat' => 'Sayur',       'farmer' => 1, 'price' => 9000,  'unit' => 'kg',    'emoji' => '🍅', 'organik' => false, 'stok' => 30],
        ['id' => 5, 'name' => 'Paket Sayur Mingguan', 'cat' => 'Paket',       'farmer' => 2, 'price' => 45000, 'unit' => 'paket', 'emoji' => '🧺', 'organik' => true,  'stok' => 15],
        ['id' => 6, 'name' => 'Pisang Cavendish',     'cat' => 'Buah',        'farmer' => 3, 'price' => 15000, 'unit' => 'sisir', 'emoji' => '🍌', 'organik' => false, 'stok' => 20],
        ['id' => 7, 'name' => 'Kacang Hijau',         'cat' => 'Biji-bijian', 'farmer' => 1, 'price' => 19000, 'unit' => 'kg',    'emoji' => '🫘', 'organik' => true,  'stok' => 18],
        ['id' => 8, 'name' => 'Paket Buah Organik',   'cat' => 'Paket',       'farmer' => 2, 'price' => 60000, 'unit' => 'paket', 'emoji' => '🍇', 'organik' => true,  'stok' => 10],
    ],

    // Keranjang pembeli: product = id produk
    'cart' => [
        ['product' => 1, 'qty' => 2],
        ['product' => 4, 'qty' => 1],
    ],

    // Riwayat pesanan pembeli
    'orders' => [
        ['id' => 'TS1023', 'items' => 'Bayam Segar x2, Jeruk Manis x1', 'total' => 30000, 'status' => 'Selesai', 'date' => '20 Sep'],
        ['id' => 'TS1011', 'items' => 'Beras Merah x2',                  'total' => 44000, 'status' => 'Dikirim', 'date' => '8 Okt'],
    ],

    // Pesanan masuk untuk petani (Pak Budi)
    'incoming' => [
        ['id' => 'TS2041', 'buyer' => 'Siti Aminah',    'items' => 'Jeruk Manis x3, Tomat Ranti x2', 'total' => 72000, 'status' => 'Baru',    'date' => 'Hari ini'],
        ['id' => 'TS2038', 'buyer' => 'Budi Santoso',   'items' => 'Kacang Hijau x1',                'total' => 19000, 'status' => 'Dikemas', 'date' => 'Kemarin'],
        ['id' => 'TS2030', 'buyer' => 'Rani Wulandari', 'items' => 'Paket Sayur Mingguan x1',        'total' => 45000, 'status' => 'Selesai', 'date' => '20 Sep'],
    ],

    // Chat pembeli -> petani (kunci = id petani). me=true artinya pesan dari kita.
    'farmer_chats' => [
        1 => [['me' => false, 't' => 'Halo! Ada yang bisa dibantu terkait produk kami? 🌱']],
        2 => [['me' => false, 't' => 'Selamat datang di lapak Bu Sari, silakan tanya-tanya ya 😊']],
        3 => [],
    ],

    // Chat petani -> pembeli
    'buyer_chats' => [
        1 => ['name' => 'Siti Aminah',    'emoji' => '🧑', 'msgs' => [
            ['me' => false, 't' => 'Halo kak, jeruk manisnya stok masih ada?'],
            ['me' => true,  't' => 'Masih kak, stok 40kg 🍊'],
            ['me' => false, 't' => 'Oke saya order 3kg ya'],
        ]],
        2 => ['name' => 'Budi Santoso',   'emoji' => '🧑', 'msgs' => [
            ['me' => false, 't' => 'Siap, terima kasih'],
        ]],
        3 => ['name' => 'Rani Wulandari', 'emoji' => '👩', 'msgs' => []],
    ],

    'addresses' => [
        ['label' => 'Rumah',  'name' => 'Andi Wijaya', 'phone' => '0812-3456-7890', 'address' => 'Jl. Melati No. 12, Kebayoran Baru, Jakarta Selatan', 'default' => true],
        ['label' => 'Kantor', 'name' => 'Andi Wijaya', 'phone' => '0812-3456-7890', 'address' => 'Gedung Graha, Jl. Sudirman Kav. 5, Jakarta Pusat',     'default' => false],
    ],

    'reviews' => [
        ['farmer' => 'Bu Sari', 'product' => 'Bayam Segar', 'rating' => 5, 'comment' => 'Segar banget dan dikirim cepat, mantap!', 'date' => '21 Sep 2026'],
    ],

    'notifications' => [
        ['icon' => '📦', 'title' => 'Pesanan sedang diproses',  'desc' => 'Pesanan #TS1023 sedang disiapkan oleh petani',   'time' => '2 jam lalu', 'read' => false],
        ['icon' => '💬', 'title' => 'Pesan baru dari Bu Sari', 'desc' => '"Siap kak, bisa kirim besok pagi ya"',          'time' => '5 jam lalu', 'read' => false],
        ['icon' => '🎉', 'title' => 'Promo Gratis Ongkir',      'desc' => 'Belanja hari ini gratis ongkos kirim se-Jabodetabek', 'time' => 'Kemarin',   'read' => true],
    ],
];