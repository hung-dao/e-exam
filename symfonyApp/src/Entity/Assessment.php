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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StudentAnswer", mappedBy="assessment", cascade={"persist", "remove"})
     */
    private $studentAnswer;

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

    public function getStudentAnswer(): ?StudentAnswer
    {
        return $this->studentAnswer;
    }

    public function setStudentAnswer(?StudentAnswer $studentAnswer): self
    {
        $this->studentAnswer = $studentAnswer;

        // set (or unset) the owning side of the relation if necessary
        $newAssessment = $studentAnswer === null ? null : $this;
        if ($newAssessment !== $studentAnswer->getAssessment()) {
            $studentAnswer->setAssessment($newAssessment);
        }

        return $this;
    }
}
