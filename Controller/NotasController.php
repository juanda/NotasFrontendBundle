<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Nota;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Form\Type\NotaType;

class NotasController extends Controller
{

    public function indexAction()
    {
        $request = $this->getRequest(); // equivalente a $this->get('request');
        $session = $this->get('session');

        $ruta = $request->get('_route');

        switch ($ruta)
        {
            case 'jamn_homepage':

                break;

            case 'jamn_conetiqueta':
                $session->set('busqueda.tipo', 'por_etiqueta');
                $session->set('busqueda.valor', $request->get('etiqueta'));
                $session->set('nota.seleccionada.id', '');

                break;

            case 'jamn_buscar':
                $session->set('busqueda.tipo', 'por_termino');
                $session->set('busqueda.valor', $request->get('termino'));
                $session->set('nota.seleccionada.id', '');

                break;
            case 'jamn_nota':
                $session->set('nota.seleccionada.id', $request->get('id'));
                break;
        }

        list($etiquetas, $notas, $notaSeleccionada) = $this->dameEtiquetasYNotas();

        // creamos un formulario para borrar la nota
        if ($notaSeleccionada instanceof Nota) {
            $deleteForm = $this->createDeleteForm($notaSeleccionada->getId())->createView();
        } else {
            $deleteForm = null;
        }

        return $this->render('JAMNotasFrontendBundle:Notas:index.html.twig', array(
                    'etiquetas' => $etiquetas,
                    'notas' => $notas,
                    'nota_seleccionada' => $notaSeleccionada,
                    'delete_form' => $deleteForm,
                ));
    }

    public function nuevaAction()
    {
        $request = $this->getRequest();
        $session = $this->get('session');

        if ($request->getMethod() == 'POST') {

            // si los datos que vienen en la request son buenos guarda la nota

            $session->setFlash('mensaje', 'Se debería guardar la nota:'
                    . $request->get('nombre') . '. Como aun no disponemos de un
                         servicio para persistir los datos, mostramos la nota 1');

            return $this->redirect($this->generateUrl('jamn_nota', array('id' => 1)));
        }

        list($etiquetas, $notas, $nota_seleccionada) = $this->dameEtiquetasYNotas();

        return $this->render('JAMNotasFrontendBundle:Notas:nueva.html.twig', array(
                    'etiquetas' => $etiquetas,
                    'notas' => $notas,
                    'nota_seleccionada' => $nota_seleccionada,
                ));
    }

    public function editarAction()
    {
        $request = $this->getRequest();
        $id = $request->get('id');
        list($etiquetas, $notas, $nota_seleccionada) = $this->dameEtiquetasYNotas();

        $em = $this->getDoctrine()->getEntityManager();

        $nota = $em->getRepository('JAMNotasFrontendBundle:Nota')->find($id);

        if (!$nota) {
            throw $this->createNotFoundException('No se ha podido encontrar esa nota');
        }

        $editForm = $this->createForm(new NotaType(), $nota);
        $deleteForm = $this->createDeleteForm($id);

        if ($this->getRequest()->getMethod() == "POST") {
            $request = $this->getRequest();

            $editForm->bindRequest($request);

            if ($editForm->isValid()) {
                $usuario = $this->get('security.context')->getToken()->getUser();

                $item = $request->get('item');
                $this->actualizaEtiquetas($nota, $item['tags'], $usuario);

                $nota->setFecha(new \DateTime());

                $file = $editForm['fichero']->getData();

                if ($file) {

                    list($dir, $filename) = $this->moveFile($file);

                    $nota->setNombreFichero($filename);
                    $nota->setRutaFichero($dir);
                }

                $em->persist($nota);

                $em->flush();

                return $this->redirect($this->generateUrl('mn_homepage'));
            }
        }

        return $this->render('JAMNotasFrontendBundle:Notas:editar.html.twig', array(
                    'etiquetas' => $etiquetas,
                    'notas' => $notas,
                    'nota_seleccionada' => $nota,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'edita' => true,
                ));
    }

    public function borrarAction()
    {
        $request = $this->getRequest();
        $session = $this->get('session');
        $form = $this->createDeleteForm($request->get('id'));

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('JAMNotasFrontendBundle:Nota')->find($request->get('id'));

            if (!$entity) {
                throw $this->createNotFoundException('Esa nota no existe.');
            }

            $em->remove($entity);
            $em->flush();

            $session->set('nota.seleccionada.id', '');
        }

        return $this->redirect($this->generateUrl('jamn_homepage'));
    }

    public function miEspacioAction()
    {
        $params = 'Los datos de la página de inicio del espacio premium';
        return $this->render('JAMNotasFrontendBundle:Notas:index', array('params' => $params));
    }

    public function rssAction()
    {
        
    }

    protected function dameEtiquetasYNotas()
    {
        $session = $this->get('session');
        $em = $this->getDoctrine()->getEntityManager();

        $usuario = $this->get('security.context')->getToken()->getUser();


        $busqueda_tipo = $session->get('busqueda.tipo');

        $busqueda_valor = $session->get('busqueda.valor');

        // Etiquetas. Se pillan todas
        $etiquetas = $em->getRepository('JAMNotasFrontendBundle:Etiqueta')->
                findByUsuarioOrderedByTexto($usuario);

        // Notas. Se pillan según el filtro almacenado en la sesión
        if ($busqueda_tipo == 'por_etiqueta' && $busqueda_valor != 'todas') {
            $notas = $em->getRepository('JAMNotasFrontendBundle:Nota')->
                    findByUsuarioAndEtiqueta($usuario, $busqueda_valor);
        } elseif ($busqueda_tipo == 'por_termino') {
            $notas = $em->getRepository('JAMNotasFrontendBundle:Nota')->
                    findByUsuarioAndTermino($usuario, $busqueda_valor);
        } else {
            $notas = $em->getRepository('JAMNotasFrontendBundle:Nota')->
                    findByUsuarioOrderedByFecha($usuario);
        }

        $nota_seleccionada = null;
        if (count($notas) > 0) {
            $nota_selecionada_id = $session->get('nota.seleccionada.id');
            if (!is_null($nota_selecionada_id) && $nota_selecionada_id != '') {
                $nota_seleccionada = $em->getRepository('JAMNotasFrontendBundle:Nota')->
                        findOneById($nota_selecionada_id);
            } else {
                $nota_seleccionada = $notas[0];
            }
        }

        return array($etiquetas, $notas, $nota_seleccionada);
    }

    protected function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}

