<?php

namespace App\Services;

use App\Entity\Deal;
use Symfony\Component\Workflow\Registry;

class DealWorkflow
{
    public const SIMPLE_DRAFTING = 'drafting';
    public const SIMPLE_ISSUED = 'issued';
    public const SIMPLE_REVIEW = 'review';
    public const SIMPLE_NEGOTIATION = 'negotiation';

    /** @var Registry */
    private $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    public function simplifyStatus(string $status, Deal $deal): string
    {
        $metadata = $this->getPlaceMetadata($deal, $status);

        return $metadata['simplified'];
    }

    private function getPlaceMetadata(Deal $subject, string $placeName): array
    {
        $workflow = $this->registry->get($subject);

        return $workflow->getMetadataStore()->getPlaceMetadata($placeName);
    }
}
