<?php

require("initBoard.php");
require("consoleDisplay.php");
require("movePiece.php");

$main = new MainClass;
$main->main();

class MainClass {
    public function main() {
        $display = new ConsoleDisplayClass;
        $movePiece = new MovePieceClass;
        // 初期盤面を表示
        $aryBoard = initBoardClass::initBoard();
        $display->display($aryBoard);
        // 駒を動かす
        $aryPos = $movePiece->get();
        $movePiece->move($aryPos[0], $aryPos[1]);
    }
}