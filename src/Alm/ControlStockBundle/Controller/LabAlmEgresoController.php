<?php

namespace Alm\ControlStockBundle\Controller;

use Alm\ControlStockBundle\Entity\LabAlmEgreso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Labalmegreso controller.
 *
 * @Route("labalmegreso")
 */
class LabAlmEgresoController extends Controller
{
    /**
     * Lists all labAlmEgreso entities.
     *
     * @Route("/", name="labalmegreso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $labAlmEgresos = $em->getRepository('AlmControlStockBundle:LabAlmEgreso')->findAll();

        return $this->render('labalmegreso/index.html.twig', array(
            'labAlmEgresos' => $labAlmEgresos,
        ));
    }

    /**
     * Creates a new labAlmEgreso entity.
     *
     * @Route("/new", name="labalmegreso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $labAlmEgreso = new Labalmegreso();
        $form = $this->createForm('Alm\ControlStockBundle\Form\LabAlmEgresoType', $labAlmEgreso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $labAlmEgreso->setEstado(1);
            $em->persist($labAlmEgreso);
            $em->flush($labAlmEgreso);
            $this->addFlash('mensaje','Se guardo correctamente');

            return $this->redirectToRoute('labalmdetalleegreso_new', array('id' => $labAlmEgreso->getId()));
        }

        return $this->render('labalmegreso/new.html.twig', array(
            'labAlmEgreso' => $labAlmEgreso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a labAlmIngreso entity.
     *
     * @Route("/{id}/confirmar/", name="labalmegreso_confirmar")
     * @Method("GET")
     */
    public function confirmarAction(LabAlmEgreso $labAlmEgreso)
    {
        $em=$this->getDoctrine()->getManager();

        $egresoDetalles=$em->getRepository('AlmControlStockBundle:LabAlmDetalleegreso')->findByEgreso($labAlmEgreso);
        if (count($egresoDetalles)<1) {
            $this->addFlash('error','No tiene producto registrados');
            return $this->redirectToRoute('labalmegreso_show',array('id'=>$labAlmEgreso->getId()));
        }
        if (is_null($labAlmEgreso->getRecibidoPor())) {

            $this->addFlash('mensaje','llenar el nombre de que recibe el egreso');

            return $this->redirectToRoute('labalmegreso_show',array('id'=>$labAlmEgreso->getId()));
        }

        $labAlmEgreso->setEstado(2);
        $labAlmEgreso->setfechaEntregado(new \DateTime());
        foreach ($egresoDetalles as $egresoDetalle) {
            if ($egresoDetalle->getEstado()==1) {
                $egresoDetalle->setEstado(2);
                $productolab=$egresoDetalle->getProductolab();
                $productolab->setStock($productolab->getStock()-$egresoDetalle->getCantidad());
                $em->persist($productolab);
                $em->persist($egresoDetalle);
            }
            
        }
        $em->persist($labAlmEgreso);
        $em->flush();
         $this->addFlash('mensaje','Se confirmo el egreso');
        return $this->redirectToRoute('labalmegreso_index');
        
    }

    /**
     * Finds and displays a labAlmEgreso entity.
     *
     * @Route("/{id}", name="labalmegreso_show")
     * @Method("GET")
     */
    public function showAction(LabAlmEgreso $labAlmEgreso)
    {
        $em=$this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($labAlmEgreso);
        $egresoDetalles=$em->getRepository('AlmControlStockBundle:LabAlmDetalleegreso')->findByEgreso($labAlmEgreso);

        return $this->render('labalmegreso/show.html.twig', array(
            'labAlmEgreso' => $labAlmEgreso,
            'labAlmDetalleegresos'=>$egresoDetalles,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing labAlmEgreso entity.
     *
     * @Route("/{id}/edit", name="labalmegreso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, LabAlmEgreso $labAlmEgreso)
    {
        $deleteForm = $this->createDeleteForm($labAlmEgreso);
        $editForm = $this->createForm('Alm\ControlStockBundle\Form\LabAlmEgresoType', $labAlmEgreso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('mensaje','Se modifico el ingreso');
            return $this->redirectToRoute('labalmdetalleegreso_new', array('id' => $labAlmEgreso->getId()));
        }

        return $this->render('labalmegreso/new.html.twig', array(
            'labAlmEgreso' => $labAlmEgreso,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a labAlmEgreso entity.
     *
     * @Route("/{id}", name="labalmegreso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, LabAlmEgreso $labAlmEgreso)
    {
        $form = $this->createDeleteForm($labAlmEgreso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($labAlmEgreso);
            $em->flush();
        }

        return $this->redirectToRoute('labalmegreso_index');
    }

    /**
     * Creates a form to delete a labAlmEgreso entity.
     *
     * @param LabAlmEgreso $labAlmEgreso The labAlmEgreso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(LabAlmEgreso $labAlmEgreso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('labalmegreso_delete', array('id' => $labAlmEgreso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Export to PDF
     *
     * @Route("/{id}/pdf", name="egreso_print")
     */
    public function pdfAction(LabAlmEgreso $labAlmEgreso){
        $em=$this->getDoctrine()->getManager();
        $egresoDetalles=$em->getRepository('AlmControlStockBundle:LabAlmDetalleegreso')->findByEgreso($labAlmEgreso);
        $html=$this->render('labalmegreso/print.html.twig', array(
            'labAlmEgreso' => $labAlmEgreso,
            'labAlmDetalleegresos'=>$egresoDetalles,
        ))->getContent();

        $filename = sprintf('Egreso-%s.pdf', date('Y-m-d'));

        $response= new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html,
            array('lowquality' => false,
                    'encoding' => 'utf-8',
                    'page-size' => 'letter',
                    'outline-depth' => 8,
                    'orientation' => 'Portrait',
                    'title'=> 'Egreso de Insumos',
                    'copies'=>1,
                    'outline'=>true,
                    'print-media-type'=>true,
                    'exclude-from-outline'=>false,
                    'images'=>true,
                    'header-font-size'=>7
                    )),
            200,
            array(
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('inline; filename="%s"', $filename),
            )
        );
        return $response;
    }
}
