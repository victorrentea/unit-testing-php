<?php
//
//namespace PhpUnitWorkshopTest;
//
//class GameRound
//{
//
//    static function roll(int $pins) {
//        return new static();
//    }
//
//    public function __construct(
//        public readonly int $first,
//        public readonly int $second
//    )
//    {
//    }
//    function isDone():bool {
//
//    }
//
//   function getType():GameRoundType {
//       if ($this->first == 10) {
//           return GameRoundType::STRIKE;
//       } elseif ($this->first + $this->second == 10) {
//           return GameRoundType::SPARE;
//       } else {
//           return GameRoundType::REGULAR;
//       }
//   }
//}