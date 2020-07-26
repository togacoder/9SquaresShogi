<?php

const RED = 31;
const BLUE = 34;
const WHITE_PANEL = 47;
const FRIEND = 1;
const ENEMY = 2;


/**
 * コンソール画面に表示するためのクラス
 */
class ConsoleDisplayClass {
    /**
     * @param array $boardInfo
     */
    public function display($boardInfo) {
        self::holdingPiecesDisplay($boardInfo[0]);
        self::onBoardDisplay(array_slice($boardInfo, 1, 3));
        self::holdingPiecesDisplay($boardInfo[4]);
    }

    /**
     * 盤上の駒の表示
     * @param array $pieceAry
     */
    private function onBoardDisplay($pieceAry) {
        $nums = array("Ｃ", "Ｂ", "Ａ");
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
    private function holdingPiecesDisplay($pieceAry) {
        self::lineDrow();
        foreach ($pieceAry as $piece) {
            self::pieceDisplay($piece);
        }
        echo "|\n";
        self::lineDrow();
    }

    /**
     * 駒を表示
     * @param string $pieceStr
     */
    private function pieceDisplay($pieceStr) {
        $pieceInfo = self::pieceInfoShaping($pieceStr);
        if ($pieceInfo['team'] == FRIEND) {
            echo '| ' . self::colorEcho(BLUE, self::convertPieceTypeToJapanese($pieceInfo['type'])) . ' ';
        } else if($pieceInfo['team'] == ENEMY) {
            echo '| ' . self::colorEcho(RED, self::convertPieceTypeToJapanese($pieceInfo['type'])) . ' ';
        } else {
            echo '| ' . self::colorEcho(WHITE_PANEL, self::convertPieceTypeToJapanese($pieceInfo['type'])) . ' ';
        }
    }

    /**
     * 駒の情報を種類と持ち主に分ける
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
     * 駒の種類を日本語に変換する。
     * @param string $pieceId
     * @return string
     */
    private function convertPieceTypeToJapanese($pieceId) {
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
            '-' => '　');

        return $aryPieceToJp[$pieceId];
    }
}