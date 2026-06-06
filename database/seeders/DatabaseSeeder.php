<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Product::create([
            'name' => 'Kemeja Flanel Premium',
            'description' => 'Kemeja flanel kotak-kotak dengan bahan katun premium. Nyaman dipakai sehari-hari.',
            'price' => 149000,
            'stock' => 50,
            'category' => 'Kemeja',
        ]);

        Product::create([
            'name' => 'Kaos Oblong Polos',
            'description' => 'Kaos oblong polos berbahan katun combed 30s. Tersedia berbagai warna.',
            'price' => 79000,
            'stock' => 100,
            'category' => 'Kaos',
        ]);

        Product::create([
            'name' => 'Jaket Hoodie Sweater',
            'description' => 'Jaket hoodie berbahan fleece tebal dan hangat. Cocok untuk cuaca dingin.',
            'price' => 199000,
            'stock' => 30,
            'category' => 'Jaket',
        ]);

        Product::create([
            'name' => 'Celana Chino Slim Fit',
            'description' => 'Celana chino slim fit dengan bahan stretch. Nyaman dan stylish.',
            'price' => 179000,
            'stock' => 40,
            'category' => 'Celana',
        ]);

        Product::create([
            'name' => 'Blazer Formal Pria',
            'description' => 'Blazer formal pria dengan bahan wool blend. Cocok untuk acara formal.',
            'price' => 399000,
            'stock' => 20,
            'category' => 'Blazer',
        ]);

        Product::create([
            'name' => 'Kemeja Batik Modern',
            'description' => 'Kemeja batik dengan motif modern dan bahan katun jepang. Tampil elegan.',
            'price' => 169000,
            'stock' => 35,
            'category' => 'Kemeja',
        ]);

        Product::create([
            'name' => 'Kaos Graphic Print',
            'description' => 'Kaos dengan graphic print eksklusif. Tersedia berbagai desain unik.',
            'price' => 99000,
            'stock' => 75,
            'category' => 'Kaos',
        ]);

        Product::create([
            'name' => 'Jaket Bomber Kulit Sintetis',
            'description' => 'Jaket bomber berbahan kulit sintetis premium. Tampilan casual keren.',
            'price' => 299000,
            'stock' => 25,
            'category' => 'Jaket',
        ]);
    }
}
