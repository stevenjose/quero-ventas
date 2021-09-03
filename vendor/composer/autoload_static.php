<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite8232429834662cfd4834d36e1510e03
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite8232429834662cfd4834d36e1510e03::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite8232429834662cfd4834d36e1510e03::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
