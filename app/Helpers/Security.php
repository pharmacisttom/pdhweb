<?php
namespace App\Helpers;

class Security {
    
    /**
     * Generate and store a CSRF token
     */
    public static function csrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Return hidden input HTML tag with CSRF token
     */
    public static function csrfField() {
        return '<input type="hidden" name="csrf_token" value="' . self::csrfToken() . '">';
    }

    /**
     * Validate CSRF token from POST request
     */
    public static function validateCsrf() {
        if (!isset($_POST['csrf_token']) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            die('Invalid CSRF token.');
        }
    }

    /**
     * Clean XSS from input string
     */
    public static function xssClean($data) {
        if (is_array($data)) {
            $cleaned = [];
            foreach ($data as $key => $value) {
                $cleaned[$key] = self::xssClean($value);
            }
            return $cleaned;
        }
        
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    public static function isValidThaiPhone($phone) {
        $digits = preg_replace('/\D/', '', (string)$phone);
        return (bool)preg_match('/^0\d{8,9}$/', $digits);
    }

    public static function isValidDate($date) {
        $parsed = \DateTime::createFromFormat('Y-m-d', (string)$date);
        return $parsed && $parsed->format('Y-m-d') === $date;
    }

    public static function loginAllowed() {
        $attempts = $_SESSION['login_attempts'] ?? [];
        $cutoff = time() - 900;
        $attempts = array_values(array_filter($attempts, fn($time) => $time >= $cutoff));
        $_SESSION['login_attempts'] = $attempts;
        return count($attempts) < 5;
    }

    public static function recordLoginFailure() {
        $_SESSION['login_attempts'] = $_SESSION['login_attempts'] ?? [];
        $_SESSION['login_attempts'][] = time();
    }

    public static function clearLoginFailures() {
        unset($_SESSION['login_attempts']);
    }
}
