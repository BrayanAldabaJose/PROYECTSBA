<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        $exampleCurrencies = [
            ['name' => 'Bolivianos', 'code' => 'BOB', 'symbol' => 'Bs.', 'country' => 'Bolivia', 'exchange_rate' => 1.00],
            ['name' => 'Soles', 'code' => 'PEN', 'symbol' => 'S/.', 'country' => 'Perú', 'exchange_rate' => 0.55],
            ['name' => 'Euros', 'code' => 'EUR', 'symbol' => '€', 'country' => 'Unión Europea', 'exchange_rate' => 1.18],
            ['name' => 'Dólares', 'code' => 'USD', 'symbol' => '$', 'country' => 'Estados Unidos', 'exchange_rate' => 6.96],
            // Agrega más monedas aquí
            ['name' => 'Libra esterlina', 'code' => 'GBP', 'symbol' => '£', 'country' => 'Reino Unido', 'exchange_rate' => 0.85],
            ['name' => 'Yen japonés', 'code' => 'JPY', 'symbol' => '¥', 'country' => 'Japón', 'exchange_rate' => 0.0068],
            ['name' => 'Dólar canadiense', 'code' => 'CAD', 'symbol' => 'CA$', 'country' => 'Canadá', 'exchange_rate' => 5.55],

            // Agrega más monedas según sea necesario
        ];


        foreach ($exampleCurrencies as $example) {
            Currency::firstOrCreate($example);
        }
    }
}
