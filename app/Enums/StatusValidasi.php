<?php

namespace App\Enums;

enum StatusValidasi: string
{
    case BELUM = 'Belum Divalidasi';
    case VALID = 'Valid';
    case TIDAK_VALID = 'Tidak Valid';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::BELUM => 'secondary',
            self::VALID => 'success',
            self::TIDAK_VALID => 'danger',
            default => 'default',
        };
    }

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public static function getOptions(): array
    {
        return array_map(
            fn ($case) => $case->value,
            array_filter(self::cases(), fn ($case) => $case !== self::TIDAK_VALID)
        );
    }
}
