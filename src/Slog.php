<?php

namespace lifanko;

class Slog
{
    const CONFIG = [
        'server' => 'http://hpu.lifanko.cn:8081/',
        'uuid' => 'slog-tool'
    ];

    public static function log($obj, $url = 'auto', $type = 'auto')
    {
        $server = self::CONFIG['server'];
        $uuid = str_replace(' ', '_', self::CONFIG['uuid']);

        if (substr($server, strlen($server) - 1) == '/') {
            $server_url = $server . $uuid;
        } else {
            $server_url = $server . '/' . $uuid;
        }

        if ($url == 'auto') {
            if (isset($_SERVER['HTTP_HOST'])) {
                $url = $_SERVER['HTTP_HOST'];
            }
            if (isset($_SERVER['REQUEST_URI'])) {
                $url .= $_SERVER['REQUEST_URI'];
            }
            if ($url == 'auto') {
                $url = 'Unknown URL';
            }
        }

        if ($type == 'auto') {
            $type = gettype($obj);
        }

        if ($type == 'object') {
            $obj = (array)$obj;
        }

        $obj = [
            'obj' => $obj,
            'url' => $url,
            'type' => $type
        ];

        $body = json_encode($obj);
        $ch = curl_init($server_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
