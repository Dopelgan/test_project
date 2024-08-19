<?php

namespace App\Service;

class TextRuAPi
{
    public function getTextUID(string $text): string
    {
        $body = [
            'userkey' => '3c735202aaae686740f25cdf6326d5ad',
            // Проверяемый текст
            'text' => $text,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.text.ru/post');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, \json_encode($body));

        $rawResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Ошибка curl: ' . curl_error($ch));
        }

        curl_close($ch);

        $response = \json_decode($rawResponse, true);

        return $response['text_uid'];
    }

    public function checkTextUniq(string $textUID): int
    {
        $body = [
            'userkey' => '3c735202aaae686740f25cdf6326d5ad',
            'uid' => $textUID,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.text.ru/post');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, \json_encode($body));

        $rawResponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Ошибка curl: ' . curl_error($ch));
        }

        curl_close($ch);

        $response = \json_decode($rawResponse, true);

        return $response['text_unique'];
    }
}