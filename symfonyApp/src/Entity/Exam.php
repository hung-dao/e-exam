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
     * @ORM\Column(type="boolean")
     */
    private $isOpen;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExamForStudent", mappedBy="exam")
     */
    private $examForStudents;

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

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $numberOfQuestions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Question", mappedBy="exams")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="id")
     */
    private $questions;

    public function __construct()
    {
        $this->examForStudents = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->studentAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ExamForStudent[]
     */
    public function getExamForStudents(): Collection
    {
        return $this->examForStudents;
    }

    public function addExamForStudent(ExamForStudent $examForStudent): self
    {
        if (!$this->examForStudents->contains($examForStudent)) {
            $this->examForStudents[] = $examForStudent;
            $examForStudent->setExam($this);
        }

        return $this;
    }

    public function removeExamForStudent(ExamForStudent $examForStudent): self
    {
        if ($this->examForStudents->contains($examForStudent)) {
            $this->examForStudents->removeElement($examForStudent);
            // set the owning side to null (unless already changed)
            if ($examForStudent->getExam() === $this) {
                $examForStudent->setExam(null);
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

    public function getOpenDate(): ?\DateTime
    {
        return $this->openDate;
    }


    public function setOpenDate(\DateTime $openDate): self

    {
        $this->openDate = $openDate;
        return $this;
    }

    public function getNumberOfQuestions(): ?int
    {
        return $this->numberOfQuestions;
    }

    public function setNumberOfQuestions(?int $numberOfQuestions): self
    {
        $numberOfQuestions == null ?
            $this->numberOfQuestions = $this->questions->count() :
            $this->numberOfQuestions = $numberOfQuestions;

        return $this;
    }


    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->addExam($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            $question->removeExam($this);
        }

        return $this;
    }

}

