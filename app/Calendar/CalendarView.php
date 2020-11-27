<?php
namespace App\Calendar;   // クラスを使うための制限を設けている：https://qiita.com/7968/items/1e5c61128fa495358c1f

use Carbon\Carbon;        // ライブラリ導入 ライブラリの詳細：https://carbon.nesbot.com/docs/

class CalendarView {

	private $carbon;

	function __construct($date){
		// 週初めを変更する：https://qiita.com/fabled/items/b762407d02a9b805176a
		Carbon::setWeekStartsAt(Carbon::SUNDAY); // 週の最初を日曜日に設定
		Carbon::setWeekEndsAt(Carbon::SATURDAY); // 週の最後を土曜日に設定
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

		$html[] = '<tbody>';
		$weeks = $this->getWeeks();
		foreach($weeks as $week){
			$html[] = '<tr class="'.$week->getClassName().'">';
			$days = $week->getDays();
			foreach($days as $day){
				$html[] = '<td class="'.$day->getClassName().'">';
				$html[] = $day->render();
				$html[] = '</td>';
			}
			$html[] = '</tr>';
		}
		$html[] = '</tbody>';

		$html[] = '</table>';
		$html[] = '</div>';
		return implode("", $html);
	}
	// private, protected, publicの違い： https://uxmilk.jp/26435
	// 月を一週間ごとに分割
	protected function getWeeks(){
		$weeks = [];

		//初日
		$firstDay = $this->carbon->copy()->firstOfMonth();			// copy() で、クラスに存在する carbon インスタンスを直接操作してデータを破壊しないようにする

		//月末まで
		$lastDay = $this->carbon->copy()->lastOfMonth();

		//1週目
		$week = new CalendarWeek($firstDay->copy());						// 一週間を取得するインスタンスの生成（詳細は引用記事参照）
		$weeks[] = $week;

		//作業用の日
		$tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

		//月末までループさせる
		while($tmpDay->lte($lastDay)){
			//週カレンダーViewを作成する
			$week = new CalendarWeek($tmpDay, count($weeks));
			$weeks[] = $week;
			
            //次の週=+7日する
			$tmpDay->addDay(7);
		}

		return $weeks;
	}
}
// カレンダー作成、引用記事：https://note.com/laravelstudy/n/nea15c1191987