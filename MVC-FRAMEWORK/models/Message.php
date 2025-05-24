<?php
class Message {
    public static function set($type, $text) {
        $_SESSION['messages'][$type][] = $text;
    }

    public static function get() {
        if (!isset($_SESSION['messages'])) return '';

        $output = '';
        foreach ($_SESSION['messages'] as $type => $messages) {
            foreach ($messages as $message) {
                $output .= "<div class='$type'>$message</div>";
            }
        }

        // очищаем после показа
        unset($_SESSION['messages']);
        return $output;
    }

    public static function error($text) {
        self::set('error', $text);
    }

    public static function success($text) {
        self::set('success', $text);
    }

    public static function warning($text) {
        self::set('warning', $text);
    }
}
