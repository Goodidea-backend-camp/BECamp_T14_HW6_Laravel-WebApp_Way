<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $foods = [
            'Burger', 'Pizza', 'Sushi', 'Pasta', 'Ramen',
            'Salad', 'Taco', 'Steak', 'Fried Chicken', 'Curry',
            'Dumpling', 'Sandwich', 'Noodles', 'Ice Cream', 'Donut',
            'Hot Dog', 'Spring Roll', 'Bibimbap', 'Kebab', 'Burrito',
            'Falafel', 'Lasagna', 'Quiche', 'Gyoza', 'Pad Thai',
            'Grilled Cheese', 'Fish and Chips', 'Chow Mein', 'Meatball', 'Risotto',
            'Water', 'Coca Cola', 'Pepsi', 'Sprite', 'Fanta',
            'Iced Tea', 'Lemonade', 'Orange Juice', 'Apple Juice', 'Grape Juice',
            'Milk', 'Soy Milk', 'Coffee', 'Latte', 'Cappuccino',
            'Espresso', 'Green Tea', 'Black Tea', 'Oolong Tea', 'Bubble Tea',
            'Smoothie', 'Milkshake', 'Hot Chocolate', 'Energy Drink', 'Sports Drink',
            'Herbal Tea', 'Chai', 'Matcha', 'Soda Water','Tonic Water'
        ];
        
        $property = [ 'Piece', 'Slice', 'Portion', 'Serving', 'L', 'M', 'S' ];

        return [
            'store_id' => Store::inRandomOrder()->first()->id,
            'name' => fake()->randomElement($foods),
            'property' => fake()->randomElement($property),
            'price' => fake()->randomFloat(2,1,90),
        ];
    }
}
