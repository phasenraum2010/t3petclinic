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
 * Pet
 */
class Pet extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * birthdate
     *
     * @var \DateTime
     */
    protected $birthdate = null;

    /**
     * owner
     *
     * @var \ThomasWoehlke\T3petclinic\Domain\Model\Owner
     */
    protected $owner = null;

    /**
     * petType
     *
     * @var \ThomasWoehlke\T3petclinic\Domain\Model\PetType
     */
    protected $petType = null;

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
     * Returns the birthdate
     *
     * @return \DateTime $birthdate
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Sets the birthdate
     *
     * @param \DateTime $birthdate
     * @return void
     */
    public function setBirthdate(\DateTime $birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * Returns the owner
     *
     * @return \ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Sets the owner
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner
     * @return void
     */
    public function setOwner(\ThomasWoehlke\T3petclinic\Domain\Model\Owner $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Returns the petType
     *
     * @return \ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType
     */
    public function getPetType()
    {
        return $this->petType;
    }

    /**
     * Sets the petType
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType
     * @return void
     */
    public function setPetType(\ThomasWoehlke\T3petclinic\Domain\Model\PetType $petType)
    {
        $this->petType = $petType;
    }
}
