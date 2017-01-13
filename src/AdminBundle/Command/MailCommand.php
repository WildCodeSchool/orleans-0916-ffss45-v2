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
            ->setDescription('Envoie de mails automatique.')
            ->setHelp("Cette commande envoie un mail ~ 6 jours avant le début de formation")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['Mail Inscription','============',]);

        $em = $this->getContainer()->get('doctrine')->getManager();
        $reservations = $em->getRepository('CommerceBundle:Reservation')->findAll();
        foreach ($reservations as $reservation){
            $dateDeb = $reservation -> getAgenda() -> getDateDeDebut();


            /////////////////////////////////////////CALCUL DATE
            $today = new \DateTime('now');
            // $dateDebut = new DateTime();
            $interval = $today->diff($dateDeb);
            $diff = $interval->format('%R%a');
            $output->write($diff.'---');
            /////////////////////////////////////////////////////

            if ($diff=='+4') {
                $utilisateur = $reservation -> getUser();
                $output->writeln($utilisateur->getEmail());
                $output->writeln(['============',]);

                // envoi du mail
                // swiftmailer ...
                $message = \Swift_Message::newInstance()
                    ->setSubject('La formation débute bientôt !')
                    ->setFrom('contact@ffss.fr')
                    ->setTo($utilisateur->getEmail())
                    ->setBody(
                        $this->getContainer()->get('templating')->render(
                            'CommerceBundle:Default:reponse.html.twig',
                            array('reservation'=>$reservation)

                        ),
                        'text/html'
                    );



                $this->getContainer()->get('mailer')->send($message);

                // Du fait qu'il y est un spool de mail en mémoire définit dans le fichier de config et que ce spool est uber pratique dans le cadre des controller
                // On force l'envoie des mails du spool avec le code-ci dessous
                /* @var $mailer Swift_Mailer */
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
