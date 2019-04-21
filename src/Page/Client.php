<?php

namespace Freyo\MtaH5\Page;

use Freyo\MtaH5\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 查询当天所有url的pv\uv\vv\iv数据.
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E9%A1%B5%E9%9D%A2%E6%8E%92%E8%A1%8C-%E5%BD%93%E5%A4%A9%E5%AE%9E%E6%97%B6%E5%88%97%E8%A1%A8
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function realtime()
    {
        $params = [
            'idx' => 'pv,uv,vv,iv',
        ];

        return $this->httpGet('ctr_page/list_all_page_realtime', $params);
    }

    /**
     * 按天查询所有url的pv\uv\vv\iv数据.
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E9%A1%B5%E9%9D%A2%E6%8E%92%E8%A1%8C-%E7%A6%BB%E7%BA%BF%E5%88%97%E8%A1%A8
     *
     * @param string $startDate 开始时间(Y-m-d)
     * @param string $endDate   结束时间(Y-m-d)
     * @param int    $page      每页2000条
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function offline($startDate, $endDate, $page = 1)
    {
        $params = [
            'start_date' => $startDate,
            'end_date'   => $endDate,
            'page'       => $page,
            'idx'        => 'pv,uv,vv,iv',
        ];

        return $this->httpGet('ctr_page/list_all_page_offline', $params);
    }

    /**
     * 按天查询url的pv\uv\vv\iv数据.
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E9%A1%B5%E9%9D%A2%E6%8E%92%E8%A1%8C-%E6%8C%87%E5%AE%9A%E6%9F%A5%E8%AF%A2%E9%83%A8%E5%88%86url
     *
     * @param string       $startDate 开始时间(Y-m-d)
     * @param string       $endDate   结束时间(Y-m-d)
     * @param array|string $urls      url地址
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function query($startDate, $endDate, $urls)
    {
        $params = [
            'start_date' => $startDate,
            'end_date'   => $endDate,
            'urls'       => implode((array) $urls, ','),
            'idx'        => 'pv,uv,vv,iv',
        ];

        return $this->httpGet('ctr_page', $params);
    }

    /**
     * 按天查询用户访问深度.
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E8%AE%BF%E9%97%AE%E6%B7%B1%E5%BA%A6
     *
     * @param string $startDate 开始时间(Y-m-d)
     * @param string $endDate   结束时间(Y-m-d)
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function depth($startDate, $endDate)
    {
        $params = [
            'start_date' => $startDate,
            'end_date'   => $endDate,
        ];

        return $this->httpGet('ctr_depth', $params);
    }

    /**
     * 按天查询对应省市的访问延时与解析时长
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E6%80%A7%E8%83%BD%E7%9B%91%E6%8E%A7
     *
     * @param string       $startDate    开始时间(Y-m-d)
     * @param string       $endDate      结束时间(Y-m-d)
     * @param array|string $typeContents 省市可选值详见附录（省市）; 运营商可选值详见附录（运营商）
     * @param string       $type         可选值详见附录（性能监控）
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function speed($startDate, $endDate, $typeContents, $type)
    {
        $params = [
            'start_date'    => $startDate,
            'end_date'      => $endDate,
            'type_contents' => implode((array) $typeContents, ','),
            'type'          => $type,
            'idx'           => 'visitor_speed,dns_speed,tcp_speed,request_speed,resource_speed,dom_speed',
        ];

        return $this->httpGet('ctr_page_speed', $params);
    }
}
