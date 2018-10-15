<?php
//Exam that student takes
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamForStudentRepository")
 */
class ExamForStudent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $result;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Exam", inversedBy="examForStudents")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $exam;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="examForStudent", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id", unique=true)
     */
    private $user;

    //collection of student answers
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StudentAnswer", mappedBy="examForStudent", cascade={"persist", "remove"})
     */
    private $AnswersSheet;

    public function __construct()
    {
        $this->AnswersSheet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getResult(): ?int
    {
        return $this->result;
    }

    public function setResult(?int $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getExam(): ?Exam
    {
        return $this->exam;
    }

    public function setExam(?Exam $exam): self
    {
        $this->exam = $exam;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|StudentAnswer[]
     */
    public function getAnswersSheet(): Collection
    {
        return $this->AnswersSheet;
    }

    public function addAnswersSheet(StudentAnswer $answersSheet): self
    {
        if (!$this->AnswersSheet->contains($answersSheet)) {
            $this->AnswersSheet[] = $answersSheet;
            $answersSheet->setExamForStudent($this);
        }

        return $this;
    }

    public function removeAnswersSheet(StudentAnswer $answersSheet): self
    {
        if ($this->AnswersSheet->contains($answersSheet)) {
            $this->AnswersSheet->removeElement($answersSheet);
            // set the owning side to null (unless already changed)
            if ($answersSheet->getExamForStudent() === $this) {
                $answersSheet->setExamForStudent(null);
            }
        }

        return $this;
    }
}
