<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc675063e4d401c88fe770f0d68b46a6c
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TextLK\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TextLK\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/TextLK',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc675063e4d401c88fe770f0d68b46a6c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc675063e4d401c88fe770f0d68b46a6c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc675063e4d401c88fe770f0d68b46a6c::$classMap;

        }, null, ClassLoader::class);
    }
}