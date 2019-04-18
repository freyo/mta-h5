<?php

namespace Freyo\MtaH5\Trend;

use Freyo\MtaH5\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 应用每天的pv\uv\vv\iv数据
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E5%BA%94%E7%94%A8%E5%8E%86%E5%8F%B2%E8%B6%8B%E5%8A%BF
     *
     * @param string $startDate 开始时间(Y-m-d)
     * @param string $endDate 结束时间(Y-m-d)
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     */
    public function query($startDate, $endDate)
    {
        $params = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'idx' => 'pv,uv,vv,iv',
        ];

        return $this->httpGet('ctr_core_data', $params);
    }

    /**
     * 应用当天每小时的pv\uv\vv\iv数据
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E5%BA%94%E7%94%A8%E5%AE%9E%E6%97%B6%E5%B0%8F%E6%97%B6%E6%95%B0%E6%8D%AE
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     */
    public function realtime()
    {
        $params = [
            'idx' => 'pv,uv,vv,iv',
        ];

        return $this->httpGet('ctr_realtime/get_by_hour', $params);
    }

    /**
     * 应用当前pv\uv\vv\iv心跳数据数据
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E5%BA%94%E7%94%A8%E5%BF%83%E8%B7%B3%E6%95%B0%E6%8D%AE
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     */
    public function heartbeat()
    {
        return $this->httpGet('ctr_realtime/heartbeat');
    }
}