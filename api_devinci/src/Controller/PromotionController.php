<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Entity\User;
use App\Form\PromotionType;
use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PromotionController extends AbstractController
{
    /** 
    * @var PromotionRepository
    * @var EntityManagerInterface
    */
    private $promotionRepository;
    private $objectManager;

    public function __construct(EntityManagerInterface $objectManager, RequestStack $request){
        $this->promotionRepository = $objectManager->getRepository(Promotion::class);
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
     * @Route("/promotions", name="get_promotions", methods={"GET"})
     * 
     * @return Response
     */
    public function getPromotions(): Response
    {
        $promotions = $this->promotionRepository->findAll();
        return $this->json($promotions);
    }



    /**
     * @Route("/promotions/{promotionId}", name="get_promotion", methods={"GET"})
     * 
     * @param promotionId $promotionId
     * @return Response
     */
    public function getPromotion($promotionId): Response
    {
        $promotion = $this->promotionRepository->find($promotionId);

        if(!$promotion instanceof Promotion){
            throw new NotFoundHttpException();
        }

        return $this->json($promotion);
    }


    /**
     * @Route("/promotions/{promotionId}", name="delete_promotion", methods={"DELETE"})
     * 
     * @param promotionId $promotionId
     * @return Response
     */
    public function deletePromotion($promotionId): Response
    {
        $promotion = $this->promotionRepository->find($promotionId);

        if(!$promotion instanceof Promotion){
            throw new NotFoundHttpException();
        }

        $this->objectManager->remove($promotion);
        $this->objectManager->flush();

        return $this->json('La promotion a bien été supprimé !');
    }


    /**
     * @Route("/promotions", name="add_promotion", methods={"POST"})
     * 
     * @param Request $request
     * @return Response
     */
    public function addPromotion(Request $request): Response
    {
        $promotion = new Promotion; 

        $form = $this->createForm(PromotionType::class, $promotion);
        $form->submit($request->request->all());
        // $promotion->setNomPromo($request->request->get('nomPromo'));
        // $promotion->setDateSortie($request->request->get('dateSortie'));
        
        $this->objectManager->persist($promotion);
        $this->objectManager->flush();

        return $this->json($promotion);
    }


    /**
     * @Route("/promotions/{promotionId}", name="update_promotion", methods={"PUT"})
     * 
     * @param Request $request
     * @param promotionId $promotionId
     * @return Response
     */
    public function updatePromotion($promotionId, Request $request): Response
    {
        $promotion = $this->promotionRepository->find($promotionId);
        $form = $this->createForm(PromotionType::class, $promotion);
        $form->submit($request->request->all());

        if(!$promotion instanceof Promotion){
            throw new NotFoundHttpException();
        }

        $this->objectManager->persist($promotion);
        $this->objectManager->flush();

        return $this->json($promotion);
    }
}
