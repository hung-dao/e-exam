<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionInExamRepository")
 */
class QuestionInExam
{
   /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="questionInExams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Exam", inversedBy="questionInExams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $exam;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StudentAnswer", mappedBy="questionInExam")
     */
    private $studentAnswers;

    public function __construct()
    {
        $this->studentAnswers = new ArrayCollection();
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

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

    /**
     * @return Collection|StudentAnswer[]
     */
    public function getStudentAnswers(): Collection
    {
        return $this->studentAnswers;
    }

    public function addStudentAnswer(StudentAnswer $studentAnswer): self
    {
        if (!$this->studentAnswers->contains($studentAnswer)) {
            $this->studentAnswers[] = $studentAnswer;
            $studentAnswer->setQuestionInExam($this);
        }

        return $this;
    }

    public function removeStudentAnswer(StudentAnswer $studentAnswer): self
    {
        if ($this->studentAnswers->contains($studentAnswer)) {
            $this->studentAnswers->removeElement($studentAnswer);
            // set the owning side to null (unless already changed)
            if ($studentAnswer->getQuestionInExam() === $this) {
                $studentAnswer->setQuestionInExam(null);
            }
        }

        return $this;
    }
}
