<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Payment;
use Faker\Factory as Faker;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $orders = Order::all(); // Pastikan ada data di tabel orders terlebih dahulu

        if ($orders->count() > 0) {
            foreach ($orders->random(min(10, $orders->count())) as $order) {
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => $faker->randomElement(['Transfer Bank', 'Kartu Kredit', 'E-wallet']),
                    'amount' => $faker->numberBetween(50000, 2000000),
                    'status' => $faker->randomElement(['pending', 'completed', 'failed']),
                    'transaction_id' => $faker->uuid(),
                    'payment_date' => $faker->dateTimeBetween('-1 month', 'now'),
                    'notes' => $faker->sentence(5),
                ]);
            }

            // Tambahkan beberapa pembayaran lunas
            foreach ($orders->random(min(5, $orders->count())) as $order) {
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => 'Transfer Bank',
                    'amount' => $faker->numberBetween(100000, 1500000),
                    'status' => 'completed',
                    'transaction_id' => $faker->uuid(),
                    'payment_date' => $faker->dateTimeBetween('-2 weeks', 'now'),
                    'notes' => 'Pembayaran berhasil diverifikasi.',
                ]);
            }

            // Tambahkan beberapa pembayaran pending
            foreach ($orders->random(min(3, $orders->count())) as $order) {
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => 'E-wallet',
                    'amount' => $faker->numberBetween(75000, 1250000),
                    'status' => 'pending',
                    'transaction_id' => null,
                    'payment_date' => null,
                    'notes' => 'Menunggu konfirmasi pembayaran.',
                ]);
            }
        } else {
            $this->command->info('Tidak ada data pesanan. Pastikan tabel orders sudah diisi.');
        }
    }
}