<?php
declare(strict_types = 1);

namespace App\Infrastructure\Service\IdentityGenerator;

final class Uuid4Generator
{
    /**
     * Генерация Uuid v4
     *
     * @return string
     */
    public function generate() : string
    {
        $bytes = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
        $hex = bin2hex($bytes);
        $fields = [
            'time_low' => substr($hex, 0, 8),
            'time_mid' => substr($hex, 8, 4),
            'time_hi_and_version' => substr($hex, 12, 4),
            'clock_seq_hi_and_reserved' => substr($hex, 16, 2),
            'clock_seq_low' => substr($hex, 18, 2),
            'node' => substr($hex, 20, 12)
        ];

        return vsprintf(
            '%08s-%04s-%04s-%02s%02s-%012s',
            $fields
        );
    }
}
