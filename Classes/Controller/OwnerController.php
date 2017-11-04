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
 * OwnerController
 */
class OwnerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * ownerRepository
     *
     * @var \ThomasWoehlke\T3petclinic\Domain\Repository\OwnerRepository
     * @inject
     */
    protected $ownerRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $owners = $this->ownerRepository->findAll();
        $this->view->assign('owners', $owners);
    }

    /**
     * action show
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner
     * @return void
     */
    public function showAction(\ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner)
    {
        $this->view->assign('owner', $owner);
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
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Owner $newOwner
     * @return void
     */
    public function createAction(\ThomasWoehlke\T3petclinic\Domain\Model\Owner $newOwner)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->ownerRepository->add($newOwner);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner
     * @ignorevalidation $owner
     * @return void
     */
    public function editAction(\ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner)
    {
        $this->view->assign('owner', $owner);
    }

    /**
     * action update
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner
     * @return void
     */
    public function updateAction(\ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->ownerRepository->update($owner);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner
     * @return void
     */
    public function deleteAction(\ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->ownerRepository->remove($owner);
        $this->redirect('list');
    }
}
