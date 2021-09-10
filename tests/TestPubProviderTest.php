<?php

namespace App\Tests;

use App\PubsProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TestPubProviderTest extends KernelTestCase
{
    private PubsProvider $provider;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $this->provider = $container->get(PubsProvider::class);
    }

    public function testGetPubs(): void
    {
        $this->assertTrue(is_array($this->provider->getPubs()));
        $this->assertSame(4, count($this->provider->getPubs()));
    }

    public function testGetPub(): void
    {
        $this->assertTrue(is_array($this->provider->getPub(1)));
        $this->assertSame(5, count($this->provider->getPub(1)));
        $this->assertSame('Bufet Černý kohout',$this->provider->getPub(1)['name']);
    }
}
