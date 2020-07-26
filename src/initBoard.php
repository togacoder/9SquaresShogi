<?php
/**
 * 盤面の初期配置
 */
class InitBoardClass {
    /**
     * 初期配置
     * @return array $aryBaord
     */
    public static function initBoard() {
        $aryBoard = array(
            "0" => array(
                ["-", "-", "-"],
                ["hu2", "gin2", "o2"],
                ["-", "-", "-"],
                ["o1", "gin1", "hu1"],
                ["-", "-", "-"],
            ),
        );

        return $aryBoard[0];
    }
}