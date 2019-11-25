<?php

use Illuminate\Database\Seeder;
use App\Deals;
class DealsTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    // Let's truncate our existing records to start from scratch.
    {
        Deals::truncate();
        $faker = \Faker\Factory::create();
        
        for ($i = 0; $i < 50; $i++) {
            Deals::create([
                'company_name' => $faker->company,
                'company_type' => $faker->catchPhrase,
		        'industry' => $faker->name,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'amount_to_raise' => $faker->biasedNumberBetween($min = 10000, $max = 2000000, $function = 'sqrt'),
                'company_cover_photo' => $faker->imageUrl,
                'company_details' => $faker->realText,
                'business_plan' => $faker->boolean,
		        'memo_of_understanding' => $faker->boolean,
                'cert_of_registration' => $faker->boolean($chanceOfGettingTrue = 50),
                'financial_state' => $faker->boolean,
                'cash_flow' => $faker->boolean($chanceOfGettingTrue = 50),
		        'contract_doc' => $faker->boolean,
                'certified_audit_acc' => $faker->boolean($chanceOfGettingTrue = 50)	
            ]);
        }
    }
}
