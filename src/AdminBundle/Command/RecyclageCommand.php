<?php
/**
 * Created by PhpStorm.
 * User: optix
 * Date: 10/01/17
 * Time: 09:44
 */

// src/AdminBundle/Command/MailCommand.php

namespace AdminBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class RecyclageCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ffss:mail-recyclage')
            ->setDescription('Envoie de mails automatique.')
            ->setHelp("Cette commande envoie un mail ~ 1 mois avant l'expiration de la formation")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['Mail Inscription','============',]);

        $em = $this->getContainer()->get('doctrine')->getManager();
        $formations = $em->getRepository('AdminBundle:Formation')->findAll();
        foreach ($formations as $formation){
            $dateExp = $formation -> getFormation() -> getRecyclage();


            /////////////////////////////////////////CALCUL DATE
            $today = new \DateTime('now');
            // $dateDebut = new DateTime();
            $interval = $today->diff($dateExp);
            $diff = $interval->format('%R%a');
            $output->write($diff.'---');
            /////////////////////////////////////////////////////

            if ($diff=='+1') {
                $utilisateur = $reservation -> getUser();
                $output->writeln($utilisateur->getEmail());
                $output->writeln(['============',]);

                // envoi du mail
                // swiftmailer ...
                $message = \Swift_Message::newInstance()
                    ->setSubject('La formation expire bientôt !')
                    ->setFrom('contact@ffss.fr')
                    ->setTo($utilisateur->getEmail())
                    ->setBody(
                        $this->getContainer()->get('templating')->render(
                            'CommerceBundle:Default:reponseRecyclage.html.twig',
                            array('reservation'=>$reservation)

                        ),
                        'text/html'
                    );



                $this->getContainer()->get('mailer')->send($message);


                $mailer = $this->getContainer()->get('mailer');

                $transport = $mailer->getTransport();
                if ($transport instanceof Swift_Transport_SpoolTransport) {
                    $spool = $transport->getSpool();
                    $sent = $spool->flushQueue($this->getContainer()->get('swiftmailer.transport.real'));
                }
            }

        }


    }
}
