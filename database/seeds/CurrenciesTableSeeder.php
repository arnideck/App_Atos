<?php

use App\Currency;

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ "id" => "1", "country" => "Brazil", "currency" => "Reais", "code" => "BRL", "symbol" => "R$",
            "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null , "updated_at" => null ],
            [ "id" => "2", "country" => "Estados unidos", "currency" => "Dólares", "code" => "USD", "symbol" => '$',
            "thousand_separator" => ".", "decimal_separator" => ",", "created_at" => null , "updated_at" => null ]
      ];

        Currency::insert($data);

        
    }
}
