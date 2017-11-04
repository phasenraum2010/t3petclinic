<?php
namespace ThomasWoehlke\T3petclinic\Domain\Model;

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
 * Specialty
 */
class Specialty extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * vets
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasWoehlke\T3petclinic\Domain\Model\Vet>
     */
    protected $vets = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->vets = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Adds a Vet
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Vet $vet
     * @return void
     */
    public function addVet(\ThomasWoehlke\T3petclinic\Domain\Model\Vet $vet)
    {
        $this->vets->attach($vet);
    }

    /**
     * Removes a Vet
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Vet $vetToRemove The Vet to be removed
     * @return void
     */
    public function removeVet(\ThomasWoehlke\T3petclinic\Domain\Model\Vet $vetToRemove)
    {
        $this->vets->detach($vetToRemove);
    }

    /**
     * Returns the vets
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasWoehlke\T3petclinic\Domain\Model\Vet> $vets
     */
    public function getVets()
    {
        return $this->vets;
    }

    /**
     * Sets the vets
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasWoehlke\T3petclinic\Domain\Model\Vet> $vets
     * @return void
     */
    public function setVets(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $vets)
    {
        $this->vets = $vets;
    }
}
