<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentAnswerRepository")
 */
class StudentAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuestionInExam", inversedBy="studentAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $questionInExam;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionInExam(): ?QuestionInExam
    {
        return $this->questionInExam;
    }

    public function setQuestionInExam(?QuestionInExam $questionInExam): self
    {
        $this->questionInExam = $questionInExam;

        return $this;
    }
}
