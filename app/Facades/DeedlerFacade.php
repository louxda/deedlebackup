<?php

namespace App\Facades;

use App\Models\Deedler;
use Illuminate\Support\Facades\Facade;

class DeedlerFacade extends Facade
{
    protected static Deedler $deedler;

    protected static function getFacadeAccessor()
    {
        return 'deedlerfacade';
    }

    public static function setDeedler($deedler)
    {
        self::$deedler = $deedler;
    }

    public static function getDeedler()
    {
        return self::$deedler ?? null;
    }
}