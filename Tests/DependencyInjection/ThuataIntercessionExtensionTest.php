<?php

namespace Thuata\IntercessionBundle\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ThuataIntercessionExtensionTest extends KernelTestCase
{
    /**
     * {@inheritdoc}
     */
    public function testLoad()
    {
        self::bootKernel();
        $extension = new ThuataIntercessionExtension();

        $extension->load([], new ContainerBuilder());

        $this->assertInstanceOf(ThuataIntercessionExtension::class, $extension);
    }
}
