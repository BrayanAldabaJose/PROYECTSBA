<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tax;

class TaxSeeder extends Seeder
{
    public function run()
    {
        $exampleTaxes = [
            ['name' => 'IVA', 'rate' => 12.00],
            ['name' => 'Impuesto al Consumo', 'rate' => 5.00],
            ['name' => 'Impuesto a las Ventas', 'rate' => 10.00],
            ['name' => 'Impuesto sobre la Renta', 'rate' => 15.00],
            // Puedes agregar más ejemplos aquí
        ];

        foreach ($exampleTaxes as $example) {
            Tax::firstOrCreate($example);
        }
    }
}
