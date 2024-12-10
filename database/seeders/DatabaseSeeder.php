<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductTemplate;
use App\Models\ProductTemplateAttribute;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $baseCategories = Category::factory(5)->create();

        foreach ($baseCategories as $baseCategory) {
            $firstLevelChildren = Category::factory(3)->create([
                'category_id' => $baseCategory->id
            ]);

            foreach ($firstLevelChildren as $firstLevelChild) {
                $childCategories = Category::factory(5)->create([
                    'category_id' => $firstLevelChild->id
                ]);

                foreach ($childCategories as $childCategory) {
                    $productTemplate = ProductTemplate::factory(1)->create()->first();

                    $templateAttributes = ProductTemplateAttribute::factory(10)->create([
                        'product_template_id' => $productTemplate->id,
                    ]);

                    $products = Product::factory(10)->create([
                        'category_id' => $childCategory->id,
                        'product_template_id' => $productTemplate->id,
                    ]);

                    foreach ($products as $product) {
                        foreach ($templateAttributes as $templateAttribute) {
                            $productAttribute = ProductAttribute::factory(1)
                                ->create([
                                    'product_id' => $product->id,
                                    'product_template_attribute_id' => $templateAttribute->id,
                                ])
                                ->first();
                        }
                    }

                }
            }
        }

        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'test@example.com',
            'role' => RoleEnum::ADMIN,
            'phone' => '797616615'
        ]);

        $user->address()->create([
            'country' => fake()->country,
            'city' => fake()->city,
            'postcode' => fake()->postcode,
            'street' => fake()->streetName,
            'building' => fake()->buildingNumber,
            'flat' => null,
        ]);
    }
}
