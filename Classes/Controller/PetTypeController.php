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
 * PetTypeController
 */
class PetTypeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * petTypeRepository
     *
     * @var \ThomasWoehlke\T3petclinic\Domain\Repository\PetTypeRepository
     * @inject
     */
    protected $petTypeRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $petTypes = $this->petTypeRepository->findAll();
        $this->view->assign('petTypes', $petTypes);
    }

    /**
     * action show
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType
     * @return void
     */
    public function showAction(\ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType)
    {
        $this->view->assign('petType', $petType);
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
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\PetType $newPetType
     * @return void
     */
    public function createAction(\ThomasWoehlke\T3petclinic\Domain\Model\PetType $newPetType)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->petTypeRepository->add($newPetType);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType
     * @ignorevalidation $petType
     * @return void
     */
    public function editAction(\ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType)
    {
        $this->view->assign('petType', $petType);
    }

    /**
     * action update
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType
     * @return void
     */
    public function updateAction(\ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->petTypeRepository->update($petType);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType
     * @return void
     */
    public function deleteAction(\ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->petTypeRepository->remove($petType);
        $this->redirect('list');
    }
}
