<?php
/*
 * This file is part of the ideneal/emailoctopus library
 *
 * (c) Daniele Pedone <ideneal.ztl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ideneal\EmailOctopus;


use Ideneal\EmailOctopus\Entity\MailingList;
use Ideneal\EmailOctopus\Http\ApiClient;
use Ideneal\EmailOctopus\Serializer\MailingListDeserializer;

class EmailOctopus
{
    /**
     * @var ApiClient
     */
    private $client;

    /**
     * EmailOctopus constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->client = new ApiClient($apiKey);
    }

    /**
     * Returns all mailing lists.
     *
     * @param int $limit
     * @param int $page
     *
     * @return MailingList[]
     */
    public function getMailingLists(int $limit = 100, int $page = 1): array
    {
        $response = $this->client->get('lists', [
            'limit' => $limit,
            'page'  => $page,
        ]);
        return MailingListDeserializer::deserialize($response);
    }

    /**
     * Returns the mailing list.
     *
     * @param string $id
     *
     * @return MailingList
     */
    public function getMailingList(string $id): MailingList
    {
        $response = $this->client->get('lists/' . $id);
        return MailingListDeserializer::deserialize($response);
    }

    /**
     * Creates a mailing list.
     *
     * @param string $name
     *
     * @return MailingList
     */
    public function createMailingList(string $name): MailingList
    {
        $response = $this->client->post('lists', [], [
            'name' => $name,
        ]);
        return MailingListDeserializer::deserialize($response);
    }

    /**
     * Updates a mailing list.
     *
     * @param MailingList $list
     *
     * @return MailingList
     */
    public function updateMailingList(MailingList $list): MailingList
    {
        $response = $this->client->put('lists/' . $list->getId(), [], [
            'name' => $list->getName(),
        ]);
        return MailingListDeserializer::deserialize($response);
    }

    /**
     * Deletes a mailing list.
     *
     * @param string $id
     */
    public function deleteMailingList(string $id): void
    {
        $this->client->delete('lists/' . $id);
    }
}