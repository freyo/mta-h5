<?php

namespace Freyo\MtaH5\Device;

use Freyo\MtaH5\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * 按天查询对应属性的终端信息数据
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E7%BB%88%E7%AB%AF%E5%B1%9E%E6%80%A7%E5%88%97%E8%A1%A8
     *
     * @param string $startDate 开始时间(Y-m-d)
     * @param string $endDate 结束时间(Y-m-d)
     * @param int $typeId 可选值详见附录（终端属性）
     * @param array|string $typeContents 可选值为终端属性列表返回的client值
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     */
    public function query($startDate, $endDate, $typeId, $typeContents = [])
    {
        $params = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'type_id' => $typeId,
            'idx' => 'pv,uv,vv,iv',
        ];

        if ($typeContents) {

            return $this->httpGet('ctr_client/get_by_content', array_merge($params, [
                'type_contents' => implode((array)$typeContents, ','),
            ]));

        }

        return $this->httpGet('ctr_client/get_by_para', $params);
    }

    /**
     * 按天查询运营商的pv\uv\vv\iv量
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E8%BF%90%E8%90%A5%E5%95%86
     *
     * @param string $startDate 开始时间(Y-m-d)
     * @param string $endDate 结束时间(Y-m-d)
     * @param array|string $typeIds 可选值详见附录(运营商)
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     */
    public function operator($startDate, $endDate, $typeIds)
    {
        $params = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'type_ids' => implode((array)$typeIds, ','),
            'idx' => 'pv,uv,vv,iv',
        ];

        return $this->httpGet('ctr_operator', $params);
    }

    /**
     * 按天查询地区的pv\uv\vv\iv量
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E5%9C%B0%E5%8C%BA%E6%95%B0%E6%8D%AE
     *
     * @param string $startDate 开始时间(Y-m-d)
     * @param string $endDate 结束时间(Y-m-d)
     * @param array|string $typeIds 可选值详见附录（省市字典，市字典）
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     */
    public function area($startDate, $endDate, $typeIds)
    {
        $params = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'type_ids' => implode((array)$typeIds, ','),
            'idx' => 'pv,uv,vv,iv',
        ];

        return $this->httpGet('ctr_area/get_by_area', $params);
    }

    /**
     * 按天查询省市下有流量的城市的pv\uv\vv\iv量
     *
     * @see https://mta.qq.com/docs/h5_api.html#%E7%9C%81%E5%B8%82%E6%95%B0%E6%8D%AE
     *
     * @param string $startDate 开始时间(Y-m-d)
     * @param string $endDate 结束时间(Y-m-d)
     * @param array|string $typeIds 可选值详见附录（省字典，市字典）
     *
     * @return array|\Freyo\MtaH5\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Freyo\MtaH5\Kernel\Exceptions\InvalidConfigException
     */
    public function province($startDate, $endDate, $typeIds)
    {
        $params = [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'type_ids' => implode((array)$typeIds, ','),
            'idx' => 'pv,uv,vv,iv',
        ];

        return $this->httpGet('ctr_area/get_by_province', $params);
    }
}