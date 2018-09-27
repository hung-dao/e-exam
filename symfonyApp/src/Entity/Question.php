<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $questionText;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Answer", mappedBy="question")
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuestionInExam", mappedBy="question")
     */
    private $questionInExams;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->questionInExams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionText(): ?string
    {
        return $this->questionText;
    }

    public function setQuestionText(string $questionText): self
    {
        $this->questionText = $questionText;

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

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
            $questionInExam->setQuestion($this);
        }

        return $this;
    }

    public function removeQuestionInExam(QuestionInExam $questionInExam): self
    {
        if ($this->questionInExams->contains($questionInExam)) {
            $this->questionInExams->removeElement($questionInExam);
            // set the owning side to null (unless already changed)
            if ($questionInExam->getQuestion() === $this) {
                $questionInExam->setQuestion(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
