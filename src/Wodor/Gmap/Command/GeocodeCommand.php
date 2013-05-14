<?php

namespace Wodor\Gmap\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GeocodeCommand extends Command{

    protected $container;

    public function __construct(\ArrayAccess $container, $name = null)
    {
        $this->container = $container;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('gmap:query')
            ->setDescription('Ask google maps about the address')
            ->addArgument(
                'address',
                InputArgument::REQUIRED,
                'Where do you want to go ?'
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \Geocoder $geocoderService */
        $geocoderService = $this->container['geocoder.formatted'];
        $address = $input->getArgument('address');
        $output->writeln($geocoderService->geocodeToString($address));
    }
}