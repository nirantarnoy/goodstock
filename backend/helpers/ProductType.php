<?php

namespace backend\helpers;

class ProductType
{
    const PRODUCT = 1;
    const SERVICE = 2;
    const PRODUCT_MASTER = 3;
    private static $data = [
        1 => 'สินค้า',
        2 => 'บริการ',
        3 => 'สินค้าต้นฉบับ'
    ];

	private static $dataobj = [
        ['id'=>1,'name' => 'สินค้า'],
        ['id'=>2,'name' => 'บริการ'],
        ['id'=>3,'name' => 'สินค้าต้นฉบับ'],
    ];
    public static function asArray()
    {
        return self::$data;
    }
     public static function asArrayObject()
    {
        return self::$dataobj;
    }
    public static function getTypeById($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
    public static function getTypeByName($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
}
