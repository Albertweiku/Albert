<?php
// +----------------------------------------------------------------------
// | ShopXO 国内领先企业级B2C免费开源电商系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2099 http://shopxo.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( https://opensource.org/licenses/mit-license.php )
// +----------------------------------------------------------------------
// | Author: Devil
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\service\StatisticalService;

/**
 * 首页
 * @author   Devil
 * @blog     http://gong.gg/
 * @version  0.0.1
 * @datetime 2016-12-01T21:51:08+0800
 */
class Index extends Common
{
	/**
	 * 构造方法
	 * @author   Devil
	 * @blog     http://gong.gg/
	 * @version  0.0.1
	 * @datetime 2016-12-03T12:39:08+0800
	 */
	public function __construct()
	{
		// 调用父类前置方法
		parent::__construct();

		// 登录校验
		$this->IsLogin();
	}

	/**
	 * [Index 首页]
	 * @author   Devil
	 * @blog     http://gong.gg/
	 * @version  0.0.1
	 * @datetime 2017-01-05T21:36:13+0800
	 */
	public function Index()
	{
		// 默认进入页面初始化
		$to_url = MyUrl('admin/index/init');

		// 是否指定页面地址
		if(!empty($this->data_request['to_url']))
		{
			$to_url = base64_decode(urldecode($this->data_request['to_url']));
		}

		$this->assign('to_url', $to_url);
		return $this->fetch();
	}

	/**
	 * [Init 初始化页面]
	 * @author   Devil
	 * @blog     http://gong.gg/
	 * @version  0.0.1
	 * @datetime 2017-01-05T21:36:41+0800
	 */
	public function Init()
	{
		// 系统信息
		$mysql_ver = db()->query('SELECT VERSION() AS `ver`');
		$data = array(
				'server_ver'	=>	php_sapi_name(),
				'php_ver'		=>	PHP_VERSION,
				'mysql_ver'		=>	isset($mysql_ver[0]['ver']) ? $mysql_ver[0]['ver'] : '',
				'os_ver'		=>	PHP_OS,
				'host'			=>	isset($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : '',
				'ver'			=>	'ShopXO'.' '.APPLICATION_VERSION,
			);
		$this->assign('data', $data);

		// 用户
		$user = StatisticalService::UserYesterdayTodayTotal();
		$this->assign('user', $user['data']);

		// 订单总数
		$order_number = StatisticalService::OrderNumberYesterdayTodayTotal();
		$this->assign('order_number', $order_number['data']);

		// 订单成交总量
		$order_complete_number = StatisticalService::OrderCompleteYesterdayTodayTotal();
		$this->assign('order_complete_number', $order_complete_number['data']);

		// 订单收入总计
		$order_complete_money = StatisticalService::OrderCompleteMoneyYesterdayTodayTotal();
		$this->assign('order_complete_money', $order_complete_money['data']);

		// 近30日订单成交金额走势
		$order_profit_chart = StatisticalService::OrderProfitSevenTodayTotal();
		$this->assign('order_profit_chart', $order_profit_chart['data']);

		// 近30日订单交易走势
		$order_trading_trend = StatisticalService::OrderTradingTrendSevenTodayTotal();
		$this->assign('order_trading_trend', $order_trading_trend['data']);
		
		// 近30日支付方式
		$pay_type_number = StatisticalService::PayTypeSevenTodayTotal();
		$this->assign('pay_type_number', $pay_type_number['data']);

		// 近30日热销商品
		$goods_hot_sale = StatisticalService::GoodsHotSaleSevenTodayTotal();
		$this->assign('goods_hot_sale', $goods_hot_sale['data']);

		return $this->fetch();
	}
}
?>