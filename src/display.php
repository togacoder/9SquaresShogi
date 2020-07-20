<?php
const RED = 31;
const BLUE = 34;

displayClass::debug();

class displayClass {
    /**
     * Debug
     */
     public function debug() {
         self::sample();
     }

    /**
     * sample
     */
    private function sample() {
        $ary = array("hu", "ou", "_");
        self::lineDrow();
        foreach ($ary as $key) {
            echo '| ' . self::colorEcho(RED, self::convertPieceIdToJp($key)) . ' ';
        }
        echo "|\n";
        self::lineDrow();
    }

    /**
     * 線を引く
     * @param int $n
     */
    private function lineDrow($n = 3) {
        $line = '-----';
        for ($i = 0; $i < $n; $i++) {
            echo $line;
        }
        echo "\n";
    }

    /**
     * ターミナルへのechoに色をつける。
     * @param int $color
     * @param string $str
     * @return string
     */
    private function colorEcho($color = BLUE, $str = 'test') {
        return sprintf("\e[%dm%s\e[m", $color, $str);
    }

    /**
     * pieceIdから日本語に変換する。
     * @param string $pieceId
     * @return string
     */
    private function  convertPieceIdToJp($pieceId) {
        $aryPieceToJp = array(
            'hu' => '歩',
            'kyou' => '香',
            'kei' => '桂',
            'gin' => '銀',
            'kin' => '金',
            'kaku' => '角',
            'hisya' => '飛',
            'to' => 'と',
            'uma' => '馬',
            'ryu' => '竜',
            'ou' => '王',
            ' ' => '　');

        return $aryPieceToJp[$pieceId];
    }
}