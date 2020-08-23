<?php


namespace App;


class Renderer
{
    protected static $smarty;

    public static function getSmarty()
    {
        if (is_null(static::$smarty)) {
            static::init();
        }

        return static::$smarty;
    }

    protected static function init()
    {
        $smarty = new \Smarty();

        $smarty->template_dir = __DIR__ . '/../templates';
        $smarty->compile_dir = __DIR__ . '/../var/compile';
        $smarty->cache_dir = __DIR__ . '/../var/cache';
        $smarty->config_dir = __DIR__ . '/../var/config';

        static::$smarty = $smarty;
    }
}