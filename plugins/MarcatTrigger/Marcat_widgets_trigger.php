<?php

/*
Plugin Name: MarcatTrigger
Plugin URI: 
Description: Marcat_widgetsが提供するwidgetのアイテムを更に便利にするアイテムを集めたプラグインです。新着情報から、画像のタイトル用のものまで作成が可能になります。
Version: 1.0.0
Author: MarcatCube
Author URI: https://www.marcatcube.com
License: MarcatCube
*/

	
date_default_timezone_set('Asia/Tokyo');

/*■タイトル作成用■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■*/
//■画像+文章+画像+文章のコンテンツ作成用アイテム
require_once(dirname(__FILE__) . '/library/wiget_data/title_widgets/wiget_data_title_maker_01.php');
//■タイトル（本タイトル+サブタイトルで使用する）
require_once(dirname(__FILE__) . '/library/wiget_data/title_widgets/wiget_data_title_maker_02.php');
//■画像+タイトル+サブタイトル+文章+一覧へのリンク作成用アイテム
require_once(dirname(__FILE__) . '/library/wiget_data/title_widgets/wiget_data_title_maker_03.php');
//■ウェブチ用【コンテンツ001（画像のみ）】
require_once(dirname(__FILE__) . '/library/wiget_data/title_widgets/wiget_data_title_maker_04.php');
//■ウェブチ用【タイトル一文のみ】
require_once(dirname(__FILE__) . '/library/wiget_data/title_widgets/wiget_data_title_maker_05.php');
//■ウェブチ用【タイトルとナビのみ】
require_once(dirname(__FILE__) . '/library/wiget_data/title_widgets/wiget_data_title_maker_06.php');

/*■新着情報作成用■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■*/
//■新着情報【サムネイル・サムネイル内NEWアイコン・日付（年月日曜日）・投稿ユーザー名・本文】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_01.php');
//■新着情報【日付・本文のみ】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_01_01.php');

//■新着情報【Newアイコン・日付（年月日）・カテゴリー・タイトル】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_02.php');
//■新着情報【Newアイコン・日付（年月日）・タイトル】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_03.php');
//■新着情報【Newアイコン・日付（年月日）・タイトル・抜粋（文字数制限有り）】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_04.php');
//■新着情報【本日だけのものを抽出】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_05.php');


//■ウェブチ用【コンテンツ003～005】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_06.php');
//■ウェブチ用【コンテンツ006】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_07.php');

//■ウェブチ用【コンテンツ007～010】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_08.php');
//■ウェブチ用【コンテンツ011】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_12.php');

//■ウェブチ用【コンテンツ012】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_09.php');
//■ウェブチ用【コンテンツ013】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_10.php');
//■ウェブチ用【コンテンツ014】
require_once(dirname(__FILE__) . '/library/wiget_data/topix_widgets/wiget_data_topix_maker_11.php');

/*■slider作成用■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■*/
//■boxスライダーを使用したスライダーコンテンツ
require_once(dirname(__FILE__) . '/library/wiget_data/slaider/wiget_data_slaider_01.php');
//■ウェブチ用【コンテンツ001（スライダー）】
require_once(dirname(__FILE__) . '/library/wiget_data/slaider/wiget_data_slaider_02.php');