<?php

namespace App\Enums;

enum FieldOfStudy: string
{
    case BiologicalSciences = 'biological_sciences';
    case PhysicsAstronomy = 'physics_astronomy';
    case ComputerScienceAi = 'computer_science_ai';
    case SocialSciences = 'social_sciences';
    case Humanities = 'humanities';
    case MedicineHealth = 'medicine_health';

    public function label(): string
    {
        return match ($this) {
            self::BiologicalSciences => 'Biological Sciences',
            self::PhysicsAstronomy => 'Physics & Astronomy',
            self::ComputerScienceAi => 'Computer Science & AI',
            self::SocialSciences => 'Social Sciences',
            self::Humanities => 'Humanities',
            self::MedicineHealth => 'Medicine & Health',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $out = [];
        foreach (self::cases() as $case) {
            $out[$case->value] = $case->label();
        }

        return $out;
    }
}
