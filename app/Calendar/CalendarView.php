<?php
namespace App\Calendar;   // クラスを使うための制限を設けている：https://qiita.com/7968/items/1e5c61128fa495358c1f

use Carbon\Carbon;        // ライブラリ導入 ライブラリの詳細：https://carbon.nesbot.com/docs/

class CalendarView {

	private $carbon;

	function __construct($date){
		$this->carbon = new Carbon($date);
	}
	/**
	 * タイトル
	 */
	public function getTitle(){
		return $this->carbon->format('Y年n月'); 
	}

	/**
	 * カレンダーを出力する
	 */
	function render(){
		$html = [];
		$html[] = '<div class="calendar">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th class="red">日</th>';
		$html[] = '<th>月</th>';
		$html[] = '<th>火</th>';
		$html[] = '<th>水</th>';
		$html[] = '<th>木</th>';
		$html[] = '<th>金</th>';
		$html[] = '<th class="blue">土</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';
		$html[] = '</table>';
		$html[] = '</div>';
		return implode("", $html);
	}
}
// カレンダー作成、引用記事：https://note.com/laravelstudy/n/nea15c1191987