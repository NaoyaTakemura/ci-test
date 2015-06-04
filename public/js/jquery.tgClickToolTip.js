/* 
 * jquery.tgClickToolTip
 * for jQuery 1.8.1
 * 
 * 【概要】
 * <a>タグで設定されているリンククリックで、
 * 同名IDで設定されている<p>タグ内容をツールチップとして表示します。
 * 
 * 【リンク設定例】[?]部分です。
 * <a href="#note1" class="clickToolTip">?</a>
 * 
 * 【ツールチップ内容設定例】「invisible」classは最初から設定しておいてください。
 * <p id="note1" class="toolTip invisible">ツールチップ内容<br />ツールチップ内容</p>
 * 
 * 
 * @Copyright : 2012 toogie | http://wataame.sumomo.ne.jp/archives/1719
 * @Version   : 1.1
 * @Modified  : 2012-09-19
 * 
 */

(function($){

	$.fn.tgClickToolTip = function(options){

		var opts = $.extend({}, $.fn.tgClickToolTip.defaults, options);

		$(opts.selector).click(function(){

			// リンクの #note** を取得
			var targetNote = $(this).attr('class');

			// [?]の座標を取得
			var position = $(this).position();
			var intPositionTop = parseInt(opts.PositionTop);							/* 数値型に変換 */
			var intPositionLeft = parseInt(opts.PositionLeft);
			var newPositionTop  = position.top + intPositionTop;					/* + 数値で下方向へ移動 */
			var newPositionLeft = position.left + intPositionLeft;				/* + 数値で右方向へ移動 */

			// ツールチップの位置を調整
			$('p#'+targetNote).css({'top': newPositionTop + 'px', 'left': newPositionLeft + 'px'});

			// ツールチップの class="invisible" を削除
			$('p#'+targetNote).removeClass('invisible');
		});

		// 表示されたツールチップを隠す処理（マウスクリックで全て隠す）
		$('html').mousedown(function(){
			$('p.toolTip').addClass('invisible');
		});
	}

	// default option
	$.fn.tgClickToolTip.defaults = {
		selector : 'a.clickToolTip',
		PositionTop : '-10',
		PositionLeft : '40',
	};

})(jQuery);
