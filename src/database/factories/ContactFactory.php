<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            'gender'     => $this->faker->randomElement(['男性', '女性','その他']),
            'email'      => $this->faker->unique()->safeEmail(),
            'tel'        => $this->faker->phoneNumber,
            'address'    => $this->faker->postcode() . ' ' . $this->faker->prefecture() . $this->faker->city() . $this->faker->streetAddress(),
            'message'    => $this->faker->randomElement([
                '商品の配送が予定より遅れているようなので確認したいです。',
                '注文内容を間違えたため、変更したいです。',
                '届いた商品に不良があり、交換を希望します。',
                'ショップへのアクセス方法を教えてください。',
                '商品の詳細についてもう少し教えていただけますか？',
                '支払い方法をクレジットカードに変更したいです。',
                'ギフト包装をお願いしたいです。',
                '注文をキャンセルしたいのですが、どうすればよいですか？',
                '領収書の発行をお願いしたいです。',
                '返品の手続き方法を教えてください。',
            ]),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
