<?php
namespace Models;
use Models\Page;

class Refuge extends Page
{
    protected static $table = 'refuges';
    protected static $viewPath = '/Views/home.php';

    private static $refugeName; 
    private static $refugeAddress;
    private static $refugeZipCode;
    private static $refugeCity;
    private static $refugePhone;

    public static function getRefugeName()
    {
        return static::$refugeName;
    }

    public static function setRefugeName($name)
    {
        static::$refugeName = $name;
    }

    public static function getRefugeAddress()
    {
        return static::$refugeAddress . '<br>' . static::$refugeZipCode . ' - ' . static::$refugeCity;
    }

    public static function setRefugeAddress($address, $zipCode, $city)
    {
        static::$refugeAddress = $address;
        static::$refugeZipCode = $zipCode;
        static::$refugeCity = $city;
    }

    public static function getRefugePhone()
    {
        return static::$refugePhone;
    }

    public static function setRefugePhone($phone)
    {
        static::$refugePhone = $phone;
    }
}