<?php

namespace Freyo\MtaH5\AdTag;

use Freyo\MtaH5\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 按天查询渠道的分析数据
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E6%B8%A0%E9%81%93%E6%95%88%E6%9E%9C%E5%88%86%E6%9E%90
     *
     * @param string $startDate 开始时间(Y-m-d)
     * @param string $endDate 结束时间(Y-m-d)
     * @param array|string $adTags
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     */
    public function query($startDate, $endDate, $adTags)
    {
        $params = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'adtags' => implode((array)$adTags, ','),
            'idx' => 'pv,uv,vv,iv',
        ];

        return $this->httpGet('ctr_adtag', $params);
    }
}