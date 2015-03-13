<?php

namespace RubenBundle\Controller;

use RubenBundle\Entity\UploadEntity;
use RubenBundle\Utils\Helper\ReviewsHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('RubenBundle:Home:index.html.twig');
    }

    public function loadDefaultReviewsAction()
    {


        $reviewsHelper = new ReviewsHelper();

        $reviews = $reviewsHelper->getReviews($this->get('kernel')->getRootDir() . "/Test/DefaultReviews/reviews.csv");
        $reviewsHelper->getCriteria($this->get('kernel')->getRootDir() . "/Test/DefaultReviews/criteria.csv");

        $reviewsResult = $reviewsHelper->getReviewsResult($reviews);

        return $this->render('RubenBundle:Home:defaults.html.twig', array(
            'reviews' => $reviewsResult,
        ));

    }

    public function uploadPhpAction(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('criteria', 'file')
            ->add('reviews', 'file')
            ->add('ajax', 'checkbox', array(
                'label'     => 'Do it with ajax',
                'required'  => false,
            ))
            ->add('save', 'submit', array('label' => 'Load'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $rootDir = $this->get('kernel')->getRootDir().'/Resources/Tmp/';

            $reviewsHelper = new ReviewsHelper();


            $reviewsHelper->processRequestFile($rootDir, $request);
            $reviews = $reviewsHelper->getReviews($rootDir. 'reviews.csv');
            $reviewsHelper->getCriteria($rootDir. 'criteria.csv');
            $reviewsHelper->removeCsv($rootDir);


            $reviewsResult = $reviewsHelper->getReviewsResult($reviews);

            return $this->render('RubenBundle:Home:defaults.html.twig', array(
                'reviews' => $reviewsResult,
            ));

        }

        return $this->render('RubenBundle:Home:form-php.html.twig', array(
            'form' => $form->createView(),
        ));


    }

    public function uploadJsAction()
    {

        return $this->render('RubenBundle:Home:form-js.html.twig');

    }

    public function uploadAjaxAction(Request $request)
    {

        $rootDir = $this->get('kernel')->getRootDir().'/Resources/Tmp/';

        $reviewsHelper = new ReviewsHelper();

        $reviewsHelper->processRequestFile($rootDir, $request);
        $reviews = $reviewsHelper->getReviews($rootDir. 'reviews.csv');
        $reviewsHelper->getCriteria($rootDir. 'criteria.csv');
        $reviewsHelper->removeCsv($rootDir);

        $reviewsResult = $reviewsHelper->getReviewsResult($reviews);

        return $this->render('partials/home/data-table.html.twig', array(
            'reviews' => $reviewsResult,
        ));

    }

    public function liveReviewAction()
    {
        return $this->render('RubenBundle:Home:live-review.html.twig');
    }

}
