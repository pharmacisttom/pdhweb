<?php
namespace App\Helpers;

class ThemeHelper {
    
    /**
     * Get the theme colors based on the current day of the week.
     * 
     * 0 = Sunday (Red)
     * 1 = Monday (Yellow)
     * 2 = Tuesday (Pink)
     * 3 = Wednesday (Green)
     * 4 = Thursday (Orange)
     * 5 = Friday (Blue)
     * 6 = Saturday (Purple)
     * 
     * @return array Associative array with primary and secondary color hex codes.
     */
    public static function getDailyThemeColors() {
        // Default to today
        $dayOfWeek = date('w');
        
        // For testing, you can uncomment this to force a specific day (0-6)
        // $dayOfWeek = 0; // Test Sunday (Red)
        
        switch ($dayOfWeek) {
            case 0: // Sunday (วันอาทิตย์ - แดง)
                return [
                    'primary' => '#ef4444', // Red 500
                    'secondary' => '#b91c1c' // Red 700
                ];
            case 1: // Monday (วันจันทร์ - เหลือง)
                return [
                    'primary' => '#eab308', // Yellow 500
                    'secondary' => '#a16207' // Yellow 700
                ];
            case 2: // Tuesday (วันอังคาร - ชมพู)
                return [
                    'primary' => '#ec4899', // Pink 500
                    'secondary' => '#be185d' // Pink 700
                ];
            case 3: // Wednesday (วันพุธ - เขียว)
                return [
                    'primary' => '#10b981', // Emerald 500
                    'secondary' => '#047857' // Emerald 700
                ];
            case 4: // Thursday (วันพฤหัสบดี - ส้ม)
                return [
                    'primary' => '#f97316', // Orange 500
                    'secondary' => '#c2410c' // Orange 700
                ];
            case 5: // Friday (วันศุกร์ - ฟ้า)
                return [
                    'primary' => '#0ea5e9', // Sky 500
                    'secondary' => '#0369a1' // Sky 700
                ];
            case 6: // Saturday (วันเสาร์ - ม่วง)
                return [
                    'primary' => '#a855f7', // Purple 500
                    'secondary' => '#7e22ce' // Purple 700
                ];
            default: // Default (Teal)
                return [
                    'primary' => '#0d9488', // Teal 600
                    'secondary' => '#0f766e' // Teal 700
                ];
        }
    }
}
