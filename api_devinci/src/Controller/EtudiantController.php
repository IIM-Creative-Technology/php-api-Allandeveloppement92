<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\User;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class EtudiantController extends AbstractController
{
    /** 
    * @var EtudiantRepository
    * @var EntityManagerInterface
    */
    private $etudiantRepository;
    private $objectManager;

    public function __construct(EntityManagerInterface $objectManager, RequestStack $request){
        $this->etudiantRepository = $objectManager->getRepository(Etudiant::class);
        $this->objectManager = $objectManager;

        $apiToken = $request->getCurrentRequest()->headers->get('api-token');
        $user = $this->objectManager->getRepository(User::class)->findOneBy([
            'apiKey' => $apiToken,
        ]);

        if(!$user instanceof User){
            throw new HttpException(401, 'Unauthorized');
        }
    }

    /**
     * @Route("/etudiants", name="get_etudiants", methods={"GET"})
     * 
     * @return Response
     */
    public function getetudiants(): Response
    {
        $etudiants = $this->etudiantRepository->findAll();
        return $this->json($etudiants);
    }



    /**
     * @Route("/etudiants/{etudiantId}", name="get_etudiant", methods={"GET"})
     * 
     * @param etudiantId $etudiantId
     * @return Response
     */
    public function getetudiant($etudiantId): Response
    {
        $etudiant = $this->etudiantRepository->find($etudiantId);

        if(!$etudiant instanceof Etudiant){
            throw new NotFoundHttpException();
        }

        return $this->json($etudiant);
    }


    /**
     * @Route("/etudiants/{etudiantId}", name="delete_etudiant", methods={"DELETE"})
     * 
     * @param etudiantId $etudiantId
     * @return Response
     */
    public function deleteetudiant($etudiantId): Response
    {
        $etudiant = $this->etudiantRepository->find($etudiantId);

        if(!$etudiant instanceof Etudiant){
            throw new NotFoundHttpException();
        }

        $this->objectManager->remove($etudiant);
        $this->objectManager->flush();

        return $this->json('L\'étudiant a bien été supprimé !');
    }


    /**
     * @Route("/etudiants", name="add_etudiant", methods={"POST"})
     * 
     * @param Request $request
     * @return Response
     */
    public function addetudiant(Request $request): Response
    {
        $etudiant = new Etudiant; 
        
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->submit($request->request->all());
        
        $this->objectManager->persist($etudiant);
        $this->objectManager->flush();

        return $this->json($etudiant);
    }


    /**
     * @Route("/etudiants/{etudiantId}", name="update_etudiant", methods={"PUT"})
     * 
     * @param Request $request
     * @param etudiantId $etudiantId
     * @return Response
     */
    public function updateetudiant($etudiantId, Request $request): Response
    {
        $etudiant = $this->etudiantRepository->find($etudiantId);
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->submit($request->request->all());

        if(!$etudiant instanceof Etudiant){
            throw new NotFoundHttpException();
        }

        $this->objectManager->persist($etudiant);
        $this->objectManager->flush();

        return $this->json($etudiant);
    }
}
