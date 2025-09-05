<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'Admin';
    case PETANI = 'Petani';
    case PETUGAS = 'Petugas Lapangan';
    case KEPALADINAS = 'Kepala Dinas';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::ADMIN => 'primary',
            self::PETANI => 'success',
            self::PETUGAS => 'danger',
            self::KEPALADINAS => 'warning',
            default => 'default'
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
            array_filter(self::cases(), fn ($case) => ! in_array($case, [self::ADMIN, self::KEPALADINAS]))
        );
    }
}
