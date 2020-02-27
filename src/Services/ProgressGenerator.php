<?php

namespace App\Services;

use App\Entity\Deal;
use App\Model\Progress;

class ProgressGenerator
{
    /** @var DealWorkflow */
    private $workflow;

    public function __construct(DealWorkflow $workflow)
    {
        $this->workflow = $workflow;
    }

    public function generateProgress(Deal $deal): Progress
    {
        $currentStatus = $this->workflow->simplifyStatus($deal->getStatus(), $deal);

        return new Progress(
            $this->getPreviousStatuses($currentStatus),
            $currentStatus,
            $this->getNextStatuses($currentStatus)
        );
    }

    private function getPreviousStatuses(string $status): array
    {
        if (DealWorkflow::SIMPLE_DRAFTING === $status) {
            return [];
        }

        if (DealWorkflow::SIMPLE_ISSUED === $status) {
            return [DealWorkflow::SIMPLE_DRAFTING];
        }

        if (DealWorkflow::SIMPLE_REVIEW === $status) {
            return [
                DealWorkflow::SIMPLE_DRAFTING,
                DealWorkflow::SIMPLE_ISSUED,
            ];
        }

        return [
            DealWorkflow::SIMPLE_DRAFTING,
            DealWorkflow::SIMPLE_ISSUED,
            DealWorkflow::SIMPLE_REVIEW,
        ];
    }

    private function getNextStatuses(string $status): array
    {
        if (DealWorkflow::SIMPLE_DRAFTING === $status) {
            return [
                DealWorkflow::SIMPLE_ISSUED,
                DealWorkflow::SIMPLE_REVIEW,
                DealWorkflow::SIMPLE_NEGOTIATION,
            ];
        }

        if (DealWorkflow::SIMPLE_ISSUED === $status) {
            return [
                DealWorkflow::SIMPLE_REVIEW,
                DealWorkflow::SIMPLE_NEGOTIATION,
            ];
        }

        if (DealWorkflow::SIMPLE_REVIEW === $status) {
            return [DealWorkflow::SIMPLE_NEGOTIATION];
        }

        return [];
    }
}
