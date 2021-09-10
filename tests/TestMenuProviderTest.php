<?php

namespace App\Tests;

use App\MenuProvider;
use App\PubsProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TestMenuProviderTest extends KernelTestCase
{
    private MenuProvider $provider;
    private PubsProvider $pubsProvider;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $this->pubsProvider = $container->get(PubsProvider::class);
        $this->provider = $container->get(MenuProvider::class);
    }

    public function testGetPubs(): void
    {
        $this->assertTrue(is_array($this->provider->getMenu(1)));
        foreach ($this->pubsProvider->getPubs() as $key => $pub) {
            $menu = $this->provider->getMenu($key);
            $this->assertSame(2, count($menu));
            $this->assertSame(3, count($menu[0]));
            $this->assertSame(4, count($menu[0]['courses']));
            $this->assertSame(2, count($menu[0]['courses'][0]['meals']));
            $this->assertSame(34, $menu[0]['courses'][0]['meals'][1]['price']);
        }
    }
}
