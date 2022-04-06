<?php
if ( ! function_exists('nprint')) {
    function nprint($data) {
        if (gettype($data) == 'object') {
            echo '<pre class="text-sm">'.print_r($data->toArray(), true).'</pre>';
        } else {
            echo '<pre class="text-sm">'.print_r($data, true).'</pre>';
        }
    }
}

if ( ! function_exists('nprintd')) {
    function nprintd($data) {
        echo nprint($data);
        die();
    }
}

if ( ! function_exists('mix_url')) {
    function mix_url($path) {
        return url(mix($path));
    }
}

if ( ! function_exists('back_url')) {
    function back_url($default, $set = false) {
        if ($set === true) {
            session(['back_url_'.md5($default) => url()->full()]);
        }

        return url(session('back_url_'.md5($default), $default));
    }
}

if ( ! function_exists('str_dot')) {
    function str_dot($str) {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $str);
    }
}

if ( ! function_exists('format_markdown')) {
    function format_markdown($text, $strip_tags = true) {
        if ($strip_tags) {
            $text = strip_tags($text);
        }
        return Parsedown::instance()->setBreaksEnabled(true)->text($text);
    }
}

if ( ! function_exists('format_dmy')) {
    function format_dmy($date = null) {
        if ($date && is_object($date)) {
            return $date->format('d-m-Y');
        }
        if ($date && substr($date, 0, 4) != '0000') {
            return implode('-', array_reverse(explode('-', $date)));
        }
        return null;
    }
}

if ( ! function_exists('format_dmyt')) {
    function format_dmyt($date = null) {
        if ($date && is_object($date)) {
            return $date->format('d-m-Y H:i');
        }
        if ($date && substr($date, 0, 4) != '0000') {
            return implode('-', array_reverse(explode('-', $date)));
        }
        return null;
    }
}

if ( ! function_exists('format_ymd')) {
    function format_ymd($date = null) {
        if ($date && is_object($date)) {
            return $date->format('Y-m-d');
        }
        if ($date && substr($date, 0, 4) != '0000') {
            return $date;
            return implode('-', array_reverse(explode('-', $date)));
        }
        return null;
    }
}

if ( ! function_exists('format_time')) {
    function format_time($start =  null, $end = null) {
        if ($start && substr($start, 0, 5) == '00:00') {
            $start = null;
        }
        if ($end && substr($end, 0, 5) == '00:00') {
            $end = null;
        }

        if ($start && $end) {
            return substr($start, 0, 5).' - '.substr($end, 0,5);
        } else if ($start) {
            return substr($start, 0, 5);
        }
        return null;
    }
}

if ( ! function_exists('format_price')) {
    function format_price($value) {
        return '€ '.number_format($value, 2, ',', '.');
    }
}

if ( ! function_exists('replace_tags')) {
    function replace_tags($content, $tags = [], $re = '/\[(.*?)\]/') {
        preg_match_all($re, $content, $matches);
        foreach ($matches[0] as $i => $m) {
            $str = $matches[1][$i];

            if ($optional = substr($str, -1) ==  '?') {
                $str = substr($str, 0, -1);
            }
            if (array_key_exists($str, $tags)) {
                $content = trim(str_replace($m, $tags[$str], $content));
            } else if ($optional) {
                $content = trim(str_replace($m, '', $content));
            }
        }
        return $content;
    }
}
