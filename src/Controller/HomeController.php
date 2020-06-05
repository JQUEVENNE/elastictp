<?php


namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use http\Env\Request;

class HomeController
{
     /**
      * @Route("/home")
      */

    public function first(): Response{
        $ch = curl_init();
        curl_setopt_array($ch, [
                CURLOPT_URL => 'http://localhost:9200/',
                CURLOPT_RETURNTRANSFER => true,
            ]
        );
        $rep = curl_exec($ch);

        $rep = json_decode($rep, JSON_OBJECT_AS_ARRAY);


    }
    /**
     * @Route("/search", name="movie_search")
     * @Method("GET")
     */
    public function search(Request $request, PostRepository $posts): Response
    {

        $foundPosts = $posts->findBySearchQuery($query, $limit);

        $results = [];
        foreach ($foundPosts as $post) {
            $results[] = [
                'actor' => htmlspecialchars($post->getactor()),
               // 'date' => $post->getPublishedAt()->format('M d, Y'),
                'theme' => htmlspecialchars($post->gettheme()),
                'url' => $this->generateUrl('movie_post', ['slug' => $post->getSlug()]),
            ];
        }

        return $this->json($results);
    }
}