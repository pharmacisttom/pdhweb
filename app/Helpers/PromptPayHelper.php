<?php
namespace App\Helpers;

/**
 * PromptPay & e-Donation EMVCo QR Code Generator Helper
 * Generates official Thai QR Payment compatible strings for e-Donation Bill Payment & PromptPay
 */
class PromptPayHelper {

    const BILLER_ID = '0994000164877'; // Hospital Tax ID for e-Donation
    const AID_BILL_PAYMENT = 'A000000677010111';

    /**
     * Helper to format TLV (Tag-Length-Value)
     */
    private static function tlv($tag, $value) {
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
     * Generate EMVCo QR Code String for e-Donation / Bill Payment
     *
     * @param string $billerId 13-digit Tax ID (defaults to Hospital Tax ID)
     * @param float|null $amount Optional specific amount
     * @param string $ref1 Optional Reference 1
     * @return string
     */
    public static function generateEDonationPayload($amount = null, $ref1 = '', $billerId = self::BILLER_ID) {
        // Tag 30: Merchant Account Information - Bill Payment
        $billerTag = self::tlv('00', self::AID_BILL_PAYMENT) . self::tlv('01', str_pad($billerId, 15, '0', STR_PAD_RIGHT));
        if (!empty($ref1)) {
            $billerTag .= self::tlv('02', $ref1);
        }

        // Tag 00: Version (01)
        // Tag 01: Point of Initiation (11 = Static QR without amount, 12 = Dynamic QR with amount)
        $isDynamic = (!empty($amount) && floatval($amount) > 0);
        $raw = self::tlv('00', '01')
             . self::tlv('01', $isDynamic ? '12' : '11')
             . self::tlv('30', $billerTag)
             . self::tlv('53', '764'); // Currency THB

        if ($isDynamic) {
            $formattedAmount = number_format(floatval($amount), 2, '.', '');
            $raw .= self::tlv('54', $formattedAmount);
        }

        $raw .= self::tlv('58', 'TH')
             . '6304';

        return $raw . self::crc16($raw);
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
        $payload = self::generateEDonationPayload($amount, $ref1);
        return 'https://api.qrserver.com/v1/create-qr-code/?size=' . $size . 'x' . $size . '&data=' . urlencode($payload);
    }
}
