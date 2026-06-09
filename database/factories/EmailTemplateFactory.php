<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\EmailTemplate>
 */
final class EmailTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmailTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id'                  => \App\Models\Company::factory(),
            'email_template_title'        => fake()->optional()->text,
            'email_template_type'         => fake()->optional()->word,
            'email_template_body'         => fake()->word,
            'email_template_subject'      => fake()->optional()->text,
            'email_template_from_name'    => fake()->optional()->text,
            'email_template_from_email'   => fake()->optional()->text,
            'email_template_cc'           => fake()->optional()->text,
            'email_template_bcc'          => fake()->optional()->text,
            'email_template_pdf_template' => fake()->optional()->word,
        ];
    }
}
