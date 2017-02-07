<?php

namespace CommerceBundle\Services;
use CommerceBundle\Entity\Reservation;

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 05/02/17
 * Time: 11:35
 */
class PaymentValidation
{

    public function __construct($doctrine, $templating, $mailer, $fos, $email)
    {
        $this->em = $doctrine;
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->fos = $fos;
        $this->mailFrom = $email;
    }
    // enregistrement de la reservation, des users inscrit et envoie du mail de confirmation
    public function saveReservation($panier, $orderId) {
        $em = $this->em;
        foreach ($panier as $agenda_id => $formation) {

            $users = $em->getRepository('AdminBundle:User')->findAll();
            foreach ($users as $value) {
                $emails[] = $value->getEmail();
                $usernames[] = $value->getUserName();

            }
            $inscrits = $formation['inscrits'];

            foreach ($inscrits as $newUser) {
                $nom = $newUser['nom'];
                $prenom = $newUser['prenom'];
                $email = $newUser['email'];
                $password = uniqid(1, false);

                if (in_array($email, $emails)) {
                    $user = $em->getRepository('AdminBundle:User')->findOneByEmail($email);

                    $reservation = new Reservation();
                    $reservation->setUser($user);
                    $reservation->setStatus(2);

                    $agenda = $em->getRepository('AdminBundle:Agenda')->find($agenda_id);
                    $reservation->setAgenda($agenda);
                    $reservation->setnumeroReservation($orderId);

                    $em->persist($reservation);

                    $message = \Swift_Message::newInstance()
                        ->setSubject('FFSS45 : Finaliser votre inscription')
                        ->setFrom($this->mailFrom)
                        ->setTo($email)
                        ->setBody(
                            $this->templating->render('emailMember.html.twig', array('nom'    => $nom,
                                                                             'prenom' => $prenom,
                            ),
                                'text/html'
                            ));
                    $this->mailer->send($message);


                } else {
                    $username = $prenom . $nom;
                    $nb = 2;
                    while (in_array($username, $usernames)) {
                        $username = $prenom . $nom . $nb;
                        $nb++;
                    }
                    $passwordcrypt = md5($password);
                    $firstPassword[] = $password;

                    $userManager = $this->fos;
                    $user = $userManager->createUser();

                    $user->setUsername($username);
                    $user->setEmail($email);
                    $user->setNom($nom);
                    $user->setPrenom($prenom);
                    $user->setPassword($passwordcrypt);

                    $userManager->updateUser($user);


                    $reservation = new Reservation();
                    $reservation->setUser($user);
                    $reservation->setStatus(2);

                    $agenda = $em->getRepository('AdminBundle:Agenda')->find($agenda_id);
                    $reservation->setAgenda($agenda);
                    $reservation->setnumeroReservation($orderId);
                    $em->persist($reservation);

                    $message = \Swift_Message::newInstance()
                        ->setSubject('FFSS45 : Finaliser votre inscription')
                        ->setFrom($this->mailFrom)
                        ->setTo($email)
                        ->setBody(
                            $this->templating->render('emailSubscription.html.twig', array('nom'    => $nom,
                                                                                   'prenom' => $prenom, 'password' => $password,

                            ),
                                'text/html'
                            ));
                    $this->mailer->send($message);
                }
            }

        }
        $em->flush();

    }

}