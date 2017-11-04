<?php
namespace ThomasWoehlke\T3petclinic\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Thomas Woehlke <thomas@woehlke.org>
 */
class SpecialtyTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ThomasWoehlke\T3petclinic\Domain\Model\Specialty
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ThomasWoehlke\T3petclinic\Domain\Model\Specialty();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getVetsReturnsInitialValueForVet()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getVets()
        );
    }

    /**
     * @test
     */
    public function setVetsForObjectStorageContainingVetSetsVets()
    {
        $vet = new \ThomasWoehlke\T3petclinic\Domain\Model\Vet();
        $objectStorageHoldingExactlyOneVets = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneVets->attach($vet);
        $this->subject->setVets($objectStorageHoldingExactlyOneVets);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneVets,
            'vets',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addVetToObjectStorageHoldingVets()
    {
        $vet = new \ThomasWoehlke\T3petclinic\Domain\Model\Vet();
        $vetsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $vetsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($vet));
        $this->inject($this->subject, 'vets', $vetsObjectStorageMock);

        $this->subject->addVet($vet);
    }

    /**
     * @test
     */
    public function removeVetFromObjectStorageHoldingVets()
    {
        $vet = new \ThomasWoehlke\T3petclinic\Domain\Model\Vet();
        $vetsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $vetsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($vet));
        $this->inject($this->subject, 'vets', $vetsObjectStorageMock);

        $this->subject->removeVet($vet);
    }
}
