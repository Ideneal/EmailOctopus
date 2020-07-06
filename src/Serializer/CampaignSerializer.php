<?php
/*
 * This file is part of the ideneal/emailoctopus library
 *
 * (c) Daniele Pedone <ideneal.ztl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ideneal\EmailOctopus\Serializer;


use Ideneal\EmailOctopus\Entity\Campaign;

/**
 * Class CampaignSerializer
 *
 * @package Ideneal\EmailOctopus\Serializer
 */
class CampaignSerializer extends ApiSerializer
{
    /**
     * @param Campaign $object
     *
     * @return array
     */
    public static function serialize($object): array
    {
        return [
            'name'   => $object->getName(),
            'status' => $object->getStatus(),
        ];
    }

    /**
     * @param array $json
     *
     * @return Campaign
     * @throws \Exception
     */
    public static function deserializeSingle(array $json)
    {
        $campaign = new Campaign();
        $campaign
            ->setId($json['id'])
            ->setStatus($json['status'])
            ->setName($json['name'])
            ->setSubject($json['subject'])
            ->setTo($json['to'])
            ->setFrom($json['from'])
            ->setContent($json['content'])
            ->setCreatedAt(new \DateTime($json['created_at']))
            ->setSentAt(new \DateTime($json['sent_at']))
        ;

        return $campaign;
    }
}