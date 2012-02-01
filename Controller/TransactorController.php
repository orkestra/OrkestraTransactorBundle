<?php

namespace Orkestra\TransactorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Orkestra\PaginationBundle\Pagination\Paginator;
    
use Orkestra\TransactorBundle\Form\TransactorSelectType,
    Orkestra\TransactorBundle\Pagination\TransactorListOptions;

/**
 * Transactor controller.
 *
 * @Route("")
 */
class TransactorController extends Controller
{
    /**
     * Lists all Transactors.
     *
     * @Route("/transactors", name="admin_transactors")
     * @Template()
     */
    public function indexAction()
    {
        $paginator = new Paginator($this->container, new TransactorListOptions($this->getDoctrine()->getEntityManager()));

        return array('paginator' => $paginator->createView());
    }

    /**
     * Finds and displays a TransactorBase entity.
     *
     * @Route("/transactor/{id}/show", name="admin_transactor_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $transactor = $em->getRepository('Orkestra\Transactor\Entity\TransactorBase')->find($id);

        if (!$transactor) {
            throw $this->createNotFoundException('Unable to locate Transactor');
        }

        return array(
            'transactor' => $transactor,
        );
    }

    /**
     * Displays a form to create a new Transactor.
     *
     * @Route("/transactor/new", name="admin_transactor_new")
     * @Template()
     */
    public function newAction()
    {
        $form = $this->createForm(new TransactorSelectType());

        if ($this->getRequest()->getMethod() == 'POST') {
            $form->bindRequest($this->getRequest());
            
            if ($form->isValid()) {
                $data = $form->getData();
                
                return $this->redirect($this->generateUrl('admin_transactor_configure', array('type' => $data['type'])));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }
    
    /**
     * Displays a form to configure a new TransactorBase.
     *
     * @Route("/transactor/configure", name="admin_transactor_configure")
     * @Template()
     */
    public function configureAction()
    {
        $request = $this->getRequest();
        
        $type = $request->get('type');
        
        if (!$type) {
            throw $this->createNotFoundException('No transactor type specified');
        }
        
        $formTypeName = 'Orkestra\TransactorBundle\Form\\' . $type . 'Type';
        
        if (!class_exists($formTypeName)) {
            throw $this->createNotFoundException(sprintf('Transactor of type %s is not configured correctly. No FormType found.', $type));
        }
        
        $form = $this->createForm(new $formTypeName());

        if ($this->getRequest()->getMethod() == 'POST') {
            $form->bindRequest($this->getRequest());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $transactor = $form->getData();
                $em->persist($transactor);
                $em->flush();
                
                $this->get('session')->setFlash('success', 'The transactor has been created.');
                
                return $this->redirect($this->generateUrl('admin_transactor_show', array('id' => $transactor->getId())));
            }
        }
        
        return array(
            'type' => $type,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Transactor
     *
     * @Route("/transactor/{id}/edit", name="admin_transactor_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $transactor = $em->getRepository('Orkestra\Transactor\Entity\TransactorBase')->find($id);

        if (!$transactor) {
            throw $this->createNotFoundException('Unable to locate Transactor');
        }
        
        $type = @array_pop(explode('\\', get_class($transactor)));
        $formTypeName = 'Orkestra\TransactorBundle\Form\\' . $type . 'Type';
        
        if (!class_exists($formTypeName)) {
            throw $this->createNotFoundException(sprintf('Transactor of type %s is not configured correctly. No FormType found.', $type));
        }

        $form = $this->createForm(new $formTypeName(), $transactor);

        return array(
            'transactor' => $transactor,
            'form' => $form->createView(),
        );
    }

    /**
     * Edits an existing Transactor
     *
     * @Route("/transactor/{id}/update", name="admin_transactor_update")
     * @Method("post")
     * @Template("OrkestraTransactorBundle:TransactorBase:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $transactor = $em->getRepository('Orkestra\Transactor\Entity\TransactorBase')->find($id);

        if (!$transactor) {
            throw $this->createNotFoundException('Unable to locate Transactor');
        }

        $type = @array_pop(explode('\\', get_class($transactor)));
        $formTypeName = 'Orkestra\TransactorBundle\Form\\' . $type . 'Type';
        
        if (!class_exists($formTypeName)) {
            throw $this->createNotFoundException(sprintf('Transactor of type %s is not configured correctly. No FormType found.', $type));
        }

        $form = $this->createForm(new $formTypeName(), $transactor);
        
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $em->persist($transactor);
            $em->flush();

            $this->get('session')->setFlash('success', 'Your changes have been saved.');

            return $this->redirect($this->generateUrl('admin_transactor_show', array('id' => $id)));
        }

        return array(
            'transactor' => $transactor,
            'form' => $form->createView(),
        );
    }
}
