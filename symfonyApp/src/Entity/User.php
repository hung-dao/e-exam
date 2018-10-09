<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;
	
	/**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="smallint")
     */
    private $role;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ExamStatus", mappedBy="user", cascade={"persist", "remove"})
     */
    private $examStatus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Exam", mappedBy="user")
     */
    private $exams;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\StudentAnswer", mappedBy="user", cascade={"persist", "remove"})
     */
    private $studentAnswer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="owner")
     */
    private $question;

    public function __construct()
    {
        $this->exams = new ArrayCollection();
        $this->question = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
	
	public function getPassword(): ?string
                            {
                                return $this->password;
                            }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getExamStatus(): ?ExamStatus
    {
        return $this->examStatus;
    }

    public function setExamStatus(ExamStatus $examStatus): self
    {
        $this->examStatus = $examStatus;

        // set the owning side of the relation if necessary
        if ($this !== $examStatus->getUser()) {
            $examStatus->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Exam[]
     */
    public function getExams(): Collection
    {
        return $this->exams;
    }

    public function addExam(Exam $exam): self
    {
        if (!$this->exams->contains($exam)) {
            $this->exams[] = $exam;
            $exam->setUser($this);
        }

        return $this;
    }

    public function removeExam(Exam $exam): self
    {
        if ($this->exams->contains($exam)) {
            $this->exams->removeElement($exam);
            // set the owning side to null (unless already changed)
            if ($exam->getUser() === $this) {
                $exam->setUser(null);
            }
        }

        return $this;
    }

    public function getStudentAnswer(): ?StudentAnswer
    {
        return $this->studentAnswer;
    }

    public function setStudentAnswer(StudentAnswer $studentAnswer): self
    {
        $this->studentAnswer = $studentAnswer;

        // set the owning side of the relation if necessary
        if ($this !== $studentAnswer->getUser()) {
            $studentAnswer->setUser($this);
        }

        return $this;
    }

    public function getRoles()
    {
        return[
            'ROLE_USER'
        ];
    }
    public function getSalt()
    {
        # code...
    }
    public function eraseCredentials()
    {
        
    }

    public function getQuetions(): ?string
    {
        return $this->quetions;
    }

    public function setQuetions(?string $quetions): self
    {
        $this->quetions = $quetions;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestion(): Collection
    {
        return $this->question;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->question->contains($question)) {
            $this->question[] = $question;
            $question->setOwner($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->question->contains($question)) {
            $this->question->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getOwner() === $this) {
                $question->setOwner(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->getUsername();
    }
}
