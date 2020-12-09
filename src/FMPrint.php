<?php
namespace xingyk\helper;

class FMPrint
{
    public static function ddJson()
    {
        $args = func_get_args();
        $end = end($args);

        echo '<pre>';
        foreach ($args as $k => $v) {
            echo json_encode($v);
            echo '<br>';
        }
        if ($end == 'die') {
            exit;
        }
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
}
