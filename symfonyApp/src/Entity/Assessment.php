<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssessmentRepository")
 */
class Assessment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $assessment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Answer", inversedBy="assessments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $answer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ExamStatus", inversedBy="assessments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $examStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssessment(): ?int
    {
        return $this->assessment;
    }

    public function setAssessment(int $assessment): self
    {
        $this->assessment = $assessment;

        return $this;
    }

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(?Answer $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getExamStatus(): ?ExamStatus
    {
        return $this->examStatus;
    }

    public function setExamStatus(?ExamStatus $examStatus): self
    {
        $this->examStatus = $examStatus;

        return $this;
    }
}
