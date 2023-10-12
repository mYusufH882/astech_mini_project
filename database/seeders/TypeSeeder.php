<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = ['Income', 'Expense'];

        $no = 1;
        foreach ($type as $item) {
            $data = [
                'id' => $no++,
                'type_name' => $item
            ];

            Type::create($data);
        }
    }
}
