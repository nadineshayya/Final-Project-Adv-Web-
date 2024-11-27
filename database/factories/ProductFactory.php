<?php
namespace Database\Factories;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->unique()->words(3, true);
        $slug = Str::slug($title);

        // Fetch valid subcategory IDs
        $subCategoryIds = SubCategory::pluck('id')->toArray();

        return [
            'title' => $title,
            'slug' => $slug,
            'category_id' => 28, // Update this as necessary
            'sub_category_id' => $this->faker->randomElement($subCategoryIds), // Ensure valid subcategory
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'sku' => $this->faker->unique()->bothify('SKU-#####'),
            'track_qty' => $this->faker->randomElement(['Yes', 'No']),
            'qty' => $this->faker->numberBetween(0, 100),
            'is_featured' => $this->faker->randomElement(['Yes', 'No']),
            'status' => $this->faker->boolean(),
        ];
    }
}