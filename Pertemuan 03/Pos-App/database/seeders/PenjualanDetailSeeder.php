<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $detail_id = 1;

        // 10 transaksi x 3 barang = 30 data
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $data[] = [
                    'detail_id' => $detail_id,
                    'penjualan_id' => $i,
                    'barang_id' => ($detail_id % 15) + 1, // ID barang 1-15 secara acak berurutan
                    'harga' => 15000, // Sama dengan harga jual
                    'jumlah' => 2, // Beli 2 qty per barang
                ];
                $detail_id++;
            }
        }
        DB::table('t_penjualan_detail')->insert($data);
    }
}
