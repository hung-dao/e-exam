<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamRepository")
 */
class Exam
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOpen;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionInExam", mappedBy="exam")
     */
    private $questionInExams;

    public function __construct()
    {
        $this->questionInExams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIsOpen(): ?bool
    {
        return $this->isOpen;
    }

    public function setIsOpen(bool $isOpen): self
    {
        $this->isOpen = $isOpen;

        return $this;
    }

    /**
     * @return Collection|QuestionInExam[]
     */
    public function getQuestionInExams(): Collection
    {
        return $this->questionInExams;
    }

    public function addQuestionInExam(QuestionInExam $questionInExam): self
    {
        if (!$this->questionInExams->contains($questionInExam)) {
            $this->questionInExams[] = $questionInExam;
            $questionInExam->setExam($this);
        }

        return $this;
    }

    public function removeQuestionInExam(QuestionInExam $questionInExam): self
    {
        if ($this->questionInExams->contains($questionInExam)) {
            $this->questionInExams->removeElement($questionInExam);
            // set the owning side to null (unless already changed)
            if ($questionInExam->getExam() === $this) {
                $questionInExam->setExam(null);
            }
        }

        return $this;
    }
}
<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamRepository")
 */
class Exam
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isOpen;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionInExam", mappedBy="exam")
     */
    private $questionInExams;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExamStatus", mappedBy="exam")
     */
    private $examStatuses;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="exams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPublic;

    /**
     * @ORM\Column(type="date")
     */
    private $openDate;

    public function __construct()
    {
        $this->questionInExams = new ArrayCollection();
        $this->examStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIsOpen(): ?bool
    {
        return $this->isOpen;
    }

    public function setIsOpen(bool $isOpen): self
    {
        $this->isOpen = $isOpen;

        return $this;
    }

    /**
     * @return Collection|QuestionInExam[]
     */
    public function getQuestionInExams(): Collection
    {
        return $this->questionInExams;
    }

    public function addQuestionInExam(QuestionInExam $questionInExam): self
    {
        if (!$this->questionInExams->contains($questionInExam)) {
            $this->questionInExams[] = $questionInExam;
            $questionInExam->setExam($this);
        }

        return $this;
    }

    public function removeQuestionInExam(QuestionInExam $questionInExam): self
    {
        if ($this->questionInExams->contains($questionInExam)) {
            $this->questionInExams->removeElement($questionInExam);
            // set the owning side to null (unless already changed)
            if ($questionInExam->getExam() === $this) {
                $questionInExam->setExam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ExamStatus[]
     */
    public function getExamStatuses(): Collection
    {
        return $this->examStatuses;
    }

    public function addExamStatus(ExamStatus $examStatus): self
    {
        if (!$this->examStatuses->contains($examStatus)) {
            $this->examStatuses[] = $examStatus;
            $examStatus->setExam($this);
        }

        return $this;
    }

    public function removeExamStatus(ExamStatus $examStatus): self
    {
        if ($this->examStatuses->contains($examStatus)) {
            $this->examStatuses->removeElement($examStatus);
            // set the owning side to null (unless already changed)
            if ($examStatus->getExam() === $this) {
                $examStatus->setExam(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(?bool $isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getOpenDate(): ?\DateTimeInterface
    {
        return $this->openDate;
    }

    public function setOpenDate(\DateTimeInterface $openDate): self
    {
        $this->openDate = $openDate;

        return $this;
    }
}
