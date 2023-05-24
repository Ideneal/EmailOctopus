<?php
declare(strict_types=1);

namespace Ideneal\EmailOctopus\Serializer;

use Ideneal\EmailOctopus\Entity\Automation;

final class AutomationSerializer extends ApiSerializer
{
    /**
     * @param Automation $object
     *
     * @return array<string, string>
     */
    public static function serialize($object): array
    {
        if (!$object instanceof Automation) {
            throw new \InvalidArgumentException('Invalid object type. Expected Automation.');
        }

        return [
            'list_member_id' => $object->getListMemberId(),
        ];
    }

    /**
     * @param array<string, mixed> $json
     */
    public static function deserializeSingle(array $json): void
    {
    }
}