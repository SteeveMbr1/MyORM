<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf3356dfa5f696fe33f46a7a7d5e28071
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf3356dfa5f696fe33f46a7a7d5e28071::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf3356dfa5f696fe33f46a7a7d5e28071::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf3356dfa5f696fe33f46a7a7d5e28071::$classMap;

        }, null, ClassLoader::class);
    }
}