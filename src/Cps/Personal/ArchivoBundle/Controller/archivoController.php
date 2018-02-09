<?php

namespace Cps\Personal\ArchivoBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Cps\Personal\ArchivoBundle\Entity\archivo;
use Cps\Personal\ArchivoBundle\Entity\Empleado;
use Cps\Personal\ArchivoBundle\Entity\detalle;
use Cps\Personal\PlanillaBundle\Entity\Auxempleado;
use Cps\Personal\ArchivoBundle\Form\archivoType;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Cps\Personal\ArchivoBundle\Form\busfunType as Type;
/**
 * archivo controller.
 *
 * @Route("/archivo")
 */
class archivoController extends Controller
{
    /**
     * Lists all archivo entities.
     *
     * @Route("/", name="archivo_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $searchQuery = $request->get('query');
        $em = $this->getDoctrine()->getManager();
        $lista = array(); $cont=0;
        $archivos = $em->getRepository('CpsPerArchivoBundle:archivo')->FiltrarPer($searchQuery);
        foreach ($archivos as $value) {
          $nro = $value->getNroempleado();
          $lista[$cont]['id'] = $value->getId();
          $lista[$cont]['fecha'] = $value->getFecha();
          $lista[$cont]['nroempleado'] = $nro;
          $lista[$cont]['glosa'] = $value->getGlosa();

          $empleado = $em->getRepository('CpsPerArchivoBundle:Empleado')->findOneBy( array('id' => $nro ));
          $lista[$cont]['nombre'] = $empleado->getNomCompletoNPM();
          $Auxempleado = $em->getRepository('CpsPerPlanillaBundle:Auxempleado')->findOneBy( array('empleado' => $nro ));
          $cargo = "Ninguno";
          $item = "Ninguno";
          if ($Auxempleado != null) {
             $cargo = $Auxempleado->getCargo();
             $item = $Auxempleado->getItem();
          }
          $lista[$cont]['cargo'] = $cargo;
          $lista[$cont]['item'] = $item;
          $cont++;
        }
        return $this->render('archivo/index.html.twig', array(
            'archivos' => $lista,
        ));
    }

     /**
     * Lists all archivo entities.
     *
     * @Route("/search", name="busemp")
     * @Method({"GET", "POST"})
     */
    public function busempAction(Request $request)
    {
        $formbus = $this->createForm(new Type());
        $formbus->bind($request);
        if ($formbus->isSubmitted() && $formbus->isValid()) {
            $data=$formbus->getData();
            $em = $this->getDoctrine()->getManager();
            $empleados = $em->getRepository('CpsPerArchivoBundle:Empleado')->findOneBy(array('id' => $data['filtro'] ));
            $ASD="ASD";
            return $this->redirectToRoute('archivo_new');
        }
        return $this->render('archivo/busemp.html.twig', array(
            'form' => $formbus->createView(),
        ));
    }
    /**
     * Creates a new archivo entity.
     *
     * @Route("/new", name="archivo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fchAct = new \Datetime("now");
        $archivo = new archivo();
        $archivo->setFecha($fchAct);
        $form = $this->createForm('Cps\Personal\ArchivoBundle\Form\archivoType', $archivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($archivo);
            $em->flush();
            return $this->redirectToRoute('archivo_index');
            //return $this->redirectToRoute('archivo_show', array('id' => $archivo->getId()));
        }

        return $this->render('archivo/new.html.twig', array(
            'archivo' => $archivo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a archivo entity.
     *
     * @Route("/{id}", name="archivo_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(archivo $archivo, Request $request)
    {
        $archivo_id = $archivo->getId();
        $em = $this->getDoctrine()->getManager();
        $nroempleado= $archivo->getNroempleado();
        $deleteForm = $this->createDeleteForm($archivo);

        $empleado = $em->getRepository('CpsPerArchivoBundle:Empleado')->findOneBy( array('id' => $nroempleado ));
        $Auxempleado = $em->getRepository('CpsPerPlanillaBundle:Auxempleado')->findOneBy( array('empleado' => $nroempleado ));
        if ($Auxempleado == null) {
          $Auxempleado = array('carHoraria'=> 'ninguno','totGanado' => "ninguno",'cargo' => 'ninguno','ingresoEl' => 'ninguno', 'item' => 'ninguno');
        }
        $detalle = new detalle();
        $form = $this->createForm('Cps\Personal\ArchivoBundle\Form\detalleType', $detalle);
        $form->handleRequest($request);
        $idArch = $em->getRepository('CpsPerArchivoBundle:archivo')->find($archivo_id);
        $detalle1 = $em->getRepository('CpsPerArchivoBundle:archivo')->detalle1($archivo_id);
        $detalle2 = $em->getRepository('CpsPerArchivoBundle:archivo')->detalle2($archivo_id);
        $detalle3 = $em->getRepository('CpsPerArchivoBundle:archivo')->detalle3($archivo_id);
        $detalle4 = $em->getRepository('CpsPerArchivoBundle:archivo')->detalle4($archivo_id);
        $detalle5 = $em->getRepository('CpsPerArchivoBundle:archivo')->detalle5($archivo_id);

        if ($form->isSubmitted() && $form->isValid()) {
            $data=$form->getData();
            $Nombre=$data->getNombre();
            /*********************************************ARCHIVO PDF/IMG******************************************/
            $detalle->setFechareg(new \DateTime("now"));
            $file = $detalle->getArchivo();
            // Generar un numbre único para el archivo antes de guardarlo
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            // Mover el archivo al directorio donde se guardan los pdf
            $Dir = $this->container->getparameter('dir.upload.perarc').'FileVirtual';
            $file->move($Dir, $fileName);
            // Actualizar la propiedad pdf para guardar el nombre de archivo PDF
            // en lugar de sus contenidos
    
            $detalle->setArchivo($fileName);
            $detalle->setEstado(1);
            $detalle->setFechareg(new \DateTime("now"));
            $exten=substr($fileName,-3);
            $detalle->setExt($exten);
            $detalle->setArchivoc($idArch);
            /*****************************************************************************************************/
            $em = $this->getDoctrine()->getManager();
            $em->persist($detalle);
            $em->flush();
            $this->addFlash('mensaje','Se ha registrado correctamente.');
            return $this->redirect($request->getUri());
        }

        return $this->render('archivo/show.html.twig', array(
            'archivo' => $archivo,
            'empleado' => $empleado,
            'detalle1'=>$detalle1,
            'detalle2'=>$detalle2,
            'detalle3'=>$detalle3,
            'detalle4'=>$detalle4,
            'detalle5'=>$detalle5,
            'Auxempleado' => $Auxempleado,
            'delete_form' => $deleteForm->createView(),
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing archivo entity.
     *
     * @Route("/{id}/edit", name="archivo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, archivo $archivo)
    {
        $deleteForm = $this->createDeleteForm($archivo);
        $editForm = $this->createForm('Cps\Personal\ArchivoBundle\Form\archivoType', $archivo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($archivo);
            $em->flush();
            $this->addFlash('mensaje','Se modificado correctamente.');
            return $this->redirectToRoute('archivo_show ', array('id' => $archivo->getId()));
        }

        return $this->render('archivo/edit.html.twig', array(
            'archivo' => $archivo,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a archivo entity.
     *
     * @Route("/{id}", name="archivo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, archivo $archivo)
    {
        $form = $this->createDeleteForm($archivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($archivo);
            $em->flush();
        }

        return $this->redirectToRoute('archivo_index');
    }

    /**
     * Creates a form to delete a archivo entity.
     *
     * @param archivo $archivo The archivo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(archivo $archivo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('archivo_delete', array('id' => $archivo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
