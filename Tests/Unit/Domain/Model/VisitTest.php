<?php
namespace ThomasWoehlke\T3petclinic\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Thomas Woehlke <thomas@woehlke.org>
 */
class VisitTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ThomasWoehlke\T3petclinic\Domain\Model\Visit
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ThomasWoehlke\T3petclinic\Domain\Model\Visit();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getDateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getDate()
        );
    }

    /**
     * @test
     */
    public function setDateForDateTimeSetsDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setDate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'date',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'description',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPetReturnsInitialValueForPet()
    {
        self::assertEquals(
            null,
            $this->subject->getPet()
        );
    }

    /**
     * @test
     */
    public function setPetForPetSetsPet()
    {
        $petFixture = new \ThomasWoehlke\T3petclinic\Domain\Model\Pet();
        $this->subject->setPet($petFixture);

        self::assertAttributeEquals(
            $petFixture,
            'pet',
            $this->subject
        );
    }
}
