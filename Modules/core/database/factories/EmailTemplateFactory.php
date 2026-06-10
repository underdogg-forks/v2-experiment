<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Core\Models\EmailTemplate;

class EmailTemplateFactory extends Factory
{
    protected $model = EmailTemplate::class;

    public function definition(): array
    {
        return [
            'company_id'                => \Modules\Core\Models\Company::factory(),
            'email_template_title'      => fake()->sentence(3),
            'email_template_type'       => fake()->randomElement(['invoice', 'quote', 'payment']),
            'email_template_body'       => fake()->paragraphs(3, true),
            'email_template_subject'    => fake()->sentence(),
            'email_template_from_name'  => fake()->name(),
            'email_template_from_email' => fake()->safeEmail(),
        ];
    }
}
