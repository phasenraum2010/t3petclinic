<?php
namespace ThomasWoehlke\T3petclinic\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Thomas Woehlke <thomas@woehlke.org>
 */
class SpecialtyControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ThomasWoehlke\T3petclinic\Controller\SpecialtyController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Controller\SpecialtyController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllSpecialtiesFromRepositoryAndAssignsThemToView()
    {

        $allSpecialties = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $specialtyRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\SpecialtyRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $specialtyRepository->expects(self::once())->method('findAll')->will(self::returnValue($allSpecialties));
        $this->inject($this->subject, 'specialtyRepository', $specialtyRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('specialties', $allSpecialties);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenSpecialtyToView()
    {
        $specialty = new \ThomasWoehlke\T3petclinic\Domain\Model\Specialty();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('specialty', $specialty);

        $this->subject->showAction($specialty);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenSpecialtyToSpecialtyRepository()
    {
        $specialty = new \ThomasWoehlke\T3petclinic\Domain\Model\Specialty();

        $specialtyRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\SpecialtyRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $specialtyRepository->expects(self::once())->method('add')->with($specialty);
        $this->inject($this->subject, 'specialtyRepository', $specialtyRepository);

        $this->subject->createAction($specialty);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenSpecialtyToView()
    {
        $specialty = new \ThomasWoehlke\T3petclinic\Domain\Model\Specialty();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('specialty', $specialty);

        $this->subject->editAction($specialty);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenSpecialtyInSpecialtyRepository()
    {
        $specialty = new \ThomasWoehlke\T3petclinic\Domain\Model\Specialty();

        $specialtyRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\SpecialtyRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $specialtyRepository->expects(self::once())->method('update')->with($specialty);
        $this->inject($this->subject, 'specialtyRepository', $specialtyRepository);

        $this->subject->updateAction($specialty);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenSpecialtyFromSpecialtyRepository()
    {
        $specialty = new \ThomasWoehlke\T3petclinic\Domain\Model\Specialty();

        $specialtyRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\SpecialtyRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $specialtyRepository->expects(self::once())->method('remove')->with($specialty);
        $this->inject($this->subject, 'specialtyRepository', $specialtyRepository);

        $this->subject->deleteAction($specialty);
    }
}
