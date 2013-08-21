<?php

namespace Rz\TutorialBundle\Controller;

use Sonata\AdminBundle\Controller\HelperController as BaseHelperController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Admin\AdminHelper;

class HelperController extends BaseHelperController
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var \Sonata\AdminBundle\Admin\AdminHelper
     */
    protected $helper;

    /**
     * @var \Sonata\AdminBundle\Admin\Pool
     */
    protected $pool;

    /**
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getShortObjectDescriptionAction(Request $request)
    {
        $code     = $request->get('code');
        $objectId = $request->get('objectId');
        $uniqid   = $request->get('uniqid');
        $parentId = $request->get('parentId');
        $linkCoordinates = $request->get('linkCoordinates');

        $admin = $this->pool->getInstance($code);

        if (!$admin) {
            throw new NotFoundHttpException();
        }

        $admin->setRequest($request);

        if ($uniqid) {
            $admin->setUniqid($uniqid);
        }

        $object = $admin->getObject($objectId);

        if (!$object) {
            return new Response();
        }

        $description = 'no description available';
        foreach (array('getAdminTitle', 'getTitle', 'getName', '__toString') as $method) {
            if (method_exists($object, $method)) {
                $description = call_user_func(array($object, $method));
                break;
            }
        }

        $htmlOutput = $this->twig->render('RzTutorialBundle:Helper:short-object-description.html.twig',
            array(
                'admin' => $admin,
                'description' => $description,
                'object' => $object,
                'parentId' => $parentId,
                'link_coordinates' => $linkCoordinates,
            )
        );

        return new Response($htmlOutput);
    }

    /**
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function appendLinkCoordinates(Request $request)
    {
        $parentId    = $request->get('parentId');
        $uniqid    = $request->get('uniqid');
        $x1        = $request->get('x1');
        $y1        = $request->get('y1');
        $x2        = $request->get('x2');
        $y2        = $request->get('y2');
        $type      = $request->get('type');

        $htmlOutput = $this->twig->render('RzTutorialBundle:Helper:link-coordinates.html.twig',
                                          array(
                                              'x1' => $x1,
                                              'y1' => $y1,
                                              'x2' => $x2,
                                              'y2' => $y2,
                                              'type' => $type,
                                              'parentId' => $parentId,
                                              'uniqid' => $uniqid
                                          )
        );

        return new Response($htmlOutput);
    }
}
