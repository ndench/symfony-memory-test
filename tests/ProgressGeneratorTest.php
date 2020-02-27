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

    public function testDrafting(): void
    {
        static::bootKernel();
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
