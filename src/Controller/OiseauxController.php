<?php

namespace App\Controller;

use App\Manipulator\OiseauxManipulator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation as Nelmio;
use OpenApi\Annotations as OA;

class OiseauxController extends AbstractController
{
    protected $params;
    protected $oiseauxManipulator;

    public function __construct(
        ContainerBagInterface $params,
        OiseauxManipulator $oiseauxManipulator
    ) {
        $this->params = $params;
        $this->oiseauxManipulator = $oiseauxManipulator;
    }

    /**
     * @OA\Response(response=200,description="Index")
     * @OA\Tag(name="Default")
     * @Nelmio\Security(name="Bearer")
     */
    public function index(
        Request $request
    ) {
        $countFamilles = 0;
        $countOiseaux = 0;
        $listeOrdresEtFamilles = $this->oiseauxManipulator->listeOrdresEtFamilles_3();
        $countOrdres = count($listeOrdresEtFamilles);
        foreach ($listeOrdresEtFamilles as $ordreEtFamille) {
            foreach ($ordreEtFamille['familles'] as $famille) {
                $countFamilles++;
                foreach ($famille['oiseaux'] as $oiseau) {
                    $countOiseaux++;
                }
            }
        }
        /*
         * COUNT IMAGES
         * */
        $cheminVersDossierImagesOiseaux = $this->params->get('kernel.project_dir').'/public/build/images/oiseaux/';
        $countImages = count(glob($cheminVersDossierImagesOiseaux.'*'));
//        $numbers = range(1, $count);
//        shuffle($numbers);
//        $indiceImage = $numbers[0];
//        $i = 0;
//        $imageChoisie = null;
//        $scanDIR = scandir($cheminVersDossierImagesOiseaux);
//        foreach($scanDIR as $file) {
//            if(strpos($file, 'png') !== false) {
//                $i++;
//                if($indiceImage == $i) {
//                    $imageChoisie = $file;
//                }
//            }
//        }
//
//
        return $this->render('Birds/index.html.twig', [
            'ordresEtFamilles' => $this->oiseauxManipulator->listeOrdresEtFamilles_3(),
            'countOrdres' => $countOrdres,
            'countFamilles' => $countFamilles,
            'countOiseaux' => $countOiseaux,
            'countImages' => $countImages
        ]);
    }

    /**
     * @OA\Response(response=200,description="Index")
     * @OA\Tag(name="Default")
     * @Nelmio\Security(name="Bearer")
     */
    public function oiseau(
        Request $request
    ) {
        return $this->render('Birds/oiseau.html.twig',
            $this->oiseauxManipulator->oiseau(
                $request->get('string')
            )
        );
    }


    #[Route(path: '/foo/{id}/bar', name: 'my_route_to_expose', options: ['expose' => true])]

    /**
     * @Route ("/one", name="one", options={"expose"=true})
     *
     * @OA\Response(response=200,description="Index")
     * @OA\Tag(name="Default")
     * @Nelmio\Security(name="Bearer")
     */
    public function one(
        Request $request
    ) {
        return $this->render('Birds/oiseau.html.twig',
            $this->oiseauxManipulator->oiseau(
                $request->get('string')
            )
        );
    }

    /**
     * @OA\Response(response=200,description="Apprendre")
     * @OA\Tag(name="Default")
     * @Nelmio\Security(name="Bearer")
     */
    public function apprendre(
        Request $request
    ) {
        return $this->render('Birds/apprendre.html.twig',
            $this->oiseauxManipulator->apprendre()
        );
    }

    /**
     * @OA\Response(response=200,description="Apprendre JS")
     * @OA\Tag(name="Default")
     * @Nelmio\Security(name="Bearer")
     */
    public function apprendreJS(
        Request $request
    ) {

//        dump($this->oiseauxManipulator->apprendre());die;


//        $listeOiseaux = $this->oiseauxManipulator->listeOiseaux();
//        dump($listeOiseaux);
//        die;
        return $this->render('Birds/apprendre.html.twig',
            $this->oiseauxManipulator->apprendre()
        );
    }

    /**
     * @OA\Response(response=200,description="Index")
     * @OA\Tag(name="Default")
     * @Nelmio\Security(name="Bearer")
     */
    public function quizzUnOiseau(
        Request $request
    ) {
//        dump(
//            $this->oiseauxManipulator->imagesDixOiseauxAuHasard()
//        );
//        die;
//        return $this->oiseauxManipulator->quizzUnOiseau();

//        $listeOiseaux = $this->oiseauxManipulator->listeOiseaux();
//        dump($listeOiseaux);
//        die;
        return $this->render('Birds/quizzUnOiseau.html.twig', [
            'images' => $this->oiseauxManipulator->quizzUnOiseau()
        ]);
    }
}