<?php
const RED = 31;
const BLUE = 34;
const WHITE_PANEL = 47;
const FRIEND = 1;
const ENEMY = 2;

displayClass::debug();

class displayClass {
    /**
     * Debug
     */
     public function debug() {
        $boardInfo = array(["hu2", "o2", "gin2"],
                           ["_", "_", "_"],
                           ["to2", "_", "_"],
                           ["_", "kin1", "_"],
                           ["kin1", "_", "_"]);

         self::display($boardInfo);
     }

    /**
     * コンソール画面への表示
     * @param array $boardInfo
     */
    private function display($boardInfo) {
        self::keepPieceDisplay($boardInfo[0]);
        self::boardPieceDisplay(array_slice($boardInfo, 1, 3));
        self::keepPieceDisplay($boardInfo[4]);
    }

    /**
     * 盤面の駒の表示
     * @param array $pieceAry
     */
    private function boardPieceDisplay($pieceAry) {
        $nums = array("Ａ", "Ｂ", "Ｃ");
        $count = 1;
        foreach ($nums as $num) {
            echo "  $num ";
        }
        echo " \n";
        self::lineDrow();
        foreach ($pieceAry as $ary) {
            foreach ($ary as $key) {
               self::pieceDisplay($key);
            }
            echo "| $count\n";
            $count++;
        self::lineDrow();
        }
        echo "\n";
    }

    /**
     * 持ち駒の表示
     * @param array $pieceAry
     */
    private function keepPieceDisplay($pieceAry) {
        self::lineDrow();
        foreach ($pieceAry as $piece) {
            self::pieceDisplay($piece);
        }
        echo "|\n";
        self::lineDrow();
    }

    /**
     * 駒の表示
     * @param string $pieceStr
     */
    private function pieceDisplay($pieceStr) {
        $pieceInfo = self::pieceInfoShaping($pieceStr);
        if ($pieceInfo['team'] == FRIEND) {
            echo '| ' . self::colorEcho(BLUE, self::convertPieceIdToJp($pieceInfo['type'])) . ' ';
        } else if($pieceInfo['team'] == ENEMY) {
            echo '| ' . self::colorEcho(RED, self::convertPieceIdToJp($pieceInfo['type'])) . ' ';
        } else {
            echo '| ' . self::colorEcho(WHITE_PANEL, self::convertPieceIdToJp($pieceInfo['type'])) . ' ';
        }
    }

    /**
     * 駒の情報を整形
     * @param string $pieceStr
     * @return array $pieceInfo
     */
    private function pieceInfoShaping($pieceStr) {
        $pieceInfo = array('type' => '_', 'team' => 0);
        if (preg_match('/\D*/', $pieceStr, $match)) {
            $pieceInfo['type'] = $match[0];
        }
        if (preg_match('/\d/', $pieceStr, $match)) {
            $pieceInfo['team'] = $match[0];
        }
        return $pieceInfo;
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
    private function convertPieceIdToJp($pieceId) {
        $aryPieceToJp = array(
            'hu' => '歩',
            'kyo' => '香',
            'kei' => '桂',
            'gin' => '銀',
            'kin' => '金',
            'kaku' => '角',
            'hi' => '飛',
            'to' => 'と',
            'uma' => '馬',
            'ryu' => '竜',
            'o' => '王',
            '_' => '　');

        return $aryPieceToJp[$pieceId];
    }
}