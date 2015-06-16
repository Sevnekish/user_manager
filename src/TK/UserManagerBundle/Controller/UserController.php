<?php

namespace TK\UserManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TK\UserManagerBundle\Entity\User;
use TK\UserManagerBundle\Form\UserType;

use TK\UserManagerBundle\Entity\UserAddress;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{

  /**
   * Lists all User entities.
   *
   * @Route("/", name="user")
   * @Method("GET")
   * @Template()
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();

    $entities = $em->getRepository('TKUserManagerBundle:User')->findAll();

    return array(
      'entities' => $entities,
    );
  }
  /**
   * Creates a new User entity.
   *
   * @Route("/", name="user_create")
   * @Method("POST")
   * @Template("TKUserManagerBundle:User:new.html.twig")
   */
  public function createAction(Request $request)
  {
    $entity = new User();
    $form = $this->createCreateForm($entity);

    // $form->handleRequest($request);
    // if ($form->isValid()) {
    //     echo '<pre>';
    //     exit(\Doctrine\Common\Util\Debug::dump($entity));
    // }

    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
    }

    return array(
      'entity' => $entity,
      'form'   => $form->createView(),
    );
  }

  /**
   * Displays a form to create a new User entity.
   *
   * @Route("/new", name="user_new")
   * @Method("GET")
   * @Template()
   */
  public function newAction()
  {
    $entity = new User();

    $address1 = new UserAddress();
    $entity->getUserAddresses()->add($address1);

    // $address1 = new UserAddress();
    // $address1->setZip('12345');
    // $address1->setCity('Kiev');
    // $entity->getUserAddresses()->add($address1);

    // $address2 = new UserAddress();
    // $address2->setZip('3245');
    // $address2->setCity('Moscow');
    // $entity->getUserAddresses()->add($address2);

    $form   = $this->createCreateForm($entity);

    return array(
      'entity' => $entity,
      'form'   => $form->createView(),
    );
  }

  /**
   * Finds and displays a User entity.
   *
   * @Route("/{id}", name="user_show")
   * @Method("GET")
   * @Template()
   */
  public function showAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('TKUserManagerBundle:User')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find User entity.');
    }

    $deleteForm = $this->createDeleteForm($id);

    return array(
      'entity'      => $entity,
      'delete_form' => $deleteForm->createView(),
    );
  }

  /**
   * Displays a form to edit an existing User entity.
   *
   * @Route("/{id}/edit", name="user_edit")
   * @Method("GET")
   * @Template()
   */
  public function editAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('TKUserManagerBundle:User')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find User entity.');
    }

    $editForm = $this->createEditForm($entity);
    $deleteForm = $this->createDeleteForm($id);

    return array(
      'entity'      => $entity,
      'edit_form'   => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }


  /**
   * Edits an existing User entity.
   *
   * @Route("/{id}", name="user_update")
   * @Method("PUT")
   * @Template("TKUserManagerBundle:User:edit.html.twig")
   */
  public function updateAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('TKUserManagerBundle:User')->find($id);

    if (!$entity) {
      throw $this->createNotFoundException('Unable to find User entity.');
    }

    $originalUserAddresses = new ArrayCollection();
    $originalPassword = $entity->getPassword();

    foreach ($entity->getUserAddresses() as $userAdress) {
      $originalUserAddresses->add($userAdress);
    }

    $deleteForm = $this->createDeleteForm($id);
    $editForm = $this->createEditForm($entity);
    $editForm->handleRequest($request);

    /////////////////////////////
    // if ($editForm->isValid()) {
    //     echo '<pre>';
    //     exit(\Doctrine\Common\Util\Debug::dump($originalUserAddresses));
    // }
    ///////////////////////////

    if ($editForm->isValid()) {

      $password = $editForm->get('password')->getData();
      if (empty($password)) {
          $entity->setPassword($originalPassword);
      }
      // filter $originalUserAddresses to contain addresses no longer present
      foreach ($originalUserAddresses as $originalUserAddress) {
        if($entity->getUserAddresses()->contains($originalUserAddress) === false) {
          $entity->removeUserAddress($originalUserAddress);
          $originalUserAddress->setUser(null);
          $em->remove($originalUserAddress);
          // $em->persist($originalUserAddress);
        }
      }
      /////////////////////////////
      // if ($editForm->isValid()) {
      //     echo '<pre>';
      //     exit(\Doctrine\Common\Util\Debug::dump($originalUserAddresses));
      // }
      ///////////////////////////
      $em->persist($entity);
      $em->flush();

      return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
      // return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
    }

    return array(
      'entity'      => $entity,
      'edit_form'   => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    );
  }
  /**
   * Deletes a User entity.
   *
   * @Route("/{id}", name="user_delete")
   * @Method("DELETE")
   */
  public function deleteAction(Request $request, $id)
  {
    $form = $this->createDeleteForm($id);
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('TKUserManagerBundle:User')->find($id);

      if (!$entity) {
        throw $this->createNotFoundException('Unable to find User entity.');
      }

      $em->remove($entity);
      $em->flush();
    }

    return $this->redirect($this->generateUrl('user'));
  }

  /**
   * Creates a form to create a User entity.
   *
   * @param User $entity The entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createCreateForm(User $entity)
  {
    $form = $this->createForm(new UserType(), $entity, array(
      'validation_groups' => array('create'),
      'action' => $this->generateUrl('user_create'),
      'method' => 'POST',
    ));
    $form->add('password', 'repeated', array(
              'validation_groups' => array('create'),
              'type' => 'password',
              'invalid_message' => 'The password fields must match.',
              'options' => array('attr' => array('class' => 'password-field')),
              'required' => true,
              'first_options'  => array('label' => 'Password'),
              'second_options' => array('label' => 'Repeat Password')
    ));
    // $form->add('password', 'repeated', array(
    //           'type' => 'password',
    //           'invalid_message' => 'The password fields must match.',
    //           'options' => array('attr' => array('class' => 'password-field')),
    //           'required' => false,
    //           'first_options'  => array('label' => 'Password'),
    //           'second_options' => array('label' => 'Repeat Password')
    // ));

    $form->add('submit', 'submit', array('label' => 'Create'));

    return $form;
  }

  /**
  * Creates a form to edit a User entity.
  *
  * @param User $entity The entity
  *
  * @return \Symfony\Component\Form\Form The form
  */
  private function createEditForm(User $entity)
  {
    $form = $this->createForm(new UserType(), $entity, array(
      'action' => $this->generateUrl('user_update', array('id' => $entity->getId())),
      'method' => 'PUT',
    ));

    $form->add('password', 'repeated', array(
              'type' => 'password',
              'invalid_message' => 'The password fields must match.',
              'options' => array('attr' => array('class' => 'password-field')),
              'required' => false,
              'first_options'  => array('label' => 'Password'),
              'second_options' => array('label' => 'Repeat Password')
    ));

    $form->add('submit', 'submit', array('label' => 'Update'));

    return $form;
  }

  /**
   * Creates a form to delete a User entity by id.
   *
   * @param mixed $id The entity id
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm($id)
  {
    return $this->createFormBuilder()
      ->setAction($this->generateUrl('user_delete', array('id' => $id)))
      ->setMethod('DELETE')
      ->add('submit', 'submit', array('label' => 'Delete'))
      ->getForm()
    ;
  }
}
