<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb460b31ec922f64dad6893bb0ea23009
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kata\\Test\\' => 10,
            'Kata\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kata\\Test\\' => 
        array (
            0 => __DIR__ . '/../..' . '/test',
        ),
        'Kata\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb460b31ec922f64dad6893bb0ea23009::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb460b31ec922f64dad6893bb0ea23009::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}