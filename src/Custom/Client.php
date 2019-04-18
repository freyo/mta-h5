<?php

namespace Freyo\MtaH5\Custom;

use Freyo\MtaH5\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 按天查询自定义事件的pv\uv\vv\iv
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E8%87%AA%E5%AE%9A%E4%B9%89%E4%BA%8B%E4%BB%B6
     *
     * @param string $startDate 开始时间(Y-m-d)
     * @param string $endDate 结束时间(Y-m-d)
     * @param array|string $custom 自定义事件ID
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     */
    public function query($startDate, $endDate, $custom)
    {
        $params = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'custom' => implode((array)$custom, ','),
            'idx' => 'pv,uv,vv,iv',
        ];

        return $this->httpGet('ctr_custom', $params);
    }
}