<?php
class MovePieceClass {
    /**
     * 標準入力から文字列を取得
     */
    public function get() {
        $str = fgets(STDIN);
        self::getPosition($str);
    }

    /**
     * 文字列から盤面の位置を取得
     * @param string $str
     */
    private function getPosition($str) {
        $aryPos = explode(" ", $str);
        return array($nowPos, $nextPos);
    }
}