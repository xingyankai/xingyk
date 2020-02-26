<?php
namespace xingyk\helper;

class FMPrint
{
    public static function ddJson()
    {
        $args = func_get_args();

        echo '<pre>';
        foreach ($args as $k => $v) {
            echo json_encode($v);
            echo '<br>';
        }
        exit;
    }


    public static function dd()
    {
        $args = func_get_args();
        $end = end($args);

        echo '<pre>';
        foreach ($args as $k => $v) {
            if ($end == 'var') {
                var_dump($v);
            }else{
                print_r($v);
            }
            echo '<br>';
        }
        exit;
    }

    public static function dp()
    {
        $args = func_get_args();
        $end = end($args);

        echo '<pre>';
        foreach ($args as $k => $v) {
            if ($end == 'var') {
                var_dump($v);
            }else{
                print_r($v);
            }
            echo '<br>';
        }
    }


    /**
     * Notes: only dd 仅打印，不做html格式化
     * User: xingyk
     */
    public static function odd()
    {
        $args = func_get_args();
        $end = end($args);

        foreach ($args as $k => $v) {
            if ($end == 'var') {
                var_dump($v);
            }else{
                print_r($v);
            }
            echo '  ';
        }
        exit;
    }


    /**
     * Notes: only dp 仅打印，不做html格式化
     * User: xingyk
     */
    public static function odp()
    {
        $args = func_get_args();
        $end = end($args);

        foreach ($args as $k => $v) {
            if ($end == 'var') {
                var_dump($v);
            }else{
                print_r($v);
            }
            echo '  ';
        }
    }

}
