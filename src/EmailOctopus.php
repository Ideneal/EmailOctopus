<?php
declare(strict_types=1);

/*
 * This file is part of the ideneal/emailoctopus library
 *
 * (c) Daniele Pedone <ideneal.ztl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ideneal\EmailOctopus;

use Ideneal\EmailOctopus\Entity\Automation;
use Ideneal\EmailOctopus\Entity\Campaign;
use Ideneal\EmailOctopus\Entity\Contact;
use Ideneal\EmailOctopus\Entity\MailingList;
use Ideneal\EmailOctopus\Entity\MailingListField;
use Ideneal\EmailOctopus\Http\ApiClient;
use Ideneal\EmailOctopus\Serializer\CampaignSerializer;
use Ideneal\EmailOctopus\Serializer\ContactSerializer;
use Ideneal\EmailOctopus\Serializer\MailingListFieldSerializer;
use Ideneal\EmailOctopus\Serializer\MailingListSerializer;

/**
 * Class EmailOctopus
 *
 * @package Ideneal\EmailOctopus
 */
class EmailOctopus
{
    private ApiClient $client;

    /**
     * EmailOctopus constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->client = new ApiClient($apiKey);
    }

    public function startAutomation(Automation $automation): void
    {
        $this->client->post("automations/{$automation->getId()}/queue");
    }

    /**
     * Returns all mailing lists.
     *
     * @return MailingList[]
     */
    public function getMailingLists(int $limit = 100, int $page = 1): array
    {
        $response = $this->client->get('lists', \compact('limit', 'page'));
        return MailingListSerializer::deserialize($response);
    }

    /**
     * Returns the mailing list.
     */
    public function getMailingList(string $listId): MailingList
    {
        $response = $this->client->get("lists/{$listId}");
        return MailingListSerializer::deserialize($response);
    }

    /**
     * Creates a mailing list.
     */
    public function createMailingList(MailingList $list): MailingList
    {
        $response = $this->client->post('lists', MailingListSerializer::serialize($list));
        return MailingListSerializer::deserialize($response);
    }

    /**
     * Updates a mailing list.
     */
    public function updateMailingList(MailingList $list): MailingList
    {
        $response = $this->client->put("lists/{$list->getId()}", MailingListSerializer::serialize($list));
        return MailingListSerializer::deserialize($response);
    }

    /**
     * Deletes a mailing list.
     */
    public function deleteMailingList(MailingList $list): void
    {
        $this->client->delete("lists/{$list->getId()}");
    }

    /**
     * Creates a mailing list field.
     */
    public function createMailingListField(MailingListField $field, MailingList $list): MailingListField
    {
        $response = $this->client->post("lists/{$list->getId()}/fields", MailingListFieldSerializer::serialize($field));
        return MailingListFieldSerializer::deserialize($response);
    }

    /**
     * Updates a mailing list field.
     */
    public function updateMailingListField(MailingListField $field, MailingList $list): MailingListField
    {
        $response = $this->client->post("lists/{$list->getId()}/fields/{$field->getTag()}", MailingListFieldSerializer::serialize($field));
        return MailingListFieldSerializer::deserialize($response);
    }

    /**
     * Deletes a mailing list field.
     */
    public function deleteMailingListField(MailingListField $field, MailingList $list): void
    {
        $this->client->delete("lists/{$list->getId()}/fields/{$field->getTag()}");
    }

    /**
     * Returns all contact of a mailing list.
     *
     * @return Contact[]
     */
    public function getContactsByMailingList(MailingList $list, int $limit = 100, int $page = 1): array
    {
        $response = $this->client->get("lists/{$list->getId()}/contacts", compact('limit', 'page'));
        return ContactSerializer::deserialize($response);
    }

    /**
     * Returns SUBSCRIBED contact of a mailing list.
     *
     * @return Contact[]
     */
    public function getSubscribedContactsByMailingList(MailingList $list, int $limit = 100, int $page = 1): array
    {
        $response = $this->client->get("lists/{$list->getId()}/contacts/subscribed", compact('limit', 'page'));
        return ContactSerializer::deserialize($response);
    }

    /**
     * Returns UNSUBSCRIBED contact of a mailing list.
     *
     * @return Contact[]
     */
    public function getUnsubscribedContactsByMailingList(MailingList $list, int $limit = 100, int $page = 1): array
    {
        $response = $this->client->get("lists/{$list->getId()}/contacts/unsubscribed", compact('limit', 'page'));
        return ContactSerializer::deserialize($response);
    }

    /**
     * Returns a contact of a mailing list.
     */
    public function getContactByMailingList(string $contactId, MailingList $list): Contact
    {
        $response = $this->client->get("lists/{$list->getId()}/contacts/{$contactId}");
        return ContactSerializer::deserialize($response);
    }

    /**
     * Creates a contact of a mailing list.
     */
    public function createContact(Contact $contact, MailingList $list): Contact
    {
        $response = $this->client->post("lists/{$list->getId()}/contacts", ContactSerializer::serialize($contact));
        return ContactSerializer::deserialize($response);
    }

    /**
     * Updates a contact of a mailing list.
     */
    public function updateContact(Contact $contact, MailingList $list): Contact
    {
        $response = $this->client->put("lists/{$list->getId()}/contacts/{$contact->getId()}", ContactSerializer::serialize($contact));
        return ContactSerializer::deserialize($response);
    }

    /**
     * Deletes a contact of a mailing list.
     */
    public function deleteContact(Contact $contact, MailingList $list): void
    {
        $this->client->delete("lists/{$list->getId()}/contacts/{$contact->getId()}");
    }

    /**
     * Returns all campaigns.
     *
     * @return Campaign[]
     */
    public function getCampaigns(int $limit = 100, int $page = 1): array
    {
        $response = $this->client->get('campaigns', compact('limit', 'page'));
        return CampaignSerializer::deserialize($response);
    }

    /**
     * Returns a campaign.
     */
    public function getCampaign(string $campaignId): Campaign
    {
        $response = $this->client->get("campaigns/{$campaignId}");
        return CampaignSerializer::deserialize($response);
    }
}
