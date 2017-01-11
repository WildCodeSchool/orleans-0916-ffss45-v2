<?php
/**
 * Created by PhpStorm.
 * User: optix
 * Date: 10/01/17
 * Time: 09:44
 */

// src/AdminBundle/Command/MailCommand.php

namespace AdminBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class MailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ffss:mail-inscription')
            ->setDescription('Envoie de mails.')
            ->setHelp("Cette commande envoie un mail avant commencement de formation")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['Mail Inscription','============',]);

        $em = $this->getContainer()->get('doctrine')->getManager();
        $users = $em->getRepository('CommerceBundle:Reservations')->findAll();


        for ($i = 0; $i <= $i; $i++) {
            $output->write([$users[$i]->getUsername()]);
            $output->write(['  ',]);
            $output->writeln([$users[$i]->getemail()]);
            $output->writeln(['============',]);
        }

    }
}
