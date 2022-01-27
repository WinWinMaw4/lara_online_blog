<?php


class My{

    public $name,$age;

    public function __construct($myName,$myAge)
    {
        $this->name = $myName;
        $this->age = $myAge;

    }
}

$me = new My("WinWinMaw",22);
//$me->name = "hhz";
//$me->age = 22;

$my = new My("Maw",20);
//$me->name = "hhz";
//$me->age = 22;

$abc = new My("abc",32);


print_r([$me,$my,$abc]);
?>
