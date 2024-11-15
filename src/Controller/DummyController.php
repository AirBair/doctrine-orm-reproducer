<?php

namespace App\Controller;

use App\Entity\DummyParent;
use App\Entity\DummyChild;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DummyController extends AbstractController
{
    #[Route('/create-dummies', name: 'create_dummies')]
    public function createParentWithChildren(EntityManagerInterface $entityManager): Response
    {
        $dummyChildOne = (new DummyChild())->setName('Dummy Child One');
        $dummyChildTwo = (new DummyChild())->setName('Dummy Child Two');
        $dummyParent = (new DummyParent())
            ->setName('Dummy Parent')
            ->addDummyChild($dummyChildOne)
            ->addDummyChild($dummyChildTwo);

        dump($dummyParent);

        $entityManager->persist($dummyParent);
        $entityManager->flush();

        return new Response('Dummy Parent and children created');
    }

    #[Route('/delete-dummy-child', name: 'delete_dummy_child')]
    public function deleteDummyChild(EntityManagerInterface $entityManager): Response
    {
        $dummyParent = $entityManager->getRepository(DummyParent::class)->findOneBy(['name' => 'Dummy Parent']);
        $dummyChild = $entityManager->getRepository(DummyChild::class)->findOneBy(['name' => 'Dummy Child One']);

        $dummyParent->removeDummyChild($dummyChild);

        $entityManager->flush();

        return new Response('Dummy Child One delete.');
    }
}
