<?php

namespace backend\helpers;

class RunnoTitle
{
    const RUNNO_PR = 1;
    const RUNNO_PO = 2;
    const RUNNO_QT = 3;
    const RUNNO_SO = 4;
    const RUNNO_TRANSFER = 5;
    const RUNNO_ISSUE = 6;
    const RUNNO_ISSUE_RETURN = 7;
    const RUNNO_SO_RETURN = 8;
    const RUNNO_PO_RETURN = 9;
    const RUNNO_COUNT = 10;
    const RUNNO_ADJUST = 11;
  
    private static $data = [
        1 => 'ขอซื้อ',
        2 => 'สั่งซ์้อ',
        3 => 'เสนอราคา',
        4 => 'ขาย',
        5 => 'ย้าย',
        6 => 'เบิก',
        7 => 'คืนเบิก',
        8 => 'คืนขาย',
        9 => 'คืนซ์้อ',
        10 => 'นับสต๊อก',
        11 => 'ปรับสต๊อก',
    ];

	private static $dataobj = [
        ['id'=>1,'name' => 'ขอซื้อ'],
        ['id'=>2,'name' => 'สั่งซ์้อ'],
        ['id'=>3,'name' => 'เสนอราคา'],
        ['id'=>4,'name' => 'ขาย'],
        ['id'=>5,'name' => 'ย้าย'],
        ['id'=>6,'name' => 'เบิก'],
        ['id'=>7,'name' => 'คืนเบิก'],
        ['id'=>8,'name' => 'คืนขาย'],
        ['id'=>9,'name' => 'คืนซ์้อ'],
        ['id'=>10,'name' => 'นับสต๊อก'],
        ['id'=>11,'name' => 'ปรับสต๊อก']
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
