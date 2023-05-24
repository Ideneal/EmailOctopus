<?php
declare(strict_types=1);

namespace Ideneal\EmailOctopus\Tests\Serializer;

use Ideneal\EmailOctopus\Entity\Automation;
use Ideneal\EmailOctopus\Serializer\AutomationSerializer;

final class AutomationSerializerTest extends ApiSerializerTestCase
{
    public function testSerialize(): void
    {
        $automation = new Automation();
        $automation->setListMemberId('123456');

        $result = AutomationSerializer::serialize($automation);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('list_member_id', $result);
        $this->assertSame('123456', $result['list_member_id']);
    }

    public function testSerializeWithInvalidObject(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid object type. Expected Automation.');

        $object = new \stdClass();

        AutomationSerializer::serialize($object);
    }

    public function testDeserializeSingle(): void
    {
        $json = [
            'list_member_id' => '123456',
        ];

        // Since the method does not return anything, we can only assert that it does not throw an exception
        $this->assertNull(AutomationSerializer::deserializeSingle($json));
    }
}