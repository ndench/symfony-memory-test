<?php

namespace App\Tests;

use App\Model\Progress;
use App\Services\DealWorkflow;
use App\Services\ProgressGenerator;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class ProgressGeneratorTest extends WebTestCase
{
    use FixturesTrait;

    protected function setUp(): void
    {
        static::bootKernel();
    }

    public function testDrafting(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/draft_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [],
            DealWorkflow::SIMPLE_DRAFTING,
            [
                DealWorkflow::SIMPLE_ISSUED,
                DealWorkflow::SIMPLE_REVIEW,
                DealWorkflow::SIMPLE_NEGOTIATION,
            ],
            $progress
        );
    }

    public function testIssued(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/issued_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [DealWorkflow::SIMPLE_DRAFTING],
            DealWorkflow::SIMPLE_ISSUED,
            [
                DealWorkflow::SIMPLE_REVIEW,
                DealWorkflow::SIMPLE_NEGOTIATION,
            ],
            $progress
        );
    }

    public function testReview(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/review_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [
                DealWorkflow::SIMPLE_DRAFTING,
                DealWorkflow::SIMPLE_ISSUED,
            ],
            DealWorkflow::SIMPLE_REVIEW,
            [
                DealWorkflow::SIMPLE_NEGOTIATION,
            ],
            $progress
        );
    }

    public function testConcierge(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/concierge_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [
                DealWorkflow::SIMPLE_DRAFTING,
                DealWorkflow::SIMPLE_ISSUED,
            ],
            DealWorkflow::SIMPLE_REVIEW,
            [
                DealWorkflow::SIMPLE_NEGOTIATION,
            ],
            $progress
        );
    }

    public function testNegoSender(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/negoSender_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [
                DealWorkflow::SIMPLE_DRAFTING,
                DealWorkflow::SIMPLE_ISSUED,
                DealWorkflow::SIMPLE_REVIEW,
            ],
            DealWorkflow::SIMPLE_NEGOTIATION,
            [],
            $progress
        );
    }

    public function testNegoReceiver(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/negoReceiver_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [
                DealWorkflow::SIMPLE_DRAFTING,
                DealWorkflow::SIMPLE_ISSUED,
                DealWorkflow::SIMPLE_REVIEW,
            ],
            DealWorkflow::SIMPLE_NEGOTIATION,
            [],
            $progress
        );
    }

    public function testDrafting2(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/draft_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [],
            DealWorkflow::SIMPLE_DRAFTING,
            [
                DealWorkflow::SIMPLE_ISSUED,
                DealWorkflow::SIMPLE_REVIEW,
                DealWorkflow::SIMPLE_NEGOTIATION,
            ],
            $progress
        );
    }

    public function testIssued2(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/issued_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [DealWorkflow::SIMPLE_DRAFTING],
            DealWorkflow::SIMPLE_ISSUED,
            [
                DealWorkflow::SIMPLE_REVIEW,
                DealWorkflow::SIMPLE_NEGOTIATION,
            ],
            $progress
        );
    }

    public function testReview2(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/review_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [
                DealWorkflow::SIMPLE_DRAFTING,
                DealWorkflow::SIMPLE_ISSUED,
            ],
            DealWorkflow::SIMPLE_REVIEW,
            [
                DealWorkflow::SIMPLE_NEGOTIATION,
            ],
            $progress
        );
    }

    public function testConcierge2(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/concierge_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [
                DealWorkflow::SIMPLE_DRAFTING,
                DealWorkflow::SIMPLE_ISSUED,
            ],
            DealWorkflow::SIMPLE_REVIEW,
            [
                DealWorkflow::SIMPLE_NEGOTIATION,
            ],
            $progress
        );
    }

    public function testNegoSender2(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/negoSender_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [
                DealWorkflow::SIMPLE_DRAFTING,
                DealWorkflow::SIMPLE_ISSUED,
                DealWorkflow::SIMPLE_REVIEW,
            ],
            DealWorkflow::SIMPLE_NEGOTIATION,
            [],
            $progress
        );
    }

    public function testNegoReceiver2(): void
    {
        $generator = static::$container->get(ProgressGenerator::class);

        $deal = $this->loadFixtureFiles(
            [
                __DIR__.'/fixtures/negoReceiver_deal.yml',
            ]
        )['deal'];

        $progress = $generator->generateProgress($deal);

        $this->assertProgressData(
            [
                DealWorkflow::SIMPLE_DRAFTING,
                DealWorkflow::SIMPLE_ISSUED,
                DealWorkflow::SIMPLE_REVIEW,
            ],
            DealWorkflow::SIMPLE_NEGOTIATION,
            [],
            $progress
        );
    }

    private function assertProgressData(
        array $previous,
        string $current,
        array $next,
        Progress $progress
    ): void {
        static::assertSame($previous, $progress->getPrevious());
        static::assertSame($current, $progress->getCurrent());
        static::assertSame($next, $progress->getNext());
    }
}
