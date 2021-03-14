<?php

namespace App\Controller;

use App\Entity\Intervenant;
use App\Entity\User;
use App\Form\IntervenantType;
use App\Repository\IntervenantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;


class IntervenantController extends AbstractController
{
    /** 
    * @var IntervenantRepository
    * @var EntityManagerInterface
    */
    private $intervenantRepository;
    private $objectManager;

    public function __construct(EntityManagerInterface $objectManager, RequestStack $request){
        $this->intervenantRepository = $objectManager->getRepository(Intervenant::class);
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
     * @Route("/intervenants", name="get_intervenants", methods={"GET"})
     * 
     * @return Response
     */
    public function getIntervenants(): Response
    {
        $intervenants = $this->intervenantRepository->findAll();
        return $this->json($intervenants);
    }



    /**
     * @Route("/intervenants/{intervenantId}", name="get_intervenant", methods={"GET"})
     * 
     * @param intervenantId $intervenantId
     * @return Response
     */
    public function getIntervenant($intervenantId): Response
    {
        $intervenant = $this->intervenantRepository->find($intervenantId);

        if(!$intervenant instanceof Intervenant){
            throw new NotFoundHttpException();
        }

        return $this->json($intervenant);
    }


    /**
     * @Route("/intervenants/{intervenantId}", name="delete_intervenant", methods={"DELETE"})
     * 
     * @param intervenantId $intervenantId
     * @return Response
     */
    public function deleteIntervenant($intervenantId): Response
    {
        $intervenant = $this->intervenantRepository->find($intervenantId);

        if(!$intervenant instanceof Intervenant){
            throw new NotFoundHttpException();
        }

        $this->objectManager->remove($intervenant);
        $this->objectManager->flush();

        return $this->json('La intervenant a bien été supprimé !');
    }


    /**
     * @Route("/intervenants", name="add_intervenant", methods={"POST"})
     * 
     * @param Request $request
     * @return Response
     */
    public function addIntervenant(Request $request): Response
    {
        $intervenant = new intervenant; 
        
        $form = $this->createForm(IntervenantType::class, $intervenant);
        $form->submit($request->request->all());
        
        $this->objectManager->persist($intervenant);
        $this->objectManager->flush();

        return $this->json($intervenant);
    }


    /**
     * @Route("/intervenants/{intervenantId}", name="update_intervenant", methods={"PUT"})
     * 
     * @param Request $request
     * @param intervenantId $intervenantId
     * @return Response
     */
    public function updateIntervenant($intervenantId, Request $request): Response
    {
        $intervenant = $this->intervenantRepository->find($intervenantId);
        $form = $this->createForm(IntervenantType::class, $intervenant);
        $form->submit($request->request->all());

        if(!$intervenant instanceof Intervenant){
            throw new NotFoundHttpException();
        }

        $this->objectManager->persist($intervenant);
        $this->objectManager->flush();

        return $this->json($intervenant);
    }
}
