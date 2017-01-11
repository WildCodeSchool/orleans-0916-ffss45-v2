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
        $reservations = $em->getRepository('CommerceBundle:Reservation')->findAll();
        foreach ($reservations as $reservation){
            $dateDeb = $reservation -> getAgenda() -> getDateDeDebut();

            $today = new DateTime('now');
           // $dateDebut = new DateTime();
            $interval = $today->diff($dateDeb);
            $diff = $interval->format('%d');
            var_dump($diff);

            if ($diff) {
                $utilisateur = $reservation -> getUser();
                $output->write($utilisateur->getEmail());
                // envoi du mail
                // swiftmailer ...
            }

        }



        $compte = count($reservations);

        for ($i = 0; $i < $compte; $i++) {
            $output->write([$reservations[$i]->getUsername()]);
            $output->write(['  ',]);
            $output->writeln([$reservations[$i]->getemail()]);
            $output->writeln(['============',]);
        }

    }
}
