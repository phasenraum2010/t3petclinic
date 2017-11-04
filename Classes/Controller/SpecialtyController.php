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
 * SpecialtyController
 */
class SpecialtyController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * specialtyRepository
     *
     * @var \ThomasWoehlke\T3petclinic\Domain\Repository\SpecialtyRepository
     * @inject
     */
    protected $specialtyRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $specialties = $this->specialtyRepository->findAll();
        $this->view->assign('specialties', $specialties);
    }

    /**
     * action show
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Specialty $specialty
     * @return void
     */
    public function showAction(\ThomasWoehlke\T3petclinic\Domain\Model\Specialty $specialty)
    {
        $this->view->assign('specialty', $specialty);
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
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Specialty $newSpecialty
     * @return void
     */
    public function createAction(\ThomasWoehlke\T3petclinic\Domain\Model\Specialty $newSpecialty)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->specialtyRepository->add($newSpecialty);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Specialty $specialty
     * @ignorevalidation $specialty
     * @return void
     */
    public function editAction(\ThomasWoehlke\T3petclinic\Domain\Model\Specialty $specialty)
    {
        $this->view->assign('specialty', $specialty);
    }

    /**
     * action update
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Specialty $specialty
     * @return void
     */
    public function updateAction(\ThomasWoehlke\T3petclinic\Domain\Model\Specialty $specialty)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->specialtyRepository->update($specialty);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Specialty $specialty
     * @return void
     */
    public function deleteAction(\ThomasWoehlke\T3petclinic\Domain\Model\Specialty $specialty)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->specialtyRepository->remove($specialty);
        $this->redirect('list');
    }
}
