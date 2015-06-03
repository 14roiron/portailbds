<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        	new AppBundle\AppBundle(),
            new BDS\UserBundle\BDSUserBundle(),
        	new FOS\UserBundle\FOSUserBundle(),
            new BDS\NewsBundle\BDSNewsBundle(),
            new BDS\CoreBundle\BDSCoreBundle(),
            new BDS\ImageBundle\BDSImageBundle(),
        	new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
        	new ADesigns\CalendarBundle\ADesignsCalendarBundle(),
            new BDS\EvenementBundle\BDSEvenementBundle(),
            new BDS\CalendarBundle\BDSCalendarBundle(),
        	new BladeTester\CalendarBundle\BladeTesterCalendarBundle(),
        	new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
        	new Ornicar\GravatarBundle\OrnicarGravatarBundle()
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
