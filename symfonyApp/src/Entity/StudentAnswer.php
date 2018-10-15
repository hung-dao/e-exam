<?php
// answer of student
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

    // determine if this answer is true or false
    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $result;

    // student
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="studentAnswer", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="studentAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Answer", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $answer;

    /**
     * @ORM\ManyToOne(targetEntity="ExamForStudent", inversedBy="AnswersSheet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $examForStudent;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getResult(): ?boolean
    {
        return $this->result;
    }

    public function setResult($result): self
    {
        $this->result = $result;
        return $this;
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

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(Answer $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getExamForStudent(): ?ExamForStudent
    {
        return $this->examForStudent;
    }

    public function setExamForStudent(?ExamForStudent $examForStudent): self
    {
        $this->examForStudent = $examForStudent;

        return $this;
    }
}
