<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Repository\AdminRepository;
use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AdminFormType;
use App\Form\StandFormType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use App\Security\AdminAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class ApiController extends AbstractController{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/", name="main")
     * @return Response
     */
    public function pageMain(): Response
    {
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/coordonnees", name="CoordonneesOccupees", methods = {"GET"})
     * @return Response
     */
    public function getCoordonneesOccupees()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $response = $this->client->request(
            'GET',
            'http://127.0.0.1:8001/api/get_coordonnees'
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $coordonnees = json_decode($content, true);

        //return new Response($content, 200, ['content-type' => 'text/plain']);
        //return $content;
        return $this->render('map.html.twig', ['coordonnees' => $coordonnees]);
    }

    /**
     * @Route("/Stands", name="AllStands", methods = {"GET"})
     * @return Response
     */
    public function getAllStands()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $response = $this->client->request(
            'GET',
            'http://127.0.0.1:8001/api/get_stands'
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $stands = json_decode($content, true);
        $placement =  array();
        for ($i=0; $i < 5; $i++) { 
            $placement[$i]=array();
        }
        foreach ($stands as $stand) {
            foreach ($stand['coordonnees'] as $coordonnee) {
                $placement[$coordonnee['y']][$coordonnee['x']]='stand'.$stand['id_stand'];
            }
        }
        $templateAreas = '';
        for ($y=0; $y <5; $y++) { 
            $ligne = '"';
            for ($x=0; $x <10; $x++) { 
                if(array_key_exists($x, $placement[$y]) && $placement[$y][$x] != NULL)
                {
                    $ligne .= $placement[$y][$x];
                }
                else $ligne .= ".";
                if ($x <9) $ligne .= " ";
            }
            $ligne .= '"';
            $templateAreas .= $ligne;
        }
        return $this->render('table.html.twig', ['stands' => $stands, 'templateAreas' => $templateAreas, 'placement'=>$placement]);

        //return new Response($data, 200);
        //return new Response($content, 200, ['content-type' => 'text/plain']);
        //return $this->render('table.html.twig');
    }

    /**
     * @Route("/new", name="new")
     * @return Response
     */
    public function newStands(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $response = $this->client->request(
            'GET',
            'http://127.0.0.1:8001/api/get_stands'
        );

        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->getContent();
        $stands = json_decode($content, true);
        $placement =  array();
        for ($i=0; $i < 5; $i++) { 
            $placement[$i]=array();
        }
        foreach ($stands as $stand) {
            foreach ($stand['coordonnees'] as $coordonnee) {
                $placement[$coordonnee['y']][$coordonnee['x']]='stand'.$stand['id_stand'];
            }
        }
        $templateAreas = '';
        for ($y=0; $y <5; $y++) { 
            $ligne = '"';
            for ($x=0; $x <10; $x++) { 
                if(array_key_exists($x, $placement[$y]) && $placement[$y][$x] != NULL)
                {
                    $ligne .= $placement[$y][$x];
                }
                else $ligne .= ".";
                if ($x <9) $ligne .= " ";
            }
            $ligne .= '"';
            $templateAreas .= $ligne;
        }

        $form = $this->createForm(StandFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $nom = $form["nom"]->getData();
            $nord = $form["nord"]->getData();
            $ouest = $form["ouest"]->getData();
            $est = $form["est"]->getData();
            $sud = $form["sud"]->getData();

            $response = $this->client->request(
                'POST',
                'http://127.0.0.1:8001/api/create_stand',
                ['body'=>json_encode(['nom_stand'=>$nom, 'coordonnees'=>
                ['nord'=>$nord, 'ouest'=>$ouest, 'est'=>$est, 'sud'=>$sud]])]
            );
            //$statusCode = $response->getStatusCode();
            //$contentType = $response->getHeaders()['content-type'][0];
            $content = $response->getContent();
            $data = json_decode($content, true);
            $success = $data['status']=='fail';
            if ($success){
                return $this->redirectToRoute('new');
            }
            else{
                return $this->redirectToRoute('AllStands');
            }

        }

        return $this->render('new.html.twig', ['standForm'=>$form->createView(),'stands' => $stands, 'templateAreas' => $templateAreas, 'placement'=>$placement]);

    }


    /**
     * @Route("/delete/{id}", name="delete")
     * @return Response
     */
    public function deleteStand(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $response = $this->client->request(
            'POST',
            'http://127.0.0.1:8001/api/delete_stand',
            ['body'=>json_encode(['id_stand'=>$id])]
        );
        return $this->redirectToRoute('AllStands');
    }


    /**
     * @Route("/login", name="login")
     * @return Response
     */
    public function login(EntityManagerInterface $em, Request $request, AdminAuthenticator $authenticator, GuardAuthenticatorHandler $guardHandler)
    {
        $form = $this->createForm(AdminFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $id = $form["idAdmin"]->getData();
            $mdp = $form["motDePasse"]->getData();

            $response = $this->client->request(
                'POST',
                'http://127.0.0.1:8001/api/authenticate',
                ['body'=>json_encode(['id_admin'=>$id, 'mot_de_passe'=>$mdp])]
            );
    
            $statusCode = $response->getStatusCode();
            $contentType = $response->getHeaders()['content-type'][0];
            $content = $response->getContent();
            $data = json_decode($content, true);
    
            $success = $data['authenticationStatus']=='success';
            if ($success){
                $admin = new Admin();
                $admin->setIdAdmin($id);
                
                $guardHandler->authenticateUserAndHandleSuccess(
                    $admin,
                    $request,
                    $authenticator,
                    'main'
                );
                //return $this->render('table.html.twig');
                return $this->redirectToRoute('AllStands');
            }

        }
        return $this->render('login.html.twig', [
            'adminForm'=>$form->createView(),
        ]);
        
        
    }


    
}
