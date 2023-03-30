<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="app_category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="get_categories", methods={"GET"})
     */
    public function index(CategoriesRepository $categoriesRepository): JsonResponse
    {
        $categories = $categoriesRepository->findAll();
        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->getId(),
                'name' => $category->getTitle(),
            ];
            }
        return $this->json($data);
    }

    
    /**
     * @Route("/", name="create_category", methods={"POST"})
     */
    public function new(Request $request, CategoriesRepository $categoriesRepository): JsonResponse
    {
 
        $category = new Categories();
        $category->setTitle($request->get('title'));
 
        $categoriesRepository->add($category, true);
 
        return $this->json('Created new project successfully with id ' . $category->getId());
    }

    /**
     * @Route("/{id}", name="get_category_by_id", methods={"GET"})
     */
    public function find($id, CategoriesRepository $categoriesRepository): JsonResponse
    {
        $category = $categoriesRepository->findOneById($id);
        if (!$category) {
 
            return $this->json('No category found for id ' . $id, 404);
        }
 
        $data =  [
            'id' => $category->getId(),
            'title' => $category->getTitle(),
        ];
         
        return $this->json($data);
    }
 
    
    /**
     * @Route("/{id}", name="update_category", methods={"PUT"})
     */
    public function update(Request $request, int $id, CategoriesRepository $categoriesRepository): JsonResponse
    {
        $category = $categoriesRepository->findOneById($id);
        if (!$category) {
            return $this->json('No project found for id ' . $id, 404);
        }
 
        $category->setTitle($request->get('title'));

        $categoriesRepository->add($category, true);
 
        $data =  [
            'id' => $category->getId(),
            'name' => $category->getTitle(),
        ];
         
        return $this->json($data);
    }

    
    /**
     * @Route("/{id}", name="delete_category", methods={"DELETE"})
     */
    public function delete(int $id, CategoriesRepository $categoriesRepository): JsonResponse
    {
        $category = $categoriesRepository->findOneById($id);
 
        if (!$category) {
            return $this->json('No project found for id ' . $id, 404);
        }
        $categoriesRepository->remove($category, true);
 
        return $this->json('Deleted a project successfully with id ' . $id);
    }
}
