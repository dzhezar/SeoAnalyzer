<?php


namespace App\Controller;


use App\DTO\FormDTO;
use App\Form\InputForm;
use DOMDocument;
use DOMXPath;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{


    public function index(Request $request)
    {
        $dto = new FormDTO();
        $form = $this->createForm(InputForm::class, $dto);
        $form->handleRequest($request);

        return $this->render('base.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function search(Request $request)
    {
        $result = [];
        $crawler = new Crawler(file_get_contents($request->get('url')));
        foreach ($request->get('options') as $choice) {
                $element = $crawler->filter($choice);
                if ($element->count() === 1) {
                    $result[$choice][] = $element->text();
                }
                elseif ($element->count() === 0) {
                    $result[$choice][] = 'no content';
                }
                elseif ($element->count() > 1) {
                    $element->each(function (Crawler $node) use (&$result, &$choice) {
                        $result[$choice][] = $node->text() ;
                    });
                }
        }
        return $this->render('table.html.twig', [
            'array' => $result
        ]);
    }
}
