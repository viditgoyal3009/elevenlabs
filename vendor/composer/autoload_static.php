<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3d16f8e980819c2dc490cb48b309ae87
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Innovination\\Elevenlabs\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Innovination\\Elevenlabs\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit3d16f8e980819c2dc490cb48b309ae87::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3d16f8e980819c2dc490cb48b309ae87::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3d16f8e980819c2dc490cb48b309ae87::$classMap;

        }, null, ClassLoader::class);
    }
}
