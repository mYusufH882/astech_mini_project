<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $income = ['Business', 'Investments', 'Extra income', 'Deposits', 'Lottery', 'Gifts', 'Salary', 'Savings', 'Rental income'];
        $expense = ['Bills', 'Car', 'Clothes', 'Travel', 'Food', 'Shopping', 'House', 'Entertainment', 'Phone', 'Pets', 'Other'];

        foreach ($income as $item) {
            $ItemIncome = [
                'id_type' => '1',
                'category_name' => $item
            ];

            Category::create($ItemIncome);
        }

        foreach ($expense as $item) {
            $ItemExpense = [
                'id_type' => '2',
                'category_name' => $item
            ];

            Category::create($ItemExpense);
        }
    }
}
