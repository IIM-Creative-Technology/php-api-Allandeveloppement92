<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Entity\User;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class MatiereController extends AbstractController
{
    /** 
    * @var matiereRepository
    * @var EntityManagerInterface
    */
    private $matiereRepository;
    private $objectManager;

    public function __construct(EntityManagerInterface $objectManager, RequestStack $request){
        $this->matiereRepository = $objectManager->getRepository(Matiere::class);
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
     * @Route("/matieres", name="get_matieres", methods={"GET"})
     * 
     * @return Response
     */
    public function getMatieres(): Response
    {
        $matieres = $this->matiereRepository->findAll();
        // // return serialize($matieres);
        return $this->json($matieres);   
    }



    /**
     * @Route("/matieres/{matiereId}", name="get_matiere", methods={"GET"})
     * 
     * @param matiereId $matiereId
     * @return Response
     */
    public function getMatiere($matiereId): Response
    {
        $matiere = $this->matiereRepository->find($matiereId);

        if(!$matiere instanceof Matiere){
            throw new NotFoundHttpException();
        }

        return $this->json($matiere);
    }


    /**
     * @Route("/matieres/{matiereId}", name="delete_matiere", methods={"DELETE"})
     * 
     * @param matiereId $matiereId
     * @return Response
     */
    public function deleteMatiere($matiereId): Response
    {
        $matiere = $this->matiereRepository->find($matiereId);

        if(!$matiere instanceof Matiere){
            throw new NotFoundHttpException();
        }

        $this->objectManager->remove($matiere);
        $this->objectManager->flush();

        return $this->json('L\'étudiant a bien été supprimé !');
    }


    /**
     * @Route("/matieres", name="add_matiere", methods={"POST"})
     * 
     * @param Request $request
     * @return Response
     */
    public function addMatiere(Request $request): Response
    {
        $matiere = new Matiere; 
        
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->submit($request->request->all());
        
        $this->objectManager->persist($matiere);
        $this->objectManager->flush();

        return $this->json($matiere);
    }


    /**
     * @Route("/matieres/{matiereId}", name="update_matiere", methods={"PUT"})
     * 
     * @param Request $request
     * @param matiereId $matiereId
     * @return Response
     */
    public function updateMatiere($matiereId, Request $request): Response
    {
        $matiere = $this->matiereRepository->find($matiereId);
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->submit($request->request->all());

        if(!$matiere instanceof Matiere){
            throw new NotFoundHttpException();
        }

        $this->objectManager->persist($matiere);
        $this->objectManager->flush();

        return $this->json($matiere);
    }
}