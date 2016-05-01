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
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        	new AppBundle\AppBundle(),
            new BDS\UserBundle\BDSUserBundle(),
        	new FOS\UserBundle\FOSUserBundle(),
            new BDS\NewsBundle\BDSNewsBundle(),
            new BDS\CoreBundle\BDSCoreBundle(),
            new BDS\ImageBundle\BDSImageBundle(),
        	new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new BDS\EvenementBundle\BDSEvenementBundle(),
        	new Ornicar\GravatarBundle\OrnicarGravatarBundle(),
			new Stfalcon\Bundle\TinymceBundle\StfalconTinymceBundle(),
        	new SC\DatetimepickerBundle\SCDatetimepickerBundle(),
            new BDS\SponsorBundle\BDSSponsorBundle(),
            new BDS\SportBundle\BDSSportBundle(),
        	new Knp\Bundle\TimeBundle\KnpTimeBundle(),
            new BDS\ChatBundle\BDSChatBundle(),
            new BDS\CalendrierBundle\BDSCalendrierBundle(),
            new BDS\SabreDavBundle\BDSSabreDavBundle(),
        	new JMS\SerializerBundle\JMSSerializerBundle(),
        	new Ob\HighchartsBundle\ObHighchartsBundle()
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new CoreSphere\ConsoleBundle\CoreSphereConsoleBundle();

        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
