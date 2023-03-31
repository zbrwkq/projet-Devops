<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostsRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/post", name="app_post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="get_categories", methods={"GET"})
     */
    public function index(PostsRepository $postsRepository): JsonResponse
    {

        $posts = $postsRepository->findAll();
        $data = [];
        foreach ($posts as $post) {
            $data[] = [
                'id' => $post->getId(),
                'name' => $post->getTitle(),
                'description' => $post->getContent(),
                'category' => $post->getCategoryIdOrNull(),
            ];
        }
        return $this->json($data);
    }


    /**
     * @Route("/", name="create_post", methods={"POST"})
     */
    public function new(Request $request, PostsRepository $postsRepository, CategoriesRepository $categoriesRepository): JsonResponse
    {

        $post = new Posts();
        $post->setTitle($request->get('title'));
        $post->setContent($request->get('content'));
        $post->setCategory($categoriesRepository->findOneById($request->get('category')));


        $postsRepository->add($post, true);

        return $this->json('Created new project successfully with id ' . $post->getId());
    }

    /**
     * @Route("/{id}", name="get_post_by_id", methods={"GET"})
     */
    public function find($id, PostsRepository $postsRepository): JsonResponse
    {
        $post = $postsRepository->findOneById($id);
        if (!$post) {

            return $this->json('No post found for id ' . $id, 404);
        }

        $data =  [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'category' => $post->getCategoryIdOrNull(),
        ];

        return $this->json($data);
    }


    /**
     * @Route("/{id}", name="update_post", methods={"PUT"})
     */
    public function update(Request $request, int $id, PostsRepository $postsRepository, CategoriesRepository $categoriesRepository): JsonResponse
    {
        $post = $postsRepository->findOneById($id);
        if (!$post) {
            return $this->json('No project found for id ' . $id, 404);
        }

        $post->setTitle($request->get('title'));
        $post->setContent($request->get('content'));
        $post->setCategory($categoriesRepository->findOneById($request->get('category')));

        $postsRepository->add($post, true);

        $data =  [
            'id' => $post->getId(),
            'name' => $post->getTitle(),
            'content' => $post->getContent(),
            'category' => $post->getCategoryIdOrNull(),
        ];

        return $this->json($data);
    }


    /**
     * @Route("/{id}", name="delete_post", methods={"DELETE"})
     */
    public function delete(int $id, PostsRepository $postsRepository): JsonResponse
    {
        $post = $postsRepository->findOneById($id);

        if (!$post) {
            return $this->json('No project found for id ' . $id, 404);
        }
        $postsRepository->remove($post, true);

        return $this->json('Deleted a project successfully with id ' . $id);
    }
}
