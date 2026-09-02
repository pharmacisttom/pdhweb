<?php
namespace App\Helpers;

/**
 * PromptPay EMVCo Thai QR Payment Generator
 * Standard compliance with Bank of Thailand & National ITMX PromptPay Specification
 */
class PromptPayHelper {

    const PROMPTPAY_ID = '0994000164877'; // Hospital 13-digit Tax ID
    const AID_PROMPTPAY = 'A000000677010111';

    /**
     * Helper to format TLV (Tag-Length-Value)
     */
    public static function tlv($tag, $value) {
        $len = str_pad(strlen($value), 2, '0', STR_PAD_LEFT);
        return $tag . $len . $value;
    }

    /**
     * Compute standard CRC16-CCITT (0xFFFF, 0x1021)
     */
    public static function crc16($str) {
        $crc = 0xFFFF;
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            $crc ^= (ord($str[$i]) << 8);
            for ($j = 0; $j < 8; $j++) {
                if ($crc & 0x8000) {
                    $crc = (($crc << 1) ^ 0x1021) & 0xFFFF;
                } else {
                    $crc = ($crc << 1) & 0xFFFF;
                }
            }
        }
        return strtoupper(str_pad(dechex($crc), 4, '0', STR_PAD_LEFT));
    }

    /**
     * Generate Standard PromptPay EMVCo QR Code Payload (Tag 29 AnyID)
     *
     * @param float|null $amount Optional specific amount
     * @param string $target Target Phone (08x...) or 13-digit Tax ID / National ID
     * @return string
     */
    public static function generatePayload($amount = null, $target = self::PROMPTPAY_ID) {
        $cleanTarget = preg_replace('/[^0-9]/', '', $target);

        // Format sub-tag 01 (Mobile: 0066...) or sub-tag 02 (13-digit Tax ID/National ID)
        if (strlen($cleanTarget) <= 10 && str_starts_with($cleanTarget, '0')) {
            $formattedTarget = '0066' . substr($cleanTarget, 1);
            $subTag = self::tlv('01', $formattedTarget);
        } else {
            $subTag = self::tlv('02', $cleanTarget);
        }

        // Tag 29: Merchant Account Information - PromptPay AnyID
        $tag29Content = self::tlv('00', self::AID_PROMPTPAY) . $subTag;
        $tag29 = self::tlv('29', $tag29Content);

        // Tag 00: Version (01)
        // Tag 01: Point of Initiation (11 = Static without amount, 12 = Dynamic with amount)
        $isDynamic = (!empty($amount) && floatval($amount) > 0);
        $raw = self::tlv('00', '01')
             . self::tlv('01', $isDynamic ? '12' : '11')
             . $tag29
             . self::tlv('53', '764'); // Currency Code 764 = THB

        if ($isDynamic) {
            $formattedAmount = number_format(floatval($amount), 2, '.', '');
            $raw .= self::tlv('54', $formattedAmount);
        }

        $raw .= self::tlv('58', 'TH')
             . '6304';

        return $raw . self::crc16($raw);
    }

    /**
     * Backward-compatible alias for generatePayload
     */
    public static function generateEDonationPayload($amount = null, $ref1 = '', $billerId = self::PROMPTPAY_ID) {
        return self::generatePayload($amount, $billerId);
    }

    /**
     * Generate QR Image URL
     *
     * @param float|null $amount
     * @param string $ref1
     * @param int $size
     * @return string
     */
    public static function getQrImageUrl($amount = null, $ref1 = '', $size = 280) {
        $payload = self::generatePayload($amount);
        return 'https://api.qrserver.com/v1/create-qr-code/?size=' . $size . 'x' . $size . '&data=' . urlencode($payload);
    }
}
