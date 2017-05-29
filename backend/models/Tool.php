<?php

namespace backend\models;

class Tool{

    public static function encrypt($rule, $type = 'js')
    {
        $invert_bytes = self::invert_bytes($rule, $type);

        $rand_number = mt_rand(1, 10);
        if($type == 'js'){
            $hash = self::$encode_table[$rand_number];
        }else{
            $hash = self::$encode_table_client[$rand_number];
        }
        $hash .= trim(self::randString($rand_number));
        $dst = base64_encode(implode('', $invert_bytes));
        $equal_size = strstr($dst, '=') ?
            strpos($dst, '=') - strpos($dst, '=') + 1 : 0;
        if($type == 'js'){
            $hash .= self::$encode_table[$equal_size];
        }else{
            $hash .= self::$encode_table_client[$equal_size];
        }
        $hash .= str_replace('=', '', $dst);

        return $hash;
    }

    public static $encode_table = [
        0 => 'MA',
        1 => 'cQ', 2 => 'cw',
        3 => 'Yw', 4 => 'Zg',
        5 => 'dA', 6 => 'aA',
        7 => 'sQ', 8 => 'aw',
        9 => 'zw', 10 => 'Ow'
    ];

    public static $encode_table_client = [
        0 => 'MA',
        1 => 'cQ', 2 => 'cw',
        3 => 'Yw', 4 => 'Zg',
        5 => 'dA', 6 => 'aA',
        7 => 'bQ', 8 => 'aw',
        9 => 'bw', 10 => 'Ow'
    ];

    public static $space_dict = [
        'MA' => '',
        'cQ' => '=', 'cw' => '=='
    ];

    public static $space_dict_client = [
        'MA' => '',
        'cQ' => '=', 'cw' => '=='
    ];

    private static function randString($length, $specialChars = false)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz'
            .'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        if ($specialChars) {
            $chars .= '!@#$%^&*()';
        }

        $result = '';
        $max = strlen($chars) -1;
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[rand(0, $max)];
        }
        return $result;
    }

    public static function invert_bytes($bytes, $type = 'js') {
        if($type == 'js'){
            $cube = function($b) { return $b; };
            return array_map($cube, str_split($bytes) );
        }else{
            $cube = function($b) { return pack('c*', ~ $b); };
            return array_map($cube, unpack('c*', $bytes));
        }
    }

    /**
     * Rule - Decrypt
     */
    public static function decrypt($hash, $type = 'js')
    {
        if($type == 'js'){
            $reverse_encode_table = array_flip(self::$encode_table);
        }else{
            $reverse_encode_table = array_flip(self::$encode_table_client);
        }
        $should_delete_len = $reverse_encode_table[substr($hash, 0, 2)] + 2;
        $decode = substr($hash, $should_delete_len, strlen($hash));
        if($type == 'js'){
            $should_add_few_space = self::$space_dict[substr($decode, 0,2)];
        }else{
            $should_add_few_space = self::$space_dict_client[substr($decode, 0,2)];
        }
        $base64_encode = substr($decode, 2, strlen($decode)) .
            $should_add_few_space;
        $bytes = base64_decode($base64_encode);
        return implode(self::invert_bytes($bytes, $type));
    }


}

?>