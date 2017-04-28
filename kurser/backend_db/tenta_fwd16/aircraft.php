<?php

interface refuel {
    public function texaco();
}

abstract class aircraft implements refuel{
    protected $speed;
    protected $range;
    protected $payload;
    protected $aircraftDesignation;
    
    const constMessage = "Refueling charter";
    public static $staticMessage = "WARNING!!! Boogie 9 oclock, Angels 5";
    
    public function __construct($speed, $range, $payload, $aircraftDesignation) {
        $this->speed = $speed;
        $this->range = $range;
        $this->payload = $payload;
        $this->aircraftDesignation = $aircraftDesignation;
        
        echo self::constMessage . "</br></br>";
        echo self::$staticMessage . "</br></br>";
    }
    
    public function texaco() {
        echo "Go Juice, thanks Texaco" . "</br></br>";
    }
    
}

class interceptor extends aircraft {
    public $missiles;
    
    public function __construct($speed, $range, $payload, $aircraftDesignation, $missiles) {
        $this->missiles = $missiles;
        parent::__construct($speed, $range, $payload, $aircraftDesignation);
    }
}

class bomber extends aircraft {
    public $bombs;
    
    public function __construct($speed, $range, $payload, $aircraftDesignation, $bombs) {
        $this->bombs = $bombs;
        parent::__construct($speed, $range, $payload, $aircraftDesignation);
    }
}

