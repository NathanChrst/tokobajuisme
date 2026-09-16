<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Brand;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Users ────────────────────────────────────────
        $admin = User::create([
            'name' => 'Admin TokoBaju',
            'email' => 'admin@tokobaju.com',
            'password' => bcrypt('password'),
            'phone_number' => '081234567890',
            'role' => 'admin',
        ]);

        $customer = User::create([
            'name' => 'Budi Santoso',
            'email' => 'customer@tokobaju.com',
            'password' => bcrypt('password'),
            'phone_number' => '081298765432',
            'role' => 'customer',
        ]);

        $customer2 = User::create([
            'name' => 'Sari Dewi',
            'email' => 'sari@tokobaju.com',
            'password' => bcrypt('password'),
            'phone_number' => '081377889900',
            'role' => 'customer',
        ]);

        // ── Addresses ────────────────────────────────────
        Address::create([
            'user_id' => $customer->id,
            'label' => 'Rumah',
            'street' => 'Jl. Merdeka No. 45, RT 03/RW 07',
            'city' => 'Jakarta Selatan',
            'province' => 'DKI Jakarta',
            'postal_code' => '12345',
            'is_default' => true,
        ]);

        Address::create([
            'user_id' => $customer->id,
            'label' => 'Kantor',
            'street' => 'Jl. Sudirman Kav. 52-53, Gedung A Lt.5',
            'city' => 'Jakarta Pusat',
            'province' => 'DKI Jakarta',
            'postal_code' => '10210',
            'is_default' => false,
        ]);

        Address::create([
            'user_id' => $customer2->id,
            'label' => 'Rumah',
            'street' => 'Jl. Diponegoro No. 12',
            'city' => 'Bandung',
            'province' => 'Jawa Barat',
            'postal_code' => '40115',
            'is_default' => true,
        ]);

        // ── Brands ───────────────────────────────────────
        $brands = [];
        foreach (['Nike', 'Adidas', 'Uniqlo', 'H&M', 'Zara'] as $name) {
            $brands[$name] = Brand::create([
                'name' => $name,
                'logo_url' => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=random&size=128&bold=true',
            ]);
        }

        // ── Categories ───────────────────────────────────
        $pria = Category::create(['name' => 'Pria', 'slug' => 'pria']);
        $wanita = Category::create(['name' => 'Wanita', 'slug' => 'wanita']);
        $anak = Category::create(['name' => 'Anak', 'slug' => 'anak']);
        $aksesoris = Category::create(['name' => 'Aksesoris', 'slug' => 'aksesoris']);

        // Sub-categories
        $kemejaPria = Category::create(['name' => 'Kemeja Pria', 'slug' => 'kemeja-pria', 'parent_id' => $pria->id]);
        $kaosPria = Category::create(['name' => 'Kaos Pria', 'slug' => 'kaos-pria', 'parent_id' => $pria->id]);
        $celanaPria = Category::create(['name' => 'Celana Pria', 'slug' => 'celana-pria', 'parent_id' => $pria->id]);
        $jaketPria = Category::create(['name' => 'Jaket Pria', 'slug' => 'jaket-pria', 'parent_id' => $pria->id]);

        $dressWanita = Category::create(['name' => 'Dress', 'slug' => 'dress', 'parent_id' => $wanita->id]);
        $blouseWanita = Category::create(['name' => 'Blouse', 'slug' => 'blouse', 'parent_id' => $wanita->id]);
        $rokWanita = Category::create(['name' => 'Rok', 'slug' => 'rok', 'parent_id' => $wanita->id]);

        $kaosAnak = Category::create(['name' => 'Kaos Anak', 'slug' => 'kaos-anak', 'parent_id' => $anak->id]);

        $topiAksesoris = Category::create(['name' => 'Topi', 'slug' => 'topi', 'parent_id' => $aksesoris->id]);
        $tasAksesoris = Category::create(['name' => 'Tas', 'slug' => 'tas', 'parent_id' => $aksesoris->id]);

        // ── Products ─────────────────────────────────────
        $products = [];

        $productData = [
            [
                'name' => 'Kemeja Flanel Premium',
                'brand' => 'Uniqlo',
                'category_id' => $kemejaPria->id,
                'price' => 349000,
                'description' => 'Kemeja flanel kotak-kotak dengan bahan katun premium 100%. Tekstur lembut, cocok untuk gaya casual maupun smart casual. Dilengkapi double-pocket di bagian dada.',
                'featured' => true,
                'colors' => ['Merah', 'Biru Navy', 'Hijau'],
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'name' => 'Kaos Oblong Essential',
                'brand' => 'H&M',
                'category_id' => $kaosPria->id,
                'price' => 149000,
                'description' => 'Kaos oblong polos berbahan katun combed 30s yang super nyaman. Jahitan double-stitch untuk durabilitas. Cocok untuk dipakai sehari-hari.',
                'featured' => true,
                'colors' => ['Putih', 'Hitam', 'Abu-abu', 'Navy'],
                'sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
            ],
            [
                'name' => 'Jaket Hoodie Urban',
                'brand' => 'Nike',
                'category_id' => $jaketPria->id,
                'price' => 599000,
                'description' => 'Jaket hoodie berbahan fleece premium yang tebal dan hangat. Fitur kangaroo pocket dan drawstring hood adjustable. Cocok untuk aktivitas outdoor.',
                'featured' => true,
                'colors' => ['Hitam', 'Abu-abu', 'Olive'],
                'sizes' => ['M', 'L', 'XL'],
            ],
            [
                'name' => 'Celana Chino Slim Fit',
                'brand' => 'Zara',
                'category_id' => $celanaPria->id,
                'price' => 449000,
                'description' => 'Celana chino slim fit dengan bahan stretch berkualitas tinggi. Potongan modern yang memperindah siluet. 4 warna pilihan untuk berbagai occasion.',
                'featured' => false,
                'colors' => ['Khaki', 'Navy', 'Hitam', 'Olive'],
                'sizes' => ['29', '30', '31', '32', '33', '34'],
            ],
            [
                'name' => 'Dress Midi Floral',
                'brand' => 'Zara',
                'category_id' => $dressWanita->id,
                'price' => 529000,
                'description' => 'Dress midi dengan motif floral elegan. Bahan chiffon yang jatuh cantik dengan inner lining. Tali pinggang adjustable untuk fit sempurna.',
                'featured' => true,
                'colors' => ['Pink Floral', 'Blue Floral', 'Black Floral'],
                'sizes' => ['XS', 'S', 'M', 'L'],
            ],
            [
                'name' => 'Blouse Satin Elegant',
                'brand' => 'H&M',
                'category_id' => $blouseWanita->id,
                'price' => 279000,
                'description' => 'Blouse satin dengan kerah V-neck yang anggun. Bahan satin premium dengan jatuh sempurna. Cocok untuk acara formal maupun casual chic.',
                'featured' => false,
                'colors' => ['Putih', 'Dusty Pink', 'Cream'],
                'sizes' => ['S', 'M', 'L'],
            ],
            [
                'name' => 'Rok A-Line Classic',
                'brand' => 'Uniqlo',
                'category_id' => $rokWanita->id,
                'price' => 299000,
                'description' => 'Rok A-line dengan potongan klasik yang timeless. Bahan twill yang structured namun nyaman. Cocok dipadukan dengan blouse atau kaos.',
                'featured' => false,
                'colors' => ['Hitam', 'Navy', 'Camel'],
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'name' => 'Running Jacket Windbreaker',
                'brand' => 'Adidas',
                'category_id' => $jaketPria->id,
                'price' => 799000,
                'description' => 'Jaket windbreaker ringan dengan teknologi water-resistant. Ideal untuk running atau aktivitas outdoor. Reflective detail untuk safety.',
                'featured' => true,
                'colors' => ['Hitam', 'Royal Blue'],
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'name' => 'Kaos Grafis Anak Dino',
                'brand' => 'H&M',
                'category_id' => $kaosAnak->id,
                'price' => 99000,
                'description' => 'Kaos anak dengan print dinosaurus yang lucu dan playful. Bahan katun 100% yang lembut dan aman untuk kulit anak.',
                'featured' => false,
                'colors' => ['Putih', 'Kuning', 'Biru Muda'],
                'sizes' => ['3-4Y', '5-6Y', '7-8Y', '9-10Y'],
            ],
            [
                'name' => 'Topi Baseball Classic',
                'brand' => 'Nike',
                'category_id' => $topiAksesoris->id,
                'price' => 249000,
                'description' => 'Topi baseball dengan bordir logo premium. Strap adjustable di belakang untuk fit sempurna. Bahan katun twill yang breathable.',
                'featured' => false,
                'colors' => ['Hitam', 'Putih', 'Navy'],
                'sizes' => ['One Size'],
            ],
            [
                'name' => 'Kemeja Linen Summer',
                'brand' => 'Zara',
                'category_id' => $kemejaPria->id,
                'price' => 399000,
                'description' => 'Kemeja linen ringan yang breathable untuk musim panas. Potongan relaxed fit yang stylish. Cocok untuk beach vibes dan liburan.',
                'featured' => true,
                'colors' => ['Putih', 'Sky Blue', 'Sage'],
                'sizes' => ['S', 'M', 'L', 'XL'],
            ],
            [
                'name' => 'Tas Tote Kanvas Premium',
                'brand' => 'Uniqlo',
                'category_id' => $tasAksesoris->id,
                'price' => 199000,
                'description' => 'Tas tote kanvas tebal yang spacious dan durable. Cocok untuk daily use ke kampus atau kantor. Dilengkapi pocket dalam untuk barang kecil.',
                'featured' => false,
                'colors' => ['Natural', 'Hitam', 'Navy'],
                'sizes' => ['One Size'],
            ],
        ];

        foreach ($productData as $pd) {
            $slug = Str::slug($pd['name']);
            $product = Product::create([
                'brand_id' => $brands[$pd['brand']]->id,
                'category_id' => $pd['category_id'],
                'name' => $pd['name'],
                'slug' => $slug,
                'description' => $pd['description'],
                'base_price' => $pd['price'],
                'is_active' => true,
                'is_featured' => $pd['featured'],
            ]);

            // Create variants
            foreach ($pd['colors'] as $color) {
                foreach ($pd['sizes'] as $size) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'color' => $color,
                        'size' => $size,
                        'stock' => rand(5, 50),
                        'sku' => strtoupper(Str::slug($pd['brand'] . '-' . Str::substr($pd['name'], 0, 10) . '-' . $color . '-' . $size, '-')),
                    ]);
                }
            }

            // Create images (3 per product using picsum)
            for ($i = 0; $i < 3; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => 'https://picsum.photos/seed/' . $slug . '-' . $i . '/600/800',
                    'sort_order' => $i,
                ]);
            }

            $products[] = $product;
        }

        // ── Wishlists ────────────────────────────────────
        Wishlist::create(['user_id' => $customer->id, 'product_id' => $products[0]->id]);
        Wishlist::create(['user_id' => $customer->id, 'product_id' => $products[4]->id]);
        Wishlist::create(['user_id' => $customer2->id, 'product_id' => $products[2]->id]);

        // ── Cart Items ───────────────────────────────────
        $variant1 = ProductVariant::where('product_id', $products[1]->id)->first();
        $variant2 = ProductVariant::where('product_id', $products[3]->id)->first();

        if ($variant1) {
            CartItem::create([
                'user_id' => $customer->id,
                'product_variant_id' => $variant1->id,
                'quantity' => 2,
            ]);
        }
        if ($variant2) {
            CartItem::create([
                'user_id' => $customer->id,
                'product_variant_id' => $variant2->id,
                'quantity' => 1,
            ]);
        }

        // ── Sample Orders ────────────────────────────────
        $address = Address::where('user_id', $customer->id)->where('is_default', true)->first();

        // Order 1: Delivered
        $order1 = Order::create([
            'user_id' => $customer->id,
            'address_id' => $address->id,
            'order_number' => 'INV-20260901-001',
            'status' => 'delivered',
            'total_amount' => 948000,
            'shipping_cost' => 15000,
        ]);

        $variantForOrder = ProductVariant::where('product_id', $products[0]->id)->first();
        if ($variantForOrder) {
            OrderItem::create([
                'order_id' => $order1->id,
                'product_variant_id' => $variantForOrder->id,
                'quantity' => 2,
                'price_at_purchase' => $products[0]->base_price,
            ]);
        }

        $variantForOrder2 = ProductVariant::where('product_id', $products[2]->id)->first();
        if ($variantForOrder2) {
            OrderItem::create([
                'order_id' => $order1->id,
                'product_variant_id' => $variantForOrder2->id,
                'quantity' => 1,
                'price_at_purchase' => 249000,
            ]);
        }

        Payment::create([
            'order_id' => $order1->id,
            'payment_method' => 'transfer_bank',
            'status' => 'success',
        ]);

        // Order 2: Pending payment
        $order2 = Order::create([
            'user_id' => $customer->id,
            'address_id' => $address->id,
            'order_number' => 'INV-20260915-001',
            'status' => 'pending_payment',
            'total_amount' => 529000,
            'shipping_cost' => 20000,
        ]);

        $variantForOrder3 = ProductVariant::where('product_id', $products[4]->id)->first();
        if ($variantForOrder3) {
            OrderItem::create([
                'order_id' => $order2->id,
                'product_variant_id' => $variantForOrder3->id,
                'quantity' => 1,
                'price_at_purchase' => $products[4]->base_price,
            ]);
        }

        Payment::create([
            'order_id' => $order2->id,
            'payment_method' => 'transfer_bank',
            'status' => 'pending',
        ]);
    }
}
