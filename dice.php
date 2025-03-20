<?php
class Dice {

    private $tracer;

    function __construct() {
    }

    public function roll($rolls) {
        $result = [];
        for ($i = 0; $i < $rolls; $i++) {
            $result[] = $this->rollOnce();
        }
        return $result;
    }

    private function rollOnce() {
      $result = random_int(1, 6);
      return $result;
    }
}
