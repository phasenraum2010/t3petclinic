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
 * Visit
 */
class Visit extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * date
     *
     * @var \DateTime
     */
    protected $date = null;

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * pet
     *
     * @var \ThomasWoehlke\T3petclinic\Domain\Model\Pet
     */
    protected $pet = null;

    /**
     * Returns the date
     *
     * @return \DateTime $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date
     *
     * @param \DateTime $date
     * @return void
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the pet
     *
     * @return \ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet
     */
    public function getPet()
    {
        return $this->pet;
    }

    /**
     * Sets the pet
     *
     * @param \ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet
     * @return void
     */
    public function setPet(\ThomasWoehlke\T3petclinic\Domain\Model\Pet $pet)
    {
        $this->pet = $pet;
    }
}
