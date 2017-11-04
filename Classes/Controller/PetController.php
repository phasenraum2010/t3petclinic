<?php
namespace ThomasWoehlke\T3petclinic\Controller;

/***
 *
 * This file is part of the "T3Petclinic" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017 Thomas Woehlke <thomas@woehlke.org>, ]init[ AG
 *
 ***/

/**
 * PetController
 */
class PetController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * petRepository
     *
     * @var \ThomasWoehlke\T3petclinic\Domain\Repository\PetRepository
     * @inject
     */
    protected $petRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $pets = $this->petRepository->findAll();
        $this->view->assign('pets', $pets);
    }

    /**
     * action show
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet
     * @return void
     */
    public function showAction(\ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet)
    {
        $this->view->assign('pet', $pet);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Pet $newPet
     * @return void
     */
    public function createAction(\ThomasWoehlke\T3petclinic\Domain\Model\Pet $newPet)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->petRepository->add($newPet);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet
     * @ignorevalidation $pet
     * @return void
     */
    public function editAction(\ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet)
    {
        $this->view->assign('pet', $pet);
    }

    /**
     * action update
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet
     * @return void
     */
    public function updateAction(\ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->petRepository->update($pet);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet
     * @return void
     */
    public function deleteAction(\ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->petRepository->remove($pet);
        $this->redirect('list');
    }
}
