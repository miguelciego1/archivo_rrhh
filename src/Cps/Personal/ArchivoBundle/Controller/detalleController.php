<?php

namespace Cps\Personal\ArchivoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Cps\Personal\ArchivoBundle\Entity\detalle;
use Cps\Personal\ArchivoBundle\Form\detalleType;

/**
 * detalle controller.
 *
 * @Route("/detalle")
 */
class detalleController extends Controller
{
    /**
     * Lists all detalle entities.
     *
     * @Route("/", name="detalle_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $detalles = $em->getRepository('CpsPerArchivoBundle:detalle')->findAll();

        return $this->render('detalle/index.html.twig', array(
            'detalles' => $detalles,
        ));
    }

    /**
     * Creates a new detalle entity.
     *
     * @Route("/new", name="detalle_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $detalle = new detalle();
        $form = $this->createForm('Cps\Personal\ArchivoBundle\Form\detalleType', $detalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $detalle->getArchivo();

            // Generar un numbre único para el archivo antes de guardarlo
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Mover el archivo al directorio donde se guardan los archivos
            $Dir = $this->container->getparameter('dir.upload.perarc').'/FileVirtual';
            $file->move($Dir, $fileName);

            // Actualizar la propiedad curriculum para guardar el nombre de archivo PDF
            // en lugar de sus contenidos
            $detalle->setArchivo($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($detalle);
            $em->flush();

            return $this->redirectToRoute('detalle_show', array('id' => $detalle->getId()));
        }

        return $this->render('detalle/new.html.twig', array(
            'detalle' => $detalle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a detalle entity.
     *
     * @Route("/{id}", name="detalle_eliminar")
     * @Method("GET")
     */
    public function EliminarAction(detalle $detalle, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $nro = $detalle->getArchivoc();
        $adasd= $nro;
        if ($detalle->getEstado() == 1) {
            $detalle->setEstado(0);
            $em->persist($detalle);
            $em->flush();
            $this->addFlash('mensaje','Se ha Eliminado Correctamente!.');
            return $this->redirect($request->getUri());
        }
        return $this->redirectToRoute('archivo_show', array('id' => $detalle->getArchivoc()->getId()));
    }

    /**
     * Finds and displays a detalle entity.
     *
     * @Route("/{id}", name="detalle_show")
     * @Method("GET")
     */
    public function showAction(detalle $detalle)
    {
        $deleteForm = $this->createDeleteForm($detalle);

        return $this->render('detalle/show.html.twig', array(
            'detalle' => $detalle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing detalle entity.
     *
     * @Route("/{id}/edit", name="detalle_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, detalle $detalle)
    {
        $deleteForm = $this->createDeleteForm($detalle);
        $editForm = $this->createForm('Cps\Personal\ArchivoBundle\Form\detalleType', $detalle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($detalle);
            $em->flush();

            return $this->redirectToRoute('detalle_edit', array('id' => $detalle->getId()));
        }

        return $this->render('detalle/edit.html.twig', array(
            'detalle' => $detalle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a detalle entity.
     *
     * @Route("/{id}", name="detalle_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, detalle $detalle)
    {
        $form = $this->createDeleteForm($detalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($detalle);
            $em->flush();
        }

        return $this->redirectToRoute('detalle_index');
    }

    /**
     * Creates a form to delete a detalle entity.
     *
     * @param detalle $detalle The detalle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(detalle $detalle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('detalle_delete', array('id' => $detalle->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
