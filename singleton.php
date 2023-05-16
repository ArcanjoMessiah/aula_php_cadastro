<?php

class Singleton
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): Singleton
    {
        $cls = static::class;
		
		echo $cls;
		echo "<br>";
		
        if (!isset(self::$instances[$cls])) {
			echo "Passo1";
            self::$instances[$cls] = new static();
			echo "<br>";
        }

        return self::$instances[$cls];
    }

    public function someBusinessLogic()
    {
        
    }
}

function clientCode()
{
    $s1 = Singleton::getInstance();
    $s2 = Singleton::getInstance();
    if ($s1 === $s2) {
        echo "Singleton works, both variables contain the same instance.";
    } else {
        echo "Singleton failed, variables contain different instances.";
    }
}

clientCode();